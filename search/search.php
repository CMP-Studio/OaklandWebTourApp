<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/app/code/data.php";
session_start();
	$code = searchByCode($_POST["artcode"]);
	
	if(isset($code))
	{
		unset($_SESSION["NOT-FOUND"]);
		if($code['type'] == 'art')
		{
			header("location: /artwork/?a=" . $code['uuid'] );
		}
		else
		{
			header("location: /artist/?a=" . $code['uuid'] );
		}
		
	}
	else
	{
		$_SESSION["NOT-FOUND"] = true;
		header("location: ./");
	}

?>
