<?php
// Block: Slider Images (Logos)
// Renders a Slick carousel of logo images
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
    <div class="slider slider-for">
        <?php if (have_rows('slider_images')) : ?>
            <?php while (have_rows('slider_images')) : the_row(); ?>
                <?php
                $logoimage = get_sub_field('slider_logo');
                ?>
                <div class="slide">
                    <img src="<?php echo esc_url($logoimage['url']); ?>" alt="<?php echo esc_attr($logoimage['alt']); ?>">
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>
