<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Database\Expression\ValuesExpression;

class HelloController extends AppController
{
    public function initialize()
    {
        $this->viewBuilder()->setlayout('hello');
    }

    public function index()
    {
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
