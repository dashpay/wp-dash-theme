<?php 
/* Template Name: Large Banner Page */ 
get_header(); ?>

<div id="main" class="page-largebanner">

	<?php if (get_field( "hide_large_banner" )!='yes') { ?>
	<div class="banner <?php if ( get_field( "large_banner_embed" )!='' ){echo 'has-embed';}?>" style="background-image:url(<?php echo get_field( "large_banner_image" ); ?>)">
		<?php if ( get_field( "large_banner_embed" )=='' ){?>
		<div class="caption-container">
			<div class="caption">
				<h1><?php echo get_field( "large_banner_title" ); ?></h1>
				<p><?php echo get_field( "large_banner_subtitle" ); ?></p>

				<?php if ( get_field( "large_banner_video" )!='' ){
					?>
					<a class="playvideo-js" href="<?php echo get_field( "large_banner_video" )?>" data-fancybox>
						<i class="icon-el play" title="Play Video"></i>
					</a>
				<?php
				}; ?>
			</div>
		</div>
		<?php } else {
			echo get_field( "large_banner_embed" );
		}?>
	</div>
	<?php } ?>

	<?php if(get_field('title_banner')==true){ ?>
	<div class="banner-shape container pull-up">
		<div class="bg bg-gradient-v"></div>
		<div class="row flex-lg-wrap">
			<div class="d-block col-6 mx-auto">
				<img src="<?php echo get_field('title_image'); ?>" alt class="img-fluid d-block">
				<p class="d-block text-center mt-2"><?php echo get_field('title_text'); ?></p>
			</div>
		</div>
	</div>

	<?php } else { 
	if( have_rows('callout_items') ): ?>
	<div class="banner-shape container pull-up">
		<div class="bg bg-gradient-v"></div>
		<div class="row flex-lg-nowrap">

			<?php while( have_rows('callout_items') ): the_row(); 
				?>
			<div class="col-lg">
				<a href="<?php the_sub_field('callout_link')?>">
					<div class="callout">
						<div class="row align-items-center">
							<div class="col-10">
								<h3><?php echo get_sub_field('callout_title'); ?></h3>

								<p><?php echo get_sub_field('callout_description'); ?></p>
							</div>
							<div class="col-1">
								<span class="icon-inline sm lightblue">
									<?php get_template_part('inc/caret.svg'); ?>
								</span>
							</div>
						</div>
					</div>
				</a>
			</div>
			<?php endwhile; ?>
			
		</div>
	</div>
	<?php endif; 
	} ?>

	<!-- section type: plain richtext -->
	<?php if ( !empty( get_the_content() ) ){ ?>
	<section class="block block-text bg-white">
		<div class="container-sm block-pad-v">
			<div class="richtext text-lg-center">
				<?php the_content(); ?>
			</div>
		</div>
	</section>
	<?php }?>


	<?php get_template_part('inc/content_lg'); ?>


</div>

<?php get_footer(); ?>
