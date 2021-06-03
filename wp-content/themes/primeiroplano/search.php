<?php get_header(); ?>

<?php
	// Pega o termo da busca
	$search_term = get_search_query();
?>

<?php get_header(); ?>

<div id="hero" class="row">
	<div class="wrapper">

		<h1 class="pageHeader"><?= __('Busca por ', 'spatheme') . '"' .$search_term . '"' ?></h1>

	</div>
</div>

<main id="corpo" class="row page-busca">

	<div class="wrapper">

	    <?php
		$num = $wp_query->found_posts;

		if ($num == 1){ ?>
			<h3 class="page-title"><?php echo $num . ' ' . __('resultado encontrado', 'spatheme') ?>.</h3>

	<?php } else if ($num > 1){ ?>

			<h3 class="page-title"><?php echo $num . ' ' . __('resultados encontrados', 'spatheme') ?>.</h3>

	<?php } else { ?>

			<h3 class="page-title"><?php echo __('Nenhum resultado encontrado', 'spatheme') ?>.</h3>
	<?php }	?>


		<div class="row flexbox publicacoes">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<?php $title = get_the_title(); ?>

			<?php
				$post_type = get_post_type_object( get_post_type($post) );

				if($post_type->label == 'Posts') $post_type->label = __('Notícias', 'spatheme');
			?>

			<a href="<?php the_permalink(); ?>" title="<?= $title ?>" class="grid-item resultado">
				<?php if( has_post_thumbnail() ){ the_post_thumbnail('thumbnail'); } else { echo '<img src="'. get_template_directory_uri() . '/images/thumb_default.jpg" alt="">'; } ?>
				<h2 class="listHeader"><?= $title ?></h2>

				<span class="grid-note"><?= $post_type->label ?></span>
			</a>

		<?php endwhile; endif; ?>

			<div class="resultado grid-escondido"></div>

		</div>

		<div id="pagenav" class="row">
			<?php wp_pagenavi(); ?>
		</div>

	</div>

</main>

<img src="<?= THEMEPATH ?>/images/ilustracao_publicacoes.png" alt="" class="ilustracao_full">

<?php include(ROOTPATH . '/includes/section-doeagora.php'); ?>

<?php include(ROOTPATH . '/includes/section-newsletter.php'); ?>

<?php get_footer(); ?>

</body>

</html><!-- This is the end. Beautiful friend.  -->



