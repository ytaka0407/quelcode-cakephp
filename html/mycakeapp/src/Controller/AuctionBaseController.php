<?php

namespace App\Controller;


use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Event\Event;

class AuctionBaseController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent(
            'Auth',
            [
                'authrize' => ['Controller'],
                'authenticate' => [
                    'Form' => [
                        'fields' => [
                            'username' => 'username',
                            'password' => 'password'
                        ]
                    ]
                ]
            ],
            [
                'loginRedirect' => [
                    'controller' => 'Users',
                    'action' => 'login'
                ],
                'logoutRedirect' => [
                    'controller' => 'Users',
                    'action' => 'logout'
                ],
                'authError' => 'ログインしてください。',
            ]
        );
    }


    function login()
    {
        if ($this->request->isPost()) {
            $user = $this->Auth->identify();
            if (!empty($user)) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('ユーザー名かパスワードが間違っています。');
        }
    }

    function logout()
    {
        $this->request->session->destroy();
        return $this->redirect($this->Auth->logout());
    }

    //認証しないページの設定
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow([]);
    }

    //認証時のロール処理
    public function isAuthorized($user = null)
    {
        if (($user['role']) === 'admin') {
            return true;
        }

        if (($user['role']) === 'admin') {
            if ($this->name == 'Auction') {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
}
