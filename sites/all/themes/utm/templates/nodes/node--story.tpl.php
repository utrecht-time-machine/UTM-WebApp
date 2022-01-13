<?php
$slides = (isset($content['field_block']) ? $content['field_block']['#items'] : false);
$slides_list = array();
if($slides){
	foreach($slides as $e){
		$slides_list[] = $e['value'];
	}
}
$view = '';
if(!empty($slides_list)){
	$view = views_embed_view('paragraphs', 'story_slides', implode('+', $slides_list));
}
?>
<article class="<?= $classes; ?> clearfix node-<?= $node->nid; ?>"<?= $attributes; ?>>
<?php if($unpublished): ?>
	<div class="unpublished">Draft &mdash; niet gepubliceerd</div>
<?php endif; ?>
	<div class="band band-node">
		<div class="spacer">
			<h2><?= $title; ?></h2>
			<?= $view; ?>
		</div>
	</div>
</article>