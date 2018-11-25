<?php

namespace form;

use helper\Web;


class BaseForm
{
    public static $_forms = [];
    public static $_form_index =1;
    public $_form_name='';
    public $_token='';
    public $_is_valid_source = false;
    public $_errors=[];
    private $_standalon_parameters=[
        'required',
        'readonly',
    ];
    public function __construct(){
        if(count($_POST)>0){
            $f_name = $_POST['_form_name'];
            if(isset($_SESSION[$f_name])){
                //our form was submitted with correct token.
                //let's capture all form data into our current object
                foreach($_POST as $key=>$value){
                    $this->{str_replace($f_name.'_','',$key)}=$value;
                }
                //furthermore, let's validate the token
                if($_SESSION[$f_name] == $this->_token){
                    //our form is finally validated to be valid
                    $this->_is_valid_source = true;

                }else{
                    //someone wants to hack us.
                    $this->_is_valid_source = false;
                }
            }else{
                //someone wants to hack us again.
                $this->_is_valid_source = false;
            }
        }
        $reflect = new \ReflectionClass($this);
        $name = strtolower($reflect->getShortName());
        $name.=self::$_form_index;
        self::$_form_index +=1;
        self::$_forms[$name]=md5(microtime());
        $_SESSION[$name]=self::$_forms[$name];
        $this->_form_name=$name;
        $this->_token=$_SESSION[$name];
    }

    public function isPost(){
        return $_SERVER['REQUEST_METHOD']=='POST';
    }
    /**
     * @return Boolean
     */
    public function validate(){
        if(!$this->is_valid()){
            return false;
        }
        $labels = $this->labels();
        $is_valid = true;
        foreach($this->rules() as $type=>$details){
            if($type=='required'){
                foreach($details as $field){
                    if($this->$field==''){
                        $this->_errors[$field]=$labels[$field].' is required';
                    }
                }
            }
        }
        return $is_valid;
    }
    public function add_error($field,$error){
        $this->_errors[$field] = $error;
    }
    public function rules(){
        return [];
    }
    public function labels(){
        return [];
    }
    public function getToken(){
        return $this->_token;
    }
    public function getName(){
        return $this->_form_name;
    } 
    public function name(){
        $defaults = [
            'type'=>'hidden',
            'value'=>$this->_form_name,
            'name'=>'_form_name',
        ];
        $param_html = '';
        foreach($defaults as $key=>$value){
            $param_html.=' '.$key.'="'.$value.'"';
        }
        return '<input '.$param_html.'></input>'."\n";
    }
    public function hidden($suffix,$value='',$parameters=[]){
        $defaults = [
            'type'=>'hidden',
            'id'=>$this->_form_name.'_'.$suffix,
            'name'=>$this->_form_name.'_'.$suffix,
            'value'=>$value,
        ];
        return '<input '.$this->build_params($suffix,$defaults,$parameters).'></input>'."\n";
    }
    public function text($suffix,$value='',$parameters=[]){
        $defaults = [
            'type'=>'text',
            'class'=>'form-control',
            'id'=>$this->_form_name.'_'.$suffix,
            'name'=>$this->_form_name.'_'.$suffix,
            'value'=>$value,            
        ];
        return '<input '.$this->build_params($suffix,$defaults,$parameters).'></input>'."\n".$this->get_error_msg($suffix);
    }
    private function get_error_msg($name){
        if(isset($this->_errors[$name])){
           return '<small id="'.$this->_form_name.'_'.$name.'_error" class="text-danger">
                '.$this->_errors[$name].'
            </small>';
        }
        return '';
    }
    private function build_params($name, $default, $params){
        $param_html = '';
        $parameters = array_merge(
            $default,$params
        );

        if(isset($parameters['class'])){
            if(isset($this->_errors[$name])){
                $parameters['class'] .= ' is-invalid';
            }
        }
        
        if(!isset($parameters['class'])){
            $parameters['class'] = 'form-control';
        }
        
        if(strpos($parameters['class'],'form-control') == 0){
            $parameters['class'] .= ' form-control';
        }
        
        foreach($parameters as $key => $value){
            if(!in_array($key,$this->_standalon_parameters)){
                $param_html .= ' '.$key.'="'.$value.'"';
            }else{
                $param_html .= ' '.$key;
            }
        }
        $rules = $this->rules();
        if(isset($rules['required'])){
            if(in_array($name,$rules['required'])){
                $param_html.=' required';
            }
        }
        return $param_html;
    }
    public function email($suffix,$value='',$parameters=[]){
        $defaults = [
            'type'=>'email',
            'class'=>'form-control',
            'id'=>$this->_form_name.'_'.$suffix,
            'name'=>$this->_form_name.'_'.$suffix,
            'value'=>$value,
        ];
        return '<input '.$this->build_params($suffix,$defaults,$parameters).'></input>'."\n".$this->get_error_msg($suffix);
    }
    public function password($suffix,$value='',$parameters=[]){
        $defaults = [
            'type'=>'password',
            'class'=>'form-control',
            'id'=>$this->_form_name.'_'.$suffix,
            'name'=>$this->_form_name.'_'.$suffix,
            'value'=>$value,
        ];
        return '<input '.$this->build_params($suffix,$defaults,$parameters).'></input>'."\n".$this->get_error_msg($suffix);
    }
    public function textarea($suffix,$value='',$parameters=[]){
        $defaults = [
            'type'=>'checkbox',
            'class'=>'form-check-input',
            'id'=>$this->_form_name.'_'.$suffix,
            'name'=>$this->_form_name.'_'.$suffix,
            'rows'=>3
        ];
        return '<textarea '.$this->build_params($suffix,$defaults,$parameters).'>'.$value.'</textarea>'."\n".$this->get_error_msg($suffix);
    }
    public function checkbox($suffix,$value='',$parameters=[]){
        $defaults = [
            'type'=>'checkbox',
            'class'=>'form-check-input',
            'id'=>$this->_form_name.'_'.$suffix,
            'name'=>$this->_form_name.'_'.$suffix,
        ];
        return '<input '.$this->build_params($suffix,$defaults,$parameters).'>'."\n";
    }
    public function getControlId($suffix){
        return $this->_form_name.'_'.$suffix;
    }

    public function getControlName($suffix){
        return $this->_form_name.'_'.$suffix;
    }
    public function is_valid(){
        return $this->_is_valid_source;
    }
    public function __set($name, $value)
    {
        $this->$name=$value;
    }
    public function __get($name)
    {
        if(isset($this->{$name})){
            return $this->{$name};
        }
        return '';
    }

    public function select($suffix, $value='',$options=[],$parameters=[]){
        $defaults = [
            'class'=>'form-control',
            'id'=>$this->_form_name.'_'.$suffix,
            'name'=>$this->_form_name.'_'.$suffix,
        ];
        $opts = '';
        foreach($options as $opt=>$details){
            $opts.='<option ';
            foreach($details as $key=>$vlu){
                if($key!='label'){
                    $opts.=' value="'.$details['value'].'"';
                }
            }
            $opts.='>'.$details['label'].'</option>';
        }
        return '<select '. $this->build_params($suffix,$defaults,$parameters).'>'.$opts.'</select>'."\n".$this->get_error_msg($suffix);
    }

    public function load($obj){
        $props = get_object_vars($obj);
        foreach($props as $key=>$value){
            $this->$key=$value;
        }
    }
}