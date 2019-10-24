<?php
/**
	Template Name: CSV Data
*/

if (isset($_GET['t']) && 
	($_GET['t'] == 'tipo' ||
	$_GET['t'] == 'provincia' ||
	$_GET['t'] == 'any' ||
	$_GET['t'] == 'sentencia' ||
	$_GET['t'] == 'delito')) {

	header('Content-Type: text; charset=utf-8');
	$fp = fopen('php://output', 'w');

	if ($_GET['t'] == 'tipo') {
		echo "tipo\tnum\r\n";

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
			echo $term->name . "\t" . $my_query->found_posts . "\r\n";
		}
	}
	else if ($_GET['t'] == 'provincia') {
		echo "name\tnum\r\n";

		$provinces = getProvinces();

		foreach ($provinces as $province) {
			$args = array(
				'post_type'    => 'hatecrime',
				'meta_key'     => 'province',
				'meta_value'   => $province,
			);
			$my_query = new WP_Query( $args );
			echo $province . "\t" . $my_query->found_posts . "\r\n";
		}
	}
	else if ($_GET['t'] == 'any') {
		echo "any\tnum\r\n";

		for ($i = 1991; $i < 2016; $i++) {
			$args = array(
				'post_type'    => 'hatecrime',
				'meta_key'     => 'date',
				'meta_value'   => $i,
				'meta_compare' => 'LIKE',
			);
			$my_query = new WP_Query( $args );
			echo $i . "\t" . $my_query->found_posts . "\r\n";
		}

		fclose($fp);
	}
	else if ($_GET['t'] == 'sentencia') {
		echo "sentencia\tnum\r\n";

		$terms = get_terms(array('sentence_type'));

		$num = 0;

		foreach ($terms as $term) {
			$args = array(
			    'post_type' => 'hatecrime',
				'tax_query' => array(
					array(
						'taxonomy' => 'sentence_type',
						'field'    => 'slug',
						'terms'    => $term->slug,
					),
				),
			);
			$my_query = new WP_Query($args);
			echo $term->name . "\t" . $my_query->found_posts . "\r\n";
			$num += $my_query->found_posts;
		}

		// get total
		$args = array(
		    'post_type' => 'hatecrime',
		);
		$my_query = new WP_Query($args);
		$num = $my_query->found_posts - $num;
		echo "Desconegut\t" . $num;
	}
	else if ($_GET['t'] == 'delito') {
		echo "delito\tnum\r\n";

		$terms = get_terms(array('delict'));

		$num = 0;

		foreach ($terms as $term) {
			$args = array(
			    'post_type' => 'hatecrime',
				'tax_query' => array(
					array(
						'taxonomy' => 'delict',
						'field'    => 'slug',
						'terms'    => $term->slug,
					),
				),
			);
			$my_query = new WP_Query($args);
			echo $term->name . "\t" . $my_query->found_posts . "\r\n";
			$num++;
		}
	}
}
else {
	echo '<p>Añade parámetro "t" con ?t=PARA donde PARA es uno de los siguientes:</p>';
	echo '<ul>';
	echo '<li>"tipo": por tipología</li>';
	echo '<li>"provincia": por ubicación (provincia)</li>';
	echo '<li>"any": por año del crimen</li>';
	echo '<li>"sentencia": por sentencia</li>';
	echo '<li>"delito": por delito</li>';
	echo '</ul>';
	echo 'ejemplo: <a href="https://crimenesdeodio.info/data?t=any">https://crimenesdeodio.info/data?t=any</a>';
}
?>