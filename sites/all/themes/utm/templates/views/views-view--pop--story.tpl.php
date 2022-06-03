<?php if($rows): ?>
<?php $rand = uniqid('swiper-'); ?>
<div class="swiper swiper-story">
	<div class="swiper-container <?= $rand; ?>" data-id="<?= $rand; ?>">
		<div class="swiper-wrapper">
			<?= $rows; ?>
		</div>
	</div>
	<div class="swiper-pagination <?= $rand; ?>"></div>
	<div class="swiper-btn prev <?= $rand; ?>"></div>
	<div class="swiper-btn next <?= $rand; ?>"></div>
</div>
<?php endif; ?>