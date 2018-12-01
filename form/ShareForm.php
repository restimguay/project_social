<?php

namespace form;

class ShareForm extends BaseForm
{
    public $message;

    public function rules(){
        return [
            'required'=>['message'],
        ];
    }

    public function labels()
    {
        return [
            'message'=>'Message',
        ];
    }
}