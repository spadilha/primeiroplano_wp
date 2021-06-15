<?php
/*
Template Name: Sessões
*/
?>


<?php get_header(); ?>

<main id="corpo" class="row">

	<div class="wrapper">

		<h1><?php the_title(); ?></h1>


		<div id="list" class="row">

		<?php

			$sessoes = get_terms( array(
			    'taxonomy' => 'sessao',
			    'parent' => 0,
			));

			foreach($sessoes as $sessao) :


				$termSlug = $sessao->slug;
				$term_id = $sessao->term_id;

				$termLink = get_term_link( $termSlug, 'sessao' );

				echo '<h2><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="26px" height="26.5px" viewBox="0 0 26 26.5" style="overflow:visible;enable-background:new 0 0 26 26.5;" xml:space="preserve"><polygon class="st0" points="0,26.5 26,13.3 0,0" fill="#221F1F"/></svg> <a href="' . $termLink . '">' . $sessao->name . '</a></h2>';
			endforeach;
		?>



		</div>

	</div>
</main>

<?php get_footer(); ?>

</body>

</html><!-- This is the end. Beautiful friend.  -->





