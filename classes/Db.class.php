<?php
    abstract class Db
    {
        private static $conn;

        private static function getConfig()
        {
            // get the config file
            return parse_ini_file(__DIR__.'/../config/config.ini');
        }

        public static function getInstance()
        {
            if (self::$conn != null) {
                return self::$conn;
            }

            $config = self::getConfig();
            $database = $config['db_database'];
            $user = $config['db_user'];
            $password = $config['db_password'];

            try {
                self::$conn = new PDO('mysql:host=localhost;dbname='.$database.';charset=utf8mb4', $user, $password, null);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                return self::$conn;
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
    }
