<?php
// Block: Slider Testimonials
// Renders a Slick carousel of testimonials with images and text
// Note: This block renders OUTSIDE the main container div

?>
<div class="callouts-title">
	<?php if ( get_sub_field ( "section_title")!=''){ ?>
		<h3><strong><?php echo get_sub_field('section_title'); ?></strong></h3>
		<?php } ?>
		<?php if ( get_sub_field ( "section_subheading")!=''){ ?>
	<h4><?php echo get_sub_field('section_subheading'); ?></h4>
	<?php } ?>
</div>
<div class="slider-container">
    <div class="slider slider-testimonial">
        <?php if (have_rows('slider_testimonials')) : ?>
            <?php while (have_rows('slider_testimonials')) : the_row(); ?>
                <?php
                $testimimage = get_sub_field('testimonial_image');
                $testimtext = get_sub_field('testimonial_text');
                ?>
                <div class="slide">
                    <img src="<?php echo esc_url($testimimage['url']); ?>" alt="<?php echo esc_attr($testimimage['alt']); ?>">
                    <div><?php echo $testimtext; ?></div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>
