<footer class="footer" role="contentinfo">

	<?php 

		$homeid = "option";
	?>

		<div class="footer-top">
			<div class="container">
				<div class="brand">
					<div class="logo">
						<a href="<?php echo home_url(); ?>">
							<?php get_template_part('inc/dashlogo.svg'); ?>
						</a>
					</div>
					<p><?php echo get_field('dash_tagline',$homeid); ?></p>
				</div>
				<div class="row">
					
					<div class="col-lg-7 has-border">
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
									<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
									<?php } else { ?> 
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									<?php }?>
								<?php endforeach; 
								wp_reset_postdata(); ?>
								
							</div>
						<?php endwhile; ?>
							
						</div>
					</div>
					<div class="col-lg-2 has-border">
						<div class="about">

							<?php 
							$posts = get_field('navigation_about_links',$homeid);
							foreach( $posts as $post):
								setup_postdata($post); ?>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							<?php endforeach; 
							wp_reset_postdata(); ?>
								<a href="https://insight.dash.org"><?php echo(get_field('block_explorer',$homeid)); ?></a>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="support">
							<p><?php echo get_field('support_page_text',$homeid);?></p>
							<a href="<?php echo get_field('support_page_url',$homeid);?>" class="btn btn-ghost">
								<?php echo get_field('support_page_button',$homeid);?>
							</a>
						</div>
						<div class="status d-flex justify-content-center mt-3">
							<a href="https://statuspage.freshping.io/1446-Dash">
								<img src="https://statuspage.freshping.io/badge/6bd13996-45b7-47b0-aaa4-5762412982a7?0.8091951318490984"/>
							</a>
						</div>
						<div class="trustpilot-widget" data-locale="en-US" data-template-id="5419b757fa0340045cd0c938" data-businessunit-id="5fff59ee8b18380001bce801" data-style-height="25px" data-style-width="100%" style="margin-top: 1em">
  						<a href="https://www.trustpilot.com/review/www.dash.org" target="_blank" rel="noopener">Trustpilot</a>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="footer-bottom bg-dark">
			<div class="container">
				<div class="row">
					<?php /*<div class="col-lg-4 order-lg-3">
						<div class="row newsletter">
							<div class="col-12">
								<strong><?php echo get_field('newsletter_text',$homeid);?></strong>
								<?php get_template_part('inc/newsletterform'); ?>
							</div>
						</div>
					</div>*/ ?>
					<div class="col-lg-6 has-border">
						<div class="container-xs">
							<strong><?php echo get_field('discussion_text',$homeid);?></strong>

							<div class="link-container d-flex justify-content-between">
								<a href="https://github.com/dashpay"><div class="icon-el github"></div></a>
								<a href="https://github.com/dashevo"><div class="icon-el github"></div></a>
								<a href="https://discordapp.com/invite/PXbUxJB"><div class="icon-el discord"></div></a>
								<a href="https://t.me/dash_chat"><div class="icon-el telegram"></div></a>
								<a href="https://www.dash.org/forum/"><div class="icon-el dashforum"></div></a>
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
								<a href="https://www.facebook.com/DashPay"><div class="icon-el facebook"></div></a>
								<a href="https://www.instagram.com/dashpay/"><div class="icon-el instagram"></div></a>
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix text-lg-right">
					<div class="terms">
						<?php 
						$posts = get_field('navigation_privacy',$homeid);
						$post = $posts[0];
						setup_postdata($post); 
						?>
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						<span class="divider">|</span>
						<?php 
						$post = $posts[1];
						setup_postdata($post); ?>
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						<?php wp_reset_postdata(); ?>							
					</div>
				</div>
			</div>
		</div>

	</footer>

</div>

<?php wp_footer(); ?>

</body>
</html>