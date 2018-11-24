<?php

namespace form;

class RegisterForm extends BaseForm
{
    public $email;
    public $first_name;
    public $surname;
    public $hash_password;
    public $hash_password1;

    public function rules(){
        return [
            'required'=>['hash_password','hash_password1','email','first_name','surname'],
            'email'=>['email'],
        ];
    }

    public function labels()
    {
        return [            
            'first_name'=>'First Name',
            'surname'=>'Surname',
            'email'=>'e-mail',
            'hash_password'=>'Password',
            'hash_password1'=>'Verify Password',
        ];
    }
}