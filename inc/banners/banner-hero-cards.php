<?php
// Banner: Hero Cards Layout
// Two side-by-side cards with image/video backgrounds
// Reuses the same card structure as the hero_cards content block

$cards = get_field('banner_hero_cards');
if ( is_array($cards) ) : ?>
<div class="banner-hero-cards">
	<div class="hero-cards-row">
		<?php foreach ( $cards as $card ) :
			$bg_type = $card['card_background_type'];
			$bg_color = !empty($card['card_background_color']) ? $card['card_background_color'] : '';
			$style = $bg_color ? 'background-color: ' . esc_attr($bg_color) . ';' : '';
			if ( $bg_type == 'image' && !empty($card['card_background_image']) ) {
				$style .= ' background-image: url(' . esc_url($card['card_background_image']['url']) . '); background-size: cover; background-position: center;';
			}
		?>
		<div class="hero-card" style="<?php echo $style; ?>">

			<?php if ( $bg_type == 'video' && !empty($card['card_background_video']) ) : ?>
				<video class="hero-card-bg" autoplay muted loop playsinline>
					<source src="<?php echo esc_url($card['card_background_video']); ?>" type="video/mp4">
				</video>
			<?php endif; ?>

			<div class="hero-card-content">
				<?php if ( !empty($card['card_title']) ) : ?>
					<h3><?php echo $card['card_title']; ?></h3>
				<?php endif; ?>
				<?php if ( !empty($card['card_description']) ) : ?>
					<p><?php echo $card['card_description']; ?></p>
				<?php endif; ?>
				<?php if ( !empty($card['card_buttons']) && is_array($card['card_buttons']) ) : ?>
					<div class="hero-card-buttons">
						<?php foreach ( $card['card_buttons'] as $button ) :
							$btn_class = ($button['button_style'] == 'solid') ? 'btn-solid' : 'btn-outline';
							$target = !empty($button['button_new_tab']) ? ' target="_blank"' : '';
						?>
							<a href="<?php echo esc_url($button['button_url']); ?>" class="hero-card-btn <?php echo $btn_class; ?>"<?php echo $target; ?>>
								<?php echo esc_html($button['button_title']); ?>
							</a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>
<?php endif; ?>
