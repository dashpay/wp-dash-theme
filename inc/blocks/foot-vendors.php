<?php
// Block Part: Footer Vendors
// Renders a vendor row at the bottom of any section (when foot_title is set)
// This is not a standalone block type - it can appear on any block

?>
<div class="container  block-pad-v block-border-top">
	<h4 class="title-small"><?php echo get_sub_field('foot_title')?></h4>
	<div class="row pt-4">
		<?php
		$links = get_sub_field('foot_vendors');

		$linkclass = "btn-white";
		if ( $darkbg ){
			$linkclass = "btn-blue";
		}

		foreach ( $links as $link) {
			$target = $link['new_tab'] ? ' target="_blank"' : '';
			?>
		<div class="col-lg-3 col-6">
			<a href="<?php echo $link['foot_vendor_link'];?>" <?php echo $target; ?> class="btn btn-vendor <?php echo $linkclass ?>">
				<div class="icon">
				<?php echo $link['foot_vendor_logo']?'<img src="'.$link['foot_vendor_logo'].'" alt>':'<span class="icon-placeholder"></span>' ?>
				</div>
				<div>
					<span class="title"><?php echo $link['foot_vendor_name'];?></span>
					<span class="link"><?php echo parse_url($link['foot_vendor_link'], PHP_URL_HOST);?></span>
				</div>
			</a>
		</div>
		<?php } ?>
	</div>
</div>
