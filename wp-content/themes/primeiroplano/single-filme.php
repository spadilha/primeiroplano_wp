<?php get_header(); ?>

<main id="corpo" class="row single-content">
	<div class="wrapper">

		<h1><?php the_title(); ?></h1>

		<?php the_content(); ?>

		<?php
			if( has_post_thumbnail() ){
				the_post_thumbnail('large', $attr = array('class' => "thumb-image"));
			}
		?>

	</div>
</main>

<?php get_footer(); ?>

</body>

</html><!-- This is the end. Beautiful friend.  -->