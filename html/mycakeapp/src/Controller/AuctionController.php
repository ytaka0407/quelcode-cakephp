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

        $this->viewBuilder()->setLayout('action');
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

        if ($biditem->endtime < new \DateTime('now') and $biditem->finised == 0) {
            //finishedを1に変更して保存
            $biditem->finished = 1;
            $this->Biditems->save($biditem);
            //Biidinfoの空のエンティティを作成する
            $bidinfo = $this->Bidinfo->newEntity();
            //Bidinfoのbiditem_idに$idを設定。
            //エンティティは$biditem_idだけに値がある状態。
            $bidinfo->biditem_id = $id;
            //bidinfoに入れるために最高金額のBidrequestのデータをまとめて取得
            $bidrequest = $this->Bidrequests->find(
                'all',
                ['conditions' => ['biditem_id' => $id]],
                ['contain' => ['users']],
                ['order' => ['price' => 'desc']]
            )->first();
            if (!empty($bidrequest)) {
                //エンティティ$bidinfoの各種プロパティを設定して保存する
                $bidinfo->user_id = $bidrequest->user_id;
                //$bidinfo->user=$bidrequest->user; 教科書にあるけどいらないのでは？
                $bidinfo->price = $bidrequest->price;
                $this->Bidinfo->save($bidinfo);
            }
            //変数$biditemのbidinfoに$bidinfoを設定
            $biditem->bidinfo = $$bidinfo;
        }
        //Bidrequestからbiditem_idが$idのものを取得
        $bidrequest = $this->Bidrequests->find('all', [
            'conditions' => ['price' => 'desc'],
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

    //入札処理(ここから)
}
