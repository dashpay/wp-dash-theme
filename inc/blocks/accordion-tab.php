<?php
$section_title = get_sub_field('section_title');
$section_subheading = get_sub_field('section_subheading');
$items = get_sub_field('accordion_items');

if (!is_array($items) || empty($items)) {
	return;
}

$accordion_id = 'dash-accordion-' . uniqid();
?>

<section class="dash-accordion-section dash-section">
	<div class="dash-container">
		<?php if ($section_title || $section_subheading) { ?>
			<div class="dash-accordion-section__header">
				<?php if ($section_title) { ?>
					<h2><?php echo esc_html($section_title); ?></h2>
				<?php } ?>

				<?php if ($section_subheading) { ?>
					<p class="dash-text-l"><?php echo esc_html($section_subheading); ?></p>
				<?php } ?>
			</div>
		<?php } ?>

		<div class="dash-accordion" id="<?php echo esc_attr($accordion_id); ?>">
			<?php foreach ($items as $index => $item) {
				$is_open = $index === 0;
				$item_id = $accordion_id . '-item-' . $index;
			?>
				<div class="dash-accordion__item <?php echo $is_open ? 'is-active' : ''; ?>">
					<button
						class="dash-accordion__trigger"
						type="button"
						aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>"
						aria-controls="<?php echo esc_attr($item_id); ?>"
					>
						<span><?php echo esc_html($item['item_title']); ?></span>
						<span class="dash-accordion__icon" aria-hidden="true"></span>
					</button>

					<div
						class="dash-accordion__panel"
						id="<?php echo esc_attr($item_id); ?>"
						<?php echo $is_open ? '' : 'hidden'; ?>
					>
						<div class="dash-accordion__content richtext">
							<?php echo wp_kses_post($item['item_content']); ?>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</section>