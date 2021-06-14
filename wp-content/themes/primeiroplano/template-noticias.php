<?php
/*
Template Name: Notícias
*/
?>


<?php get_header(); ?>

<main id="corpo" class="row">

	<div class="wrapper">

		<h1><?php the_title(); ?></h1>


		<div id="noticias-section" class="row flexbox">

			<?php

			// SEÇÃO NOTÍCIAS

			$noticias = new WP_Query(array('post_type' => 'post', 'posts_per_page' => -1, 'tax_query' => array(
					array(
						'taxonomy' => 'edicao',
						'field'    => 'slug',
						'terms'    => $editioslug,
					),
				),
			));

			if ($noticias->have_posts()) : while ($noticias->have_posts()) : $noticias->the_post(); ?>

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

	</div>
</main>

<?php get_footer(); ?>

</body>

</html><!-- This is the end. Beautiful friend.  -->