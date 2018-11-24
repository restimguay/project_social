<?php

namespace form;

class EmailValidateForm extends BaseForm
{
    public $email;
    public $code;
    public function rules()
    {
        return [
            'required'=>['email','code']
        ];
    }

    public function labels(){
        return [
            'email'=>'e-mail',
            'code'=>'Code',
        ];
    }
}