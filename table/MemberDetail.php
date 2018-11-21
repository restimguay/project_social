<?php

namespace table;

class MemberDetail extends BaseTable
{
    public function __construct($parameter=[],$limit=1)
    {
        parent::__construct('member_detail','detail_id');
        if(count($parameter)>0){
            if($limit==1){
                $this->find_one_by_parameter($parameter);
            }else{
                return $this->find_all_by_parameter($parameter);
            }
        }
    }
}