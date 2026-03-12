<?php
// Block: App Callout
// Renders app download section with store links and phone image

?>
<div class="row">
	<div class="col-lg-6">

		<div class="block-pad-v fade-in-left">
			<div class="container-xs">
				<div class="richtext">
					<?php echo get_sub_field('section_description') ?>
				</div>
			</div>

			<div class="row d-none d-md-flex py-3">

				<?php
				$links = get_sub_field('block_list');
				foreach ( $links as $link) { ?>

					<div class="col-4">
						<a href="<?php echo $link['block_link'] ?>" class="btn btn-hovershadow">
							<img src="<?php echo $link['block_item_image']['url'] ?>" alt="<?php echo $link['block_item_image']['alt'] ?>" class="img-fluid">
							<span><strong><?php echo $link['block_item_title'] ?></strong></span><span><?php echo $link['block_item_description'] ?></span>
						</a>
					</div>
			 	<?php } ?>
			</div>

			<div class="container-xs buttons">
				<a href="<?php echo get_sub_field('block_link') ?>" class="btn btn-ghost"><?php echo get_sub_field('block_action') ?></a>
			</div>
		</div>
	</div>
	<div class="col-lg-6 col-right">
		<div class="image image-float bottom right">
			<img width="450" src="/wp-content/uploads/home-phone-hires.png" class="img-fluid">
		</div>
	</div>
</div>
