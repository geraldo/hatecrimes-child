<?php
/**
	Template Name: Stats

    - Cualificación legal (PRIORITARI ABANS D'UNIFICAR CAMP)
    - Sentecia (PRIORITARI ABANS D'UNIFICAR CAMP)
    - Tipologia (categoria)
    - Ubicació (per provincies)
    - Any del crim
    - Edat de l'agressor (dades les passa el David)
*/

echo "<h1>Statistics - Crimenes de odio</h1>";

$args = array(
    'post_type' => 'hatecrime',
);
$my_query = new WP_Query($args);
echo "Total: <a href='http://crimenesdeodio.info/?post_type=hatecrime'>" . $my_query->found_posts . "</a>";

/********************/

echo "<h2>por tipología</h2>";

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
	echo $term->name . ": <a href='http://crimenesdeodio.info/type/" . $term->slug . "'>" . $my_query->found_posts . "</a><br>";
}

/********************/

echo "<h2>por ubicación (provincia)</h2>";

$provinces = getProvinces();

foreach ($provinces as $province) {
	$args = array(
		'post_type'    => 'hatecrime',
		'meta_key'     => 'province',
		'meta_value'   => $province,
	);
	$my_query = new WP_Query( $args );
	echo $province . ": " . $my_query->found_posts . "<br>";
}

/********************/

echo "<h2>por año del crimen</h2>";

for ($i = 1991; $i < 2016; $i++) {
	$args = array(
		'post_type'    => 'hatecrime',
		'meta_key'     => 'date',
		'meta_value'   => $i,
		'meta_compare' => 'LIKE',
	);
	$my_query = new WP_Query( $args );
	echo $i . ": " . $my_query->found_posts . "<br>";

}

/********************/

echo "<h2>por sentencia</h2>";

$sentences = array(
	'NO', 'absuelto', 'archivado', 'condenado', 'prisión', 'carcel', 'arresto', 'internamiento', 'NO HAY IMPUTADOS',
);

foreach ($sentences as $sentence) {
	$args = array(
		'post_type'    => 'hatecrime',
		'meta_key'     => 'sentence',
		'meta_value'   => $sentence,
		'meta_compare' => 'LIKE',
	);
	$my_query = new WP_Query( $args );
	echo $sentence . ": " . $my_query->found_posts . "<br>";
}

//desconocido
echo "desconocido: " . getUnknown('sentence') . "<br>";

/********************/

echo "<h2>por cualificación legal</h2>";

$legals = array(
	'NO', 'asesinato', 'homicidio', 'archivado', 'Riña tumultuaria',
);

foreach ($legals as $legal) {
	$args = array(
		'post_type'    => 'hatecrime',
		'meta_key'     => 'legal',
		'meta_value'   => $legal,
		'meta_compare' => 'LIKE',
	);
	$my_query = new WP_Query( $args );
	echo $legal . ": " . $my_query->found_posts . "<br>";
}

echo "desconocido: " . getUnknown('legal') . "<br>";

/********************/

echo "<h2>por edad del agresor</h2>";

$args = array(
	'post_type'    => 'hatecrime',
	'meta_key'     => 'age',
	'meta_value'   => 20,
	'meta_type'    => 'numeric',
	'meta_compare' => '<',
);
$my_query = new WP_Query( $args );
echo "<20: " . $my_query->found_posts . "<br>";

$args = array(
	'post_type'    => 'hatecrime',
	'meta_key'     => 'age',
	'meta_value'   => array(20,29),
	'meta_type'    => 'numeric',
	'meta_compare' => 'BETWEEN',
);
$my_query = new WP_Query( $args );
echo "20-29: " . $my_query->found_posts . "<br>";

$args = array(
	'post_type'    => 'hatecrime',
	'meta_key'     => 'age',
	'meta_value'   => 30,
	'meta_type'    => 'numeric',
	'meta_compare' => '>=',
);
$my_query = new WP_Query( $args );
echo ">=30: " . $my_query->found_posts . "<br>";

echo "desconocido: " . getUnknown('age') . "<br>";

/********************/

function getUnknown($field) {
	$args = array(
		'post_type'    => 'hatecrime',
		'meta_key'     => $field,
		'meta_value'   => array(''),
		'meta_compare' => '=',
	);
	$my_query = new WP_Query( $args );
	return $my_query->found_posts;
}

?>