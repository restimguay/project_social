<?php
require 'helper/init.php';
require 'helper/autoloader.php';
require 'helper/cleaner.php';

use route\Http;
$request_method = Http::get_request_method();


$controller ='';
$method = '';

if($request_method==='GET'){
    $get_request = Http::get_base();
    $get_parts = explode('/',$get_request);
    
    if(strpos($get_parts[1],"_") > 0){
        $prts = explode("_",$get_parts[1]);
        $actn = '';
        foreach($prts as $prt){
            if($actn==''){
                $actn.=$prt;
            }else{
                $actn.=ucwords($prt);
            }
        }
        $get_parts[1] = $actn;
    }
    $controller = 'controller\\'.ucwords(isset($get_parts[0])?$get_parts[0]:'Site').'Controller';
    $method = (isset($get_parts[1])?$get_parts[1]:'index').'Action';
}else{
    $post_request = Http::get_base();
    $post_parts  = explode('/',$post_request);
    if(strpos($post_parts[1],"_") > 0){
        $prts = explode("_",$post_parts[1]);
        $actn = '';
        foreach($prts as $prt){
            if($actn==''){
                $actn.=$prt;
            }else{
                $actn.=ucwords($prt);
            }
        }
        $post_parts[1] = $actn;
    }
    $controller = 'controller\\'.ucwords(isset($post_parts[0])?$post_parts[0]:'Post').'Controller';
    $method = (isset($post_parts[1])?$post_parts[1]:'index').'Action';
}
//die($controller);
if(!file_exists($controller.'.php')){
    header("HTTP/1.0 404 Not Found");
    die();
}
$ctrlr = new $controller();
if(method_exists($ctrlr,$method)){
    $ctrlr->$method();
}else{
    header("HTTP/1.0 404 Not Found");
    die();
}
?>