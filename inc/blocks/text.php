<?php
// Block: Text
// Renders a text section with optional title, subheading, and rich text content

?>
<div class="text-section-header-wrap">
	<?php if ( get_sub_field ( "section_title")!=''){ ?>
	<h3><strong><?php echo get_sub_field('section_title'); ?></strong></h3>
	<?php } ?>

	<?php if ( get_sub_field ( "section_subheading")!=''){ ?>
	<h4><?php echo get_sub_field('section_subheading'); ?></h4>
	<?php } ?>
</div>
<div class="richtext text-lg-center">
	<?php echo get_sub_field('section_description') ?>
</div>
