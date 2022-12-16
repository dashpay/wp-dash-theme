<?php 
/* Template Name: Brand Assets */ 
get_header(); ?>


<div id="<?php echo get_field('main_id'); ?>" class="page-halfbanner">

	<?php get_template_part('inc/halfbanner'); ?>

	<?php if ( !empty( get_the_content() ) ){ ?>
	<section class="block block-text bg-white">
		<div class="container-sm block-pad-v">
			<div class="richtext text-lg-center">
				<?php the_content(); ?>
			</div>
		</div>
	</section>
	<?php }?>

	<div class="container">

		<section class="block-brand">
			<div class="header">
				<div class="row align-items-center">
					<div class="col-lg-8">
						<h3><?php _e( 'Color Palette', 'html5blank' ); ?></h3>
					</div>
					<div class="col-lg-4">
					</div>
				</div>
			</div>
			<div class="row content">

				<?php 
				$index = 0;
				while( have_rows('brand_palette') ): the_row();
				$index++; 
				?>
				<div class="col-md col-6">
					<div class="palette-item">
						<div class="thumb" style="background:<?php the_sub_field('hexcolor'); ?>"></div>
						<div class="text">
							<h4 class="mb-3"><?php the_sub_field('color_title'); ?></h4>
							<p><?php echo nl2br(get_sub_field('other_text')); ?></p>
						</div>
					</div>
				</div>
				<?php endwhile; ?>

			</div>
		</section>

		<section class="block-brand">
			<div class="header">
				<div class="row align-items-center">
					<div class="col-lg-8">
						<h3><?php _e( 'Typography', 'html5blank' ); ?></h3>
					</div>
					<div class="col-lg-4">
						<a href="https://fonts.google.com/selection?selection.family=Montserrat|Open+Sans|Roboto+Condensed" target="_blank" class="btn btn-download">
							<i class="icon-el offsite"></i> Google Fonts
						</a>
					</div>
				</div>
			</div>
			<div class="row content">
				<?php 
				$index = 0;
				while( have_rows('brand_typography') ): the_row();
				$index++; ?>
				<div class="col-lg-4">
					<div class="typography-item">
						<span class="lg" style="font-family:<?php the_sub_field('font_name'); ?>">
							<?php the_sub_field('font_name'); ?>
						</span>
						<div class="text-gray">
							<p><?php the_sub_field('font_description'); ?></p>
						</div>
					</div>
				</div>
				<?php endwhile; ?>
			</div>
		</section>

		<section class="block-brand">
			<div class="header">
				<div class="row align-items-center">
					<div class="col-lg-8">
						<h3><?php _e( 'Dash Logos', 'html5blank' ); ?></h3>
					</div>
					<div class="col-lg-4">
					<!-- 	<a href="#" target="_blank" class="btn btn-download">
							<i class="icon-el offsite"></i> Download all icons
						</a> -->
					</div>
				</div>
			</div>

			<div class="row content">
				<?php while( have_rows('brand_logos') ): the_row();?>
				<div class="col-lg-3 col-6">
					<div class="brandasset-item">
						<div class="image">
							<img src="<?php the_sub_field('brand_logo_image'); ?>" alt class="img-fluid">
						</div>
						<div class="richtext">
							<h4 class="mb-3"><?php the_sub_field('brand_logo_title'); ?></h4>
						</div>
						<div class="text">
							<?php while( have_rows('brand_logo_links') ): the_row();?>
							<a href="<?php the_sub_field('brand_logo_file'); ?>" download>
								<i class="icon-el download"></i> <?php the_sub_field('brand_logo_title'); ?>
							</a>
							<?php endwhile; ?>
						</div>
					</div>
				</div>
				<?php endwhile; ?>


		</section>

	 	<section class="block-brand">
			<div class="header">
				<div class="row align-items-center">
					<div class="col-lg-8">
						<h3><?php _e( 'Dash Icons', 'html5blank' ); ?></h3>
					</div>
					<div class="col-lg-4">
					</div>
				</div>
			</div>

			<div class="row content">
				<?php while( have_rows('brand_icons') ): the_row();?>
				<div class="col-lg-3 col-6">
					<div class="brandasset-item">
						<div class="image">
							<img src="<?php the_sub_field('brand_icon_image'); ?>" alt class="img-fluid">
						</div>
						<div class="richtext">
							<h4 class="mb-3"><?php the_sub_field('brand_icon_title'); ?></h4>
						</div>
						<div class="text">
							<?php while( have_rows('brand_icon_links') ): the_row();?>
							<a href="<?php the_sub_field('brand_icon_file'); ?>" download>
								<i class="icon-el download"></i> <?php the_sub_field('brand_icon_title'); ?>
							</a>
							<?php endwhile; ?>
						</div>
					</div>
				</div>
				<?php endwhile; ?>


		</section>

	<!--	<section class="block-brand">
			<div class="header">
				<div class="row align-items-center">
					<div class="col-lg-8">
						<h3>Dash Coins</h3>
					</div>
					<div class="col-lg-4">
					</div>
				</div>
			</div>

		</section> -->

		<div class="row">
			<div class="col-lg-8">
				<section class="block-brand">
					<div class="header">
						<div class="row align-items-center">
							<div class="col-lg-8">
								<h3><?php _e( 'Raw code snippet for scalable SVG', 'html5blank' ); ?></h3>
							</div>
							<div class="col-lg-4">
								<a href="#" class="btn btn-download copy-trigger" data-target="#brand-logo-copy">
									<i class="icon-el offsite"></i> <?php _e( 'Copy to Clipboard', 'html5blank' ); ?>
								</a>
							</div>
						</div>
					</div>
					<div class="content">
						<textarea class="form-control" id="brand-logo-copy"><?php echo get_field( "brand_svg_code" ); ?></textarea>
					</div>
				</section>
			</div>

			<div class="col-lg-4">
				<section class="block-brand">
					<div class="header">
						<div class="row align-items-center">
							<div class="col-lg-8">
								<h3><?php _e( 'Result', 'html5blank' ); ?></h3>
							</div>
						</div>
					</div>
					<div class="content">
						<div class="icon-inline logo">
							<?php echo get_field( "brand_svg_code" ); ?>
						</div>
					</div>
				</section>

			</div>
		</div>

		<!-- <div class="pb-5">
			<a href="#" class="btn btn-ghost blue">Download all assets</a>
		</div> -->


	</div>
</div>

<?php get_footer(); ?>
