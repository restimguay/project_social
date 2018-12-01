<?php

namespace route;

class Http
{
    public static function get_base(){
        foreach($_GET as $key=>$value){
            return $key;
        }
    }
    public static function post_base(){
        foreach($_POST as $key=>$value){
            return $key;
        }
    }

    public static function get_request_method(){
        return $_SERVER['REQUEST_METHOD'];
    }
}