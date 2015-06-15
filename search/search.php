<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/app/code/data.php";
session_start();
	$code = getArtworkByCode($_POST["artcode"]);
	
	if(isset($code))
	{
		header("location: /artwork/?a=$code");
		unset($_SESSION["NOT-FOUND"]);
	}
	else
	{
		$_SESSION["NOT-FOUND"] = true;
		header("location: ./");
	}

?>
