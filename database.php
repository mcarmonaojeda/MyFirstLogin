<?php
$server = 'localhost';
$username = 'xymind';
$password = '';
$database = 'pibd';
try {
  	$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
	
} catch (PDOException $e) {
  	
  	die('Connection Failed: ' . $e->getMessage());
}
?>