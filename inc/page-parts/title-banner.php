<?php
// Page Part: Title Banner
// Displays a centered image with text below it

?>
<div class="banner-shape container pull-up">
	<div class="bg bg-gradient-v"></div>
	<div class="row flex-lg-wrap">
		<div class="d-block col-10 mx-auto">
			<img src="<?php echo get_field('title_image'); ?>" alt class="mx-auto w-50 d-block">
			<h5 class="d-block text-center mt-2"><?php echo get_field('title_text'); ?></h5>
		</div>
	</div>
</div>
