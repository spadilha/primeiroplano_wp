<?php get_header(); ?>


<?php $banners = get_field('banners_home', 'options'); ?>

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


<?php get_template_part( 'template-parts/nav-submenu' ); ?>


<?php

// SEÇÃO NOTÍCIAS

$noticias = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 3));

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

			</div>
		</div>

	</section>

<?php endif; ?>


<?php get_template_part( 'template-parts/carousel-edicoes' ); ?>


<?php get_footer(); ?>


<script type="text/javascript">

jQuery(function($){

    $('.banners-container').on('init', function(slick){
    	$('#banners').addClass('active');
	});

	$('.banners-container').slick({
		autoplay: true,
		pauseOnHover: true,
        dots: true,
        arrows: false,
		adaptiveHeight: false,
        speed: 700,
        slidesToShow: 1,
        touchThreshold: 20,
        slidesToScroll: 1,
    });

});

</script>



</body>

</html><!-- This is the end. Beautiful friend.  -->