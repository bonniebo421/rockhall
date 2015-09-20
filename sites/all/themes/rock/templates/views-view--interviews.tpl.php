<?php 
$interviews = array();

foreach ($variables['view']->result as $result) {
    $node = node_load($result->nid);

    $interviews[] = array(
        'image'   => $node->field_interview_thumbnail['und'][0]['uri'],
        'alt'   => $node->field_interview_thumbnail['und'][0]['alt'],
        'title'   => $node->field_h1_title['und'][0]['safe_value'],
        'description' => $node->field_artist_biography['und'][0]['summary'],
        'url' => $node->nid
    );
}

?> 
<h1>Browse Interviews</h1>
<section id="interviews">
    <?php foreach ($interviews as $interview) { ?>
        <div>
            <?php if ($interview['image']) { ?>
                <img src="<?php print file_create_url($interview['image']); ?>" alt="<?php print $interview['alt']; ?>" />
            <?php } else { ?>
                No image
            <?php } ?>
            <h2><?php print $interview['title']; ?></h2>
            <p class="description"><?php print $interview['description']; ?></p>
            <a href="node/<?php print $interview['url']; ?>">View this interview</a>
        </div>
    <?php } ?>
</section>