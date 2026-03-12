<?php
// Block: Callouts
// Renders card-based callout blocks with optional large image, buttons

$largeimg = false;
if ( get_sub_field('callout_desktop_only_image')!='' ) {
	$largeimg = get_sub_field('callout_desktop_only_image');
}
if ( $largeimg ){ ?>
    <div class="image d-none d-lg-block"><img src="<?php echo $largeimg;?>" alt class="large img-fluid"></div>
<?php }  ?>

<div class="callouts-title">
	<?php if ( get_sub_field ( "section_title")!=''){ ?>
		<h3><strong><?php echo get_sub_field('section_title'); ?></strong></h3>
		<?php } ?>
		<?php if ( get_sub_field ( "section_subheading")!=''){ ?>
	<h4><?php echo get_sub_field('section_subheading'); ?></h4>
	<?php } ?>
</div>
<?php
$links = get_sub_field('block_list');
$class = "card border-0 text-center bg-transparent";
?>

<?php if (is_array($links)) : ?>
<div class="card-deck">
	<?php foreach ($links as $link) : ?>
		<div class="<?php echo $class; ?>">

			<?php if ($largeimg) : ?>
				<div class="d-lg-none">
					<img src="<?php echo $link['block_item_image']['url']; ?>" alt="<?php echo $link['block_item_image']['alt']; ?>" class="img-fluid">
				</div>
				<div class="card-body">
					<h3 class="title-small card-title"><?php echo $link['block_item_title']; ?></h3>
			<?php else : ?>
				<div class="callout-image">
					<img src="<?php echo $link['block_item_image']['url']; ?>" alt="<?php echo $link['block_item_image']['alt']; ?>" class="card-img-top">
				</div>
				<div class="card-body px-2">
					<h3 class="title-italic card-title"><?php echo $link['block_item_title']; ?></h3>
			<?php endif; ?>

					<p class="card-text"><?php echo $link['block_item_description']; ?></p>
				</div>

			<?php if ($link['block_link'] != '') : ?>
				<div class="card-footer bg-transparent border-0">
					<a href="<?php echo $link['block_link']; ?>" target="<?php echo get_sub_field('callout_open_new_tab') ? '_blank' : '_self'; ?>" class="btn btn-ghost <?php echo get_field('background_style') == 'bg-gradient-h' ? 'white' : 'blue'; ?>">
						<strong><?php echo $link['callout_block_link_text'] ?: __('Read more', 'html5blank'); ?></strong>
					</a>
				</div>
			<?php endif; ?>

		</div>
	<?php endforeach; ?>
</div>
<?php endif; ?>
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
						<a href="<?php echo $link['button_url']; ?>" class="btn <?php echo $class ?>"><?php echo $link['button_title']; ?></a><?php } ?>
					<?php } ?>
				</div>
			</div>
