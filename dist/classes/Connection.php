<?php 

    /**
     * connection with database class
     * v1.0.0
     */

    class Connection {

        // host
        private const DBHOST = "localhost";

        // database name
        private const DBNAME = "app_gallery";

        // username
        private const DBUSER = "root";

        // password
        private const DBPASS = "";

        // options
        private const DPOPTI = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"
        );

        // dsn
        private const DSN = "mysql:host=". self::DBHOST .";dbname=". self::DBNAME ."";

        protected $con = null;

        public function __construct() {

            try {

                $this->con = new PDO(self::DSN, self::DBUSER, self::DBPASS, self::DPOPTI);
                
                $this->con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            } catch (PDOException $e) {

                die("connection faild: " . $e->getMessage());

            }

        }

    }

?>