<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . "/app/code/data.php";
	
	$a = $_GET["a"];
	
	$art = getArtwork($a);
	
	$imgs = getArtworkMedia($a, "image");
	$vids = getArtworkMedia($a, "video");
	$med = array_merge($imgs, $vids);

?>

<html>
	<head>
		<?php
		require_once $_SERVER['DOCUMENT_ROOT'] . "/app/templates/head.php";
		require_once $_SERVER['DOCUMENT_ROOT'] . "/app/templates/topbar.php";
		?>
	<script>
		$('#carousel-media').carousel({
    pause: true,
    interval: false
});
	</script>
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
		<div id="imgHolder">
			<div id="carousel-media" class="carousel slide" data-ride="carousel" data-interval="false">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<!-- Add indicators here -->
					<?php 
					foreach($med as $k=>$i) { ?>
						<li data-target="#myCarousel" data-slide-to="<?php print $k; ?> " class="<?php if ($k == 0) print "active"; ?>"></li>
					<?php } ?>
				</ol>

				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					<!-- Add items here -->
					<?php foreach($med as $k=>$i) { ?>
						<div class="item <?php if($k ==0) print "active";?>">
							<?php if($i["kind"] == "image") { ?>
								<img src="<?php print $i["url"]; ?>" alt="<?php print $i["title"]; ?> ">
							<?php } else { ?>
								<video controls>
									<source src="<?php print $i["url"] ?>">
								</video>
							<?php } ?>
						</div>
					<?php } ?>					
				</div>

				<!-- Controls -->
				<a class="left carousel-control" href="#carousel-media" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#carousel-media" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
	</body>
</html>