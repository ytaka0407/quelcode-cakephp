<?php

namespace App\Controller;

use App\Controller;
use Cake\I18n\Time;

class MessagesController extends AppController
{
    public function index()
    {
        if ($this->request->is('post')) {   //フォームデータがある(投稿された)場合
            $data = $this->request->data['Messages']; //フォームデータ'Messages'配列をdata['Messages']で取得
            $entity = $this->Messages->newEntity($data);   //取得したデータを入れてエンティティのインスタンスを作成
            $entity->created_at = new Time(date('Y-m-d H:i:s')); //作ったエンティティの配列データのcreated_atに時刻を入れる。
            $this->Messages->save($entity); //データ保存。
        } else {
            $entity = $this->Messages->newEntity();       //投稿がない場合は$entityには空のエンティティをセット。
        }
        $data = $this->Messages->find('all')
            ->contain(['People'])       //アソシエーション
            ->order(['created_at' => 'desc']);
        $this->set('data', $data);
        $this->set('entity', $entity);
    }
}
