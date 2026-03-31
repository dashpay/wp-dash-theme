<?php
// Block: 2 Column Layout
// Handles all 2-column variants: 2col_grid, 2col_image, 2col_app, 2col_terminal
// Shared title + left column (description, links, icons, buttons)
// Right column varies by $type

// ACF true/false fields are bugged and always return false. using dropdown values 'yes' and 'no'
?>
<div class="two-col-title">
	<?php if ( get_sub_field ( "section_title")!=''){ ?>
		<h3><strong><?php echo get_sub_field('section_title'); ?></strong></h3>
		<?php } ?>
		<?php if ( get_sub_field ( "section_subheading")!=''){ ?>
	<h4><?php echo get_sub_field('section_subheading'); ?></h4>
	<?php } ?>
</div>
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
			 <?php
			 $icons = get_sub_field('2_col_icons');
			 if (isset($icons[0])){ ?>
			 	<div class="icon-list">
					<?php foreach ( $icons as $icon) { ?>
						<div class="icon-block">
							<img src="<?php echo $icon['icon_image']['url'] ?>" alt="<?php echo $icon['icon_image']['alt'] ?>" class="img-icons">
							<h6><?php echo $icon['icon_title']; ?></h6>
						</div>
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
	?>

	<?php if ($type=='2col_grid'){ ?>
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
								<div class="block-icons">
									<div class="vendor-title-desc">
										<span class="title"><?php echo $link['block_item_title'] ?></span>
										<span class="link"><?php echo $link['block_item_description'] ?></span>
					                </div>
									<div class="vendor-button">
										<span class="button"><?php echo $link['callout_block_link_text'] ?></span>
					                </div>
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
										<a href="<?php echo $link['block_link']?>" target="<?php if ( get_sub_field( "grid_link_open_new_tab" ) ) { echo "_blank"; }?>">
											<img src="<?php echo $link['block_item_image']['url'] ?>" alt="<?php echo $link['block_item_image']['alt'] ?>" class="img-fluid">
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
