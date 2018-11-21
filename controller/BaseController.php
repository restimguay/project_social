<?php

namespace controller;

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
        ob_start();
        extract($data);
        require 'view/'. $view_file .'.php';
        return ob_get_clean();
    }

    public function render($view_file, $data=[]){        
        ob_start();
        extract($data);
        require 'view/'. $view_file .'.php';
        echo ob_get_clean();
    }

}