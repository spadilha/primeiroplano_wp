<?php get_header(); ?>


<?php

// SEÇÃO NOTÍCIAS

$noticias = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 3, 'tax_query' => array(
		array(
			'taxonomy' => 'edicao',
			'field'    => 'slug',
			'terms'    => $editioslug,
		),
	),
));

if ($noticias->have_posts()) : ?>

	<section id="noticias-section" class="row">

		<div class="wrapper">

			<h2 class="section-title"><a href="<?= SITEHOME ?>/noticias" title="Notícias">Últimas notícias</a></h2>

			<div class="row flexbox">

			<?php while ($noticias->have_posts()) : $noticias->the_post(); ?>

				<article class="noticia">

					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="bg-image">
					<?php if( has_post_thumbnail() ){ the_post_thumbnail('thumbnail'); } else { echo '<img src="'. get_template_directory_uri() . '/images/thumb_default.png" alt="">'; } ?></a>
					<div class="inner">
						<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>

						<p><?php the_excerpt(); ?></p>

						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="leiaMais">Leia Mais</a>
					</div>
				</article>

			<?php endwhile; ?>

			<div class="noticia fake"></div>

			</div>
		</div>

	</section>

<?php endif; ?>


<?php get_template_part( 'template-parts/carousel-edicoes' ); ?>

<?php get_footer(); ?>

</body>

</html><!-- This is the end. Beautiful friend.  -->