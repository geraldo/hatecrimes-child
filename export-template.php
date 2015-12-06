<?php
/**
	Template Name: Export
*/
$lang =  qtranxf_getLanguage();
$url = "/home/crimenesea/www/wp-content/export/hatecrimes.".$lang.".js";
//$foutput = (file_exists($url)) ? fopen($url, "w") : fopen($url, "w+");
$foutput = fopen($url, "w");
//total amount: wp_count_posts('entitats')->publish = 711
//fwrite($foutput, "var hatecrimes =");
writeJS($foutput, 1000, 0, $url);
//stop to write geojson file
fclose($foutput);

function writeJS($foutput, $num, $offset, $url) {

	$my_query = new WP_Query('post_type=hatecrime&posts_per_page='.$num.'&offset='.$offset.'&order=ASC&orderby=ID');

	if ( have_posts() ) {

		global $post;
		$n = $offset+1;

		$features = array(
			'features' => array(),
			'type' => 'FeatureCollection'
		);

		while ($my_query->have_posts()) {

			$my_query->the_post();

			$terms = get_the_terms($post->ID, 'type');
			$cats = "";
			$catSlugs = "";
			foreach ($terms as $i => $term) {
				//implode categories
				if ($i > 0) {
					$cats .= ", ";
					$catSlugs .= ", ";
				}
				$cats .= $term->name;
				$catSlugs .= $term->slug;
			}

			$sentence = get_the_terms($post->ID, 'sentence_type');
			if ($sentence && sizeof($sentence) == 1) $sentence = $sentence[0]->name;
			else $sentence = __("unknown", "hatecrimes");

			$delict = get_the_terms($post->ID, 'delict');
			if ($delict && sizeof($delict) == 1) $delict = $delict[0]->name;
			else $delict = __("unknown", "hatecrimes");

			$features['features'][] = array(
				'properties' => array(
					'id' => $post->ID,
					'title' => get_the_title(),
					'description' => get_the_content(),
					'category' => $cats,
					'catSlug' => $catSlugs,
					'date' => get_post_meta(get_the_ID(), 'date', true),
					//'street' => get_post_meta(get_the_ID(), 'street', true),
					//'neighbourhood' => get_post_meta(get_the_ID(), 'neighbourhood', true),
					'city' => get_post_meta(get_the_ID(), 'city', true),
					'province' => get_post_meta(get_the_ID(), 'province', true),
					//'trial' => get_post_meta(get_the_ID(), 'trial', true),
					'sentence' => $sentence,
					'delict' => $delict,
					//'age' => get_post_meta(get_the_ID(), 'age', true),
					//'sources' => get_post_meta(get_the_ID(), 'sources', true),
				),
				'type' => 'Feature',
				'geometry' => array(
					'type' => 'Point',
					'coordinates' => array(
						(float)get_post_meta(get_the_ID(), 'longitude', true),
						(float)get_post_meta(get_the_ID(), 'latitude', true)
					)
				)
			);

			$n++;
		}

		fwrite($foutput, json_encode($features));

		$n--;
		echo $n." datasets written to json file ".$url;
	}
}
?>
