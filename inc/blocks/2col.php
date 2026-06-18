<?php
// Block: 2 Column Layout
// Handles all 2-column variants: 2col_grid, 2col_image, 2col_app, 2col_terminal
// Shared title + left column (description, links, icons, buttons)
// Right column varies by $type

// ACF true/false fields are bugged and always return false. using dropdown values 'yes' and 'no'

$expand = get_sub_field('2_col_expand_column');
$swap   = get_sub_field('2_col_swap_columns') == 'yes';

$two_col_class = 'dash-two-col';
if ($expand == 'yes')         $two_col_class .= ' dash-two-col--wide-media';
elseif ($expand == 'narrow')  $two_col_class .= ' dash-two-col--wide-content';
else                          $two_col_class .= ' dash-two-col--equal';
if ($swap)                    $two_col_class .= ' dash-two-col--swap';
if ($type == '2col_app')      $two_col_class .= ' dash-two-col--app';
?>

<div class="dash-two-col__title">
	<?php if ( get_sub_field('section_title')!=''){ ?>
		<h3><strong><?php echo get_sub_field('section_title'); ?></strong></h3>
	<?php } ?>
	<?php if ( get_sub_field('section_subheading')!=''){ ?>
		<h4><?php echo get_sub_field('section_subheading'); ?></h4>
	<?php } ?>
</div>

<div class="<?php echo $two_col_class; ?>">

	<div class="dash-two-col__content <?php echo $swap ? 'fade-in-right' : 'fade-in-left'; ?>">
		<div class="container-xs">
			<div class="richtext">
				<?php echo get_sub_field('section_description') ?>
			</div>

			<?php
			$links = get_sub_field('2_col_links');
			if (isset($links[0])){ ?>
				<div class="dash-link-list">
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
				<div class="dash-icon-list">
					<?php foreach ( $icons as $icon) { ?>
						<div class="dash-icon-block">
							<img src="<?php echo $icon['icon_image']['url'] ?>" alt="<?php echo $icon['icon_image']['alt'] ?>" class="dash-img-fluid">
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
				<div class="dash-button-group">
					<?php foreach ( $links as $link) {
						$class = 'dash-btn-outline-black';
						if ( $darkbg ) $class = 'dash-btn-outline-white';
						if ($link['button_style']=='solid') {
							$class = $darkbg ? 'dash-btn-white' : 'dash-btn-blue';
						}
					?>
					<a href="<?php echo $link['button_url']; ?>" class="dash-btn <?php echo $class ?>"><?php echo $link['button_title']; ?></a>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
	</div>

	<?php if ($type=='2col_grid') : ?>
		<div class="dash-two-col__media">
			<?php
			$links   = get_sub_field('block_list');
			$subtype = get_sub_field('2_col_grid_style');
			?>

			<?php if ($subtype=='vendor') : ?>
				<div class="dash-vendor-grid">
					<?php foreach ($links as $link) : ?>
						<a <?php if ($link['block_link']!=''){ ?>href="<?php echo $link['block_link']?>" target="_blank"<?php } ?> class="dash-vendor-card">
							<div class="dash-vendor-card__icon">
								<?php echo $link['block_item_image'] ? '<img src="'.$link['block_item_image'].'" alt>' : '<span class="icon-placeholder"></span>' ?>
							</div>
							<div class="dash-vendor-card__info">
								<span class="dash-vendor-card__title"><?php echo $link['block_item_title'] ?></span>
								<span class="dash-vendor-card__link"><?php echo $link['block_item_description'] ?></span>
							</div>
							<div class="dash-vendor-card__action">
								<span><?php echo $link['callout_block_link_text'] ?></span>
							</div>
						</a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<?php if ($subtype=='social') : ?>
				<div class="dash-social-grid">
					<?php foreach ($links as $link) : ?>
						<a <?php if ($link['block_link']!=''){ ?>href="<?php echo $link['block_link']?>" target="_blank"<?php } ?> class="dash-social-card">
							<div class="dash-social-card__image">
								<img src="<?php echo $link['block_item_image']['url'] ?>" alt="<?php echo $link['block_item_image']['alt'] ?>" class="dash-img-fluid">
							</div>
							<?php if ($link['block_item_title']!=''){ ?>
								<span class="dash-social-card__title"><?php echo $link['block_item_title'] ?></span>
							<?php } ?>
							<?php if ($link['block_item_description']!=''){ ?>
								<small><?php echo $link['block_item_description'] ?></small>
							<?php } ?>
						</a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<?php if ($subtype=='default') : ?>
				<div class="dash-image-grid">
					<?php foreach ($links as $link) : ?>
						<div class="dash-image-card">
							<div class="dash-image-card__image">
								<?php if ($link['block_link']!=''){ ?>
									<a href="<?php echo $link['block_link']?>" target="<?php if (get_sub_field('grid_link_open_new_tab')){ echo '_blank'; }?>">
										<img src="<?php echo $link['block_item_image']['url'] ?>" alt="<?php echo $link['block_item_image']['alt'] ?>" class="dash-img-fluid">
									</a>
								<?php } else { ?>
									<img src="<?php echo $link['block_item_image']['url'] ?>" alt="<?php echo $link['block_item_image']['alt'] ?>" class="dash-img-fluid">
								<?php } ?>
							</div>
							<?php if ($link['block_item_title']!=''){ ?>
								<p class="dash-image-card__title"><?php echo $link['block_item_title'] ?></p>
							<?php } ?>
							<?php if ($link['block_item_description']!=''){ ?>
								<small><?php echo $link['block_item_description'] ?></small>
							<?php } ?>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<?php if ($subtype=='feature') : ?>
				<div class="dash-feature-grid">
					<?php foreach ($links as $link) : ?>
						<a <?php if ($link['block_link']!=''){ ?>href="<?php echo $link['block_link']?>" target="_blank"<?php } ?> class="dash-feature-card">
							<div class="dash-feature-card__image">
								<img src="<?php echo $link['block_item_image']['url'] ?>" alt="<?php echo $link['block_item_image']['alt'] ?>" class="dash-img-fluid">
							</div>
							<?php if ($link['block_item_title']!=''){ ?>
								<span class="dash-feature-card__title"><?php echo $link['block_item_title'] ?></span>
							<?php } ?>
							<?php if ($link['block_item_description']!=''){ ?>
								<small><?php echo $link['block_item_description'] ?></small>
							<?php } ?>
						</a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

		</div>
	<?php endif; ?>

	<?php if ($type=='2col_image') : ?>
		<div class="dash-two-col__media dash-hide-mobile">
			<div class="image">
				<?php if (get_sub_field('2_col_large_image')!='') { ?>
					<img src="<?php echo get_sub_field('2_col_large_image') ?>" alt class="dash-img-fluid">
				<?php } else {
					echo get_sub_field('2_col_large_video');
				} ?>
			</div>
		</div>
	<?php endif; ?>

	<?php if ($type=='2col_app') : ?>
		<div class="dash-two-col__media block-pad-top">
			<div class="image">
				<?php if (get_sub_field('2_col_large_image')!='') { ?>
					<img src="<?php echo get_sub_field('2_col_large_image') ?>" alt class="dash-img-fluid">
				<?php } ?>
			</div>
		</div>
	<?php endif; ?>

	<?php if ($type=='2col_terminal') : ?>
		<div class="dash-two-col__media">
			<div class="dash-terminal">
				<div class="dash-terminal__header">
					<div class="dash-terminal__dots">
						<i class="dash-terminal__dot"></i>
						<i class="dash-terminal__dot"></i>
						<i class="dash-terminal__dot"></i>
					</div>
					<div class="dash-terminal__actions">
						<a href="#" class="dash-terminal__copy-btn copy-trigger" data-target="#copyarea-<?php echo $count ?>">
							<i class="icon-el clipboard"></i>
						</a>
					</div>
				</div>
				<div class="dash-terminal__body">
					<?php echo get_sub_field('terminal_text') ?>
				</div>
				<textarea class="dash-terminal__copy" id="copyarea-<?php echo $count ?>">
					<?php echo trim(strip_tags(get_sub_field('terminal_text'))) ?>
				</textarea>
			</div>
		</div>
	<?php endif; ?>

</div>
