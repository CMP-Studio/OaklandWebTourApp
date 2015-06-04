<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . "/app/code/JSON.php";
	
	$e = $_GET["e"];
	
	$tours = getTours($e);
	
	//var_dump($exhib);

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
			dispTopbar("Tours", false, "/exhibit/?e=$e" );
		?>
		<div id="toursListHolder" class="listHolder">
			<ul id="toursList" class="nav nav-stacked list">
				<?php foreach($tours as $k=>$t){ ?>
					<li role="presentation"><a href="/exhibit/tour?t=<?php print $k; ?>&e=<?php print $e; ?>"><h3><?php print $t->title; ?></h3><p><?php print $t->subtitle ?></p></a></li>
				<?php } ?>
			</ul>
		</div>
	</body>
</html>