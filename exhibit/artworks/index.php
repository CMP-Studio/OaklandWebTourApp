<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/app/code/data.php";

$e = $_GET["e"];

$mode = $_GET["m"];

$art = getExhibitArtworks($e);
$ex = getExhibit($e);
//var_dump($art);

function printArt($art, $col)
{
	foreach($art as $k=>$a)	{
		if($k % 2 == $col) {	
?>
	<a href="/artwork/?a=<?php print $a["uuid"]; ?>">
		<img src="<?php print $a["url"]; ?>" alt="<?php print $a["alt"]; ?>">
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
			//var_dump($m);
			if($mode == 'list') { //List mode
		?>
		<div id="exhibListHolder" class="listHolder">
			<ul id="exhibList" class="nav nav-stacked list">
				<?php foreach($art as $k=>$a){ ?>
					<li role="presentation"><a href="/artwork?a=<?php print $a["uuid"]; ?>"><h3><?php print $a["title"]; ?></h3><p><?php print $a["Artist"]; ?></p></a></li>
				<?php } ?>
			</ul>
		</div>

		<?php } else {  //Default to images mode?>
		
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
	<?php } ?>
		<div id="modeSwitch" class="footer">
			<p>
				<a href="./?e=<?php print $e; ?>"><i class="fa fa-picture-o <?php if($mode == null) print "active";?>"></i></a>
				<a href="./?m=list&e=<?php print $e; ?>"><i class="fa fa-list <?php if($mode == "list") print "active";?>"></i></a>
			</p>
		</div>
	</body>
</html>
	