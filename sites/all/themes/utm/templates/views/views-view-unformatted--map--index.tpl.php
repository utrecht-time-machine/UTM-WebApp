<div class="index-section">
<?php if(!empty($title)): ?>
	<h2><?= $title; ?></h2>
<?php endif; ?>
<?php foreach($rows as $id => $row): ?>
	<div<?php if($classes_array[$id]): ?> class="<?= $classes_array[$id]; ?>"<?php endif; ?>>
		<?= $row; ?>
	</div>
<?php endforeach; ?>
</div>