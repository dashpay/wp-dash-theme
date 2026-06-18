<?php
// Block: CTA with Background Image
// Renders a full-width call-to-action section with background image
// Note: This block renders OUTSIDE the main container div

?>
<div class="cta-background-image"
style="background-image:url(<?php echo get_sub_field( "cta_background_image" ); ?>)">
	<div class="cta-wrap <?php if ( get_sub_field( 'cta-text-white') ) { echo 'cta-text-white'; }?>">
		<div class="cta-content">
			<h3><strong><?php echo get_sub_field( "cta_background_image_heading" ); ?></strong></h3>

			<?php if ( get_sub_field ( "cta_background_image_paragraph")!=''){
			?>
			<p><?php echo get_sub_field('cta_background_image_paragraph'); ?></p>
			<?php } ?>

			<?php if ( get_sub_field( "cta_background_image_button" )!=''){
			?>
			<a href="<?php echo get_sub_field( "cta_background_image_button_link" )?>"
			class="banner-btn btn btn-blue"
			target="<?php if ( get_sub_field( "cta_background_image_button_new_tab" ) ) { echo "_blank"; }?>">
			<?php echo get_sub_field( "cta_background_image_button" )?></a>
			<?php
			}; ?>
		</div>
	</div>
</div>
