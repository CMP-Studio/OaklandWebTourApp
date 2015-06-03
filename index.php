<?php


?>
<html>
	<head>
		<?php
		require_once $_SERVER['DOCUMENT_ROOT'] . "/app/templates/head.php";
		?>
	</head>
	<body id="home">
		<div id="HomeHeader">
			<h1> Carnegie Museum of Art</h1>
			<a id="HomeSearch" href="/search"><i class="fa fa-search"></i></a>
		</div>
		<div id="MenuHolder">
			<ul id="MainMenu" class="nav nav-stacked">
				<li role="presentation"><a href="/visit">My Visit</a></li>
				<li role="presentation"><a href="/exhibitions">Exhibitions</a></li>
				<li role="presentation"><a href="/news">News</a></li>
				<li role="presentation"><a href="/video">TV</a></li>
				<li role="presentation"><a href="/connect">Connect</a></li>
			</ul>
		</div>
	</body>
</html>