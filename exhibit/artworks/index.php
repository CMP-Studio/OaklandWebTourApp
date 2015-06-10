<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/app/code/data.php";

$e = $_GET["e"];

$art = getExhibitArtworks($e);
$ex = getExhibit($e);
//var_dump($art);

function printArt($art, $col)
{
	foreach($art as $k=>$a)	{
		if($k % 2 == $col) {	
?>
	<a href="/artwork/?a=<?php print $a["uuid"]; ?>">
		<img src="<?php print $a["url"]; ?>" alt="<?php print $a["title"]; ?>">
	</a>
<?php
		}
	}
}
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
			dispTopbar($ex["title"], false,"/exhibit/?e=$e" );
		?>
		<div id="picHolder">
			
			<div id="left-col">
				<?php
					printArt($art, 0);
				?>
			</div>
			<div id="right-col">
				<?php
					printArt($art, 1);
				?>
			</div>
		</div>
	</body>
</html>
	