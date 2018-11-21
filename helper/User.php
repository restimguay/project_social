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
    public function getId(){
        return self::$_instance->id; 
    }
    public function __get($name)
    {
        return self::$_instance->$name;
    }
}