<?php
// Block: News
// Renders latest 3 news posts with optional buttons

?>
<div class="text-center py-3">
	<h2><strong><?php echo get_sub_field('section_title'); ?></strong></h2>
</div>
<div class="row">
	<?php
	$args = array( 'post_type' => 'post', 'posts_per_page' => 3, 'ignore_sticky_posts' => 1 );
	$wp_query = new WP_Query($args);
	while ( have_posts() ) : the_post(); ?>
		<div class="col-lg-4 col-md-6">
			<?php get_template_part('inc/newsitem'); ?>
		</div>
	<?php endwhile; wp_reset_query();?>
</div>
<div class="text-center py-4">
	<?php
	 $links = get_sub_field('block_buttons');
	 if (isset($links[0])){ ?>
				<?php foreach ( $links as $link) {
					$class = 'btn-ghost blue';
					if ($link['button_style']=='solid') {
						$class = 'btn-blue';
					}
				 ?>
				<a href="<?php echo $link['button_url']; ?>" class="btn <?php echo $class ?>"><?php echo $link['button_title']; ?></a>
		 		<?php } ?>
		</div>
	 <?php } ?>
</div>
