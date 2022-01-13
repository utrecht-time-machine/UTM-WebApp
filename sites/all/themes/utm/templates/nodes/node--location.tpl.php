<?php



//prepare data



$photo = (isset($content['field_photo']) ? $content['field_photo']['#items'][0]['uri'] : false);
$photo_caption = caption(
	(isset($content['field_caption']) ? $content['field_caption']['#items'][0]['value'] : false),
	(isset($content['field_source']) ? $content['field_source']['#items'][0]['value'] : false),
	(isset($content['field_source_link']) ? $content['field_source_link']['#items'][0]['original_url'] : false),
	(render($content['field_license']))
);
$head = (isset($content['field_head']) ? $content['field_head']['#items'][0]['value'] : false);
$teaser = (isset($content['field_teaser']) ? $content['field_teaser']['#items'][0]['value'] : false);
$street = (isset($content['field_address']) ? $content['field_address']['#items'][0]['thoroughfare'] : '');
$blocks = render($content['field_block']);
$stories_list = array();
$stories = (isset($content['field_story']) ? $content['field_story']['#items'] : array());
if(!empty($stories)){
	foreach($stories as $e){
		$stories_list[] = $e['target_id'];
	}
}



//partner data



$partner_view = false;
$partner_list = array();
$partner = (isset($content['field_partner']) ? $content['field_partner']['#items'] : false);
if($partner){
	foreach($partner as $e){
		$partner_list[] = $e['target_id'];
	}
}
if(!empty($partner_list)){
	$partner_view = views_embed_view('misc', 'partner', implode('+', $partner_list));
}



//language + translations



$lang = (isset($content['field_lang']) ? $content['field_lang']['#items'][0]['value'] : 'nl');
$lang_str = array(
	'more-btn' => array('nl' => 'Lees meer over deze plek', 'en' => 'Read more about this place'),
	'map' => array('nl' => 'Kaart', 'en' => 'Map'),
	'geo-user' => array('nl' => 'Mijn locatie', 'en' => 'My location'),
	'partner' => array('nl' => 'Een bijdrage van', 'en' => 'Contributed by'),
);
if($lang == 'en'){
	$version_en = $node->nid;
	$version_nl = trim(strip_tags(views_embed_view('misc', 'location_sibling', $version_en)));
} else{
	$version_nl = $node->nid;
	$version_en = (isset($content['field_version_en']) ? $content['field_version_en']['#items'][0]['target_id'] : '');
}
$version_nl = (!empty($version_nl) ? base_path().drupal_get_path_alias('node/'.$version_nl) : '');
$version_en = (!empty($version_en) ? base_path().drupal_get_path_alias('node/'.$version_en) : '');



//views



$latlon = (isset($content['field_geo']) ? $content['field_geo']['#items'][0] : false);
if($latlon){
	$lat = $latlon['lat'];
	$lon = $latlon['lon'];
	$near_view = views_embed_view('location', 'near_'.$lang, $lat.','.$lon, $node->nid);
}
if(!empty($stories_list)){
	$story_view = views_embed_view('story', 'location_'.$lang, implode('+', $stories_list));
}



//build map



if($latlon){
	$map_id = uniqid('map-');
	$map = utm_map(
		$map_id,
		$lang,
		$node->nid,
		false,
		$lat,
		$lon,
		14,
		false
	);
}
?>
<article class="<?= $classes; ?> clearfix node-<?= $node->nid; ?>"<?= $attributes; ?> data-nl="<?= $version_nl; ?>" data-en="<?= $version_en; ?>">
<?php if($unpublished): ?>
	<div class="unpublished">Draft &mdash; niet gepubliceerd</div>
<?php endif; ?>
	<div class="node-head-container lazy-load"<?= ($photo ? ' data-uri="'.image_style_url('wide', $photo).'" data-uri-mob="'.image_style_url('square', $photo).'"' : ''); ?>>
		<div class="node-head">
			<div class="outer"></div>
			<div class="inner">
				<div class="reg">
					<div></div>
				</div>
				<div class="mob">
					<div></div>
				</div>
			</div>
		</div>
		<div class="close"></div>
	</div>
	<div class="band band-node">
		<?= $photo_caption; ?>
		<h1><?= $title; ?></h1>
<?php if($street): ?>
		<h3><?= $street; ?></h3>
<?php endif; ?>
<?php if($head || $teaser): ?>
		<p><?= ($head ? '<strong>'.$head.'</strong>'.($teaser ? ' &mdash; ' : '') : '').($teaser ? $teaser : ''); ?></p>
<?php endif; ?>
<?php if(!empty($blocks)): ?>
		<div class="fold">
			<a><?= $lang_str['more-btn'][$lang]; ?></a>
			<div class="fold-toggle fold-toggle-hidden">
				<?= $blocks; ?>
			</div>
		</div>
<?php endif; ?>
<?php if($partner_view): ?>
		<h4><?= $lang_str['partner'][$lang]; ?></h4>
		<div class="partner-bar">
			<?= $partner_view; ?>
		</div>
<?php endif; ?>
<?php if(!empty($stories_list)): ?>
		<?= $story_view; ?>
<?php endif; ?>
<?php if($latlon): ?>
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
<?php if($latlon): ?>
	<div class="band-container">
		<div class="band">
			<?= $near_view; ?>
		</div>
	</div>
<?php endif; ?>
</article>