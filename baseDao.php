<?php 
    abstract class BaseDao {
        static protected $Db;

        public function __construct() 
        {
            $this::$Db = Database::getInstance();
        }

        abstract public function loadAll();

        public function insert() 
        {
            // $this->_pdo->something()
        }

        public function save()
        {
            // $this->_pdo->something()
        }

        public function delete() 
        {
            echo "Delete classe pai ****<br>";
            // $this->_pdo->something()
        }

        public function update() 
        {
            // $this->_pdo->something()
        }        
    }
?>
