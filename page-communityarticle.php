<?php 
/* Template Name: Community Article */ 
get_header(); ?>

<?php $main = get_field('main_id'); ?>
<div id="main <?php echo $main; ?>" class="page-communityarticle page-halfbanner">

	<?php get_template_part('inc/halfbanner'); ?>


	<section class="block block-text bg-light">
		<div class="container block-pad-v">

			<div class="row">
				<div class="col-lg-7">
					<div class="richtext text-sm">
						<?php the_content(); ?>
					</div>
				</div>
				<div class="col-lg-4 offset-lg-1">
					<div class="sidebar">
						<?php if (have_rows('resource_links')){ ?>
						<h3><?php _e( 'Resources', 'html5blank' ); ?></h3>
						<?php }?>

						<?php while( have_rows('resource_links') ): the_row(); ?>
							<div class="card-item with-hover">
								<h3><?php echo get_sub_field('resource_title')?></h3>
								<p><?php echo get_sub_field('resource_description')?></p>
								<div class="link-list">
									
									<a href="<?php echo get_sub_field('resource_link')?>" target="_blank">
										<span class="icon-inline sm blue">
											<?php get_template_part('inc/offsite.svg'); ?>
										</span>
										<?php echo get_sub_field('resource_link_title')?>
									</a>
								</div>
							</div>
						<?php endwhile; ?>
						

					</div>
				</div>
			</div>
			
		</div>
	</section>

</div>

<?php get_footer(); ?>
