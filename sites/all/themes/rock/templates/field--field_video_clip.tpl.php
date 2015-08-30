<?php // print render($items); ?>

<?php include_once __DIR__ . '/functions.php'; ?>

<section id="videos">
	<div id="video">
        <div id="player"></div>
    </div>
    <ul id="carousel">
		<?php foreach ($items as $clip) { ?>
			<li id="<?php print field_collection_item_value('field_video_id', $clip); ?>">
				<h3><?php print field_collection_item_value('field_video_clip_title', $clip); ?></h3>
				<p class="order"></p>
				<p class="description"><?php print field_collection_item_value('field_video_description', $clip); ?></p>
				<img src="<?php print file_create_url(field_collection_item_value('field_video_thumbnail', $clip, 'uri')); ?>" alt="<?php print field_collection_item_value('field_video_thumbnail', $clip, 'alt'); ?>" />
			</li>
		<?php } ?>
	</ul>
    <h2 id="video-title"></h2>
    <p id="video-order"></p>
    <p id="video-description"></p>
</section>
