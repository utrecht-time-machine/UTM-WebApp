<?php
$head = (isset($content['field_head']) ? $content['field_head']['#items'][0]['value'] : '');
$lang = (isset($content['field_lang']) ? $content['field_lang']['#items'][0]['value'] : 'nl');
$view = views_get_view('misc');
$view_disp = 'location_hot';
$view->set_display($view_disp);
$view->set_arguments(array($lang));
$view = $view->preview();
?>
<div class="block-location-hot">
	<div class="band">
<?php if($head): ?>
		<div class="section-header">
			<div>
				<h2><?= $head; ?></h2>
			</div>
			<div></div>
		</div>
<?php endif; ?>
		<div class="view-card">
			<?= $view; ?>
		</div>
	</div>
</div>