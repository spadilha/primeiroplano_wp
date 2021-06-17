<?php get_header(); ?>

<?php $search_term = get_search_query(); ?>

<main id="corpo" class="row">

	<div class="wrapper">

		<h1>Busca por <?= $search_term ?></h1>

	<?php
		$num = $wp_query->found_posts;

		if ($num == 1){ ?>
			<h3 class="page-title"><?php echo $num . ' ' . __('resultado encontrado', 'spatheme') ?>.</h3>

	<?php } else if ($num > 1){ ?>

			<h3 class="page-title"><?php echo $num . ' ' . __('resultados encontrados', 'spatheme') ?>.</h3>

	<?php } else { ?>

			<h3 class="page-title"><?php echo __('Nenhum resultado encontrado', 'spatheme') ?>.</h3>
	<?php }	?>


		<div id="noticias-section" class="row flexbox">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<article class="noticia">

					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="bg-image">
					<?php if( has_post_thumbnail() ){ the_post_thumbnail('thumbnail'); } else { echo '<img src="'. get_template_directory_uri() . '/images/thumb_default.png" alt="">'; } ?></a>
					<div class="inner">
						<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>

						<p><?php the_excerpt(); ?></p>

						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="leiaMais">Leia Mais</a>
					</div>
				</article>

			<?php endwhile; endif; ?>

			<article class="noticia fake"></article>

		</div>

		<div id="pagenav" class="row">
			<?php wp_pagenavi(); ?>
		</div>

	</div>
</main>

<?php get_footer(); ?>

</body>

</html><!-- This is the end. Beautiful friend.  -->