<?php 
/* Template Name: News Landing */ 
get_header(); ?>


<div id="main" class="page-news">

	<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array( 'post_type' => 'post', 'posts_per_page' => 12, 'paged' => $paged, 'cat' => implode(', ', get_field('news_category')) );
		$wp_query = new WP_Query($args); 
	?>

	<?php if ( have_posts() ) : ?>
		<div class="halfbanner">
			<div class="container">
				<button class="carousel-prev carousel-nav">
					<span class="icon-inline sm blue caret left">
						<?php get_template_part('inc/caret.svg'); ?>
					</span>
				</button>
				<button class="carousel-next carousel-nav">
					<span class="icon-inline sm blue caret right">
						<?php get_template_part('inc/caret.svg'); ?>
					</span>
				</button>

				<div class="carousel">
					<?php
					$posts = get_field('news_featured_posts');
					if( $posts ): ?>
						<?php foreach( $posts as $post): ?>
							<?php setup_postdata($post); ?>

							 	<div class="slide">
									<div class="row align-items-center">
										<div class="col-lg-8 order-lg-2">
											<a href="<?php the_permalink(); ?>"><div class="image" style="background-image:url(<?php the_post_thumbnail_url($post,'news') ?>)"></div></a>
										</div>
										<div class="col-lg-4">
											<div class="caption">
												<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
												<p><?php html5wp_excerpt('html5wp_index'); ?></p>
												<a class="btn btn-ghost white" href="<?php the_permalink(); ?>">
													<?php _e( 'Read Article', 'html5blank' ); ?>
												</a>
											</div>
										</div>
									</div>
								</div>

							<?php endforeach; ?>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div class="container">

		<div class="row news-list">
			<?php 
			if ( have_posts() ) :
				while ( have_posts() ) : the_post(); ?>
					<div class="col-lg-4 col-md-6">
						<?php get_template_part('inc/newsitem'); ?>
					</div>
				<?php endwhile;
			else: ?>
				<div style="margin-top:80px">
					<h3>
						<?php _e( 'Sorry, no news articles were found', 'html5blank'); ?>
					</h3>
				</div>
			<?php endif; ?>
		</div>

		<div class="pagination">
			<?php the_posts_pagination( array(
				'screen_reader_text' => ' ', 
				'mid_size'  => 6,
				'prev_text' => __( '<i class="icon-el caret left blue"></i>', 'textdomain' ),
				'next_text' => __( '<i class="icon-el caret right blue"></i>', 'textdomain' ),
			) );?>
		</div>


	</div>
	

</div>

<?php get_footer(); ?>
