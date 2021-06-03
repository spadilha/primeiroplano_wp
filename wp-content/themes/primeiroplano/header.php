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


<header id="topbar">
	<div class="wrapper">
		<img src="<?= THEMEPATH ?>/images/ico_primeiroplano.png" alt="">

		<?php wp_nav_menu( array( 'theme_location' => 'Topbar', 'container' => '', 'container_id' => '', 'container_class' => '', 'menu_class' => '') );	?>
	</div>
</header>

<header id="header">

	<div class="wrapper">

		<a href="<?= SITEHOME ?>" class="logo"><img src="<?= THEMEPATH ?>/images/logo_primeiroplano.png" alt="Festival Primeiro Plano"></a>


		<div id="menuIcon">
			<button class="hamburger hamburger-rotate fullscreen"><span>menu</span></button>
		</div>

		<nav id="menu">
			<?php wp_nav_menu( array( 'theme_location' => 'MainMenu', 'container' => '', 'container_id' => '', 'container_class' => '', 'menu_class' => '') );	?>
		</nav>

		<button class="btn-search"><svg id="surface1" xmlns="http://www.w3.org/2000/svg" width="21.278" height="21.704" viewBox="0 0 21.278 21.704">
	  <path class="transition" d="M14.933,12.879a8.16,8.16,0,1,0-2.51,2.312l6.018,5.982a1.708,1.708,0,0,0,2.477-2.353c-.021-.022-.04-.042-.062-.062Zm-6.666.558a5.263,5.263,0,1,1,5.261-5.273,5.265,5.265,0,0,1-5.261,5.273Zm0,0" fill="#fff"/>
	</svg></button>

	</div>

</header>
<div id="search">
	<div class="searchForm">
		<h3>O que você procura?</h3>
		<form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
			<input type="text" placeholder="Digite aqui sua busca…" name="s" id="s" class="searchField" />
			<input type="submit" id="searchsubmit" class="searchSubmit" value="" />
		</form>
	</div>
</div>

