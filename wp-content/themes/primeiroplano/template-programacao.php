<?php
/*
Template Name: Programação
*/
?>


<?php get_header(); ?>


<main id="corpo" class="row single-content">
	<div class="wrapper" id="programacao">
		<h1><?php the_title(); ?></h1>

		<?php the_content(); ?>
	</div>
</main>

<?php get_template_part( 'template-parts/carousel-edicoes' ); ?>

<?php get_footer(); ?>

</body>

</html><!-- This is the end. Beautiful friend.  -->