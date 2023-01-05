<?php
/**
 * The template for displaying the footer
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class="row">
				<div class="col-6 site-info">
					<p><?php printf( esc_html__( '&copy; %1$s %2$s. Alle Rechte vorbehalten.', 'dock-b-hamburg' ), date_i18n( 'Y' ), get_bloginfo( 'name', 'display' ) ); ?></p>
				</div>
				<div class="col-6 footer-menu">
					<?php
						wp_nav_menu( $args = array(
							'theme_location'	=> 'footer-menu',
							'container'			=>  false,
							'menu_class'		=> 'nav justify-content-end flex-grow-1',
							'items_wrap'        => '<ul class="%2$s">%3$s</ul>',
						) );
					?>
				</div>
			</div>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
