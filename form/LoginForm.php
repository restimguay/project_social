<?php

namespace form;
/**
 * @var string $hash_password
 * @var string $email 
 * @var string $hash_password 
 * @var boolean $remember 
 */
class LoginForm extends BaseForm
{
    /**
     * @var string
     */
    public $hash_password;
    /**
     * @var string
     */
    public $password;
    /**
     * @var string
     */
    public $email;
    /**
     * @var boolean
     */
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