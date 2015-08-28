<header>
	<a href="/"><img id="logo" src="/<?php print $directory;?>/images/logo.jpg" alt="<?php print $site_name;?>" /></a>
	<?php print render($page['header']); ?>
</header>

<?php print render($page['content']); ?>

<?php print render($page['footer']); ?>
