<div class="halfbanner bg <?php echo get_field( "background_style" )?get_field( "background_style" ):'bg-lightgray' ?> <?php if(get_field( "half_banner_display" )!='image'){echo 'with-bgimg';}?>" 
	<?php if (get_field( "half_banner_display" )!='image'){ echo 'style="background-image:url('.get_field( "half_banner_image" ).')"' ;}?>>
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-4">
					<div class="caption">
						<h1><?php echo get_field( "half_banner_title" ); ?></h1>
						<p><?php echo get_field( "half_banner_subtitle" ); ?></p>

						<?php if ( get_field( "half_banner_button_text" )!='' ){
							?>
							<a class="btn btn-ghost <?php echo get_field( "background_style" )=='bg-gradient-h'?'white':'blue'; ?>" href="<?php echo get_field( "half_banner_button_link" )?>">
								<?php echo get_field( "half_banner_button_text" )?>
							</a>
						<?php
						}; ?>
					</div>
				</div>
			</div>
		</div>
		<?php if(get_field( "half_banner_display" )=='image' && get_field( "download_image_1" ) && get_field( "download_image_2" )) { ?>
			<img src='<?php echo get_field( "download_image_1" )?>' alt class="main img-fluid" id="dlimg1" style="display: none;">
			<img src='<?php echo get_field( "download_image_2" )?>' alt class="main img-fluid" id="dlimg2" style="display: none;">
		<?php } else { ?> 

		<?php if(get_field( "half_banner_display" )=='image'){ ?>
			<img src='<?php echo get_field( "half_banner_image" )?>' alt class="main img-fluid">
		<?php }} ?> 


</div>

<?php 
	// another header variation, unlike other light header also uses white logo
	if (get_field( "background_style" )=='bg-gradient-h' ){
?>
<style type="text/css">
	.halfbanner .caption h1 {
		color: #fff;
	}
	header .lang path, header .lang polygon,
	header .logo path, header .logo polygon {
		fill: #fff!important;
	}
	header a, header a:hover {
		color: #fff;
	}
</style>
<?php } ?>
