<?php if($rows): ?>
<?php $rand = uniqid('swiper-'); ?>
<div class="swiper">
	<div class="section-header">
<?php if($header): ?>
		<div>
			<?= $header; ?>
		</div>
<?php endif; ?>
		<div>
			<div class="swiper-btn prev <?= $rand; ?>"></div>
			<div class="swiper-btn next <?= $rand; ?>"></div>
		</div>
	</div>
	<div class="swiper-container <?= $rand; ?>" data-id="<?= $rand; ?>">
		<div class="swiper-wrapper">
			<?= $rows; ?>
		</div>
	</div>
	<div class="swiper-pagination <?= $rand; ?>"></div>
</div>
<?php endif; ?>