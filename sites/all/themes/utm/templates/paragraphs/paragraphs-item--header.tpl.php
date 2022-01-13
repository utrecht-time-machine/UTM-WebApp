<?php
$ck = (isset($content['field_ck']) ? $content['field_ck']['#items'][0]['value'] : '');
$photo = (isset($content['field_photo']) ? image_style_url('resize', $content['field_photo']['#items'][0]['uri']) : false);
?>
<div class="block-header" data-uri="<?= $photo; ?>">
	<div>
		<div>
			<?= $ck; ?>
		</div>
	</div>
</div>