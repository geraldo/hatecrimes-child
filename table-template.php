<?php
/**
	Template Name: Table
 */

get_header();?>

		<section id="container">

			<table cellpadding="0" cellspacing="0" border="0" class="display" id="crims">
				<thead>
					<tr>
						<th><?php _e("Name", "hatecrimes"); ?></th>
						<th><?php _e("Date", "hatecrimes"); ?></th>
						<th><?php _e("Type", "hatecrimes"); ?></th>
						<th><?php _e("City", "hatecrimes"); ?></th>
						<th><?php _e("Province", "hatecrimes"); ?></th>
						<th><?php _e("Sentence", "hatecrimes"); ?></th>
						<th><?php _e("Delict", "hatecrimes"); ?></th>
						<!--<th>Latitude</th>
						<th>Longitude</th>
						<th>Edad del agresor</th>-->
					</tr>
				</thead>
				<tbody></tbody>
			</table>

			<!--<script src="http://crimenesdeodio.info/wp-content/plugins/hatecrimes-table/table.js"></script>-->

		</section><!-- #container -->

<?php get_footer(); ?>