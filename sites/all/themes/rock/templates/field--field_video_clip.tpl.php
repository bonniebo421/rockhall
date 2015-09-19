<?php // print render($items); ?>

<?php // include_once __DIR__ . '/functions.php';

function preg_remove($regex, $string) {
    return preg_replace($regex, '', $string);
}

function array_first($array) {
    return array_shift($array);
}

function array_first_key($array) {
    return array_first(array_keys($array));
}

function array_last($array) {
    return array_pop($array);
}

function array_last_key($array) {
    return array_last(array_keys($array));
}

function array_get($array, $key, $default) {
    return array_key_exists($key, $array) ? $array[$key] : $default;
}

function spy($x) {
    switch (1) {
        case is_string($x):
            return '"' . $x . '"';
        case is_numeric($x):
            return $x;
        case is_null($x):
            return 'NULL';
        case is_bool($x):
            return $x ? 'TRUE' : 'FALSE';
        case is_resource($x):
            return '(' . get_resource_type($x) . ')' . "$x";
        case is_object($x):
            return get_class($x);
        case is_array($x):
            break;
        case is_scalar($x):
        default:
            return "$x";
    }

    switch (count($x)) {
        case 0:
            return '[]';
        case 1:
            return '[' . spy(array_first_key($x)) . ' => ' . spy(array_pop($x)) . ']';
        case 2:
            return '[' . spy(array_first_key($x)) . ' => ' . spy(array_shift($x)) . ', '
                       . spy(array_last_key($x))  . ' => ' . spy(array_pop($x))   . ']';
        default:
            return '[' . spy(array_first_key($x)) . ' => ' . spy(array_shift($x)) .
                   ', ..., ' .
                         spy(array_last_key($x)) .  ' => ' . spy(array_pop($x)) . ']';
    }

    trigger_error('Something terrible has happened.');
}

function field_collection_item_value($field, $item, $value = 'value', $index = 0, $default = null) {
    return ($values = field_collection_item_values($field, $item, $value, $default)) ? array_shift($values) : $default;
}

function field_collection_item_values($field, $item, $value = 'value', $default = null) {
    $items  = array_first($item['entity']['field_collection_item']);
    $field  = 'field_' . preg_remove('/^field_/', $field);
    $values = array();
    foreach (array_get(array_get($items, $field, array()), '#items', array()) as $item) {
        if (!array_key_exists($value, $item)) {
            trigger_error('Value ' . spy($value) . ' does not exist for item ' . spy($item) . '.');
        }
        $values[] = array_get($item, $value, $default);
    }
    return $values;
}

?>

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
