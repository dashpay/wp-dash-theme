<?php

$count = 0;
while( have_rows('content_sections') ): the_row();

	// CONTENT BLOCKS
	// text : Text
	// callouts : Callouts
	// 2col_grid : 2 Column Grid
	// 2col_image : 2 Column Image
	// 2col_app : 2 Column App
	// 2col_terminal : 2 Column Terminal
	// stats : Stats
	// vendors : Vendors [buy and spend pages]
	// news : Latest News
	// proposals : Latest Proposals
	// app : App Callout
	// events : Events Table
	// speed : Speed Table [business]
	// cta_with_background_image: CTA with Background Image
	// slider_images : Slider Logos
	// slider_testimonials : Slider Testimonials

	$count++;

	$type = get_sub_field('section_type');
	$bg = get_sub_field('background_color');
	$padding = get_sub_field('section_padding');
	$section_id = get_sub_field('section_id');
	$section_class = get_sub_field('section_class');

	$classes = ['block-'.$type];

	if ($count==1 && get_field( "hide_large_banner" )=='yes' ){
		$classes[] = 'first-pad';
	}

	if ( $type=='app' ){
		$bg = 'bg-gradient-h';
	 	$padding = 'block-pad-none';
		$classes[] = 'block-text';
	}

	if ( $type=='2col_app' ){
		$padding = 'block-pad-none';
		$classes[] = 'block-text';
    }

	if ( $type=='speed' ){
		$bg = 'bg-gradient-dark-v';
	}

	if ( $type=='proposals' ){
		$bg = 'bg-lightgray';
	}

	if ( get_sub_field('callout_desktop_only_image')!='' ){
		$classes[] = 'walkthrough';
	}

	$bg = $bg?$bg:'bg-white';
	$darkbg = true;
	if ($bg == 'bg-white' || $bg=='bg-light' || $bg=='bg-light2'){
		$darkbg = false;
	}

	$padding = $padding?$padding:'block-pad-v';
?>
<section class="block <?php echo $section_class;?> <?php echo $bg;?> <?php echo implode(' ',$classes); ?>" <?php if ($section_id!=''){echo "id=\"$section_id\"";} ?>>
            <div class="added-code">
				<?php echo get_sub_field('section_code') ?>
			</div>
    <div class="container <?php echo $padding; ?>">

		<?php
		// Blocks that render INSIDE the container
		switch($type) {
			case 'text':
				include( locate_template('inc/blocks/text.php') );
				break;
			case 'callouts':
				include( locate_template('inc/blocks/callouts.php') );
				break;
			case '2col_grid':
			case '2col_image':
			case '2col_app':
			case '2col_terminal':
				include( locate_template('inc/blocks/2col.php') );
				break;
			case 'stats':
				include( locate_template('inc/blocks/stats.php') );
				break;
			case 'vendors':
				include( locate_template('inc/blocks/vendors.php') );
				break;
			case 'news':
				include( locate_template('inc/blocks/news.php') );
				break;
			case 'proposals':
				include( locate_template('inc/blocks/proposals.php') );
				break;
			case 'app':
				include( locate_template('inc/blocks/app.php') );
				break;
			case 'events':
				include( locate_template('inc/blocks/events.php') );
				break;
			case 'speed':
				include( locate_template('inc/blocks/speed.php') );
				break;
		}
		?>

	</div>

	<?php
	// Blocks that render OUTSIDE the container
	if ($type == 'cta_with_background_image') {
		include( locate_template('inc/blocks/cta-background.php') );
	}
	?>

	<?php
	// Footer vendors - can appear on any block type
	if ( get_sub_field('foot_title') !='' ) {
		include( locate_template('inc/blocks/foot-vendors.php') );
	}
	?>

	<?php
	// Sliders render outside the main container
	if ($type == 'slider_images') {
		include( locate_template('inc/blocks/slider-images.php') );
	}
	if ($type == 'slider_testimonials') {
		include( locate_template('inc/blocks/slider-testimonials.php') );
	}
	?>

</section>

<?php endwhile; ?>
