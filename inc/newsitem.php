<div class="news-item">
	<div class="top">
		<div class="row align-items-center">
			<div class="col-6">
				<span class="date title-small">
					<?php the_time('F j, Y'); ?>
				</span>
			</div>
			<div class="col-6 text-right">
				<?php 
					$words = explode(' ', strip_tags(get_the_content()));
				?>
				<span class="read"><?php echo ceil(count($words)/100); ?> min read</span>
			</div>
		</div>
	</div>
	<a href="<?php echo apply_filters( 'wpml_permalink', get_the_permalink(), 'en' ); ?>">

		<!-- http://placehold.it/680x280 -->
		<div class="image" style="background-image:url(<?php the_post_thumbnail_url('news_item') ?>)"></div>
	</a>
	<div class="caption">
		<h3><a href="<?php echo apply_filters( 'wpml_permalink', get_the_permalink(), 'en' ); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
		<div class="text-gray"><?php html5wp_excerpt('html5wp_index'); ?></div>
	</div>
	<hr/>
</div>
