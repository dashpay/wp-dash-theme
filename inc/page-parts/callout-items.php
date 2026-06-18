<?php
// Page Part: Callout Items
// Displays pull-up cards below the banner with title, description, and link

?>
<div class="banner-shape container pull-up">
	<div class="bg bg-gradient-v"></div>
	<div class="row flex-lg-nowrap">

		<?php while( have_rows('callout_items') ): the_row(); ?>
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
