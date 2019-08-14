<?php

require_once('class_connect.php');

class Admin{
	private $username;
	private $password;

	function __construct($login,$password){
		$this->username = $login;
		$this->password = $password;
	}

	public function validate(){
		$conn = new Connect();
		$sql = $conn->pdo->query('SELECT username = "'.$this->username.'" AND password = "'.$this->password.'" FROM admin;');
		if ($row = $sql->fetch()){
			foreach ($row as $some){
			if ($some){
				return true;
				} else return false;
			}
		} 
	}
}