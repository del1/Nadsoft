<?php
class Database {
	private $conn;
	private $host;
	private $user;
	private $password;
	private $baseName;
	private $port;
	private $Debug;
	private static $_instance;
 
    public function __construct($params=array()) {
		$this->conn = false;
		$this->host = 'localhost'; //hostname
		$this->user = 'root'; //username
		$this->password = ''; //password
		$this->baseName = 'test_oop'; //name of your database
		$this->port = '3306';
		$this->debug = true;
		$this->connect();
	}
 
	public function __destruct() {
		$this->disconnect();
	}

	public static function getInstance() {
		if(!self::$_instance) { // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	private function __clone() { }
	
	public function connect() {
		if (!$this->conn) {
			try {
				$this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->baseName.'', $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));  
			}
			catch (Exception $e) {
				die('Erreur : ' . $e->getMessage());
			}
 
			if (!$this->conn) {
				$this->status_fatal = true;
				echo 'Connection BDD failed';
				die();
			} 
			else {
				$this->status_fatal = false;
			}
		}
 
		return $this->conn;
	}
 
	public function disconnect() {
		if ($this->conn) {
			$this->conn = null;
		}
	}
	
	public function getOne($query) {
		$result = $this->conn->prepare($query);
		$ret = $result->execute();
		if (!$ret) {
		   echo 'PDO::errorInfo():';
		   echo '<br />';
		   echo 'error SQL: '.$query;
		   die();
		}
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$reponse = $result->fetch();
		
		return $reponse;
	}
	
	public function getAll($query) {
		$result = $this->conn->prepare($query);
		$ret = $result->execute();
		if (!$ret) {
		   echo 'PDO::errorInfo():';
		   echo '<br />';
		   echo 'error SQL: '.$query;
		   die();
		}
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$reponse = $result->fetchAll();
		
		return $reponse;
	}
	
	public function execute($query) {
		if (!$response = $this->conn->exec($query)) {
			echo 'PDO::errorInfo():';
		   echo '<br />';
		   echo 'error SQL: '.$query;
		   die();
		}
		return $response;
	}
}