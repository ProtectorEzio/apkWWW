<?php
    class Database
    {
        private static $dbName = 's145661' ;
        private static $dbHost = 'localhost' ;
        private static $dbUsername = 's145661';
        private static $dbUserPassword = 'OlVmiQn!u!Sv';
         
        private static $polaczenie  = null;
         
        public function __construct() {
            die('Init function is not allowed');
        }
         
        public static function connect()
        {
           if ( null == self::$polaczenie )
           {     
            try
            {
              self::$polaczenie =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
            }
            catch(PDOException $e)
            {
              die($e->getMessage()); 
            }
           }
           return self::$polaczenie;
        }
         
        public static function disconnect()
        {
            self::$polaczenie = null;
        }
    }
