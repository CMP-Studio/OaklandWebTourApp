<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . "/app/code/JSON.php";
	
	
	$exhib = getExhibitions();
	
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
			dispTopbar("Exhibitions", false);
		?>
		<div id="exhibListHolder">
			<ul id="exhibList" class="nav nav-stacked">
				<?php foreach($exhib as $k=>$e){ ?>
					<li role="presentation"><a href="/exhibitions/exhibit?e=<?php print $k; ?>"><h3><?php print $e->title; ?></h3><p><?php print $e->subtitle ?></p></a></li>
				<?php } ?>
			</ul>
		</div>
	</body>
</html>