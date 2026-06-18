<?php
// Banner: Split Layout
// Text + buttons on one side, image on the other side
// Fields: title, subtitle, description, buttons, text position, background, foreground image

$text_position = get_field('banner_text_position');
$bg_type = get_field('banner_bg_type');
$bg_color = get_field('banner_bg_color');
$bg_image = get_field('banner_bg_image');
$foreground_image = get_field('banner_foreground_image');

$style = '';
if ( $bg_type == 'image' && !empty($bg_image) ) {
	$style = 'background-image: url(' . esc_url($bg_image['url']) . '); background-size: cover; background-position: center;';
} elseif ( $bg_type == 'color' && !empty($bg_color) ) {
	$style = 'background-color: ' . esc_attr($bg_color) . ';';
}

$text_order = ($text_position == 'right') ? ' order-lg-2' : '';
$image_order = ($text_position == 'right') ? ' order-lg-1' : '';
?>
<div class="banner-split" style="<?php echo $style; ?>">
	<div class="banner-split-inner">
		<div class="banner-split-text<?php echo $text_order; ?>">
			<div class="banner-split-content">
				<?php if ( get_field('banner_split_title') != '' ) : ?>
					<h1><?php echo get_field('banner_split_title'); ?></h1>
				<?php endif; ?>
				<?php if ( get_field('banner_split_subtitle') != '' ) : ?>
					<p class="banner-split-subtitle"><?php echo get_field('banner_split_subtitle'); ?></p>
				<?php endif; ?>
				<?php if ( get_field('banner_split_text') != '' ) : ?>
					<div class="banner-split-description"><?php echo get_field('banner_split_text'); ?></div>
				<?php endif; ?>
				<?php if ( !empty(get_field('banner_buttons')) && is_array(get_field('banner_buttons')) ) : ?>
					<div class="banner-split-buttons">
						<?php foreach ( get_field('banner_buttons') as $button ) :
							$btn_class = ($button['button_style'] == 'solid') ? 'btn-solid' : 'btn-outline';
							$target = !empty($button['button_new_tab']) ? ' target="_blank"' : '';
						?>
							<a href="<?php echo esc_url($button['button_url']); ?>" class="banner-split-btn <?php echo $btn_class; ?>"<?php echo $target; ?>>
								<?php echo esc_html($button['button_title']); ?>
							</a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="banner-split-image<?php echo $image_order; ?>">
			<?php if ( !empty($foreground_image) ) : ?>
				<img src="<?php echo esc_url($foreground_image['url']); ?>" alt="<?php echo esc_attr($foreground_image['alt']); ?>">
			<?php endif; ?>
		</div>
	</div>
</div>
