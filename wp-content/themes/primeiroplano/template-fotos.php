<?php
/*
Template Name: Fotos
*/
?>

<?php get_header(); ?>

<main id="corpo" class="row">

	<div class="wrapper">

		<h1><?php the_title(); ?></h1>


		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


			<?php $galeria = get_field('fotos'); if($galeria){ ?>

			<div  class="row flexbox">

				<?php foreach ($galeria as $image) { ?>

					<div class="foto">
						<img class="slideImage" src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['caption']; ?>" data-width="<?php echo $image['width']; ?>" data-height="<?php echo $image['height']; ?>" />

						<?php if($image['caption']){ ?>
							<div class="fotoInfo">
								<p><?php echo $image['caption']; ?></p>
							</div>
						<?php } ?>

					</div>

				<?php } ?>

			</div>

			<?php } ?>

		<?php endwhile; endif; ?>

	</div>
</main>

<?php get_footer(); ?>

</body>

</html><!-- This is the end. Beautiful friend.  -->