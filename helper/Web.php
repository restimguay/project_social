<?php

namespace helper;

class Web
{
    private static $_config=[];
    private static $_user = null;
    private static $_sripts = [];
    private static $_success_notify = [];
    private static $_error_notify = [];
    public static function init($config){
        self::$_config = $config;
    }
    private static function init_user(){
        if(self::$_user==null){
            self::$_user = new User();
        }
    }

    /**
     * @return helper/User
     */
    public static function user(){
        self::init_user();
        return self::$_user;
    }
    public static function register_script($path){
        self::$_sripts[]=$path;
    }
    public static function render_scripts(){
        foreach(self::$_sripts as $sript){
            echo '<script src="'.$sript.'"></script>'."\n";
        }
    }

    public static function register_error($error_msg){
        self::$_error_notify[] =$error_msg;
    }
    public static function register_success($success_msg){
        self::$_success_notify[]=$success_msg;        
    }
    public static function get_notify(){
        $alert='';
        foreach(self::$_success_notify as $notify){
            $alert= '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Success!</strong>';
                    $alert.=$notify;
                    $alert.= '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                echo $alert;
        }
    }
}