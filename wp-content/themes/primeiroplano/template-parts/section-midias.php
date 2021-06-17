<section id="midias" class="row">
	<div class="wrapper">

		<div id="boxFotos">


			<h2>FOTOS</h2>

			<?php $galeria = get_field('midias_fotos', 'options'); if($galeria){ ?>

			<div id="galWrapper">

				<?php foreach ($galeria as $image) { ?>

					<div class="slide">
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

		</div>


		<?php $video = get_field('midias_video', 'options'); if($video){ ?>

		<div id="boxVideo">

			<h2>Vídeo</h2>

			<div class="row fitvidz">
				<?= $video ?>
			</div>

		</div>

		<?php } ?>

	</div>
</section>



<script type="text/javascript">

jQuery(function($){


	$('#galWrapper').on('init', function(slick){
    	$('#multimidia').addClass('visible');
	});

    $('#galWrapper').slick({
    	autoplay:true,
    	adaptiveHeight: false,
		arrows: false,
        speed: 400,
        slidesToShow: 1,
        touchThreshold: 20,
        slidesToScroll: 1,
        dots: true,
        responsive: [
            {
                breakpoint: 1230,
                settings: {
                    adaptiveHeight: true,
                }
            }
        ]
    });

});

</script>