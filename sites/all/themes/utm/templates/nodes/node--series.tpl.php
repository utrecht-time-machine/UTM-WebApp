<?php



//prepare data



$photo = (isset($content['field_photo']) ? image_style_url('resize', $content['field_photo']['#items'][0]['uri']) : false);
$head1 = (isset($content['field_head']) ? $content['field_head']['#items'][0]['value'] : false);
$head2 = (isset($content['field_teaser']) ? $content['field_teaser']['#items'][0]['value'] : false);
$items = (isset($content['field_location']) ? $content['field_location']['#items'] : false);
$items_list = array();
if($items){
	foreach($items as $e){
		$items_list[] = $e['target_id'];
	}
}



//location view



if(!empty($items_list)){
	$view = views_embed_view('misc', 'location_series', implode('+', $items_list));
}



//language + translations



$lang = (isset($content['field_lang']) ? $content['field_lang']['#items'][0]['value'] : 'nl');
$lang_str = array(
	'header-label' => array('nl' => 'Serie', 'en' => 'Series'),
	'list' => array('nl' => 'Locaties', 'en' => 'Locations'),
	'map' => array('nl' => 'Kaart', 'en' => 'Map'),
	'geo-user' => array('nl' => 'Mijn locatie', 'en' => 'My location'),
);



//build map



if(!empty($items_list)){
	$map_id = uniqid('map-');
	$map = utm_map(
		$map_id,
		$lang,
		false,
		$items_list,
		52.090833,
		5.122222,
		14,
		false
	);
}
?>
<article class="<?= $classes; ?> clearfix node-<?= $node->nid; ?>"<?= $attributes; ?>>
<?php if($unpublished): ?>
	<div class="unpublished">Draft &mdash; niet gepubliceerd</div>
<?php endif; ?>
	<div class="block-header" data-uri="<?= $photo; ?>">
		<div>
			<div>
				<span class="label"><?= $lang_str['header-label'][$lang]; ?></span>
				<h1><?= $node->title; ?></h1>
<?php if($head1 || $head2): ?>
				<p><?= ($head1 ? '<strong>'.$head1.'</strong> &mdash; ' : '').($head2 ? $head2 : ''); ?></p>
<?php endif; ?>
			</div>
		</div>
	</div>
	<?= render($content['field_block']); ?>
	<div class="band band-node">
<?php if(!empty($items_list)): ?>
		<div class="series-list-container">
			<div class="section-header">
				<div>
					<h2><?= count($items_list).' '.strtolower($lang_str['list'][$lang]); ?></h2>
				</div>
				<div></div>
			</div>
			<?= $view."\n"; ?>
		</div>
		<div class="node-map">
			<div class="section-header">
				<div>
					<h2><?= $lang_str['map'][$lang]; ?></h2>
				</div>
				<div>
					<a class="geo-user-btn" data-map="<?= $map_id; ?>"><?= $lang_str['geo-user'][$lang]; ?></a>
				</div>
			</div>
			<?= $map; ?>
		</div>
<?php endif; ?>
	</div>
</article>