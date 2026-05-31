<?php
// Block: Callouts
// Renders card-based callout blocks with optional large image and buttons
// Partial Bootstrap cleanup: layout/card structure moved to Dash utilities

$largeimg = false;

if (get_sub_field('callout_desktop_only_image') != '') {
	$largeimg = get_sub_field('callout_desktop_only_image');
}

if ($largeimg) { ?>
	<div class="dash-callouts__desktop-image">
		<img src="<?php echo $largeimg; ?>" alt class="large">
	</div>
<?php } ?>

<div class="callouts-title dash-callouts__title">
	<?php if (get_sub_field("section_title") != '') { ?>
		<h3><strong><?php echo get_sub_field('section_title'); ?></strong></h3>
	<?php } ?>

	<?php if (get_sub_field("section_subheading") != '') { ?>
		<h4><?php echo get_sub_field('section_subheading'); ?></h4>
	<?php } ?>
</div>

<?php
$links = get_sub_field('block_list');
$card_class = 'dash-callout-card';
?>

<?php if (is_array($links)) : ?>
	<div class="dash-callouts-grid">
		<?php foreach ($links as $link) : ?>
			<div class="<?php echo $card_class; ?>">

				<?php if ($largeimg) : ?>
					<div class="dash-callout-card__mobile-image">
						<img src="<?php echo $link['block_item_image']['url']; ?>" alt="<?php echo $link['block_item_image']['alt']; ?>">
					</div>

					<div class="dash-callout-card__body">
						<h3 class="title-small dash-callout-card__title">
							<?php echo $link['block_item_title']; ?>
						</h3>
				<?php else : ?>
					<div class="callout-image dash-callout-card__image">
						<img src="<?php echo $link['block_item_image']['url']; ?>" alt="<?php echo $link['block_item_image']['alt']; ?>">
					</div>

					<div class="dash-callout-card__body">
						<h3 class="title-italic dash-callout-card__title">
							<?php echo $link['block_item_title']; ?>
						</h3>
				<?php endif; ?>

						<p class="dash-callout-card__text">
							<?php echo $link['block_item_description']; ?>
						</p>
					</div>

				<?php if ($link['block_link'] != '') : ?>
					<div class="dash-callout-card__footer">
						<a href="<?php echo $link['block_link']; ?>" target="<?php echo get_sub_field('callout_open_new_tab') ? '_blank' : '_self'; ?>" class="btn btn-ghost <?php echo get_field('background_style') == 'bg-gradient-h' ? 'white' : 'blue'; ?>">
							<strong><?php echo $link['callout_block_link_text'] ?: __('Read more', 'html5blank'); ?></strong>
						</a>
					</div>
				<?php endif; ?>

			</div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>

<?php
$buttons = get_sub_field('block_buttons');
if (isset($buttons[0])) { ?>
	<div class="container-xs">
		<div class="dash-callouts__buttons buttons">
			<?php foreach ($buttons as $link) {
				$class = 'btn-ghost blue';

				if ($link['button_style'] == 'solid') {
					$class = 'btn-blue';
				}
			?>
				<a href="<?php echo $link['button_url']; ?>" class="btn <?php echo $class; ?>">
					<?php echo $link['button_title']; ?>
				</a>
			<?php } ?>
		</div>
	</div>
<?php } ?>
