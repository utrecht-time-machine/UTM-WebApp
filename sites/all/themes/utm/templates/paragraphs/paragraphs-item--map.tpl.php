<?php



//prepare data



$head = (isset($content['field_head']) ? $content['field_head']['#items'][0]['value'] : '');
$lang = (isset($content['field_lang']) ? $content['field_lang']['#items'][0]['value'] : 'nl');
$lang_str = array(
	'header' => array('nl' => 'Alle locaties', 'en' => 'All locations'),
	'quick_search' => array('nl' => 'Snel zoeken', 'en' => 'Quick search'),
);
$map_id = uniqid('map-');
$map = utm_map(
	$map_id,
	$lang,
	false,
	false,
	52.090833,
	5.122222,
	14,
	false
);



//view list



$view = views_get_view('map');
$view_display = 'index';
$view->set_display($view_display);
$view_filter = $view->get_item($view_display, 'filter', 'field_lang_value');
$view_filter['value'] = $lang;
$view->set_item($view_display, 'filter', 'field_lang_value', $view_filter);
$view = $view->preview();
$view_count = trim(strip_tags(views_embed_view('count', 'location_'.$lang)));
?>
<div class="block-map" data-map="<?= $map_id; ?>">
	<div class="map-view">
		<?= $map; ?>
	</div>
	<div class="map-list">
		<h2><?= $lang_str['header'][$lang]; ?> <sup><?= $view_count; ?></sup></h2>
		<input name="index-search" type="text" placeholder="<?= $lang_str['quick_search'][$lang]; ?>"/>
		<?= $view; ?>
		<div class="index-no-result">Geen resultaten</div>
	</div>
</div>