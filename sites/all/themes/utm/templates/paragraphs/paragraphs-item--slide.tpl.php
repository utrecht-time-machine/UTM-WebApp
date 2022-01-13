<?php
$head = (isset($content['field_head']) ? $content['field_head']['#items'][0]['value'] : '');
$text = (isset($content['field_ck']) ? $content['field_ck']['#items'][0]['value'] : '');
$photo = (isset($content['field_photo_slide']) ? image_style_url('resize', $content['field_photo_slide']['#items'][0]['uri']) : false);
$video = (isset($content['field_video']) ? $content['field_video']['#items'][0] : false);
if($video){
	$video_mime = $video['filemime'];
	$video = file_create_url($video['uri']);
}
$caption = caption(
	(isset($content['field_caption']) ? $content['field_caption']['#items'][0]['value'] : false),
	(isset($content['field_source']) ? $content['field_source']['#items'][0]['value'] : false),
	(isset($content['field_source_link']) ? $content['field_source_link']['#items'][0]['original_url'] : false),
	(render($content['field_license']))
);
?>
<div class="swiper-slide">
	<div class="head">
		<div>
<?php if($video): ?>
			<video preload="auto" width="320" height="180" loop="loop" muted="muted" playsinline controls>
				<source src="<?= $video; ?>" type="<?= $video_mime; ?>">
			</video>
<?php elseif($photo): ?>
			<div class="slide-load" data-uri="<?= $photo; ?>"></div>
<?php endif; ?>
		</div>
	</div>
	<div class="core">
		<div>
			<?= $caption; ?>
			<h4><?= $head; ?></h4>
			<?= $text; ?>
		</div>
	</div>
</div>