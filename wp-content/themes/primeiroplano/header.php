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


<?php
	global $currentPageId;

	if(is_page()){

		$currentPageId = $post->ID;
	} else {
		$currentPageId = 0;
	}
?>


	<?php include_once('template-parts/define-edicao.php'); ?>


	<!-- wordpress head functions -->
	<?php wp_head(); ?>

	<!-- Global site tag (gtag.js) - Google Analytics -->

</head>

<body <?php body_class(); ?>>



<nav id="menu-mobile" class="row">

	<ul>

<?php
$menumobile = new WP_Query(array('post_type' => 'page', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC',

	'meta_query' => array(
		'relation' => 'AND',
		array(
			'key' => 'menu',
			'value'    => array('principal','submenu'),
		),
	),



	'tax_query' => array(
		array(
			'taxonomy' => 'edicao',
			'field'    => 'slug',
			'terms'    => $editioslug,
		),
	),
));

if ($menumobile->have_posts()) : while ($menumobile->have_posts()) : $menumobile->the_post();

	$termo = get_field('menu_termo');

	if($termo == ''){
		$termo = get_the_title();
	}
?>

	<li <?php if($currentPageId == $post->ID) echo ' class="current-item"'; ?>><a href="<?php the_permalink() ?>"><?= $termo ?></a></li>

<?php endwhile; endif; ?>

	</ul>

	<?php get_template_part( 'template-parts/nav-socialmedia' ); ?>

</nav>


<header id="topbar" class="row">
	<div class="wrapper">
		<img id="icoLuzes" src="<?= THEMEPATH ?>/images/ico_primeiroplano.png" alt="">

		<?php wp_nav_menu( array( 'theme_location' => 'Topbar', 'container' => '', 'container_id' => '', 'container_class' => '', 'menu_class' => '') );	?>


		<div class="nome-edicao"><a href="<?= $editionLink ?>"><?= $editioname ?></a></div>
	</div>
</header>

<header id="header" class="row">

	<div class="wrapper">

		<a href="<?= SITEHOME ?>" class="logo"><img src="<?= THEMEPATH ?>/images/logo_primeiroplano.png" alt="Festival Primeiro Plano"></a>


		<div id="menuIcon">
			<button class="hamburger hamburger-rotate fullscreen"><span>menu</span></button>
		</div>

		<nav id="menu">
			<ul>

		<?php

		$menuprincipal = new WP_Query(array('post_type' => 'page', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC', 'meta_key' => 'menu', 'meta_value' => 'principal', 'tax_query' => array(
				array(
					'taxonomy' => 'edicao',
					'field'    => 'slug',
					'terms'    => $editioslug,
				),
			),
		));

		if ($menuprincipal->have_posts()) : while ($menuprincipal->have_posts()) : $menuprincipal->the_post();?>

			<li <?php if($currentPageId == $post->ID) echo ' class="current-item"'; ?>><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>

		<?php endwhile; endif; ?>

		<?php wp_reset_query(); ?>

			</ul>

		</nav>

		<button class="btn-search"><svg id="surface1" xmlns="http://www.w3.org/2000/svg" width="21.278" height="21.704" viewBox="0 0 21.278 21.704"><path class="transition" d="M14.933,12.879a8.16,8.16,0,1,0-2.51,2.312l6.018,5.982a1.708,1.708,0,0,0,2.477-2.353c-.021-.022-.04-.042-.062-.062Zm-6.666.558a5.263,5.263,0,1,1,5.261-5.273,5.265,5.265,0,0,1-5.261,5.273Zm0,0" fill="#fff"/></svg></button>

	</div>

</header>
<div id="fakeheader" class="row"></div>
<div id="search">
	<div class="searchForm">
		<h3>O que você procura?</h3>
		<form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
			<input type="text" placeholder="Pesquisar…" name="s" id="s" class="searchField" />
			<input type="submit" id="searchsubmit" class="searchSubmit" value="" />
		</form>
	</div>
</div>

<?php $banners =  get_field('banners_home', 'edicao_' . $thiseditionid); ?>

<?php if($banners){ ?>

	<section id="banners" class="row">

		<div class="banners-container">

		<?php

			foreach ($banners as $slide) {

				$link = $slide['link']['bnr_url'];
				$target = $slide['link']['bnr_target'];

				$image = $slide['bnr_imagem']['url'];
				$alt = $slide['bnr_imagem']['alt'];
				$credito = $slide['bnr_imagem']['caption'];

		?>

				<div class="slide">

					<?php if($link){ ?>
						<a href="<?= $link ?>" <?php if($target) echo ' target="_blank"'; ?>>
					<?php } ?>

						<img class="slideImage" src="<?= $image ?>"  alt="<?= $alt ?>" />

					<?php if($link) echo '</a>'; ?>

					<?php if($credito){ ?>
						<span class="credito"><?= $credito ?></span>
					<?php } ?>
				</div>

		<?php } ?>

		</div>


	</section>

<?php } ?>


<?php

$submenu = new WP_Query(array('post_type' => 'page', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC', 'meta_key' => 'menu', 'meta_value' => 'submenu', 'tax_query' => array(
		array(
			'taxonomy' => 'edicao',
			'field'    => 'slug',
			'terms'    => $editioslug,
		),
	),
));

if ($submenu->have_posts()) : ?>

	<nav id="submenu" class="row">
		<div class="wrapper">

			<ul>

				<?php while ($submenu->have_posts()) : $submenu->the_post();?>

					<?php
						$termo = get_field('menu_termo');

						if($termo == ''){
							$termo = get_the_title();
						}
					?>

					<li <?php if($currentPageId == $post->ID) echo ' class="current-item"'; ?>><a href="<?php the_permalink() ?>"><?= $termo ?></a></li>

				<?php endwhile; ?>

			</ul>

			<?php get_template_part( 'template-parts/nav-socialmedia' ); ?>

		</div>
	</nav>


<?php endif; ?>

<?php wp_reset_query(); ?>
