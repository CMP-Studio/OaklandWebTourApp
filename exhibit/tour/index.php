<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/app/code/data.php";

$t = $_GET["t"];

$works = getTourWorks($t);
$tour = getTourInfo($t);

$_SESSION["backurl"] = "/exhibit/tour/?t=$t";

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
			dispTopbar($tour["title"], false, "/exhibit/tours/?e=" . $tour["eUUID"] );
		?>
		<div id="toursListHolder" class="listHolder">
			<ul id="tourList" class="nav nav-stacked list">
				<li role="presentation" id="body"><p><?php print $tour["body"]; ?></p></li>
				<?php foreach($works as $k=>$w){ 
					//var_dump($w);
				?>
				<li role="presentation"><a class='relavtive' href="/artwork/?a=<?php print $w["UUID"]; ?>">
					<div class='circleHold'>
						<p class='circle'><?php print ($k + 1); ?></p>
					</div>
					<div class='listText'>
						<h3><?php print $w["Title"]; ?></h3>
						<p><?php print $w["Artist"]; ?></p>
					</div>
					</a></li>
				<?php } ?>
			</ul>
		</div>
	</body>
</html>