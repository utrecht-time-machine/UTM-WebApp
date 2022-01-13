<?php
$photo = (isset($content['field_photo']) ? image_style_url('resize', $content['field_photo']['#items'][0]['uri']) : false);
$photo_caption = caption(
	(isset($content['field_caption']) ? $content['field_caption']['#items'][0]['value'] : false),
	(isset($content['field_source']) ? $content['field_source']['#items'][0]['value'] : false),
	(isset($content['field_source_link']) ? $content['field_source_link']['#items'][0]['original_url'] : false),
	(render($content['field_license']))
);
?>
<div class="block-photo">
	<div>
<?php if($photo): ?>
		<img src="<?= $photo; ?>"/>
		<?= $photo_caption; ?>
<?php endif; ?>
	</div>
</div>