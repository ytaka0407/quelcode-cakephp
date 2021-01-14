<?php

namespace App\Controller;

use App\Controller\AppController;

class HelloController extends AppController
{

    public function index()
    {
        $this->viewbuilder()->autoLayout(false);
        $values = [
            'title' => 'Hello!',
            'message' => 'this is message'
        ];
        $this->set($values);
    }

    public function form(){
        $this->viewBuilder()->autoLayout=false;
        $name=$this->request->data['name'];
        $mail=$this->request->data['mail'];
        $age=$this->request->data['age'];
        $res='Hello!'.$name.'('.$age.')'.'your e-mail address is '.$mail.'.';
        $values=[
            'name'=>$name,'mail'=>$mail,'age'=>$age,'res'=>$res
        ];
        $this->set(compact('values'))
        }

}
