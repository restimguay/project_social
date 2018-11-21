<?php

namespace database;

use PDO;
class DB
{
    private static $_instance = null;
    public function __construct()
    {
        if(self::$_instance==null){
            self::_connect();
        }
    }

    private static function _connect(){
        self::$_instance = new PDO('mysql:host=localhost;dbname=project_social', 'root', '');
    }
    /**
     * @return PDO
     */
    public static function getConnection(){
        if(self::$_instance==null){
            self::_connect();
        }
        return self::$_instance;
    }
}