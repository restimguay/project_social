<?php

namespace table;

use database\DB;
use PDO;

class BaseTable extends DB
{
    private $_primary_key = '';
    private $_table_name = '';
    private $_last_affected_rows = 0;
    private $_hasresult = false;
    public function __construct($table_name,$primary_key)
    {
        $this->_primary_key = $primary_key;
        $this->_table_name = $table_name;
    }
    public function find_all_by_parameter($parameter){
        $sql = 'SELECT * from '.$this->_table_name.' WHERE ';
        $pdo = $this->getConnection();
        $where = '';
        foreach($parameter as $field=>$value){
            if($where!==''){
                $where.=' and ';
            }$where.=$field.'=:'.$field;
        }
        $sql.=$where;
        $stmt = $pdo->prepare($sql);
        foreach($parameter as $field=>&$value){
            $stmt->bindValue($field, $value);
        }
        $stmt->execute();
        $objs = $stmt->fetchAll(PDO::FETCH_OBJ);
        if($objs!=false){
            $this->_hasresult = true;
        }else{
            $this->_hasresult = false;
        }
        return $objs;
    }
    public function insert(){
        $sql = 'INSERT INTO '.$this->_table_name.'';
        $fields ='';
        $values = '';
        $properties = get_object_vars($this);
        foreach($properties as $field=>$value){
            if(strpos($field,'_')!==0){
                if($fields!==''){
                    $fields.=', ';                    
                    $values.=', ';
                }
                $fields.=$field;
                $values.=':'.$field;                
            }
        }
        $sql.='('.$fields.')';
        $sql.=' VALUES('.$values.')';
        $pdo = $this->getConnection();
        $stmt = $pdo->prepare($sql);
        
        foreach($properties as $field=>&$value){
            if(strpos($field,'_')!==0){
                $stmt->bindValue($field, $value);
            }
        }
        $stmt->execute();
        
        $this->_last_affected_rows = $stmt->rowCount();
        return $this->_last_affected_rows;
    }
    public function find_one_by_parameter($parameter){
        $sql = 'SELECT * from '.$this->_table_name.' WHERE ';
        $pdo = $this->getConnection();
        $where = '';
        foreach($parameter as $field=>$value){
            if($where!==''){
                $where.=' and ';
            }$where.=$field.'=:'.$field;
        }
        $sql.=$where.' LIMIT 1';
        $stmt = $pdo->prepare($sql);
        foreach($parameter as $field=>&$value){
            $stmt->bindValue($field, $value);
        }
        $stmt->execute();
        if($table = $stmt->fetch(PDO::FETCH_OBJ)){
            $vars = get_object_vars($table);
            foreach($vars as $prop=>$value){
                $this->$prop= $value;
            }
            $this->_hasresult = true;
            return $this;
        }else{
            $this->_hasresult = false;
            return false;
        }
    }

    public function save(){
        $pdo = $this->getConnection();
        $properties = get_object_vars($this);
        $set='';
        foreach($properties as $field=>$value){
            if(strpos($field,'_')!==0){
                if($set!==''){
                    $set.=', ';
                }
                $set.=$field.'=:'.$field;
            }
        }
        $where = ' WHERE '.$this->_primary_key.'=:'.$this->_primary_key;
        
        $sql = 'UPDATE '.$this->_table_name.' SET '.$set. $where;
        $stmt = $pdo->prepare($sql);
        foreach($properties as $field=>&$value){            
            if(strpos($field,'_')!==0){
                $stmt->bindValue($field, $value);
            }
        }
        $stmt->bindValue($this->_primary_key, $this->{$this->_primary_key});
        if(!$stmt->execute()){
            return 0;
        }
        $this->_last_affected_rows = $stmt->rowCount();
        return $this->_last_affected_rows;
    }

    public function __set($name, $value)
    {
        $this->{$name}=$value;
    }
    public function __get($name)
    {
        return $this->{$name};
    }
    /**
     * Determine if the last query has result
     */
    public function has_result(){
        return $this->_hasresult;
    }
}