<footer class="footer" role="contentinfo">

<?php 

	$homeid = "option";
?>

<div class="footer-top bg-dark">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 has-border">
					<div class="container-xs">
						<strong><?php echo get_field('discussion_text',$homeid);?></strong>

						<div class="link-container d-flex justify-content-between">
							<a href="https://github.com/dashpay"><div class="icon-el github"></div></a>
							<a href="https://discordapp.com/invite/PXbUxJB"><div class="icon-el discord"></div></a>
							<a href="https://t.me/dash_chat"><div class="icon-el telegram"></div></a>
							<a href="https://staging-www.dash.org/forum/"><div class="icon-el dashforum"></div></a>
							<a href="https://blog.dash.org/"><div class="icon-el dashblog"></div></a>
						</div>

					</div>
				</div>
				<div class="col-lg-6">
					<div class="container-xs">
						<strong><?php echo get_field('social_text',$homeid);?></strong>
						<div class="link-container d-flex justify-content-between">
							<a href="https://reddit.com/r/dashpay/"><div class="icon-el reddit"></div></a>
							<a href="https://twitter.com/Dashpay"><div class="icon-el twitter"></div></a>
							<a href="https://www.youtube.com/c/DashOrg"><div class="icon-el youtube"></div></a>
							<a href="https://www.linkedin.com/company/10424093"><div class="icon-el linkedin"></div></a>
							<a href="https://www.instagram.com/dashpay/"><div class="icon-el instagram"></div></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				
				<div class="col-lg-7 has-border desktop-footer">
					<div class="row sitemap">

					<?php while( have_rows('navigation_main',$homeid) ): the_row();
						$posts = get_sub_field('nav_item_list');
						?>
						<div class="col-lg-3 col-6">

							<!-- <h4 class="text-white"><?php echo get_sub_field('nav_item_title'); ?></h4> -->

							<?php 
							$idx = 0;
							foreach( $posts as $post):
								setup_postdata($post);
								$idx++; ?>
								<?php if ($idx==1) {?> 
								<h4><!--<a href="<?php the_permalink(); ?>">--><?php the_title(); ?><!--</a>--></h4>
								<?php } else { ?> 
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								<?php }?>
							<?php endforeach; 
							wp_reset_postdata(); ?>
							
						</div>
					<?php endwhile; ?>
						
					</div>
				</div>
				<div class="col-lg-7 mobile-footer">
    <div class="row sitemap" id="navbar-footer">
        <?php while ( have_rows('navigation_main', $homeid) ): the_row(); 
            $navposts = get_sub_field('nav_item_list'); ?>
            <div class="navbar-container-footer col-lg-3 col-6">
                <div class="navbar-item">
                    <div class="link">
                        <!-- Assume first post should be visible as the main item with an arrow -->
                        <a href="<?php echo get_permalink($navposts[0]->ID); ?>">
                            <?php echo get_the_title($navposts[0]->ID); ?>
                        </a>
                        <span class="arrow"><img src="/wp-content/uploads/arrow-menu.svg"></span>
                    </div>
                    <!-- Check if there are more than one post and create dropdown -->
                    <?php if ( count($navposts) > 1 ): ?>
                    <div class="dropdown" style="display:none">
                        <?php foreach( $navposts as $index => $navpost ): if ($index == 0) continue; // Skip the first post as it's used above ?>
                            <div class="link">
                                <a href="<?php echo get_the_permalink($navpost->ID); ?>">
                                    <?php echo get_the_title($navpost->ID); ?>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
				<div class="col-lg-3 block-support">
				<a href="https://support.dash.org"><div class="support">
				  <div class="i-support">
				    <img src="https://media.dash.org/wp-content/uploads/support.svg">
				  </div>
				  <div class="t-support">
				  <strong>Contact support</strong>
				  <p>Full services support desk with humans</p>
				  </div>
					</div></a>
					<div class="row newsletter">
						<div class="col-12">
							<?php get_template_part('inc/newsletterform'); ?>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="footer-terms">
	        <div class="copyright">©2025 Dash. All rights reserved</div>
		<div class="terms">
			<?php 
			$posts = get_field('navigation_privacy',$homeid);
			$post = $posts[0];
			setup_postdata($post); 
			?>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			<span class="divider">/</span>
			<?php 
			$post = $posts[1];
			setup_postdata($post); ?>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			<span class="divider">/</span>
			<?php 
			$post = $posts[2];
			setup_postdata($post); ?>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			<?php wp_reset_postdata(); ?>							
		</div>
	</div>

</footer>

</div>

<?php wp_footer(); ?>

</body>
</html>
