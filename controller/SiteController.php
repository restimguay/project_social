<?php

namespace controller;

use helper\Web;
use form\LoginForm;
use helper\User;


class SiteController extends BaseController
{
    public function loginAction(){
        $user = Web::user();
        
        if($user->is_guest()){
            $login_form = new LoginForm();
            if($login_form->validate()){
                $user = new User();
                $hash_password = md5($login_form->hash_password);
                if($user->login($login_form->email, $hash_password,$login_form->remember)){
                    header('location:?site/index');
                    return;
                }
            }
            $content = $this->render_partial('site/login',['form'=>$login_form]);
        }else{
            $content = $this->render_partial('site/index');
        }
        $this->render('layout/main',['content'=>$content]);
    }
    public function logoutAction(){
        Web::user()->logout();
        header('location:?site/index');
    }

    public function indexAction(){
        
        $user = Web::user();
        
        if($user->is_guest()){
            $login_form = new LoginForm();
            if($login_form->validate()){
                $user = new User();
                $hash_password = md5($login_form->hash_password);
                $user->login($login_form->email, $hash_password,$login_form->remember);
            }
            $content = $this->render_partial('site/login',['form'=>$login_form]);
        }else{

            $content = $this->render_partial('site/index');
        }
        $this->render('layout/main',['content'=>$content]);
    }
}