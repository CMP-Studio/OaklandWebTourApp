<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/app/code/data.php";

?>

<html>
	<head>
		<?php
		require_once $_SERVER['DOCUMENT_ROOT'] . "/app/templates/head.php";
		require_once $_SERVER['DOCUMENT_ROOT'] . "/app/templates/topbar.php";
		
		$_SESSION["backurl"] = "/search";
		?>
	</head>
	<body>
	<?php
			dispTopbar("Artwork Code");
	?>
	<div id="searchBody" class="fakeLink">
		<?php 
		if(isset($_SESSION["NOT-FOUND"])) 
		{
			print "<p class='orange'>Sorry, the code you searched for was not found</p>"; 
			unset($_SESSION["NOT-FOUND"]);
		}?>
		<p>To access information about a specific artwork, please enter the artwork code here:</p>
		<form action="search.php" method="POST">
			<input name="artcode" type = "text" >
			<br>
			<input type="submit" value="Search" class="link">
		</form>
	</div>
	</body>
</html>