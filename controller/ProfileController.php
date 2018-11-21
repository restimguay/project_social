<?php

namespace controller;

use form\AddressForm;
use table\MemberDetail;
use helper\Web;


class ProfileController extends BaseController
{
    public function detailsAction(){
        if(!isset($_GET['section'])){
            header("HTTP/1.0 404 Not Found");
        }
        $section =  $_GET['section'];
        $form = null;
        $user_id = Web::user()->id;
        switch ($section) {
            case 'address':
                $member_detail_forms = [];
                if($this->isPost()){
                    $form = new AddressForm();
                    if($form->validate()){
                        $form->save();
                        header('location:?profile/details&section=address');
                    }
                    $member_detail_forms[]=$form;
                }else{
                    $mem_detials = new MemberDetail();
                    $addresses = $mem_detials->find_all_by_parameter(['member_id'=> $user_id,'detail_type'=>'address']);
                    foreach($addresses as $obj){
                        $mem_det = new AddressForm();
                        $mem_det->load($obj);
                        $member_detail_forms[]=$mem_det;
                    }
                }
                $content = $this->render_partial('profile/details/address',['forms'=>$member_detail_forms]);
                $this->render('layout/main',['content'=>$content]);
                break;            
            default:
                # code...
                break;
        }
    }
}