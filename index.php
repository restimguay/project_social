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

//-- jQuery first, then Popper.js, then Bootstrap JS
Web::register_script('asset/js/jquery-3.3.1.js');
Web::register_script('asset/js/popper.min.js');
Web::register_script('asset/js/bootstrap.min.js');

//https://fonts.googleapis.com/css?family=Varela+Round
Web::register_style('asset/css/fonts.googleapis.family.varela_round.css');
//http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css
//Web::register_style('asset/css/font-awesome.min.css');
Web::register_style('http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css
Web::register_style('asset/css/bootstrap.min.css');

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