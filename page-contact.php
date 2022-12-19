<?php 
/* Template Name: Contact Page */ 
get_header(); ?>

<div id="<?php echo get_field('main_id'); ?>" class="page-halfbanner page-contact">


	<?php get_template_part('inc/halfbanner'); ?>




	<section class="block bg-white block-2col_grid">
		<div class="container block-pad-v">
			<div class="row align-items-center">
				<div class="col-lg-6">
					<div class="container-xs fade-in-left">
						<div class="richtext">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
				<div class="col-lg-6">

					<div class="row text-center grid-item-container">

					<?php
					while( have_rows('social_media_links') ): the_row(); ?>
						<div class="col-lg-3 col-6">
							<a href="<?php echo get_sub_field('link_url') ?>" target="_blank" class="btn btn-hover btn-hovershadow">
								<div class="image">
									<?php if (get_sub_field('link_icon')) {?>
										<img src="<?php echo get_sub_field('link_icon') ?>" alt class="img-fluid socialicons">
									<?php } ?>
									
								</div>
								<span class="text-blue">
									<?php echo get_sub_field('link_name') ?>
								</span>
							</a>
						</div>
					<?php endwhile; ?>

					</div>

				</div>
			</div>
		</div>
	</section>

	<section class="block bg-light block-newsletter">
		<div class="container block-pad-v">
			<div class="row align-items-center">
				<div class="col-lg-5">
					<h3 class="my-lg-0 mb-3"><strong><?php echo get_field('newsletter_text') ?></strong></h3>
				</div>
				<div class="col-lg-7">
					<div class="form px-lg-3 px-3">
						<?php get_template_part('inc/newsletterform'); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	
</div>



<?php get_footer(); ?>
