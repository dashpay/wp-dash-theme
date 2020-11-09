<?php

$count = 0;
while( have_rows('content_sections') ): the_row(); 

	// CONTENT BLOCKS
	// text : Text
	// callouts : Callouts
	// 2col_grid : 2 Column Grid
	// 2col_image : 2 Column Image
	// 2col_app : 2 Column App
	// stats : Stats
	// vendors : Vendors [buy and spend pages]
	// news : Latest News
	// proposals : Latest Proposals
	// app : App Callout
	// speed : Speed Table [business]

	$count++;

	$type = get_sub_field('section_type');
	$bg = get_sub_field('background_color');
	$padding = get_sub_field('section_padding');
	$section_id = get_sub_field('section_id');

	$classes = ['block-'.$type];

	if ($count==1 && get_field( "hide_large_banner" )=='yes' ){
		$classes[] = 'first-pad';
	}

	if ( $type=='app' ){
		$bg = 'bg-gradient-h';
	 	$padding = 'block-pad-none';
		$classes[] = 'block-text';
	}

	if ( $type=='2col_app' ){
		$padding = 'block-pad-none';
		$classes[] = 'block-text';
    }

	if ( $type=='speed' ){
		$bg = 'bg-gradient-dark-v';
	}
	
	if ( $type=='proposals' ){
		$bg = 'bg-lightgray';
	}

	if ( get_sub_field('callout_desktop_only_image')!='' ){
		$classes[] = 'walkthrough';
	}

	$bg = $bg?$bg:'bg-white';
	$darkbg = true;
	if ($bg == 'bg-white' || $bg=='bg-light' || $bg=='bg-light2'){
		$darkbg = false;
	}

	$padding = $padding?$padding:'block-pad-v';
?>
<section class="block <?php echo $bg;?> <?php echo implode(' ',$classes); ?>" <?php if ($section_id!=''){echo "id=\"$section_id\"";} ?>>
	<div class="container <?php echo $padding; ?>">


		<?php if ($type=='text'){ ?>
			<div class="richtext text-lg-center">
				<?php echo get_sub_field('section_description') ?>
			</div>
		<?php } ?>

		<?php if ($type=='callouts'){ ?>

			<?php
			$largeimg = false;
			if ( get_sub_field('callout_desktop_only_image')!='' ) {
				$largeimg = get_sub_field('callout_desktop_only_image');
			}
			if ( $largeimg ){ ?>
			    <div class="image d-none d-lg-block"><img src="<?php echo $largeimg;?>" alt class="large img-fluid"></div>
			<?php }  ?>


			<div class="card-deck">
				<?php
					$links = get_sub_field('block_list');

					$class = "card border-0 text-center bg-transparent";
					foreach ( $links as $link) { ?>
						<div class="<?php echo $class;?>">

								<?php if ($largeimg){ ?>
									<div class="d-lg-none"><img src="<?php echo $link['block_item_image']['url'] ?>" alt="<?php echo $link['block_item_image']['alt'] ?>" class="img-fluid"></div>
									<div class="card-body">
									<h3 class="title-small card-title"><?php echo $link['block_item_title'] ?></h3>
								<?php } else { ?>
									<img src="<?php echo $link['block_item_image']['url'] ?>" alt="<?php echo $link['block_item_image']['alt'] ?>" class="card-img-top">
									<div class="card-body px-2">
										<h3 class="title-italic card-title"><?php echo $link['block_item_title'] ?></h3>
								<?php } ?>

										<p class="card-text"><?php echo $link['block_item_description'] ?></p>
									</div>
								<?php if ( $link['block_link']!='' ){?>
									<div class="card-footer bg-transparent border-0">
									<a href="<?php echo $link['block_link'] ?>">
										<strong><?php _e( 'Read more', 'html5blank' ); ?></strong>
									</a></div>
								<?php }  ?>
								
						</div>
				 <?php } ?>
				
			</div>
		<?php } ?>

		<?php if ($type=='2col_grid' || $type=='2col_image' || $type=='2col_terminal' || $type=='2col_app'){ 
			// ACF true/false fields are bugged and always return false. using dropdown values 'yes' and 'no'
			?>
			<div class="row align-items-center">
				<div class="<?php 
				$expand = get_sub_field('2_col_expand_column');
				switch($expand) {
					case 'yes':    echo 'col-lg-4'; break; 
					case 'narrow': echo 'col-lg-7'; break; 
					default:       echo 'col-lg-6'; break; 
				} 
				if ($type=='2col_app') { echo(' block-pad-v'); }
				?>
				<?php echo get_sub_field('2_col_swap_columns')=='yes'?'col-right order-lg-2':''; ?>">

					<div class="container-xs <?php echo get_sub_field('2_col_swap_columns')=='yes'?'fade-in-right':'fade-in-left'; ?>">
						<div class="richtext">
						<?php echo get_sub_field('section_description') ?>
						</div>
						<?php
						 $links = get_sub_field('2_col_links');
						 if (isset($links[0])){ ?>
						 	<div class="link-list">
								<?php foreach ( $links as $link) { ?>
								<a href="<?php echo $link['link_url']; ?>" target="_blank">
									<span class="icon-inline sm <?php echo $darkbg?'white':'blue'; ?>">
										<?php get_template_part('inc/offsite.svg'); ?>
									</span>
									<?php echo $link['link_title']; ?>
								</a>
						 		<?php } ?>
							</div>
						 <?php } ?>
					</div>
					<?php
					 $links = get_sub_field('block_buttons');
					 if (isset($links[0])){ ?>
					 	<div class="container-xs">
							<div class="pt-md-5 pt-3 buttons">
								<?php foreach ( $links as $link) {
									$class = 'btn-ghost';
									if ( $darkbg ){ $class .= ' white'; }
									else { $class .= ' blue'; }
									if ($link['button_style']=='solid') {
										if ( $darkbg ){ $class = 'btn-white';}
										else { $class = 'btn-blue';}
									}
								 ?>
								<a href="<?php echo $link['button_url']; ?>" class="btn <?php echo $class ?>"><?php echo $link['button_title']; ?></a>
						 		<?php } ?>
							</div>
						</div>
					 <?php } ?>
				</div>
				<?php 
					switch($expand) {
						case 'yes':    $colclass = 'col-lg-8'; break; 
						case 'narrow': $colclass = 'col-lg-5'; break; 
						default:       $colclass = 'col-lg-6'; break; 
					}
					if ( get_sub_field('2_col_swap_columns')=='yes' ){
						$colclass .= ' col-right';
					}
					if ($type=='2col_grid'){ ?>
					<div class="<?php echo $colclass; ?>">
						<div class="row text-center grid-item-container">
							<?php 
							$links = get_sub_field('block_list');
							$subtype = get_sub_field('2_col_grid_style');
							foreach ( $links as $link) {?>

								<?php if ($subtype=='vendor'){ ?>
									<div class="col-6">
										<a <?php if ( $link['block_link']!=''){ ?>href="<?php echo $link['block_link']?>" target="_blank"<?php } ?> class="btn btn-vendor btn-white">
											<div class="icon">
											<?php echo $link['block_item_image']?'<img src="'.$link['block_item_image'].'" alt>':'<span class="icon-placeholder"></span>' ?>
											</div>
											<div>
												<span class="title"><?php echo $link['block_item_title'] ?></span>
												<span class="link"><?php echo $link['block_item_description'] ?></span>
											</div>
										</a>	
									</div>
								<?php }?>
								

								<?php if ($subtype=='social'){ ?>
									<div class="col-lg-3 col-6">
										<a <?php if ( $link['block_link']!=''){ ?>href="<?php echo $link['block_link']?>" target="_blank"<?php } ?> class="btn btn-hover">
											<div class="image">
												<img src="<?php echo $link['block_item_image']['url'] ?>" alt="<?php echo $link['block_item_image']['alt'] ?>" class="img-fluid socialicons">
											</div>
											<?php if ( $link['block_item_title']!=''){ ?>
												<span><?php echo $link['block_item_title']?></span>
											<?php } ?>
											<?php if ( $link['block_item_description']!=''){ ?>
												<small><?php echo $link['block_item_description'] ?></small>
											<?php } ?>
										</a>
									</div>
								<?php }?>
								

								<?php if ($subtype=='default'){ ?>
									<div class="col-lg-4 col-6">
										<div class="grid-item">
											<div class="image">
												<?php if ( $link['block_link']!=''){ ?>
												<a href="<?php echo $link['block_link']?>" target="_blank">
													<img src="<?php echo $link['block_item_image'];?>" alt class="img-fluid">
												</a>
											<?php } else { ?>
												<img src="<?php echo $link['block_item_image']['url'] ?>" alt="<?php echo $link['block_item_image']['alt'] ?>" class="img-fluid">
											<?php } ?>
											</div>
											<?php if ( $link['block_item_title']!=''){ ?>
												<p><?php echo $link['block_item_title']?></p>
											<?php } ?>

											<?php if ( $link['block_item_description']!=''){ ?>
												<small><?php echo $link['block_item_description'] ?></small>
											<?php } ?>
										</div>
									</div>
								<?php }?>

								<?php if ($subtype=='feature'){ ?>
									<div class="col-lg-6 col-12">
										<a <?php if ( $link['block_link']!=''){ ?>href="<?php echo $link['block_link']?>" target="_blank"<?php } ?> class="btn btn-hover feature-panel">
											<div class="image">
												<img src="<?php echo $link['block_item_image']['url'] ?>" alt="<?php echo $link['block_item_image']['alt'] ?>" class="img-fluid socialicons">
											</div>
											<?php if ( $link['block_item_title']!=''){ ?>
												<span><?php echo $link['block_item_title']?></span>
											<?php } ?>
											<?php if ( $link['block_item_description']!=''){ ?>
												<small><?php echo $link['block_item_description'] ?></small>
											<?php } ?>
										</a>
									</div>
								<?php }?>

						 	<?php } ?>
						</div>
					</div>
				<?php } ?>

				<?php if ($type=='2col_image'){ ?>
					<div class="<?php echo $colclass; ?> d-lg-block d-none">
						<div class="image">
							<?php if ( get_sub_field('2_col_large_image')!='' ) { ?>
								<img src="<?php echo get_sub_field('2_col_large_image') ?>" alt class="img-fluid">
							<?php } else {
								echo get_sub_field('2_col_large_video');
							} ?>
						</div>
					</div>
				<?php } ?>

				<?php if ($type=='2col_app'){ ?>
					<div class="<?php echo $colclass; ?> block-pad-top">
						<div class="image">
							<?php if ( get_sub_field('2_col_large_image')!='' ) { ?>
								<img src="<?php echo get_sub_field('2_col_large_image') ?>" alt class="img-fluid">
							<?php } ?>
						</div>
					</div>
				<?php } ?>

				<?php if ($type=='2col_terminal'){ ?>
					<div class="<?php echo $colclass; ?>">
						<div class="terminal-item">
							<div class="terminal-wrapper">
								<div class="terminal-header">
									<div class="row align-items-center">
										<div class="col-6">
											<i class="dot"></i>
											<i class="dot"></i>
											<i class="dot"></i>
										</div>
										<div class="col-6 text-right">
											<a href="#" class="btn btn-download copy-trigger" data-target="#copyarea-<?php echo $count ?>">
												<i class="icon-el clipboard"></i>
											</a>
										</div>
									</div>
								</div>
								<div class="terminal-body">
									<div class="textarea form-control">
										<?php echo get_sub_field('terminal_text') ?>
									</div>
										<textarea  id="copyarea-<?php echo $count ?>">
										<?php echo trim(strip_tags(get_sub_field('terminal_text'))) ?>
										</textarea>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>

			</div>
		<?php } ?>

		<?php if ($type=='stats'){ ?>
			<div class="row">
				<?php foreach ( get_sub_field('stats') as $stat) { ?>
					<div class="col-md-4">
						<div class="stat-item">
							<span class="label title-small"><?php echo $stat['stat_label'];?></span>
							<span class="value">
								<span data-countup="<?php echo $stat['stat_number'];?>"><?php echo $stat['stat_number'];?></span> 
								<?php echo $stat['stat_unit'];?></span>
						</div>
					</div>
				<?php }?>
			</div>
		<?php } ?>

		<?php if ($type=='vendors'){ ?>
			<div class="richtext text-center container-sm mx-auto">
				<?php echo get_sub_field('section_description') ?>
				
			</div>
			<div class="row pt-4">
				<?php 
				$links = get_sub_field('block_list');
				$linkclass = "btn-white";
				foreach ( $links as $link) {?>
				<div class="col-lg-3 col-6">
					<a href="<?php echo $link['block_link'];?>" target="_blank" class="btn btn-vendor <?php echo $linkclass ?>">
						<div class="icon">
						<?php echo $link['block_item_image']['url']?'<img src="'.$link['block_item_image']['url'].'" alt="'.$link['block_item_image']['alt'].'">':'<span class="icon-placeholder"></span>' ?>
						</div>
						<div>
							<span class="title"><?php echo $link['block_item_title'];?></span>
							<span class="link"><?php echo ($link['block_item_description']!='')?$link['block_item_description']:$link['block_link'];?></span>
						</div>
					</a>					
				</div>
				<?php } ?>
			</div>
		<?php } ?>

		<?php if ($type=='news'){ ?>
		
				<div class="text-center py-3">
					<h2><strong><?php echo get_sub_field('section_title'); ?></strong></h2>
				</div>
				<div class="row">
					<?php 
					$args = array( 'post_type' => 'post', 'posts_per_page' => 3 );
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
		<?php } ?>

		<?php if ($type=='proposals'){ ?>

					<div class="row align-items-center">

						<div class="col-lg-6 col-right order-lg-2">
							<div class="container-xs">
								<div class="richtext">
									<?php echo get_sub_field('section_description') ?>
								</div>
							</div>
							<div class="container-xs">
								<div class="pt-md-5 pt-3 buttons">
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
									 	<?php } ?>
								</div>
							</div>
						</div>

						<div class="col-lg-6">
							
							<dash-proposals 
							inline-template>
								<div v-cloak>
									<div class="link-table" id="proposals-table">
										<div class="row header">
											<div class="col-5">
												<?php _e( 'Latest Proposals', 'html5blank' ); ?>
											</div>
											<div class="col">
												<?php _e( 'Votes', 'html5blank' ); ?> (y/n)
											</div>
											<div class="col">
												<?php _e( 'Amount', 'html5blank' ); ?>
											</div>
											<div class="col">
												<?php _e( 'Funding', 'html5blank' ); ?>
											</div>
										</div>
									
										<div class="row link-table-item" v-for="proposal in proposals">
											<div class="col-5">
												<a :href="'https://' + proposal.url" class="text-gray" target="_blank">
												{{proposal.title.length>40 ? proposal.title.substring(0, 40) + "..." : proposal.title}}
												</a>
											</div>
											<div class="col">
												{{proposal.yes}}/{{proposal.no}}
											</div>
											<div class="col">
												<span class="icon-inline dashcurrency blue">
													<?php get_template_part('inc/dashicon.svg'); ?>
												</span>{{+proposal.monthly_amount.toFixed(1)}}
											</div>
											<div class="col">
												<span class="text-center py-2" v-if="!proposal.will_be_funded">
													-
												</span>

												<span class="icon-inline check" v-if="proposal.will_be_funded">
													<svg width="15px" height="12px" viewBox="0 0 15 12" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
													    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													        <g>
													            <path d="M13.1638664,0.317599984 L4.87097791,8.56637735 L1.84495584,5.52271084 C1.42148919,5.09924419 0.742178114,5.09924419 0.318711468,5.51388861 C-0.104755177,5.92853304 -0.104755177,6.61666634 0.309889246,7.04013298 L4.09462239,10.8513328 C4.30635571,11.0630661 4.57984459,11.1689328 4.86215569,11.1689328 C5.13564456,11.1689328 5.40913344,11.0630661 5.62086676,10.8513328 L14.6812885,1.84384435 C15.1047552,1.42037771 15.1047552,0.74106663 14.6901108,0.317599984 C14.2666441,-0.105866661 13.587333,-0.105866661 13.1638664,0.317599984 Z"></path>
													        </g>
													    </g>
													</svg>
												</span>

											</div>
										</div>

									</div>
								</div>
							</dash-proposals>

							<p><small class="text-gray"><?php _e( 'Updated every 2 hours', 'html5blank' ); ?></small></p>
						</div>

						
					</div>
				</div>
		<?php } ?>

		<?php if ($type=='app'){ ?>
			<div class="row">
				<div class="col-lg-6">

					<div class="block-pad-v fade-in-left">
						<div class="container-xs">
							<div class="richtext">
								<?php echo get_sub_field('section_description') ?>
							</div>
						</div>

						<div class="row d-none d-md-flex py-3">

							<?php
							$links = get_sub_field('block_list');
							foreach ( $links as $link) { ?>

								<div class="col-4">
									<a href="<?php echo $link['block_link'] ?>" class="btn btn-hovershadow">
										<img src="<?php echo $link['block_item_image']['url'] ?>" alt="<?php echo $link['block_item_image']['alt'] ?>" class="img-fluid">
										<span><strong><?php echo $link['block_item_title'] ?></strong></span><span><?php echo $link['block_item_description'] ?></span>
									</a>
								</div>
						 	<?php } ?>
						</div>

						<div class="container-xs buttons">
							<a href="<?php echo get_sub_field('block_link') ?>" class="btn btn-ghost"><?php echo get_sub_field('block_action') ?></a>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-right">
					<div class="image image-float bottom right">
						<img width="450" src="/wp-content/uploads/home-phone-hires.png" class="img-fluid">
					</div>
				</div>
			</div>
		<?php } ?>

		<?php if ($type=='events'){ ?>
			<div class="row">
				<div class="col-lg-6">
					<div class="block-pad-v fade-in-left">
						<div class="container-xs">
							<div class="richtext">
								<?php echo get_sub_field('section_description') ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6">

					<div class="events-table">
						<div class=""><div class="row header">
							<div class="col-4">
								<span><?php _e( 'Event', 'html5blank' ); ?></span>
							</div>
							<div class="col-3">
								<span><?php _e( 'Date', 'html5blank' ); ?></span>
							</div>
							<div class="col-3">
								<span><?php _e( 'Type', 'html5blank' ); ?></span>
							</div>
							<div class="col-2">
							</div>
						</div>

						<?php
						$events = get_sub_field('event_list');
						foreach ( $events as $event) { ?>
							<div class="events-item">
								<div class="row">
									<div class="col-4">
										<?php echo $event['event_name'] ?>
									</div>
									<div class="col-3">
										<?php echo $event['event_type'] ?>
									</div>
									<div class="col-3">
										<?php echo $event['event_date'] ?>
									</div>
									<div class="col-2">
										<a href="<?php echo $event['event_link'] ?>">
											<span class="icon-inline sm gray">
												<?php get_template_part('inc/calendar.svg'); ?>
											</span>
										</a>
									</div>
								</div>
							</div>
						<?php } ?>
					

					</div>
				</div>
			</div>
		<?php } ?>
	
		<?php if ($type=='speed'){ ?>
			<div class="row">
				<div class="col-lg-6">
					<div class="block-pad-v fade-in-left">
						<div class="container-xs">
							<div class="richtext">
								<?php echo get_sub_field('section_description') ?>
							</div>
							<?php
							 $links = get_sub_field('block_buttons');
							 if (isset($links[0])){ ?>
							 	<div class="container-xs">
									<div class="pt-md-5 pt-3 buttons">
										<?php foreach ( $links as $link) {
											$class = 'btn-ghost white';
										 ?>
										<a href="<?php echo $link['button_url']; ?>" class="btn <?php echo $class ?>"><?php echo $link['button_title']; ?></a>
								 		<?php } ?>
									</div>
								</div>
							 <?php } ?>
						</div>
					</div>
				</div>
				<div class="col-lg-6">

					<div class="speed-table">
						<div class="row header">
							<?php
							$headers = explode('/',get_sub_field('speed_table_headers'));
							$subheaders = explode('/',get_sub_field('speed_table_subheaders'));
							?>
							<div class="col-3"></div>
							<div class="col-3">
								<span><?php echo($headers[0]); ?></span>
								<small><?php echo($subheaders[0]); ?></small>
							</div>
							<div class="col-3">
								<span><?php echo($headers[1]); ?></span>
								<small><?php echo($subheaders[1]); ?></small>
							</div>
							<div class="col-3">
								<span><?php echo($headers[2]); ?></span>
								<small><?php echo($subheaders[2]); ?></small>
							</div>
						</div>
						<?php
						$links = get_sub_field('speed_table_rows');
						foreach ( $links as $row) { 
							$values = explode('/',$row['table_row_value']);
							?>
						<div class="row <?php if($row['table_row_highlight']=='yes'){echo 'highlight';} ?>">
							<?php foreach ( $values as $val) { ?>
								<div class="col-3">
									<?php
										if ($val=='Dash'){ ?> 
										<div class="icon-inline blue">
											<?php get_template_part('inc/dashlogo.svg'); ?>
										</div>
									<?php } else echo $val; ?>
								</div>
							<?php } ?>
						</div>
						<?php } ?>
					</div>
						
				</div>
			</div>							
		<?php } ?>

	</div>

	<?php

	 if ( get_sub_field('foot_title') !='' ) {?>
		<div class="container  block-pad-v block-border-top">
			<h4 class="title-small"><?php echo get_sub_field('foot_title')?></h4>
			<div class="row pt-4">
				<?php 
				$links = get_sub_field('foot_vendors');

				$linkclass = "btn-white";
				if ( $darkbg ){
					$linkclass = "btn-blue";
				}

				foreach ( $links as $link) {?>
				<div class="col-lg-3 col-6">
					<a href="<?php echo $link['foot_vendor_link'];?>" target="_blank" class="btn btn-vendor <?php echo $linkclass ?>">
						<div class="icon">
						<?php echo $link['foot_vendor_logo']?'<img src="'.$link['foot_vendor_logo'].'" alt>':'<span class="icon-placeholder"></span>' ?>
						</div>
						<div>
							<span class="title"><?php echo $link['foot_vendor_name'];?></span>
							<span class="link"><?php echo parse_url($link['foot_vendor_link'], PHP_URL_HOST);?></span>
						</div>
					</a>					
				</div>
				<?php } ?>
			</div>
		</div>
	<?php }?>

</section>
<?php endwhile; ?>

