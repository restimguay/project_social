<?php
require 'helper/init.php';
require 'helper/autoloader.php';
require 'helper/cleaner.php';

use route\Http;
$config = array_merge(
    require 'config/main.php',
    require 'config/settings.php'
);;
$request_method = $_SERVER['REQUEST_METHOD'];
use helper\Web;
Web::init($config);
$controller ='';
$method = '';

if($request_method==='GET'){
    $get_request = Http::getBase();
    $get_parts = explode('/',$get_request);
    $controller = 'controller\\'.ucwords(isset($get_parts[0])?$get_parts[0]:'Site').'Controller';
    $method = (isset($get_parts[1])?$get_parts[1]:'index').'Action';
}else{
    $post_request = Http::getBase();
    $post_parts  = explode('/',$post_request);
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