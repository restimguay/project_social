<?php

namespace form;

use helper\Web;


class AddressForm extends BaseMemberDetails
{
    public $detail_type='address';
    public function __construct()
    {
        parent::__construct();
        $this->member_id = Web::user()->id;
        $this->update_date=time();
    }
    public function rules()
    {
        return [
            'required'=>['description']
        ];
    }
    public function labels(){
        return [];
    }
    
}