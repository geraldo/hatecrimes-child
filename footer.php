<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package Cryout Creations
 * @subpackage nirvana
 * @since nirvana 0.5
 */
?>	<div style="clear:both;"></div>
	</div> <!-- #forbottom -->


	<footer id="footer" role="contentinfo">
		<div id="colophon">
		
			<?php get_sidebar( 'footer' );?>
			
		</div><!-- #colophon -->

		<div id="footer2">
			<div id="footer2-inside">
				<br><a href="https://creativecommons.org/licenses/by-sa/3.0/deed.ca"><img src="http://barrisinnovacio.net/wp-content/uploads/2015/05/cc-by-sa.png" style="width:100px"></a>
			</div> <!-- #footer2-inside -->
		</div><!-- #footer2 -->

	</footer><!-- #footer -->

	</div><!-- #main -->
</div><!-- #wrapper -->


<?php	wp_footer(); ?>

</body>
</html>
