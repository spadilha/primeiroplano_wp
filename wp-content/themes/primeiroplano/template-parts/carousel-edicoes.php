<?php global $thiseditionid, $lasteditionid; ?>


<!-- EDIÇÕES ANTERIORES -->
<section id="edicoes-anteriores" class="row">

    <div class="wrapper">


		<h2 class="section-title">Edições Anteriores</h2>

		<div class="row">

		    <div class="edicoes-wrapper">


		<?php

			$issues = get_terms( 'edicao', array(
				'order'		 => 'DESC',
				'orderby'    => 'slug',
				'hide_empty' => 0,
				'exclude'	 => array($thiseditionid),
			) );

			foreach ($issues as $cat) {

				$editionid = $cat->term_id;
				$editioslug = $cat->slug;

				$image = get_field('cartaz', 'edicao_' . $editionid);
		    	$ano = $cat->name;

		    	if($editionid == $lasteditionid){
					$link = SITEHOME;
				} else {
					$link = get_term_link( $editioslug, 'edicao' );
				}


			?>

			<div class="edicao">

		        <?php if($link){ ?><a href="<?= $link ?>" title="Festival Primeiro Plano - <?= $ano ?>"><?php } ?>

		            <?php if($image){ ?>
		                <img src="<?= $image ?>" alt="">
		            <?php } ?>

		            <?php if($ano){ ?>
		            	<h3><?= $ano ?></h3>
		        	<?php } ?>

		        <?php if($link){ ?></a><?php } ?>
			</div>

		<?php } ?>





		<?php


		    $edicoes = get_field('edicoes_anteriores', 'options');

		    foreach ($edicoes as $ed) {

		    	$image = $ed['sizes']['medium'];
		    	$ano = $ed['title'];
				$link = $ed['description'];
		?>

				<div class="edicao">

		        <?php if($link){ ?><a href="<?= $link ?>" title="Festival Primeiro Plano <?= $ano ?>" target="_blank" rel="noopener"><?php } ?>

		            <?php if($image){ ?>
		                <img src="<?= $image ?>" alt="">
		            <?php } ?>

		            <?php if($ano){ ?>
		            	<h3><?= $ano ?></h3>
		        	<?php } ?>

		        <?php if($link){ ?></a><?php } ?>
		        </div>

		<?php } ?>

		    </div>
		</div>

	</div>

</section>

<script type="text/javascript">

jQuery(function($){

    $('.edicoes-wrapper').on('init', function(slick){
        $('#edicoes-anteriores').addClass('active');
    });

    $('.edicoes-wrapper').slick({
        autoplay: false,
        pauseOnHover: false,
        infinite: false,
        dots: false,
        arrows: true,
        adaptiveHeight: false,
        speed: 700,
        slidesToShow: 6,
        touchThreshold: 20,
        slidesToScroll: 3,
        responsive: [
            {
                breakpoint: 1180,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            }
        ]
    });

});

</script>
<!-- FECHA EDIÇÕES ANTERIORES -->