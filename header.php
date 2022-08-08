<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?></title>
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-P4XQJZG');</script>
		<!-- End Google Tag Manager -->

		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon/favicon-16x16.png">
		<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon/manifest.json">

		<meta name="msapplication-TileColor" content="#0A2B69">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/img/icons/favicon/ms-icon-144x144.png">
		<meta name="theme-color" content="#0A2B69">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="apple-itunes-app" content="app-id=1206647026">

		<link href="https://fonts.googleapis.com/css?family=Montserrat:200,400,500,700,900i%7COpen+Sans:400,600,700%7CRoboto+Condensed" rel="stylesheet">

		<?php wp_head(); ?>


	</head>
	<body <?php body_class(); ?>>

		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P4XQJZG"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->		

		<!-- wrapper -->
		<div class="wrapper <?php echo (get_field('navbar_text_color')?'nav-'.get_field('navbar_text_color'):''); ?>">

			<!-- header -->
			<header class="header clear" role="banner">
					<div class="row top">
						<div class="d-lg-none col-4">
							<a href="#" class="menu-toggle menu-icon">
								<span class="bar"></span>
								<span class="bar"></span>
							</a>
						</div>
						<div class="col-lg-2 col-4">
							<div class="logo">
								<a href="<?php echo home_url(); ?>">
									<?php get_template_part('inc/dashlogo.svg'); ?>
								</a>
							</div>
						</div>
						<div class="d-lg-none col-4 text-right">
							<div class="lang-mobile">
								<div class="link">
									<a href="#">
									<span class="lang-current"></span> 
									<span class="icon-inline sm caret down">
										<?php get_template_part('inc/caret.svg'); ?>
									</span>
									</a>
								</div>
								<div class="dropdown">
									<div class="d-block d-lg-none mobile-arrow"></div>
									<?php 
											do_action('wpml_add_language_selector');
									?>
								</div>
							</div>
						</div>

						<?php 
							// $homeid = get_option( 'page_on_front' );
							$homeid = "option";
						?>


						<div class="col-lg-10 col-12">
							<div class="navbar" id="navbar-main">

								<div class="bg">
									<div class="arrow"></div>

								</div>
								
								<div class="d-block d-lg-none mobile-arrow"></div>

								<div class="navbar-container">
									<?php while( have_rows('navigation_main',$homeid) ): the_row();
										$navposts = get_sub_field('nav_item_list');
									?>
									<div class="navbar-item">
										<div class="link">
											<a href="<?php echo get_permalink($navposts[0])?>">
												<?php echo get_sub_field('nav_item_title'); ?>
											</a>
											<p class="tagline d-lg-none">
												<?php echo get_sub_field('nav_tagline'); ?>
											</p>
										</div>
										<?php if (is_countable($navposts)){?>
											<div class="dropdown">
												<?php 
												$idx = 0;
												foreach( $navposts as $navpost):?>
													<div class="link <?php echo ($idx==0?'first d-lg-none':'') ?>">
														<a href="<?php echo get_the_permalink($navpost->ID) ?>"><?php echo get_the_title($navpost->ID)?></a>
													</div>
												<?php $idx++; endforeach; ?>
											</div>
										<?php }?>
										
									</div>
									<?php endwhile; ?>

									<div class="navbar-item lang">
										<div class="link">
											<a href="#">
											<span class="lang-current"></span> 
											<span class="icon-inline sm gray caret down">
												<?php get_template_part('inc/caret.svg'); ?>
											</span>
											</a>
										</div>
										<div class="dropdown">
											<?php 
											do_action('wpml_add_language_selector');
											?>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
			</header>
			<!-- /header -->
