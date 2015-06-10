<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . "/app/code/data.php";
	
	
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
			dispTopbar("Exhibitions");
		?>
		<div id="exhibListHolder" class="listHolder">
			<ul id="exhibList" class="nav nav-stacked list">
				<?php foreach($exhib as $k=>$e){ ?>
					<li role="presentation"><a href="/exhibit?e=<?php print $e["uuid"]; ?>"><h3><?php print $e["title"]; ?></h3><p><?php print $e["subtitle"]; ?></p></a></li>
				<?php } ?>
			</ul>
		</div>
	</body>
</html>