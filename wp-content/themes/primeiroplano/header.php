<!doctype html>

<html <?php language_attributes(); ?> class="no-js">

<head>
	<meta charset="utf-8">

	<title><?php wp_title('|'); ?></title>

	<!-- Google Chrome Frame for IE -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<!-- mobile meta (hooray!) -->
	<meta name="HandheldFriendly" content="True">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1"/>

	<!-- icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) -->
	<link rel="apple-touch-icon" href="<?= THEMEPATH ?>/images/apple-touch-icon.png">
	<link rel="icon" href="<?= THEMEPATH ?>/images/favicon.ico">
	<!--[if IE]>
		<link rel="shortcut icon" href="<?= THEMEPATH ?>/images/favicon.ico">
	<![endif]-->

	<!-- wordpress head functions -->
	<?php wp_head(); ?>

	<!-- Global site tag (gtag.js) - Google Analytics -->

</head>

<body <?php body_class(); ?>>

<header id="header">
	<a href="<?= SITEHOME ?>" class="logo"><?php include_once(ROOTPATH . '/images/logo_fundocasa.php'); ?></a>

	<!-- <button class="menuIcon">MENU</button> -->

	<div id="menuIcon">
		<button class="hamburger hamburger-rotate fullscreen"><span>menu</span></button>
	</div>


	<nav id="menu">
		<?php wp_nav_menu( array( 'theme_location' => 'MainMenu', 'container' => '', 'container_id' => '', 'container_class' => '', 'menu_class' => '') );	?>


	</nav>

	<button class="btn-busca"></button>

</header>
<div id="busca">
	<div class="searchForm">
		<form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
			<input type="text" placeholder="<?php echo __('buscar', 'spatheme'); ?>" name="s" id="s" class="searchField" />
			<input type="submit" id="searchsubmit" class="searchSubmit" value="" />
		</form>
	</div>
</div>


