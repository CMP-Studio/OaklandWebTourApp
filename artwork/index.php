<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . "/app/code/data.php";
	
	$a = $_GET["a"];
	
	$art = getArtwork($a);
	
	$imgs = getArtworkMedia($a, "image");
	$vids = getArtworkMedia($a, "video");
	$med = array_merge($imgs, $vids);
	
	$audio = getArtworkMedia($a, "audio");
	
	function format($text)
	{
		$text = str_replace("\n","<br>",$text);
		$text = str_replace("\r","",$text);
		$textBold = explode("**",$text);
		
		$open = false;
		$text ="";
		foreach($textBold as $t)
		{
			if($open)
			{
				$text .= "$t</b>";
			}
			else
			{
				$text .= "$t<b>";
			}
			$open = !$open;
		}
		
		$text = substr($text,0,-4);

		return $text;
	}

?>

<html>
	<head>
		<?php
		require_once $_SERVER['DOCUMENT_ROOT'] . "/app/templates/head.php";
		require_once $_SERVER['DOCUMENT_ROOT'] . "/app/templates/topbar.php";
		?>
		<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script>
	$( document ).ready(function() {
		$('#carousel-media').carousel({
			pause: true,
			interval: false
		});
		$( "#audioInfo" ).dialog({
			autoOpen: false,
			buttons: [
				{
					text: "OK",
					click: function() {
						$( this ).dialog( "close" );
					}
				}
			]
		});
		
		$(".moreInfo").click( function()
		{
			$( "#audioInfo" ).dialog( "open" );
		});
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
		<!-- Images and videos -->
		<div id="imgHolder">
			<div id="carousel-media" class="carousel slide" data-ride="carousel" data-interval="false">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<!-- Add indicators here -->
					<?php 
					foreach($med as $k=>$i) { ?>
						<li data-target="#carousel-media" data-slide-to="<?php print $k; ?> " class="<?php if ($k == 0) print "active"; ?>"></li>
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
								<video src="<?php print $i["url"]; ?>" poster="<?php print $i["Thumbnail"] ?>" type="video/mp4" onclick="this.play();" controls/>
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
		
		<!-- first audio-->
		<?php if(isset($audio[0]))
		{
		?>
		<div id="audioHolder">

				<audio controls>
					<source src="<?php print $audio[0]["url"]; ?>" type="audio/mpeg">
				</audio>
				<p class="audioControls">
					<a class="moreInfo" href="#"><i class="fa fa-info-circle"></i></a>
					<a href="./audio/?a=<?php print $a; ?>"><i class="fa fa-music"></i></a>
				</p>
				

		</div>
		<div id="audioInfo">
			<p><?php print $audio[0]["title"]; ?></p>
		</div>
		<?php 
		}
		?>
		<!-- Body -->
		<div id="mainBody" class="list">
			<ul id="exhibList" class="nav nav-stacked list">
				<li role="presentation">
					<h3 class="fakeLink"><?php print $art["title"]; ?></h3>
				</li>
				<li role="presentation">
					<a href="/artist/?a="><p><?php print $art["Artist"]; ?></p></a>
				</li>
				<li>
					<p class="fakeLink"><?php print format($art["body"]); ?></p>
				</li>
			</ul>
		</div>
	</body>
</html>