<?php while( have_rows('simple_content_sections') ): the_row(); ?>

<section class="block bg-light">
	<div class="container block-pad-v">

		<div class="richtext">
			<h3><strong><?php echo get_sub_field('section_title'); ?></strong></h3>
			<?php echo get_sub_field('section_description'); ?>
		</div>

		<div class="row mt-5">
			<?php 
			$callouts = get_sub_field('section_callouts');
			foreach ( $callouts as $callout) {?>
			<div class="col-lg-4 col-sm-6">
				<div class="card-item tall">
					<?php if ($callout['callout_image']!=""){ ?>
						<div class="cardlogo mb-3">
							<img src="<?php echo $callout['callout_image'] ?>" alt class="img-fluid">
						</div>
					<?php }?>
					<div class="richtext">
						<h3 class="text-dark mb-3"><b><?php echo $callout['callout_title'] ?></b><br/><?php echo $callout['callout_subtitle'] ?></h3>
						<?php echo $callout['callout_text'] ?>
					</div>

					<div class="link-list">
						<?php 
						foreach (range(1,2) as $n) {
							if ( $callout['callout_link_'.$n.'_title']!='' ){ ?>

								<a href="<?php echo  $callout['callout_link_'.$n] ?>" target="_blank">
									<span class="icon-inline sm <?php echo $darkbg?'white':'blue'; ?>">
										<?php get_template_part('inc/offsite.svg'); ?>
									</span>
									<?php echo  $callout['callout_link_'.$n.'_title'] ?>
								</a>
						   
							<?php 
							} }
						?>
						
					</div>

				</div>				
			</div>
			<?php } ?>
		</div>

	</div>
</section>

<?php endwhile; ?>
