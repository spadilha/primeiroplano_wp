<?php get_header(); ?>

<main id="corpo" class="row">

	<div class="wrapper">

		<h1><?php single_term_title(); ?></h1>



	<?php

		$thisID = get_queried_object_id();

		$subsessoes = get_terms( array(
		    'taxonomy' => 'sessao',
		    'parent' => $thisID,
		));

		if($subsessoes):

			echo '<div id="noticias-section" class="row">';


			foreach($subsessoes as $subs) :


				echo '<h3 class="section-title">' . $subs->name  . '</h3>';

				echo '<div class="row flexbox">';

				$filmes = new WP_Query(array(
					'post_type' => 'filme',
					'orderby' 	=> 'title',
					'order' 	=> 'ASC',
					'tax_query' => array(
						'relation' => 'AND',
						array(
							'taxonomy' 	=> 'sessao',
							'field' 	=> 'slug',
							'terms' 	=> $subs->slug,
						),
						array(
							'taxonomy'	=> 'edicao',
							'field' 	=> 'slug',
							'terms' 	=> $editioslug,
						),
					),
				));

				if ($filmes->have_posts()) : while ($filmes->have_posts()) : $filmes->the_post(); ?>

					<article class="noticia">

						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="bg-image">
						<?php if( has_post_thumbnail() ){ the_post_thumbnail('thumbnail'); } else { echo '<img src="'. get_template_directory_uri() . '/images/thumb_default.png" alt="">'; } ?></a>
						<div class="inner">
							<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>

							<?php $autoria = get_field('autoria'); if($autoria){ ?>
								<p>de <?= $autoria ?></p>
							<?php } ?>

							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="leiaMais">Leia Mais</a>
						</div>
					</article>


				<?php endwhile; endif;

				echo '<article class="noticia fake"></article>';

				wp_reset_query();

				echo '</div>';


			endforeach;

			echo '</div>';

		else: ?>

			<div id="noticias-section" class="row flexbox">

				<?php

				$filmes = new WP_Query(array(
					'post_type' => 'filme',
					'orderby' 	=> 'title',
					'order' 	=> 'ASC',
					'tax_query' => array(
						'relation' => 'AND',
						array(
							'taxonomy' 	=> 'sessao',
							'field' 	=> 'term_id',
							'terms' 	=> $thisID
						),
						array(
							'taxonomy'	=> 'edicao',
							'field' 	=> 'slug',
							'terms' 	=> $editioslug,
						),
					),
				));

				if ($filmes->have_posts()) : while ($filmes->have_posts()) : $filmes->the_post(); ?>

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

		<?php endif; ?>

		</div>

	</div>
</main>

<?php get_template_part( 'template-parts/carousel-edicoes' ); ?>

<?php get_footer(); ?>

</body>

</html><!-- This is the end. Beautiful friend.  -->