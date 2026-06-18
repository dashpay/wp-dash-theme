<?php
/* Template Name: Large Banner Page */
get_header(); ?>

<div id="<?php echo get_field('main_id'); ?>" class="page-largebanner">

	<?php
	// Banner
	if (get_field( "hide_large_banner" )!='yes') {
		$banner_layout = get_field('banner_layout');
		if ( !$banner_layout ) { $banner_layout = 'center'; }

		switch($banner_layout) {
			case 'split':
				include( locate_template('inc/banners/banner-split.php') );
				break;
			case 'hero_cards':
				include( locate_template('inc/banners/banner-hero-cards.php') );
				break;
			case 'center':
			default:
				include( locate_template('inc/banners/banner-center.php') );
				break;
		}
	}
	?>

	<?php
	// Title banner or Callout items
	if (get_field('title_banner') == true) {
		include( locate_template('inc/page-parts/title-banner.php') );
	} elseif ( have_rows('callout_items') ) {
		include( locate_template('inc/page-parts/callout-items.php') );
	}
	?>

	<?php
	// Plain richtext content from WordPress editor
	if ( !empty( get_the_content() ) ) {
		include( locate_template('inc/page-parts/richtext-content.php') );
	}
	?>

	<?php
	// Accordions
	if ( have_rows('accordions') ) {
		include( locate_template('inc/page-parts/accordions.php') );
	}
	?>

	<?php
	// Content sections (blocks)
	get_template_part('inc/content_lg');
	?>

</div>

<?php get_footer(); ?>
