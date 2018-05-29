<?php

/**
 * 
 */
class DBAdapter {
	private const CONNECTION_FAILED = -10;

	private $_serverName = '127.0.0.1';
	private $_dbName;
	private $_username = 'root';
	private $_password = 'root';

	private $_connection;

	
	function __construct() {
		# code...
	}

	function __destruct() {
		if (alredyConnected())
			$this->disconnect();
    }

	public function setServerName($serverName) {
		$this->_serverName = $name;
	}

	public function setDbName($dbName) {
		$this->_dbName = $dbName;
	}

	public function setUsername($username) {
		$this->_username = $username;
	}

	public function setPassword($password) {
		$this->_password = $password;
	}

	public function getServerName() {
		return $this->_serverName;
	}

	public function getDbName() {
		return $this->_dbName;
	}

	public function getUsername() {
		return $this->_username;
	}

	public function getPassword() {
		return $this->_password;
	}

	public function connect() {
		if (alredyConnected()) {
			$this->disconnect();
		}
		$this->_connection = new mysqli($this->getServerName(),
			$this->getUsername(), 
			$this->getPassword(), 
			$this->getDbName());
  		if ($this->_connection->connect_error) {
    		throw new RuntimeException('Failed to connect: '.$this->_connection->connect_error, CONNECTION_FAILED);
    	}
	}

	public function disconnect() {
		$this->_connection->close();
	}

	private function alredyConnected() {
		return isset($this->_connection);
	}

}

?>