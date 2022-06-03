<?php
$link = (!empty($fields['field_cast_video']->content) ? $fields['field_cast_video']->content : false);
if($link){
	$link = uri_to_embed($link, true);
}
$name = (!empty($fields['field_cast_video_1']->content) ? $fields['field_cast_video_1']->content : 'Video');
$read = (!empty($fields['field_cast_ck']->content) ? $fields['field_cast_ck']->content : false);
?>
<div class="swiper-slide">
	<div class="head">
		<div>
<?php if($link): ?>
			<div class="tv-watch">
				<div>
					<div class="tv-watch-video">
						<div>
							<iframe src="<?= $link; ?>" width="560" height="350" frameborder="0" allowfullscreen allow="accelerometer;autoplay;clipboard-write;encrypted-media;gyroscope;picture-in-picture"></iframe>
						</div>
					</div>
				</div>
			</div>
<?php endif; ?>
		</div>
	</div>
	<div class="core">
		<div>
			<h4><?= $name; ?></h4>
<?php if($read): ?>
			<?= $read."\n"; ?>
<?php endif; ?>
		</div>
	</div>
</div>