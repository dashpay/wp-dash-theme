<?php
// Block: App Callout
// Renders app download section with store links and phone image

?>
<div class="dash-app-callout">
	<div class="dash-app-callout__content fade-in-left">

		<div class="container-xs">
			<div class="richtext">
				<?php echo get_sub_field('section_description') ?>
			</div>
		</div>

		<div class="dash-app-links">
			<?php
			$links = get_sub_field('block_list');
			foreach ( $links as $link) { ?>
				<div class="dash-app-links__item">
					<a href="<?php echo $link['block_link'] ?>" class="dash-btn-app">
						<img src="<?php echo $link['block_item_image']['url'] ?>" alt="<?php echo $link['block_item_image']['alt'] ?>" class="dash-img-fluid">
						<span><strong><?php echo $link['block_item_title'] ?></strong></span>
						<span><?php echo $link['block_item_description'] ?></span>
					</a>
				</div>
			<?php } ?>
		</div>

		<div class="container-xs buttons">
			<a href="<?php echo get_sub_field('block_link') ?>" class="dash-btn dash-btn-outline-black"><?php echo get_sub_field('block_action') ?></a>
		</div>

	</div>
	<div class="dash-app-callout__media">
		<div class="image image-float bottom right">
			<img width="450" src="/wp-content/uploads/home-phone-hires.png" class="dash-img-fluid">
		</div>
	</div>
</div>
