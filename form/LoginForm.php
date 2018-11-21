<?php

namespace form;

class LoginForm extends BaseForm
{
    public $hash_password;
    public $password;
    public $email;
    public $remember;
    public function __construct()
    {
        parent::__construct();
    }

    public function rules(){
        return [
            'required'=>['password','email'],
        ];
    }

    public function labels(){
        return [
            'password'=>'Password',
            'email'=>'E-mail',
        ];
    }
}