<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . "/app/code/data.php";
	
	$a = $_GET["a"];
	
	$art = getArtwork($a);

?>

<html>
	<head>
		<?php
		require_once $_SERVER['DOCUMENT_ROOT'] . "/app/templates/head.php";
		require_once $_SERVER['DOCUMENT_ROOT'] . "/app/templates/topbar.php";
		?>
	</head>
	<body>
		<?php
			if(isset($_SESSION["backurl"]))
			{
				dispTopbar($art["title"],false, $_SESSION["backurl"]);
			}
			else
			{
				dispTopbar($art["title"]);
			}
		?>
	
	</body>
</html>