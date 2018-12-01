<?php

namespace helper;

class Web
{
    private static $_config=[];
    private static $_user = null;
    private static $_sripts = [];
    private static $_styles = [];
    private static $_success_notify = [];

    private static $_error_notify = [];
    /**
     * @var /App;
     */
    private static $app;

    public static function config(){
        return self::$_config;
    }
    public static function init($config){
        self::$_config = $config;
    }
    /**
     * @returns App
     */
    public static function app(){
        if(self::$app==null){
            self::$app = new App();
        }
        return self::$app;
    }
    /**
     * @return helper/User Instance of Member
     */
    public static function user(){
        if(self::$_user==null){
            self::$_user = new User();
        }
        return self::$_user;
    }
    public static function register_script($path){
        self::$_sripts[]=$path;
    }
    public static function register_style($path){
        self::$_styles[]=$path;
    }
    public static function render_scripts(){
        foreach(self::$_sripts as $sript){
            echo '<script src="'.$sript.'"></script>'."\n";
        }
    }
    public static function render_styles(){
        foreach(self::$_styles as $style){
            echo '<link rel="stylesheet" href="'.$style.'">'."\n";
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
    /**
     * Build an ecoded URL with parameters
     */
    public static function url($url,$params=[]){
        return '?'.$url.self::url_encode(self::build_url_params($params));
    }
    /**
     * Navigate to specified URL with parameters
     */
    public static function navigate($url,$params=[]){        
        header('location: ?'.$url.self::url_encode(self::build_url_params($params)));
        exit();
    }
    /**
     * Build a URL's parameters
     */
    private static function build_url_params($params){
        $prms = '';
        foreach($params as $key=>$value){
            $prms.='&'.$key.'='.$value;
        }
        return $prms;
    }
    /**
     * based on http://php.net/manual/en/function.urlencode.php#97969
     * Thank you
     */
    private static function url_encode($string) {
        $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
        $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
        return str_replace($entities, $replacements, urlencode($string));
    }   
}
/**
 * @var $name String
 */
class App{

    public function __get($name)
    {
        return Web::config()['app'][$name];
    }
}