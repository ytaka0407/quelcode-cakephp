<?php

namespace App\Controller;


use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Excepction;

class AuctionController extends AuctionBaseController
{
    //デフォルトテーブルを使わない
    public $useTable = false;

    //初期化
    public function initialize()
    {
        parent::initialize();

        //ページネータ―のコンポーネントをロード
        $this->loadComponent('Paginator');
        //必要なモデルをすべてロード
        $this->loadModel('Users');
        $this->loadModel('Biditems');
        $this->loadModel('Bidrequests');
        $this->loadModel('Bidinfo');
        $this->loadModel('Bidmessages');

        $this->set('authuser', $this->Auth->user());

        $this->viewBuilder()->setLayout('auction');
    }

    public function index()
    {
        $auction = $this->paginate('Biditems', [
            'order' => ['endtime' => 'desc'],
            'limit' => 10
        ]);
        $this->set(compact('auction'));
    }


    //商品情報の表示。containで他のテーブルのデータも一緒に取得
    public function view($id = null)
    {
        $biditem = $this->Biditems->get($id, [
            'contain' => ['Users', 'Bidinfo', 'Bidinfo.Users']
        ]);

        //終わったオークションの情報を更新
        if ($biditem->endtime < new \DateTime('now') and $biditem->finished == 0) {
            //finishedを1に変更して保存
            $biditem->finished = 1;
            $this->Biditems->save($biditem);
            //Biidinfoの空のエンティティを作成する
            $bidinfo = $this->Bidinfo->newEntity();
            //Bidinfoのbiditem_idに$idを設定。
            //エンティティは$biditem_idだけに値がある状態。
            $bidinfo->biditem_id = $id;
            //bidinfoに入れるために最高金額のBidrequestのデータをまとめて取得
            $bidrequest = $this->Bidrequests->find('all', [
                'conditions' => ['biditem_id' => $id],
                'contain' => ['users'],
                'order' => ['price' => 'desc']
            ])->first();
            if (!empty($bidrequest)) {
                //エンティティ$bidinfoの各種プロパティを設定して保存する
                $bidinfo->user_id = $bidrequest->user->id;
                //$bidinfo->user=$bidrequest->user; 教科書にあるけどいらないのでは？
                $bidinfo->user = $bidrequest->user;
                $bidinfo->price = $bidrequest->price;
                $this->Bidinfo->save($bidinfo);
            }
            //変数$biditemのbidinfoに$bidinfoを設定
            $biditem->bidinfo = $bidinfo;
        }
        //Bidrequestからbiditem_idが$idのものを取得
        $bidrequests = $this->Bidrequests->find('all', [
            'conditions' => ['biditem_id' => $id],
            'contain' => ['Users'],
            'order' => ['price' => 'desc']
        ])->toArray();
        //オブジェクト類をテンプレート用に設定
        $this->set(compact('biditem', 'bidrequests'));
    }

    //出品する処理
    public function add()
    {
        //Biditemインスタンスを用意
        $biditem = $this->Biditems->newEntity();
        //POST送信時
        if ($this->request->is('post')) {
            $biditem = $this->Biditems->PatchEntity($biditem, $this->request->getData());
            //エンティティ保存
            if ($this->Biditems->save($biditem)) {
                $this->Flash->success(__('保存しました'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('保存失敗しました。再度ご入力下さい'));
        }
        $this->set(compact('biditem'));
    }

    //入札処理
    public function bid($biditem_id = null)
    {
        $bidrequest = $this->Bidrequests->newentity();
        $bidrequest->biditem_id = $biditem_id;
        $bidrequest->user_id = $this->Auth->user('id');

        if ($this->request->is('post')) {
            $bidrequest = $this->Bidrequests->patchentity($bidrequest, $this->request->getData());
            if ($this->bidrequests->save($bidrequest)) {
                $this->Flash->success(__('入札を送信しました。'));
                return $this->redirect(['action' => 'view', $biditem_id]);
            }
            $this->Flash->error(__('入札に失敗しました。もう一度入力下さい'));
            $biditem = $this->Biditem->get($biditem_id);
            $this->set(compact('bidrequest', 'biditem'));
        }
    }

    public function msg($bidinfo_id = null)
    {
        //newentity
        $bidmsg = $this->Bidmessages->newEntity();
        if ($this->request->is('post')) {
            $bidmsg = $this->Bidmessages->patchEntity($bidmsg, $this->request->getData());

            if ($this->Bidmessages->save($bidmsg)) {
                $this->Flash->success(__('保存しました。'));
            } else {
                $this->Flash->error(__('保存に失敗しました。もう一度入力下さい。'));
            }
            try {
                $bidinfo = $this->Bidinfo->get($bidinfo_id, ['contain' => ['Biditems']]);
            } catch (Exception $e) {
                $bidinfo = null;
            }
            //Bidmessageを$bidinfo_idとuser_idで検索
            $bidmsgs = $this->Bidmessages->find('all', [
                'conditions' => ['bidinfo_id' => $bidinfo_id],
                'contain' => ['Users'],
                'order' => ['created' => 'desc']
            ]);
            $this->set(compact('bidmsg', 'bidinfo', 'bidmsg'));
        }
    }
    public function home()
    {
        $bidinfo = $this->paginate('Bidinfo', [
            'conditions' => ['Bidinfo.user_id' => $this->Auth->user('id')],
            'contain' => ['Users', 'Biditems'],
            'order' => ['created' => 'desc'],
            'limit' => '10'
        ])->toArray();
        $this->set(compact('bidinfo'));
    }

    public function home2()
    {
        $biditems = $this->paginate('Bidinfo', [
            'conditions' => ['Biitems.user_id' => $this->Auth->user('id')],
            'contain' => ['Users', 'Bidingo'],
            'order' => ['created' => 'desc'],
            'limit' => 20
        ])->toArray;
        $this->set(compact('biditems'));
    }
}
