<?php

namespace controller;

use helper\User;
use helper\Web;
use form\LoginForm;


class Controller extends BaseController
{
    public function indexAction(){
        $user = Web::user();
        $content='';
        if(!$user->is_guest()){
            $content = $this->render_partial('site/login',['form'=>new LoginForm()]);
        }else{
            $content = $this->render_partial('site/index');
        }
        $this->render('layout/main',['content'=>$content]);
    }
    
}