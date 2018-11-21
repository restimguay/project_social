<?php

namespace controller;

use helper\User;
use helper\Web;


class Controller extends BaseController
{
    public function indexAction(){
        $user = Web::user();
        $content='';
        if(!$user->is_guest()){
            $content = $this->render_partial('site/login');
        }else{
            $content = $this->render_partial('site/index');
        }
        $this->render('layout/main',['content'=>$content]);
    }
    
}