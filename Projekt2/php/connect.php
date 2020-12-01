<?php
/*    $user = 'root';
    $pass = '';
    $host = 'localhost';
    $dbname = 'apkwww';
 
    try{
    $dns = 'mysql:host=' . $host . ';dbname=' . $dbname;
    $polaczenie = new PDO($dns,$user ,$pass);
    echo 'działa';
    }
    catch(PDOException $exception)
    {
        echo 'nie działa';
    }
 
    $stmt = $polaczenie->query('SELECT * FROM student');*/
    class Database
    {
        private static $dbName = 'apkwww' ;
        private static $dbHost = 'localhost' ;
        private static $dbUsername = 'root';
        private static $dbUserPassword = '';
         
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
              echo 'działa'; 
            }
            catch(PDOException $e)
            {
                echo 'nie działa';
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
    ?>