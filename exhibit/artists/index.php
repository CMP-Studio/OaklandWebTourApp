<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/app/code/data.php";

$e = $_GET["e"];

$artists = getExhibitArtists($e);


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
			dispTopbar("Artists", false, "/exhibit/?e=$e" );
		?>
		<div id="toursListHolder" class="listHolder">
			<ul id="tourList" class="nav nav-stacked list">
				<?php foreach($artists as $k=>$a){ 
					//var_dump($w);
				?>
				<li role="presentation"><a class='relavtive' href="/artist/?a=<?php print $a["uuid"]; ?>">
					<div class='listText'>
						<h3><?php print $a["Name"]; ?></h3>
						<p><?php //print $a["Country"]; ?></p>
					</div>
					</a></li>
				<?php } ?>
			</ul>
		</div>
	</body>
</html>