<aside class="barra-lateral">

<?php

// ULTIMAS NOTÍCIAS
$ultimas = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 4, 'posts_not_in' => $post->ID));

if ($ultimas->have_posts()) : ?>

	<div class="ultimas-noticias row">

		<h3>Últimas notícias</h3>

		<div class="row flexbox">

		<?php while ($ultimas->have_posts()) : $ultimas->the_post(); ?>

			<article class="noticia">

				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="bg-image">
				<?php if( has_post_thumbnail() ){ the_post_thumbnail('thumbnail'); } else { echo '<img src="'. get_template_directory_uri() . '/images/thumb_default.png" alt="">'; } ?></a>
				<div class="inner">
					<span class="data"><?php echo get_the_time('d.m.Y'); ?></span>
					<h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
				</div>
			</article>

		<?php endwhile; ?>

		</div>

	</div>

<?php endif; ?>

	<div class="inner-side">


		<nav class="nav-lateral row">
			<ul>
				<li class="item-lateral busca-lateral">
					<form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
						<input type="text" placeholder="<?php echo __('Buscar', 'spatheme'); ?>" name="s" id="s" class="searchField" />
						<input type="submit" id="searchsubmit" class="searchSubmit" value="" />
						<input type="hidden" name="post_type" value="post" />
					</form>
				</li>

				<li class="item-lateral arquivos-lateral">
					<button>Arquivos</button>
					<ul>
						<?php wp_get_archives('type=monthly'); ?>
					 </ul>
				</li>

				<li class="item-lateral categorias-lateral">
					<button>Categorias</button>

					<ul>
					    <?php wp_list_categories( array(
					        'orderby' => 'name',
					        'title_li' => ''
					    ) ); ?>
					</ul>
				</li>
			</ul>
		</nav>

<?php
	$sidedoar_titulo = get_field('doar_titulo', 'options');
	$sidedoar_texto = get_field('doar_texto', 'options');
	$sidedoar_btn_label = get_field('doar_btn_label', 'options');
	$sidedoar_btn_url = get_field('doar_btn_url', 'options');
?>

		<div class="quer-ajudar">
			<?php
			if($sidedoar_titulo){
				echo '<h3>' . $sidedoar_titulo . '</h3>';
			}
			if($sidedoar_texto){
				echo '<p>' . $sidedoar_texto . '</p>';
			}
		?>

		<?php if($sidedoar_btn_label && $sidedoar_btn_url){ ?>
			<a href="<?= $sidedoar_btn_url ?>" class="btn-doe"><?= $sidedoar_btn_label ?></a>
		<?php } ?>
		</div>
	</div>


</aside>


<script type="text/javascript">

jQuery(function($){

    $('.item-lateral > button').on('click', function(e){
    	$(this).toggleClass('opened');
    	$(this).next('ul').slideToggle(600);
	});

});

</script>

