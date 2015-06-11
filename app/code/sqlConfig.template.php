<?php 

function getSQL()
{
	$username = 'USERNAME';
	$password = 'PASSWORD';
	$db = "DATABASE";
	$host = "localhost";
	
	$mysqli = new mysqli($host, $username, $password, $db);
	
	return $mysqli;
	

}

?>