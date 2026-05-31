<?php
// Block: Callouts
// Renders card-based callout blocks with optional large image, buttons

$largeimg = false;
if ( get_sub_field('callout_desktop_only_image')!='' ) {
	$largeimg = get_sub_field('callout_desktop_only_image');
}
if ( $largeimg ){ ?>
	<div class="dash-callouts__desktop-image"><img src="<?php echo $largeimg;?>" alt class="dash-img-fluid large"></div>
<?php }  ?>

<div class="dash-callouts__title">
	<?php if ( get_sub_field('section_title')!=''){ ?>
		<h3><strong><?php echo get_sub_field('section_title'); ?></strong></h3>
	<?php } ?>
	<?php if ( get_sub_field('section_subheading')!=''){ ?>
		<h4><?php echo get_sub_field('section_subheading'); ?></h4>
	<?php } ?>
</div>

<?php $links = get_sub_field('block_list'); ?>

<?php if (is_array($links)) : ?>
<div class="dash-callouts-grid">
	<?php foreach ($links as $link) : ?>
		<div class="dash-callout-card">

			<?php if ($largeimg) : ?>
				<div class="dash-callout-card__mobile-image">
					<img src="<?php echo $link['block_item_image']['url']; ?>" alt="<?php echo $link['block_item_image']['alt']; ?>" class="dash-img-fluid">
				</div>
				<div class="dash-callout-card__body">
					<h3 class="dash-callout-card__title"><?php echo $link['block_item_title']; ?></h3>
			<?php else : ?>
				<div class="dash-callout-card__image">
					<img src="<?php echo $link['block_item_image']['url']; ?>" alt="<?php echo $link['block_item_image']['alt']; ?>" class="dash-img-fluid">
				</div>
				<div class="dash-callout-card__body">
					<h3 class="dash-callout-card__title"><?php echo $link['block_item_title']; ?></h3>
			<?php endif; ?>

					<p class="dash-callout-card__text"><?php echo $link['block_item_description']; ?></p>
				</div>

			<?php if ($link['block_link'] != '') : ?>
				<div class="dash-callout-card__footer">
					<a href="<?php echo $link['block_link']; ?>" target="<?php echo get_sub_field('callout_open_new_tab') ? '_blank' : '_self'; ?>" class="dash-btn <?php echo get_field('background_style') == 'bg-gradient-h' ? 'dash-btn-outline-white' : 'dash-btn-outline-black'; ?>">
						<strong><?php echo $link['callout_block_link_text'] ?: __('Read more', 'html5blank'); ?></strong>
					</a>
				</div>
			<?php endif; ?>

		</div>
	<?php endforeach; ?>
</div>
<?php endif; ?>

<div class="container-xs">
	<div class="dash-callouts__buttons">
		<?php
		$links = get_sub_field('block_buttons');
		if (isset($links[0])){ ?>
			<?php foreach ( $links as $link) {
				$class = 'dash-btn-outline-black';
				if ($link['button_style']=='solid') {
					$class = 'dash-btn-blue';
				}
			?>
			<a href="<?php echo $link['button_url']; ?>" class="dash-btn <?php echo $class ?>"><?php echo $link['button_title']; ?></a><?php } ?>
		<?php } ?>
	</div>
</div>
