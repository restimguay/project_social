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
    public static function url($url,$params=[]){
        return '?'.$url.self::url_encode(self::build_url_params($params));
    }

    public static function navigate($url,$params=[]){        
        header('location: ?'.$url.self::url_encode(self::build_url_params($params)));
        exit();
    }
    private static function build_url_params($params){
        $prms = '';
        foreach($params as $key=>$value){
            $prms.='&'.$key.'='.$value;
        }
        return $prms;
    }
    /**
     * based on http://php.net/manual/en/function.urlencode.php#97969
     */
    private static function url_encode($string) {
        $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
        $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
        return str_replace($entities, $replacements, urlencode($string));
    }
}