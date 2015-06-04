<?php
	$e = $_GET["e"];
	
	require_once $_SERVER['DOCUMENT_ROOT'] . "/app/code/JSON.php";
	$exhib = getExhibitions();
	
	$exhibit = $exhib[$e];
?>

<html>
	<head>
		<?php
		require_once $_SERVER['DOCUMENT_ROOT'] . "/app/templates/head.php";
		require_once $_SERVER['DOCUMENT_ROOT'] . "/app/templates/topbar.php";
		?>
	<style>
		body
		{
			background-position:50% 50%;  /* Sets reference point to scale from */
			background-size:cover;        /* Sets background image to cover entire element */
			background-image: url('<?php print $exhibit->bg_ipad_retina;  ?>');
		}
	</style>
	</head>
	<body>
		<?php
			dispTopbar($exhibit->title, false, "/exhibitions");
		?>
		<div id="exhibListHolder">
			<ul id="exhibAction" class="nav nav-stacked">
				<li role="presentation"><a href="/exhibit/artists?e=<?php print $e; ?>"><p>Meet the artists</p></a></li>
				<li role="presentation"><a href="/exhibit/artworks?e=<?php print $e; ?>"><p>Discover the artwork</p></a></li>
				<li role="presentation"><a href="/exhibit/tours?e=<?php print $e; ?>"><p>Explore the tours</p></a></li>
			</ul>
		</div>
	</body>
</html>