<?php
spl_autoload_register(function ($class_name) {
    $class = str_replace("\\", "/", $class_name);
    if(file_exists($class_name)){
        include_once($class_name);
    }elseif(file_exists($class_name.'.php')){            
        include_once($class_name.'.php');
    }elseif(file_exists(__DIR__.'/../'.$class . '.php')){
        include_once( __DIR__.'/../'.$class . '.php');
    }
});