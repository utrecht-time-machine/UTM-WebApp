<?php
$head = (isset($content['field_head']) ? $content['field_head']['#items'][0]['value'] : '');
$lang = (isset($content['field_lang']) ? $content['field_lang']['#items'][0]['value'] : 'nl');
$view = views_embed_view('location', 'new_'.$lang);
$view = str_replace('[placeholder]', $head, $view);
?>
<div class="block-location-new">
	<div class="band">
		<?= $view; ?>
	</div>
</div>