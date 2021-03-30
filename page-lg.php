<?php 
/* Template Name: Large Banner Page */ 
get_header(); ?>

<div id="main" class="page-largebanner">

	<?php if (get_field( "hide_large_banner" )!='yes') { ?>
	<div class="<?php 
		if (get_field( "hide_large_banner" )=='no-overlay') {
			echo('banner-no-overlay ');
		} else {
			echo('banner ');
		}  
		if (get_field( "large_banner_embed" )!=''){
			echo 'has-embed';
		}?>" style="background-image:url(<?php echo get_field( "large_banner_image" ); ?>)">
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
			<div class="d-block col-10 mx-auto">
				<img src="<?php echo get_field('title_image'); ?>" alt class="mx-auto w-50 d-block">
				<h5 class="d-block text-center mt-2"><?php echo get_field('title_text'); ?></h5>
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

	<?php if (have_rows('accordions')){?>
	<section class="block block-accordions bg-white">
		<div class="container block-pad-v">
			<div class="accordion" id="accordion1">

			<?php 
				$i = 0;
				while( have_rows('accordions') ): the_row(); 
				$i++;
			?>
			  <div class="card">
			    <div class="card-header" id="heading<?php echo $i;?>">
			      <h5 class="mb-0">
			        <a class="" data-toggle="collapse" data-target="#panel<?php echo $i;?>" aria-expanded="false" aria-controls="panel<?php echo $i;?>">
			        	<?php echo get_sub_field('panel_title');?>
						<span class="icon-inline sm blue"><?php get_template_part('inc/caret.svg'); ?></span>
					</a>
			      </h5>
			    </div>

			    <div id="panel<?php echo $i;?>" class="collapse" aria-labelledby="heading<?php echo $i;?>" data-parent="#accordion1">
			      <div class="card-body">
			      	<div class="richtext text-sm">
				        <?php echo get_sub_field('panel_content')?>
				       </div>
			      </div>
			    </div>
			  </div>
			<?php endwhile; ?>
			  
			</div>
		</div>
	</section>
	<?php } ?>

	<?php get_template_part('inc/content_lg'); ?>


</div>

<?php get_footer(); ?>
