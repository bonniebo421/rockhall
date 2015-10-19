<?php 
$features = array();

foreach ($variables['view']->result as $result) {
    $node = node_load($result->nid);

    $features[] = array(
        'image'   => $node->field_video_thumbnail['und'][0]['uri'],
        'alt'   => $node->field_video_thumbnail['und'][0]['alt'],
        'title'   => $node->field_video_clip_title['und'][0]['safe_value'],
        'video'   => $node->field_video_id['und'][0]['safe_value'],
        'description' => $node->field_video_description['und'][0]['safe_value'],
        'url' => $node->field_link_to_interview['und'][0]['url'],
        'link' => $node->field_link_to_interview['und'][0]['title'],
        'order' => $node->field_homepage_order['und'][0]['value']
    );
}

?> 

<section id="features">
    <?php foreach ($features as $feature) { ?>
        <div id="feat-<?php print $feature['order']; ?>">
            <?php if ($feature['video']) { ?>
                <div id="video">
                    <iframe src='https://player.vimeo.com/video/<?php print $feature['video']; ?>?autoplay=0&portrait=0&byline=0&title=0' width='800' height='480' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div>
            <?php } else { ?>
                <div>
                    <a href="<?php print file_create_url($feature['url']); ?>">
                        <img src="<?php print file_create_url($feature['image']); ?>" alt="<?php print $feature['alt']; ?>" />
                    </a>
                </div>
            <?php } ?>
            <div>
                <h2><a href="<?php print file_create_url($feature['url']); ?>"><?php print $feature['title']; ?></a></h2>
                <p class="description"><?php print $feature['description']; ?></p>
                <a href="<?php print file_create_url($feature['url']); ?>"><?php print $feature['link']; ?></a>
            </div>
        </div>
    <?php } ?>
</section>