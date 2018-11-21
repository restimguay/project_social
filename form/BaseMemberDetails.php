<?php

namespace form;

use table\MemberDetail;


class BaseMemberDetails extends BaseForm
{
    public $detail_id='';
    public $member_id='';
    public $detail_type='';
    public $value = '';
    public $description = '';
    public $from_date='';
    public $to_date='';
    public $view_level='';
    public $set_date = '';
    public $update_date = '';
    public function save(){
        if($this->detail_id==''){
           $mem_detail = new MemberDetail();
           $vars = get_object_vars($this);
           foreach($vars as $key=>$value){
                $mem_detail->$key=$value;
           }
           $mem_detail->insert();
        }else{
            $mem_detail = new MemberDetail(['detail_id'=>$this->detail_id]);
            $vars = get_object_vars($this);
            foreach($vars as $key=>$value){
                 $mem_detail->$key=$value;
            }
            $mem_detail->save();
        }
    }

    public function get_one_by_parameter($parameter){
        return new MemberDetail($parameter);
    }

    public function get_all_by_parameter($parameter){
        return new MemberDetail($parameter,2);
    }
}