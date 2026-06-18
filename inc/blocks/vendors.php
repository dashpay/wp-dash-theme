<?php
// Block: Vendors
// Renders a vendor listing grid with icons and links

?>
<div class="richtext text-center container-sm mx-auto">
	<?php echo get_sub_field('section_description') ?>
</div>
<div class="row pt-4">
	<?php
	$links = get_sub_field('block_list');
	$linkclass = "btn-white";
	foreach ( $links as $link) {
		$target = $link['new_tab'] ? ' target="_blank"' : '';
		?>
	<div class="col-lg-3 col-6">
		<a href="<?php echo $link['block_link'];?>" <?php echo $target; ?> class="btn btn-vendor <?php echo $linkclass ?> <?php echo $link['image_class'] ?>">
			<div class="icon">
			<?php echo $link['block_item_image']['url']?'<img src="'.$link['block_item_image']['url'].'" alt="'.$link['block_item_image']['alt'].'">':'<span class="icon-placeholder"></span>' ?>
			</div>
			<div class="block-icons">
				<div class="vendor-title-desc">
					<span class="title"><?php echo $link['block_item_title'];?></span>
					<span class="link"><?php echo ($link['block_item_description']!='')?$link['block_item_description']:$link['block_link'];?></span>
	            </div>
				<div class="vendor-button">
					<span class="button"><?php echo $link['callout_block_link_text'] ?></span>
	            </div>
			</div>
		</a>
	</div>
	<?php } ?>
</div>
