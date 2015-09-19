<header>
	<?php print render($page['header']); ?>
</header>

<?php // print render($page['content']); ?>
<?php // print render($content['body']); ?>
<?php print views_embed_view('homepage_features','homepage_features', $node->nid); ?>

<?php print render($page['footer']); ?>
