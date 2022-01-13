<article class="<?= $classes; ?> clearfix node-<?= $node->nid; ?>"<?= $attributes; ?>>
<?php if($unpublished): ?>
	<div class="unpublished">Draft &mdash; niet gepubliceerd</div>
<?php endif; ?>
	<?= render($content['field_block']); ?>
</article>