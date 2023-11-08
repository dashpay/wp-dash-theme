<?php 
/* Template Name: Buy or Spend */ 

// The buy/spend/exchanges page all use API for content, so maybe they can just use the same template.

get_header(); ?>

<div id="<?php echo get_field('main_id'); ?>" class="page-halfbanner">

	<?php get_template_part('inc/halfbanner'); 

	$vendors = [];
	if ( get_field( "buyspend_page_type" )=='spend' ){
		$vendors = json_encode(get_field( "spend_vendors"));
	}
	elseif ( get_field( "buyspend_page_type" )=='buy' ) {
		$vendors = get_field( "buy_vendor_json");
	}
	else {
		$vendors = json_encode(get_field( "full_list_vendors"));
	}

	?>


		<dash-buyspend 
		type="<?php echo get_field( "buyspend_page_type" ); ?>" 
		vendors='<?php echo $vendors; ?>'
		inline-template>
			<div v-cloak>

				<!-- Options -->
				<div class="bg-light py-4 filter-bar">
					<div class="container">

						<div class="row align-items-center" v-if="type=='spend'">
							<div class="col-lg-auto col-6"><?php _e( 'Select a category', 'html5blank' ); ?></div>
							<div class="col-lg-3 col-6">
								<select class="select-custom" name="category_c" v-model="category_c">
									<option v-for="opt in categories" :value="opt">{{opt.length?opt:'Any'}}</option>
								</select>
							</div>
						</div>
						<div class="row align-items-center" v-if="type=='buy'">
							<div class="col-lg-auto col-6"><?php _e( 'I want to buy with', 'html5blank' ); ?></div>
							<div class="col-lg-auto col-6">
								<select class="select-custom" name="currency_c" v-model="currency_c">
									<option v-for="opt in currencies" :value="opt">{{opt.length?opt:'Any'}}</option>
								</select>
							</div>
						</div>
						<div class="row align-items-center" v-if="type=='fulllist'">
							<div class="offset-lg-8 col-lg-2 col-6 col-lg-offset-6 text-right">sort by</div>
							<div class="col-lg-2 col-6">
								<select class="select-custom" name="currency_c" v-model="currency_c">
									<option v-for="opt in currencies" :value="opt">{{opt.length?opt:'Any'}}</option>
								</select>
							</div>
						</div>

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

				
				<!-- Spenders -->
				<div class="buyspend-items container" v-if="type=='spend'">
					<div class="buyspend-item spend" v-for="item in items">
						<div class="row">
							<div class="col-lg-1">
								<img :src="item.vendor_logo" alt class="img-fluid">
							</div>
							<div class="col-lg-4">
								<h4 class="title">{{item.vendor_name}}</h4>
							</div>
							<div class="col-lg-4">
								<p>{{item.vendor_category}}</p>
							</div>
							<div class="col-lg-3">
								<a :href="item.vendor_website" target="_blank" class="btn btn-download">
									<i class="icon-el offsite"></i> <?php _e( 'Visit Website', 'html5blank' ); ?>
								</a>
							</div>
						</div>
					</div>
				</div>

				<!-- Buyers -->
				<div class="buyspend-items container" v-if="type=='buy'">
					<div class="buyspend-header d-none d-lg-block">
						<div class="row font-weight-bold">
							<div class="col-lg-2" v-on:click="sortListBy('name')" v-bind:class="isSorted('name')">
								<?php _e( 'Exchange name', 'html5blank' ); ?>
							</div>
							<div class="col-lg-2" v-on:click="sortListBy('bti')" v-bind:class="isSorted('bti')">
								<?php _e( 'Features', 'html5blank' ); ?>
							</div>
							<div class="col-lg-2" v-on:click="sortListBy('confirmations')" v-bind:class="isSorted('confirmations')">
								<?php _e( 'Deposit speed', 'html5blank' ); ?>
							</div>
							<div class="col-lg-2">
								<?php _e( 'Exchange rate', 'html5blank' ); ?>
							</div>
							<div class="col-lg-2">
								<?php _e( 'Trading pairs', 'html5blank' ); ?>
							</div>
							<div class="col-lg-2">
								<?php _e( 'Buy Dash', 'html5blank' ); ?>
							</div>
						</div>
					</div>
					<div class="buyspend-item buy" v-for="item in items">
						<div class="row">
							<div class="col-lg-2">
								<span class="label-mobile d-block d-lg-none">
									<?php _e( 'Exchange', 'html5blank' ); ?>
								</span>
								<div class="d-md-flex d-block">
									<div class="mx-auto">
									<a :href="item.url">
										<img :src="item.image" class="img-buy mx-auto d-block mb-2">
										<h3 class="title">{{item.name}}</h3>
									</a>
								</div>
								</div>
							</div>
							<div class="col-lg-2">
								<img src="https://media.dash.org/wp-content/uploads/is-logo-blue-text.svg" class="img-buy" v-if="item.instantsend">
								<img src="https://media.dash.org/wp-content/uploads/cl-logo-blue-text.svg" class="img-buy" v-if="item.chainlocks">
							</div>
							<div class="col-lg-2">
								<span class="confirmations">{{item.confirmations * 2.5}} <?php _e( 'minutes', 'html5blank' ); ?></span>
							</div>							
							<div class="col-lg-2">
								<span class="label-mobile d-block d-lg-none">
									<?php _e( 'Exchange rate', 'html5blank' ); ?>
								</span>
								<h4 class="rate" v-if="item.price">${{item.price.toFixed(2)}}</h4>
								<p>{{typeof item.volume == 'undefined' ? "" : "Vol.: $" + item.volume.toFixed(0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}}</p>
							</div>
							<div class="col-lg-2">
								<span class="label-mobile d-block d-lg-none">
									<?php _e( 'Trading pairs', 'html5blank' ); ?>
								</span>
								<span class="pair" v-for="currency in item.currency"> {{currency}} </span>
							</div>
							<div class="col-lg-2">
								<a :href="item.url" target="_blank" class="btn btn-download">
									<i class="icon-el offsite"></i> <?php _e( 'Buy now', 'html5blank' ); ?>
								</a>
							</div>
						</div>
					</div>
				</div>



				<!-- Full List: general list and brokers -->
				<div class="buyspend-items fullist" v-if="type=='fulllist'">
					<div class="bg-light py-5">
						<div class="container">
							<div class="row">
								<div class="col-lg-3 col-6" v-for="item in items" v-if="item.vendor_type!='broker'">
									<a :href="item.vendor_website" target="_blank" class="btn btn-vendor" v-bind:class="{ 'btn-is': item.instantsend, 'btn-white': !item.instantsend }">
										<div class="icon">
											<img v-if="item.vendor_logo.length" :src="item.vendor_logo" alt>
											<span v-if="!item.vendor_logo.length" class="icon-placeholder"></span>
										</div>
										<div>
											<span class="title">{{item.vendor_name}}</span>
											<span class="link">{{item.vendor_website}}</span>
										</div>
									</a>
								</div>
							</div>
						</div>
					</div>

					<div class="bg-light2 py-5">
						<div class="container">

							<div class="richtext pb-5">
								<?php echo get_field( "broker_text") ?>
							</div>

							<div class="row">
								<div class="col-lg-3 col-6" v-for="item in items" v-if="item.vendor_type=='broker'">
									<a :href="item.vendor_website" target="_blank" class="btn btn-vendor" v-bind:class="{ 'btn-is': item.instantsend, 'btn-white': !item.instantsend }">
										<div class="icon">
											<img v-if="item.vendor_logo.length" :src="item.vendor_logo" alt>
											<span v-if="!item.vendor_logo.length" class="icon-placeholder"></span>
										</div>
										<div>
											<span class="title">{{item.vendor_name}}</span>
											<span class="link">{{item.vendor_website}}</span>
										</div>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<?php if (get_field( "view_more_link")!=""){?>
				<div class="container py-5">
					<a href="<?php echo get_field( "view_more_link" ); ?>" target="_blank" class="btn btn-blue"><?php _e( 'View more', 'html5blank' ); ?></a>
				</div>
				<?php } ?>

			</div>
		</dash-buyspend>


	<?php get_template_part('inc/content_lg'); ?>



</div>

<?php get_footer(); ?>
