<?php

namespace helper;

use table\Member;


class User
{
    public static $is_guest = true;
    public static $_instance = null;
    public function __construct()
    {
        if(self::$_instance==null){
            $session_key =isset($_SESSION['key'])?$_SESSION['key']:null;
            $session_expiry =isset($_SESSION['expiry'])?$_SESSION['expiry']:0;
            if($session_expiry<time()){
                $session_key = null;
                unset($_SESSION['key']);
                unset($_SESSION['expiry']);
            }
            if($session_key!=null){
                $member = new Member();
                if($member->find_one_by_parameter(['session_key'=>$session_key])){
                    self::$_instance = $member;
                    self::$is_guest = false;
                }else{
                    self::$is_guest = true;
                }
            }else{
                self::$is_guest = true;
            }
        }
    }
    public function is_guest(){
        return self::$is_guest;
    }
    public function logout(){
        unset($_SESSION['key']);
        unset($_SESSION['expiry']);        
    }
    public function login($email,$hash_password,$remember){
        $member = new Member();
        $member->find_one_by_parameter(['email'=>$email,'password_hash'=>$hash_password]);
        
        if($member->has_result()){
            $member->session_key = md5($email.microtime());
            $member->last_login=time();
            $_SESSION['key']=$member->session_key;
            if($remember == 'on'){
                $_SESSION['expiry'] = time()+(3600*24*180);
            }else{
                $_SESSION['expiry'] = time()+(3600);
            }
            if($member->save()){
                return true;
            }
        }
        return false;
    }
    /**
     * @param \form\Register $form Description
     */
    public function register($form){
        $member = new Member();
        $member->find_one_by_parameter(['email'=>$form->email]);
        if($member->has_result()){
            return false;
        }elseif($form->hash_password !== $form->hash_password1){
            return false;
        }

        $member->password_hash = md5($form->password_hash);
        $member->first_name = $form->first_name;
        $member->surname = $form->surname;
        $member->email = $form->email;
        $code = $this->generate_verification_code();
        $_SESSION['email_code']=$code;
        $member->email_validate_key = md5($form->email . $code);
        $member->joined_date = time();
        if($member->insert()){
            return $member;
        }
        return false;
    }
    public function getId(){
        return self::$_instance->id; 
    }
    public function __get($name)
    {
        return self::$_instance->$name;
    }

    private function generate_verification_code(){
        $string = '';
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < 6; $i++) {
            $string .= $characters[mt_rand(0, $max)];
        }
        return $string;
    }
}