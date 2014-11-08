<?php 

class User {
	
	private $_userName;
	private $_password;
	private $_group;
	private $_UID;
	
	public function __construct($userName, $password, $group = NULL, $UID = NULL) {
		$this->_userName = $userName;
		$this->_password = $password;
		$this->_group = $group;		
		$this->_UID = $UID;
	}
	
	public function getUserName() {
		return $this->_userName;
	}
	
	public function getPassword() {
		return $this->_password;
	}
	
	public function getGroup() {
		return $this->_group;
	}
	
	public function getUID() {
		return $this->_UID;
	}
	
	
	public function saveUser() {
		
	}
}