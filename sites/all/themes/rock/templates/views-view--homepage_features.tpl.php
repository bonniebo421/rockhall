<?php 
$features = array();

foreach ($variables['view']->result as $result) {
    $node = node_load($result->nid);

    $features[] = array(
        'image'   => $node->field_video_thumbnail['und'][0]['uri'],
        'alt'   => $node->field_video_thumbnail['und'][0]['alt'],
        'title'   => $node->field_video_clip_title['und'][0]['safe_value'],
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
            <?php if ($feature['image']) { ?>
                <div>
                    <img src="<?php print file_create_url($feature['image']); ?>" alt="<?php print $feature['alt']; ?>" />
                </div>
            <?php } else { ?>
                No image
            <?php } ?>
            <div>
                <h2><?php print $feature['title']; ?></h2>
                <p class="description"><?php print $feature['description']; ?></p>
                <a href="<?php print file_create_url($feature['url']); ?>"><?php print $feature['link']; ?></a>
            </div>
        </div>
    <?php } ?>
</section>