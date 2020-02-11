<?php
/**
 * Template Name: Landing
 *
 * @package Cryout Creations
 * @subpackage nirvana
 * @since nirvana 0.5
 */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php  cryout_meta_hook(); ?>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php
	 	cryout_header_hook();
		wp_head(); ?>
	<link rel="stylesheet" href="<?php echo get_site_url(); ?>/wp-content/themes/hatecrime-child/landing/landing.css" />
	<link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.min.css">
</head>
<body <?php body_class(); ?>>

<section id="container" class="front <?php echo nirvana_get_layout_class(); ?>">
	<div id="content" role="main">

		<section id="landing1" class="landing active">

			<div class="front-header">
				<?php
					if ( function_exists ( 'wpm_language_switcher' ) ) wpm_language_switcher ('list', 'name');
				?>

				<div class="right"><span class="logo"></span></div>
			</div>

			<!--<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>

			</div>
			<?php endwhile; // end of the loop. ?>-->

			<div class="center">

				<h1><img class="fronticon" src="https://crimenesdeodio.info/dev/wp-content/uploads/2020/01/icon.png" alt="" width="58" height="58" />crimenes de odio</h1>

				<p><strong>Crimen de Odio</strong>: <i>“toda infracción penal, incluidas las infracciones contra las personas y la propiedad, cuando la víctima, el lugar o el objeto de la infracción son seleccionados a causa de su conexión, relación, afiliación, apoyo o pertenencia real o supuesta a un grupo que pueda estar basado en la “raza”, origen nacional o étnico, el idioma, el color, la religión, la edad, la minusvalía física o mental, la orientación sexual u otros factores similares, ya sean reales o supuestos”</i>. <strong>OSCE (2003)</strong></p>

				<div class="front-slidedown"></div>

			</div>

			<div class="front-footer footer">
				<div class="left">
					<strong>memoria contra el <span class="strike1"><span class="strike2">olvido</span></span></strong>
				</div>
				<div class="right">
					<a class="icon" href="https://twitter.com/crimenesdeodio"><span class="twitter"></span></a><a class="icon" href="https://www.facebook.com/Cr%C3%ADmenes-de-Odio-1645711305670191/"><span class="facebook"></span></a>
				</div>
			</div>

		</section>

		<section id="landing2" class="landing">
			<div class="col_left">
				<h1>El proyecto</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<a href="/dev/casos/" class="landing-btn">Ves a casos</a>
			</div>

			<div class="col_right">
				<?php
					$args = array(
					    'post_type' => 'hatecrime',
					);
					$my_query = new WP_Query($args);
					$total = $my_query->found_posts;
					echo "<h1>" . $total . "</h1><h3>casos</h3>";

					$terms = get_terms(array('type'));

					foreach ($terms as $term) {
						$args = array(
						    'post_type' => 'hatecrime',
							'tax_query' => array(
								array(
									'taxonomy' => 'type',
									'field'    => 'slug',
									'terms'    => $term->slug,
								),
							),
						);
						$my_query = new WP_Query($args);
						echo "<div class='type " . $term->slug . "'>" . $term->name . " <span class='num'>" . $my_query->found_posts . "</span><span class='bar' style='width:" . ($my_query->found_posts*5+5) . "px'></span><img class='svgimg' src='" . get_template_directory_uri() . "-child/landing/marker-" . $term->slug . ".svg'/></div>";
					}
				?>
			</div>
		</section>

		<section id="landing3" class="landing">
			<div class="col_left">
				<h1>El mapa</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				<a href="/dev/" class="landing-btn">Visita el mapa dels crims d'odi</a>
			</div>

			<div class="col_right">
				<a href="/dev/"><img src="<?php echo get_template_directory_uri(); ?>-child/landing/map.png"/></a>
			</div>
		</section>

		<section id="landing4" class="landing">

			<div class="swiper-container">
			    <div class="swiper-wrapper">
			        <div class="swiper-slide">
			        	<div class="col_left">
				        	<h1>Crimenes de odio por año</h1>
				        	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				        </div>
						<div class="col_right">
							<div class="plotYear"></div>
						</div>
			        </div>
			        <div class="swiper-slide">
			        	<div class="col_left">
				        	<h1>Crimenes de odio por sentencia</h1>
				        	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				        </div>
						<div class="col_right">
							<div class="plotSentencia"></div>
						</div>
			        </div>
			        <div class="swiper-slide">
			        	<div class="col_left">
				        	<h1>Crimenes de odio por delito</h1>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				        </div>
						<div class="col_right">
							<div class="plotDelito"></div>
						</div>
			        </div>
			    </div>
			    <div class="swiper-pagination"></div>
			    <div class="swiper-button-prev-custom"></div>
			    <div class="swiper-button-next-custom"></div>
			</div>
		</section>

		<section id="landing5" class="landing">
			<h1>Tipologías</h1>

			<table class="tipo">
				<tr>

				<?php 
				
				$terms = get_terms( 'type' );
	                         
				if ( $terms && ! is_wp_error( $terms ) ) {
				 
				    $types = array();

				    $i = 1;
				 
				    foreach ( $terms as $term ) {

				    	if (($i-1)%4 == 0) echo "<tr>";
				        ?>

				        <td>
							<div class="clip"><img src="<?php if (function_exists('get_wp_term_image')) { echo get_wp_term_image($term->term_id); } ?>"/></div>
							<h3><span class="strike1"><span class="strike2"><?php echo $term->name; ?></span></span></h3>
							<p><?php echo $term->description; ?></p>
							<a href="/dev/<?php echo wpm_get_language(); ?>/casos/?type=<?php echo $term->name; ?>" class="landing-btn">Casos de <?php echo $term->name; ?></a>
						</td>

				        <?php

				    	if ($i%4 == 0) echo "</tr>";

				    	$i++;
				    }
				}

				?>
				</tr>

			</table>
			<div class="feminicidio">* Els crims d’odi per misogínia no estan incorporats en aquesta investigació perquè ja hi ha un registre d’aquest tipus de crims a la pàgina web <a target="_blank" href="https://feminicidio.net">www.feminicidio.net</a></div>			
		</section>

		<div class="footer">
			<div class="left">
				<span class="logo"></span><strong>crimenes de odio</strong>
			</div>
			<div class="right">
				<a class="icon" href="https://twitter.com/crimenesdeodio"><span class="twitter"></span></a><a class="icon" href="https://www.facebook.com/Cr%C3%ADmenes-de-Odio-1645711305670191/"><span class="facebook"></span></a>
			</div>
		</div>

	</div>
</section>

<?php wp_footer(); ?>

<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
<script src="https://unpkg.com/swiper/js/swiper.min.js"></script>
<script src="<?php echo get_site_url(); ?>/wp-content/themes/hatecrime-child/landing/landing.js"></script>

</body>
</html>
