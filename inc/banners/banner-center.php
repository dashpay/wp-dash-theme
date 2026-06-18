<?php
// Banner: Center Layout
// Centered text, subtitle, button, optional video link, background image
// This is the original/existing large banner layout

?>
<div class="<?php
	if (get_field( "hide_large_banner" )=='no-overlay') {
		echo('banner-no-overlay ');
	} else {
		echo('banner ');
	}
	if (get_field( "large_banner_embed" )!=''){
		echo 'has-embed';
	}
	if (get_field( "shorten_large_banner") ){
		echo 'banner-short ';
	}?>" style="background-image:url(<?php echo get_field( "large_banner_image" ); ?>)">
	<?php if ( get_field( "large_banner_embed" )=='' ){?>
	<div class="caption-container">
		<div class="caption">
			<h1><?php echo get_field( "large_banner_title" ); ?></h1>
			<p><?php echo get_field( "large_banner_subtitle" ); ?></p>

			<?php if ( get_field( "large_banner_button" )!=''){
				?>
				<br><a href="<?php echo get_field( "large_banner_button_link" )?>"
				class="banner-btn btn btn-blue"
				target="<?php if ( get_field( "large_banner_button_new_tab" ) ) { echo "_blank"; }?>">
				<?php echo get_field( "large_banner_button" )?></a>
			<?php
			}; ?>

			<?php if ( get_field( "large_banner_video" )!='' ){
				?>
				<a class="playvideo-js" href="<?php echo get_field( "large_banner_video" )?>" data-fancybox>
					<i class="icon-el play" title="Play Video"></i>
				</a>
			<?php
			}; ?>
		</div>
	</div>
	<?php } else {
		echo get_field( "large_banner_embed" );
	}?>
</div>
