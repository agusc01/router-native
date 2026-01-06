<?php
    
    require_once 'config/_index.php';

    class DatabaseAdapter
    {
        private static $accessObjectPDO;
        private $objectPDO;

        private static $dbName = DB_NAME;
        private $dbHost = DB_HOST;
        private $dbUser = DB_USER;
        private $dbPassword = DB_PASS;
        
        private function __construct()
        {
            $connectionString = "mysql:host=$this->dbHost;dbname=".self::$dbName.";charset=utf8";
            try 
            { 
                $this->objectPDO = new PDO($connectionString,
                                            $this->dbUser,
                                            $this->dbPassword,
                                            [
                                                // README: this is for the HOSTING in other situation is false
                                                PDO::ATTR_EMULATE_PREPARES => true, 
                                                
                                                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                                            ]
                                        );
            } 
            catch (PDOException $e) 
            { 
                print "Error!: " . $e->getMessage(); 
                die();
            }
        }

        public function prepare($sql)
        { 
            return $this->objectPDO->prepare($sql); 
        }

        public function lastIdInsert()
        { 
            return $this->objectPDO->lastInsertId(); 
        }

        public static function giveAccessObject()
        { 
            if (!isset(self::$accessObjectPDO))
            {          
                self::$accessObjectPDO = new DatabaseAdapter(); 
            } 
            return self::$accessObjectPDO;        
        }
        
        public function __clone()
        { 
            trigger_error('Custom message: Cloning this object is not permitted.', E_USER_ERROR); 
        }

        public static function showErrors($e)
        {
            if(SHOW_ERRORS_BASIC || SHOW_ERRORS_COMPLETE)
            {
                if(SHOW_ERRORS_BASIC)
                {
                    echo "Se generó un error: " . $e->getMessage();
                }
                else
                {
                    echo "<pre>";
                    var_dump($e);
                    echo "</pre>";
                }
            }
            else
            {
                echo SHOW_ERRORS_MESSAGE;
                die();
                exit();
            }
        }
    }
?>
