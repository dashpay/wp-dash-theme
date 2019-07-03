<?php 
/* Template Name: Brand Guidelines */ 
get_header(); ?>


<div id="main" class="page-halfbanner">

	<?php get_template_part('inc/halfbanner'); ?>

	<?php if ( !empty( get_the_content() ) ){ ?>
	<section class="block block-text bg-white">
		<div class="container-sm block-pad-v">
			<div class="richtext text-lg-center">
				<?php the_content(); ?>
			</div>
		</div>
	</section>
	<?php }?>

	<div class="container">
		<section class="block block-tabs" <?php if ($section_id!=''){echo "id=\"$section_id\"";} ?> style="padding-top: 50px;">
			<div class="container">

				<nav>
					<div class="nav nav-tabs" role="tablist">
						<?php 
						$panel = 0;
						while( have_rows('tab_list') ): 
							the_row(); 
							$panel++;
						?>
						<a 
						class="nav-item nav-link <?php echo $panel==1?'active':'' ?>"
						 id="group<?php echo $post_id?>-label<?php echo $panel?>" 
						 data-toggle="tab" 
						 href="#group<?php echo $post_id?>-tab<?php echo $panel?>" 
						 role="tab" 
						 aria-controls="nav-home"
						 style="padding-right: 75px;">
							<?php the_sub_field('tab_title'); ?>
						</a>
						<?php endwhile; ?>
					</div>
				</nav>

				<div class="tab-content">

					<?php 
					$panel = 0;

					while( have_rows('tab_list') ): 
						the_row(); 
						$panel++;
					?>
					<div 
					class="tab-pane fade show <?php echo $panel==1?'active':'' ?>" 
					id="group<?php echo $post_id?>-tab<?php echo $panel?>" 
					role="tabpanel" 
					aria-labelledby="group<?php echo $post_id?>-label<?php echo $panel?>">
						<div class="py-4">

							<?php
								$section = 0;
								while (have_rows('content_section')):
									the_row();
									$section++;
							?>

								<!-- Content Section Row Starts Here -->
								<div class="container row no-gutters" style="<?php if ($section > 1) { ?> border-top: 1px solid #dee2e6; <?php } ?>">
									<div>
										<div><h3> <?php the_sub_field('section_title'); ?> </h3></div>
										<p> <?php the_sub_field('section_description'); ?> </p>
									</div>
									
									<!-- Image Row Starts Here -->
									<div class="row no-gutters" style="margin-bottom: 20px">
									<?php
										$image = 0;
										while (have_rows('image_block')):
											the_row();
											$image++;
									?>
									
										<div class="col-lg-4 col-md-6">
											<div>
												<div class="top">
													<div class="row no-gutters align-items-center">
														<div>
															<div class="download-modal-trigger">
																<?php if (get_sub_field('image_file')){ ?>
																	<img src="<?php the_sub_field('image_file'); ?>" class="image img-fluid" alt>
																<?php } else { ?>
																	<span class="icon-placeholder image"></span>
																<?php } ?>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

									<?php endwhile; ?>
									</div>
									<!-- Image Row Ends Here -->

									<!-- Feature Row Starts Here -->
									<div class="row no-gutters">
									<?php
										$feature = 0;
										while (have_rows('feature_block')):
											the_row();
											$feature++;
									?>
										<div class="col-lg-4 col-md-6">
											<div class="download-item">
												<div class="top">
													<div class="row no-gutters align-items-center">
														<?php if (get_sub_field('feature_icon')){ ?>
															<div class="col-3">
																<div class="download-modal-trigger">
																	<img src="<?php the_sub_field('feature_icon'); ?>" class="image img-fluid" alt>
																</div>
															</div>
														<?php } ?>
														<div class="col-9">
															<div href="#" class="download-modal-trigger">
																<h4><?php the_sub_field('feature_title'); ?></h4>
															</div>
														</div>
													</div>
												</div>
												<div class="text">
													<?php the_sub_field('feature_description'); ?>
												</div>
											</div>
										</div>

									<?php endwhile; ?>
									</div>
									<!-- Freature Row Ends Here -->


									<!-- Colors Row Starts Here -->
									<div class="row content block-brand" style="margin-top: 0px;">

										<?php 
										$index = 0;
										while( have_rows('brand_palette') ): the_row();
										$index++; 
										?>
										<div class="col-md-3 col-lg-2">
											<div class="palette-item">
												<div class="thumb" style="background:<?php the_sub_field('hexcolor'); ?>; border-radius: 8px; height: 75px;"></div>
												<div class="text">
													<h6 class="mb-3"><?php the_sub_field('color_title'); ?></h6>
													<p class="text"> <?php the_sub_field('hexcolor'); ?> </p>
													<p class="text"> <?php echo nl2br(get_sub_field('other_text')); ?> </p>
												</div>
											</div>
										</div>
										<?php endwhile; ?>

									</div>
									<!-- Colors Row Ends Here -->

									<!-- Typography Starts Here -->
									<div class="row content">
										<?php 
										$index = 0;
										while( have_rows('brand_typography') ): the_row();
										$index++; ?>
										<div class="col-lg-4">
											<div class="typography-item">
												<span class="lg" style="font-family:<?php the_sub_field('font_name'); ?>">
													<h4><?php the_sub_field('font_name'); ?></h4>
												</span>
												<div class="text-gray">
													<p><?php the_sub_field('font_description'); ?></p>
												</div>
											</div>
										</div>
										<?php endwhile; ?>
									</div>
									<!-- Typography Ends Here -->

									<!-- Brand Logos Starts Here -->
									<div class="container">
										<div class="row content block-brand" style="margin-top: 0px;">
											<?php while( have_rows('brand_logos') ): the_row();?>
												<div class="col-md-3">
													<div class="brandasset-item">
														<div class="image">
															<img src="<?php the_sub_field('brand_logo_image'); ?>" alt class="img-fluid">
														</div>
														<div class="richtext">
															<h4 class="mb-3"><?php the_sub_field('brand_logo_title'); ?></h4>
														</div>
														<div class="text">
															<?php while( have_rows('brand_logo_links') ): the_row();?>
															<a href="<?php the_sub_field('brand_logo_file'); ?>" download>
																<i class="icon-el download"></i> <?php the_sub_field('brand_logo_title'); ?>
															</a>
															<?php endwhile; ?>
														</div>
													</div>
												</div>
											<?php endwhile; ?>
										</div>
									</div>
									<!-- Brand Logos Ends Here -->

								</div>
								<!-- Content Section Row Ends Here -->
							

							<?php endwhile; ?>

						</div>
					</div>
					<?php endwhile; ?>
				</div>
			</div>
		</section>
	</div>
</div>

<?php get_footer(); ?>
