<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Cryout Creations
 * @subpackage nirvana
 * @since nirvana 0.5
 */

get_header();?>

		<section id="container" class="<?php echo nirvana_get_layout_class(); ?>">
			<div id="content" role="main">
				<?php cryout_before_content_hook(); ?>
			
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1 class="entry-title">
						<?php 
							the_title(); 
							$date = strtotime(get_post_meta($post->ID, "date", true));

							//echo ".<br>".date( 'd \d\e F \d\e Y', $date);;
							setlocale(LC_TIME, "es");
							echo ".<br>".strftime("%e de %B de %Y", $date);

							echo ".<br>".get_post_meta($post->ID, "city", true); 
						?>
					</h1>
					<?php cryout_post_title_hook(); ?>

					<div id="tabs">
					<ul>
					<li><a href="#tabs-1"><?php _e("Register", "hatecrimes")?></a></li>
					<li><a href="#tabs-2"><?php _e("Sources", "hatecrimes")?></a></li>
					</ul>

					<div id="tabs-1">
						<div id="fitxa" class="entry-content">
							<p><strong><?php _e("Type", "hatecrimes")?>: </strong>
							<?php 
								$terms = get_the_terms($post->ID, "type");
								foreach ($terms as $i => $term) {
									if ($i > 0) echo ", ";
									echo $term->name;
								}
							?>
							</p>

							<!--<p><?php _e("Date", "hatecrimes")?>: 
							<?php echo get_post_meta($post->ID, "date", true); ?>
							</p>

							<p><strong><?php _e("Adress", "hatecrimes")?></strong>
							<p><?php _e("Street", "hatecrimes")?>: 
							<?php echo get_post_meta($post->ID, "street", true); ?>
							</p>
							<p><?php _e("Neighbourhood", "hatecrimes")?>: 
							<?php echo get_post_meta($post->ID, "neighbourhood", true); ?>
							</p>
							<p><?php _e("City", "hatecrimes")?>: 
							<?php echo get_post_meta($post->ID, "city", true); ?>
							</p>
							<p><?php _e("Province", "hatecrimes")?>: 
							<?php echo get_post_meta($post->ID, "province", true); ?>
							</p>

							<p><strong><?php _e("Location", "hatecrimes")?></strong>
							<p>latitude: 
							<?php echo get_post_meta($post->ID, "latitude", true); ?>
							</p>
							<p>longitude: 
							<?php echo get_post_meta($post->ID, "longitude", true); ?>
							</p>-->

							<p><strong><?php _e("Judicial body", "hatecrimes")?>: </strong>
							<?php 
								$out = get_post_meta($post->ID, "trial", true); 
								if ($out !== "") echo $out;
								else _e("unknown", "hatecrimes");
							?>
							</p>

							<p><strong><?php _e("Sentence", "hatecrimes")?>: </strong>
							<?php 
								$terms = get_the_terms($post->ID, "sentence_type");
								$out = "";
								foreach ($terms as $i => $term) {
									if ($i > 0) $out .= ", ";
									$out .= $term->name;
								}
								if ($out !== "") echo $out;
								else _e("unknown", "hatecrimes");
							?>
							</p>							
							<?php 
								$out = get_post_meta($post->ID, "sentence", true); 
								if ($out !== "") echo "<p>".$out."</p>";
							?>

							<p><strong><?php _e("Delict", "hatecrimes")?>: </strong>
							<?php 
								$terms = get_the_terms($post->ID, "delict");
								$out = "";
								foreach ($terms as $i => $term) {
									if ($i > 0) $out .= ", ";
									$out .= $term->name;
								}
								if ($out !== "") echo $out;
								else _e("unknown", "hatecrimes");
							?>
							</p>

							<div id="map-widget" style="width:280px; height:280px"></div>
						</div><!-- .entry-custom -->

						<div id="fitxa-description" class="entry-content">
							<?php the_content(); ?>
							<?php wp_link_pages( array( "before" => "<div class='page-link'><span>" . __( "Pages:", "nirvana" ), "after" => "</span></div>" ) ); ?>
						</div><!-- .entry-content -->
					</div>

					<div id="tabs-2">
						<div class="entry-content">
							<?php 
								$sources = explode("\n", trim(get_post_meta($post->ID, "sources", true)));
								if ($sources !== false && sizeOf($sources) > 0) {
									echo "<ul>";
									foreach ($sources as $src) {
										$src = trim($src);
										if ($src !== "") {
											echo "<li>";
											if (strpos($src, "|") != false) {
												$src = explode("|", $src);
												$name = trim($src[0]);
												$url = trim($src[1]);
												echo "<a target='_blank' href='".$url."'>".$name."</a>";
											} else if (substr( $src, 0, 4 ) === "http") {
												echo "<a target='_blank' href='".$src."'>".$src."</a>";
											} else {
												echo $src;
											}
											echo "</li>";
										}
									}
									echo "</ul>";
								}
								$attachments = get_posts( array(
						            'post_type' => 'attachment',
						            'posts_per_page' => -1,
						            'post_parent' => $post->ID,
						            'order' => 'ASC',
						            'exclude' => get_post_thumbnail_id()
						        ));
						        if ( $attachments ) {
									echo "<ul>";
						            foreach ($attachments as $attachment) {
						            	$class = "post-attachment mime-" . sanitize_title($attachment->post_mime_type);
						                $thumbimg = wp_get_attachment_link($attachment->ID, 'thumbnail');
						                echo '<li style="list-style-type:none;" class="' . $class . ' data-design-thumbnail">' . $thumbimg;
						            	echo "<p><a href='".$attachment->guid."'>".$attachment->post_title."</a></p></li>";
						            }
									echo "</ul></p>";
						        }
							?>

							</p>
						</div><!-- .entry-custom -->
					</div>

				</div><!-- #post-## -->

				<hr>

				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php previous_post_link( "%link", "<i class='icon-left-dir'></i> %title" ); ?></div>
					<div class="nav-next"><?php next_post_link( "%link", "%title <i class='icon-right-dir'></i>" ); ?></div>
				</div><!-- #nav-below -->

				<?php comments_template( "", true ); ?>

			<?php endwhile; // end of the loop. ?>

			<?php cryout_after_content_hook(); ?>
			</div><!-- #content -->
	<?php //get_sidebar("right"); //nirvana_get_sidebar(); ?>
		</section><!-- #container -->

<?php get_footer(); ?>

<link rel="stylesheet" href="<?php echo get_site_url(); ?>/wp-content/plugins/hatecrimes-map/lib/leaflet.css" />
<script src="<?php echo get_site_url(); ?>/wp-content/plugins/hatecrimes-map/lib/leaflet.js"></script>
<script>
	jQuery( "#tabs" ).tabs();

	var lon = '<?php echo get_post_meta($post->ID, "longitude", true); ?>';
	var lat = '<?php echo get_post_meta($post->ID, "latitude", true); ?>';

	if (isNumber(lat) && isNumber(lon)) {
		var map = L.map('map-widget').setView([lat,lon], 12);
		map.once('focus', function() { map.scrollWheelZoom.enable(); });

		L.tileLayer('https://{s}.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={token}', {
			maxZoom: 18,
			id: 'mapadelodi.f6e57a2f',
			token: 'pk.eyJ1IjoibWFwYWRlbG9kaSIsImEiOiI1M2ZkODMzYzJkYTcwMmU0MDA5YmQyNTMyYTEyOGJjNCJ9.Kr-J9A2klHClDqTlvR8fTA'
		}).addTo(this.map);

		var street = '<?php echo get_post_meta($post->ID, "street", true); ?>';
		var neighbourhood = '<?php echo get_post_meta($post->ID, "neighbourhood", true); ?>';
		var city = '<?php echo get_post_meta($post->ID, "city", true); ?>';
		var province = '<?php echo get_post_meta($post->ID, "province", true); ?>';

		var popupText = "<strong>Calle:</strong> "+street+"<br>";
		popupText += "<strong>Barrio:</strong> "+neighbourhood+"<br>";
		popupText += "<strong>Municipio:</strong> "+city+"<br>";
		popupText += "<strong>Provincia:</strong> "+province;

		var marker = L.circleMarker(new L.LatLng( lat, lon ), {
			radius: 8,
			color: "#ff0000",
			fillColor: "#ff0000",
			weight: 1,
			opacity: 1,
			fillOpacity: 0.8
		});
		marker.bindPopup(popupText);
		map.addLayer(marker);
	}

	function isNumber(n) {
		return !isNaN(parseFloat(n)) && isFinite(n);
	}
</script>