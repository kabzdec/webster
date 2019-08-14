<?php

class Connect{
private $db_host = 'localhost';
private $db_user = 'root';
private $db_pass = '123456';
private $db_name = 'test';
private $charset = 'UTF8'; 

private $opt = [
	PDO::ATTR_ERRMODE     		 => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	PDO::ATTR_EMULATE_PREPARES	 => false,
];

public $pdo;

function connect(){
	$this->pdo = new PDO("mysql:host=$this->db_host;dbname=$this->db_name;charset=$this->charset" ,$this->db_user,$this->db_pass,$this->opt);
}

function closeConnect(){
	$this->pdo=null;
	}
}