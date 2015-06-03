<?php
function dispTopbar($title, $home=true, $url="/") {
?>
<div id="topbar">
	<?php if($home) { ?>
		<a href="/"><i class="fa fa-home"></i></a>
	<?php } else { ?>
		<a href="<?php print $url; ?>"><i class="fa fa-chevron-left"></i></a>
	<?php } ?>
	<h1 id="titlebar"><?php print $title; ?></h1>
</div>
<?php
}
?>