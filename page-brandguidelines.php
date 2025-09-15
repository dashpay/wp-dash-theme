<?php 
/* Template Name: Buy or Spend */ 
get_header(); ?>

<div id="<?php echo get_field('main_id'); ?>" class="page-halfbanner">
	<?php get_template_part('inc/halfbanner'); ?>

	<?php 
	$vendors = [];
	if ( get_field( "buyspend_page_type" ) == 'spend' ) {
		$vendors = json_encode(get_field( "spend_vendors"));
	} elseif ( get_field( "buyspend_page_type" ) == 'buy' ) {
		$vendors = get_field( "buy_vendor_json");
	} else {
		$vendors = json_encode(get_field( "full_list_vendors"));
	}
	?>

	<dash-buyspend 
		type="<?php echo get_field( "buyspend_page_type" ); ?>" 
		vendors='<?php echo $vendors; ?>'
		inline-template>
			<div v-cloak>

				<!-- Filter Tabs for BUY -->
				<div class="bg-light py-4 filter-bar" v-if="type=='buy'">
					<div class="container-sm">
						<?php if (get_field('buy_tabs_title')): ?>
							<h3 class="mb-3 text-center"><?php the_field('buy_tabs_title'); ?></h3>
						<?php endif; ?>
						<ul class="buy-tabs">
							<li :class="{ active: tabFilter === 'exchange' }" @click="tabFilter = 'exchange'">Exchange</li>
							<li :class="{ active: tabFilter === 'onramp' }" @click="tabFilter = 'onramp'">Onramp</li>
							<li :class="{ active: tabFilter === 'dex' }" @click="tabFilter = 'dex'">DEX</li>
							<li :class="{ active: tabFilter === 'swap' }" @click="tabFilter = 'swap'">Swap</li>
						</ul>
					</div>
				</div>

				<!-- Category Tabs for SPEND (Grid Layout) -->
				<div class="bg-light py-4 filter-bar" v-if="type=='spend'">
					<div class="container py-5 spend">
						<ul class="buy-tabs">
							<li :class="{ active: category_c === '' }" @click="category_c = ''">All</li>
							<li v-for="cat in categories" 
    v-if="cat" 
    :key="cat" 
    :class="{ active: category_c === cat }" 
    @click="category_c = cat">
    {{ cat }}
</li>

						</ul>
					</div>
				</div>

				<?php if ( !empty( get_the_content() ) ){ ?>
				<section class="block block-text bg-white">
					<div class="container-sm block-pad-v">
						<div class="richtext text-lg-center">
							<?php the_content(); ?>
						</div>
					</div>
				</section>
				<?php }?>

				<!-- SPEND grid content -->
				<div class="container py-5" v-if="type=='spend'">
					<div class="row text-center">
						<div class="col-6 col-md-4 col-lg-2 mb-4" v-for="item in items">
							<a :href="item.vendor_website" target="_blank" class="d-block text-decoration-none text-dark">
								<img :src="item.vendor_logo" alt="" class="img-fluid mb-2" style="max-height:40px; object-fit:contain;">
								<div class="font-weight-bold small">{{ item.vendor_name }}</div>
								<div class="text-muted small">{{ item.vendor_category }}</div>
							</a>
						</div>
					</div>
				</div>

				<!-- SPEND CTA BLOCKS -->
				<?php if ( get_field("buyspend_page_type") == 'spend' && have_rows('spend_cta_blocks') ): ?>
				<section class="block block-2col-card bg-white">
					<div class="container py-5 spend-container">
						<?php while( have_rows('spend_cta_blocks') ): the_row(); ?>
							<div class="row align-items-center mb-5">
								<!-- TEXT LEFT -->
								<div class="col-lg-6 mb-4 mb-lg-0">
									<?php if ( get_sub_field('title') ): ?>
										<h3 class="mb-3"><strong><?php the_sub_field('title'); ?></strong></h3>
									<?php endif; ?>
									<?php if ( get_sub_field('description') ): ?>
										<div class="mb-3 richtext">
											<?php the_sub_field('description'); ?>
										</div>
									<?php endif; ?>
									<div class="buttons">
										<?php if( have_rows('buttons') ): ?>
											<?php while( have_rows('buttons') ): the_row(); 
												$btn_class = (get_sub_field('style') == 'solid') ? 'btn-blue' : 'btn-ghost blue'; ?>
												<a href="<?php the_sub_field('url'); ?>" 
												   class="btn <?php echo $btn_class; ?>" 
												   target="_blank">
												   <?php the_sub_field('text'); ?>
												</a>
											<?php endwhile; ?>
										<?php endif; ?>
									</div>
								</div>

								<!-- MEDIA RIGHT -->
								<div class="col-lg-6 text-center">
									<?php 
									$media_type = strtolower(get_sub_field('media_type'));
									if ($media_type === 'image') {
										$img = get_sub_field('image');
										if (!empty($img)) { ?>
											<img src="<?php echo esc_url($img['url']); ?>" 
											     alt="<?php echo esc_attr($img['alt']); ?>" 
											     class="img-fluid">
										<?php }
									} elseif ($media_type === 'video') {
										$video = get_sub_field('video_iframe');
										if (!empty($video)) { ?>
											<div class="video-wrapper">
												<?php echo $video; ?>
											</div>
										<?php }
									} ?>
								</div>
							</div>
						<?php endwhile; ?>
					</div>
				</section>
				<?php endif; ?>

				<!-- BUY content redesigned -->
				<div class="buyspend-items container" v-if="type=='buy'">
					<div class="buyspend-header d-none d-lg-flex font-weight-bold py-2 border-bottom">
						<div class="col-lg-3"></div>
						<div class="col-lg-3">Features</div>
						<div class="col-lg-2">Deposit time</div>
						<div class="col-lg-2">Trading pairs</div>
					</div>
					<div class="buyspend-item row py-3 align-items-center border-bottom" v-for="item in items" v-if="item.type === tabFilter">
						<div class="col-lg-3 d-flex align-items-center gap-2">
							<img :src="item.image" :alt="item.name" class="img-fluid" style="max-width:32px;">
							<span class="font-weight-bold">{{ item.name }}</span>
						</div>
						<div class="col-lg-3">
							<span v-if="item.chainlocks">ChainLocks</span>
							<span v-if="item.chainlocks && item.instantsend"> / </span>
							<span v-if="item.instantsend">InstantSend</span>
						</div>
						<div class="col-lg-2">
							{{ item.confirmations * 2.5 }} min
						</div>
						<div class="col-lg-2">
							<span v-for="(cur, index) in item.currency">
								{{ cur }}<span v-if="index !== item.currency.length - 1"> / </span>
							</span>
						</div>
					</div>
				</div>

				<?php if (get_field( "view_more_link") != ""){?>
				<div class="container py-5">
					<a href="<?php echo get_field( "view_more_link" ); ?>" target="_blank" class="btn btn-blue"><?php _e( 'View more', 'html5blank' ); ?></a>
				</div>
				<?php } ?>
			</div>
	</dash-buyspend>

	<?php get_template_part('inc/content_lg'); ?>
</div>
<?php get_footer(); ?>
