<?php
// Block: App Callout
// Renders app download section with store links and phone image
// Partial Bootstrap cleanup: layout moved to Dash utilities
?>

<div class="dash-app-callout">
	<div class="dash-app-callout__content fade-in-left">
		<div class="block-pad-v">
			<div class="container-xs">
				<div class="richtext">
					<?php echo get_sub_field('section_description'); ?>
				</div>
			</div>

			<?php
			$links = get_sub_field('block_list');
			if (is_array($links)) { ?>
				<div class="dash-app-links">
					<?php foreach ($links as $link) { ?>
						<div class="dash-app-links__item">
							<a href="<?php echo $link['block_link']; ?>" class="btn btn-hovershadow dash-app-link">
								<img src="<?php echo $link['block_item_image']['url']; ?>" alt="<?php echo $link['block_item_image']['alt']; ?>">
								<span><strong><?php echo $link['block_item_title']; ?></strong></span>
								<span><?php echo $link['block_item_description']; ?></span>
							</a>
						</div>
					<?php } ?>
				</div>
			<?php } ?>

			<div class="container-xs buttons">
				<a href="<?php echo get_sub_field('block_link'); ?>" class="btn btn-ghost">
					<?php echo get_sub_field('block_action'); ?>
				</a>
			</div>
		</div>
	</div>

	<div class="dash-app-callout__media col-right">
		<div class="image image-float bottom right dash-app-callout__image">
			<img width="450" src="/wp-content/uploads/home-phone-hires.png" alt="">
		</div>
	</div>
</div>
