<?php

namespace controller;

use helper\Web;


class BaseController extends BaseView
{
    
    public function __construct()
    {
        
    }
    public function isPost(){
        return $_SERVER['REQUEST_METHOD']==='POST';
    }
    public function isGet(){
        return $_SERVER['REQUEST_METHOD']==='GET';
    }
    public function render_partial($view_file, array $data=[]){       
        if(!file_exists('view/'. $view_file .'.php')){
            header("HTTP/1.0 404 Not Found");
            die();
        }
        ob_start();
        extract($data);
        require 'view/'. $view_file .'.php';
        return ob_get_clean();
    }

    public function render($view_file, $data=[]){        
        if(!file_exists('view/'. $view_file .'.php')){
            header("HTTP/1.0 404 Not Found");
            exit();
        }
        ob_start();
        extract($data);
        require 'view/'. $view_file .'.php';
        echo ob_get_clean();
        exit();
    }

    public function navigate($url,$params=[]){
        Web::navigate($url,$params);
    }/*  */
}