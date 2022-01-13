<?php
$embed = (isset($content['field_teaser']) ? $content['field_teaser']['#items'][0]['value'] : '');
$caption = (isset($content['field_caption']) ? $content['field_caption']['#items'][0]['value'] : false);
$ratio_fill = (isset($content['field_ratio_fill']) ? $content['field_ratio_fill']['#items'][0]['value'] : '0');
?>
<div class="block-embed ratio-fill-<?= $ratio_fill; ?>">
	<div>
		<div class="embed-inner">
			<div>
				<?= $embed; ?>
			</div>
		</div>
<?php if($caption): ?>
		<div class="caption-small">
			<?= $caption; ?>
		</div>
<?php endif; ?>
	</div>
</div>