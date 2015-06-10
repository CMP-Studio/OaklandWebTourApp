<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/app/code/JSON.php";

$e = $_GET["e"];
$t = $_GET['t'];

$works = getTourWorks($e, $t);

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
			dispTopbar("Tours", false, "/exhibit/tours/?e=$e" );
		?>
		<div id="toursListHolder" class="listHolder">
			<ul id="tourList" class="nav nav-stacked list">
				<?php foreach($works as $k=>$w){ 

				?>
				<li role="presentation"><a href="/artwork/?a=<?php print $w->code; ?>"><h3><?php print $w->title; ?></h3><p><?php  ?></p></a></li>
				<?php } ?>
			</ul>
		</div>
	</body>
</html>