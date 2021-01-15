<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Database\Expression\ValuesExpression;

class HelloController extends AppController
{

    public function index()
    {
        $this->viewbuilder()->autoLayout(false);
        $this->set('title', 'Hello');
        if ($this->request->isPost()) {
            $this->set('data', $this->request->data['Form1']);
        } else {
            $this->set('data', []);
        }
    }

    public function form()
    {
        $this->viewbuilder()->autoLayout(false);
        $name = $this->request->data['name'];
        $mail = $this->request->data['mail'];
        $age = $this->request->data['age'];
        $res = 'Hello!' . $name . '(' . $age . ')' . 'your e-mail address is ' . $mail . '.';
        $values = [
            'title' => 'result',
            'res' => $res
        ];
        $this->set($values);
    }
}
