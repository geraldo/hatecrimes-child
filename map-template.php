<?php
/**
	Template Name: Map
 */

get_header();?>

		<section id="container">


			    <div id="contentfilter">
			      <div class="limiter">
					<br>
			        <div id="divfilter">
			          	<form id="filter">
						</form>
			        </div>

			      </div>
			    </div>

				<div id="map">
					<!-- Start mapbox watermark -->
					<a href="http://mapbox.com/" class='mapbox-maplogo' target="_blank">MapBox</a>
					<!-- End mapbox watermark -->
				</div>

				<div id="map2"></div>

				<script src="http://crimenesdeodio.info/wp-content/plugins/hatecrimes-map/lib/leaflet.js"></script>
				<script src="http://crimenesdeodio.info/wp-content/plugins/hatecrimes-map/lib/leaflet.markercluster.js"></script>
				<script src="http://crimenesdeodio.info/wp-content/plugins/hatecrimes-map/lib/date.format.js"></script>
				<script src="http://crimenesdeodio.info/wp-content/plugins/hatecrimes-map/map.js"></script>

		</section><!-- #container -->

<?php get_footer(); ?>