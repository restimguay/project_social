<?php

namespace controller;

use helper\Web;
use form\LoginForm;
use helper\User;
use form\RegisterForm;
use table\Member;
use form\EmailValidateForm;
use form\ShareForm;


class SiteController extends BaseController
{
    public function loginAction(){
        $user = Web::user();
        
        if($user->is_guest()){
            $form = new LoginForm();
            if($form->validate()){
                $user = new User();
                $hash_password = md5($form->hash_password);
                if($user->login($form->email, $hash_password,$form->remember)){                    
                    $this->navigate('site/index');
                }
                $form->add_error('password','Invalid password or email');
            }
            $this->render('layout/content-only',[
                'content'=>$this->render_partial('site/login',['form'=>$form]),
                ]
            );
        }else{
            $this->navigate('site/index');
        }
    }
    public function logoutAction(){
        Web::user()->logout();
        $this->navigate('site/index');
    }

    public function indexAction(){        
        if(Web::user()->is_guest()){
            $this->navigate('site/login');
        }else{
            $this->render('layout/3-column',[
                'content_left'=>$this->render_partial('site/profile'),
                'content'=>$this->render_partial('site/index',[
                    'share'=>$this->render_partial('site/share',['form'=>new ShareForm()])
                    ]),
                'content_right'=>$this->render_partial('site/friends_status'),
            ]);
        }
        
    }

    public function registerAction(){
        //unset($_SESSION['verify_code']);
        if(Web::user()->is_guest()){
            $form = new RegisterForm();
            if($form->validate()){
                $member = new Member();
                $member->find_one_by_parameter(['email'=>$form->email]);
                if($member->has_result()){
                    $form->add_error('email','E-mail is already taken.');
                }else{
                    $user = new User();
                    if($user->register($form)){
                        $member = new Member();
                        $member->find_one_by_parameter(['email'=>$form->email]);
                        $_SESSION['verify_code'] = $member->email_validate_key;
                        
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $headers .= 'From: ' .$form->email. "\r\n";
                        $headers .= 'Return-Path: notify@closepeer.com' . "\r\n";
                        $result = mail($form->email,"Email Verification Code",$_SESSION['verify_code'],$headers);
                        $this->navigate('site/validate');
                    }
                }
            }
            $this->render('layout/content-only',[
                'content'=>$this->render_partial('site/register',['form'=>$form]),
                ]
            );
        }else{
            $this->navigate('site/index');
        }
    }

    public function validateAction(){
        if(!Web::user()->is_guest()){
            $this->navigate('site/index');
        }
        if(!isset($_SESSION['verify_code'])){
            $this->navigate('site/index');
        }else{
            $form = new EmailValidateForm();
            if($form->validate()){

            }
            $this->render('layout/content-only',[
                'content'=>$this->render_partial('site/validate',['form'=>$form]),
                ]
            );
        }
    }

    public function shareAction(){
        
    }
}