<?php
/**
	Template Name: Table
 */

get_header();?>

		<section id="container">

			<table cellpadding="0" cellspacing="0" border="0" class="display" id="crims">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Fecha</th>
						<th>Tipologia</th>
						<th>Ciudad</th>
						<th>Provincia</th>
						<!--<th>Latitude</th>
						<th>Longitude</th>
						<th>Sentencia</th>
						<th>Cualificación legal</th>
						<th>Edad del agresor</th>-->
					</tr>
				</thead>
				<tbody></tbody>
			</table>

			<script src="http://crimenesdeodio.info/wp-content/plugins/hatecrimes-table/table.js"></script>

		</section><!-- #container -->

<?php get_footer(); ?>