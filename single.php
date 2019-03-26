<?php get_header(); 

if ($post->post_type=='downloadgroup'){
	header('Location: /downloads');
	exit();
}

?>

<div id="main" class="no-banner page-newsdetail">
	<div class="container mx-auto">

		<div class="row my-5">
			<div class="col-12"><a href="/community/news" class="text-gray title-small backlink"><?php _e( 'Back to all articles', 'html5blank' ); ?></a></div>
		</div>

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	<div class="row mb-5">
		<div class="col-lg-7">
			
				<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
					<!--<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">-->
						<img src="<?php the_post_thumbnail_url('news_thumb'); // Fullsize image for the single post ?>" class="img-fluid mb-4" alt>
					<!--</a>-->
				<?php endif; ?>

				<span class="date text-gray title-small"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>

				<h2 class="py-3">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<strong><?php the_title(); ?></strong>
					</a>
				</h2>

				<div class="richtext text-sm mb-5" id="test">
					<?php the_content(); // Dynamic Content ?>
					<p>
						<?php if( get_field('original_author') ): ?>
							Author: <?php echo the_field('original_author') ?><br>
						<?php endif; ?>
						<?php if( get_field('original_link') ): ?>
							Original link: <a href="<?php echo the_field('original_link') ?>"><?php echo the_field('original_link') ?></a>
						<?php endif; ?>
					</p>
				</div>
				<?php 
					// the_tags( __( 'Tags: ', 'html5blank' ), ', ', '<br>'); 
				?>
				<?php 
				// _e( 'Categorised in: ', 'html5blank' ); the_category(', '); 
				?>
				<?php edit_post_link(); // Always handy to have Edit Post Links available ?>

				<?php 
				// comments_template(); 
				?>

				<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5c94c2f7ea8463de"></script>
                <div class="addthis_inline_share_toolbox"></div>

				<hr>

				<?php $author_id=$post->post_author; ?>
				<div class="news-author mb-5">
					<div class="row">
						<div class="col-12"><h4><?php _e( 'About the author', 'html5blank' ); ?></h4></div>
					</div>
					<hr>
					<div class="row">

						<?php 
							$img = get_field('author_image', 'user_'.$author_id); 
							if ( $img!='' ){
								echo '<div class="col-lg-auto col-3"><img src="'.$img.'" class="img-fluid"></div>';
							}
						?>
						
						<div class="col-9">
							<h4><?php echo get_the_author_meta('display_name') ?></h4>
							<p><?php the_field('positionspecialty', 'user_'.$author_id); ?></p>
							<p><?php echo nl2br(get_the_author_meta('description')); ?></p>
						</div>
					</div>
				</div>
		</div>
		<div class="col-lg-4 offset-lg-1">
			<div class="sidebar">

				<div class="news-author mb-5">
					<div class="row d-lg-flex d-none">
						<?php 
							$img = get_field('author_image', 'user_'.$author_id); 
							if ( $img!='' ){
								echo '<div class="col-3"><img src="'.$img.'" class="img-fluid"></div>';
							}
						?>
						<div class="col-9">
							<h4><?php echo get_the_author_meta('display_name') ?></h4>
							<p><?php the_field('positionspecialty', 'user_'.$author_id); ?></p>
						</div>
					</div>
					<hr>
					<div class="clearfix">
						
					
						<?php 
							$fb = get_field('facebook_link', 'user_'.$author_id); 
							$tw = get_field('twitter_link', 'user_'.$author_id); 
							$wa = get_field('whatsapp', 'user_'.$author_id); 
							$other = get_field('other_link', 'user_'.$author_id); 
						?>

						<?php if ($fb!=''){?>
							<a href="<?php echo $fb?>" class="fb" target="_blank"><?php get_template_part('inc/fb.svg'); ?></a>
						<?php }?>
						<?php if ($tw!=''){?>
							<a href="<?php echo $tw?>" class="twitter" target="_blank"><?php get_template_part('inc/twitter.svg'); ?></a>
						<?php }?>
						<?php if ($wa!=''){?>
							<a href="<?php echo $wa?>" class="whatsapp" target="_blank"><?php get_template_part('inc/whatsapp.svg'); ?></a>
						<?php }?>
						<?php if ($other!=''){?>
							<a href="<?php echo $other?>" class="offsite" target="_blank"><?php get_template_part('inc/offsite.svg'); ?></a>
						<?php }?>


					</div>
					<hr>
				</div>

				<div class="news-related">

					<?php
						$args = array( 'numberposts' => '5' );
						$recent_posts = wp_get_recent_posts( $args );
						foreach( $recent_posts as $recent ){ ?>

							<div class="item">
								<span class="title-small date">12 January 2019</span>
								<a href="<?php echo get_permalink($recent["ID"])?>"><h4><?php echo $recent["post_title"]?></h4></a>
							</div>


						<?php }
						wp_reset_query();
					?>
				
				</div>

			</div>

		</div>
	</div>

	<?php endwhile; ?>

	<?php else: ?>

		<!-- article -->
		<article>

			<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>

		</article>
		<!-- /article -->

	<?php endif; ?>

	</div>
</div>


<?php get_footer(); ?>
