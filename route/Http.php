<?php

namespace route;

class Http
{
    public static function getBase(){
        foreach($_GET as $key=>$value){
            return $key;
        }
    }
    public static function postBase(){
        foreach($_POST as $key=>$value){
            return $key;
        }
    }
}