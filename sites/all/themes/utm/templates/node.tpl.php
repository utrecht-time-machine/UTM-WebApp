<article class="<?= $classes; ?> clearfix node-<?= $node->nid; ?>"<?= $attributes; ?>>
<?php if($unpublished): ?>
	<div class="unpublished">Draft &mdash; niet gepubliceerd</div>
<?php endif; ?>
	<div class="band band-node">
<?php if($title): ?>
		<header>
			<h2><?= $title; ?></h2>
		</header>
<?php endif; ?>
		<?= render($content); ?>
	</div>
</article>