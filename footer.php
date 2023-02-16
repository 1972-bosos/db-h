<?php
/**
 * The template for displaying the footer
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class="row row--top">
				<div class="col-md-6 footer-logo">
					<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
    					<?php the_custom_logo(); ?>
					<?php else : ?>
						<a href="<?php echo get_home_url(); ?>"><?php bloginfo('name'); ?></a>
					<?php endif; ?>
				</div>
				<div class="col-sm-5 footer-small-logo">
					<?php $small_logo_url = get_theme_mod( 'second_logo' ); ?>
					<?php if ( $small_logo_url ) : ?>
						<a href="<?php echo get_home_url(); ?>" class="second-logo-link"><?php echo '<img src="' . $small_logo_url . '" alt = "Dock B Hamburg" class="second-logo">'; ?></a>
					<?php else : ?>
						<a href="<?php echo get_home_url(); ?>"><?php bloginfo('name'); ?></a>
					<?php endif; ?>
				</div>
				<div class="col-md-6 col-sm-7 footer-menu">
					<?php if ( get_option("vsd_xing") || get_option("vsd_linkedin") || get_option("vsd_facebook") || get_option("vsd_instagram") ) : ?>
						<div class="social-media-stripe">
							<?php if ( get_option("vsd_xing") ) : ?>
								<a href="<?php echo get_option("vsd_xing"); ?>" class="social-media__link social-media__link--xing" target="_blank"></a>
							<?php endif; ?>
							<?php if ( get_option("vsd_linkedin") ) : ?>
								<a href="<?php echo get_option("vsd_linkedin"); ?>" class="social-media__link social-media__link--linkedin" target="_blank"></a>
							<?php endif; ?>
							<?php if ( get_option("vsd_facebook") ) : ?>
								<a href="<?php echo get_option("vsd_facebook"); ?>" class="social-media__link social-media__link--facebook" target="_blank"></a>
							<?php endif; ?>
							<?php if ( get_option("vsd_instagram") ) : ?>
								<a href="<?php echo get_option("vsd_instagram"); ?>" class="social-media__link social-media__link--instagram" target="_blank"></a>
							<?php endif; ?>
						</div>
					<?php endif; ?>
					<?php
						wp_nav_menu( $args = array(
							'theme_location'	=> 'footer-menu',
							'container'			=>  false,
							'menu_class'		=> 'navbar-nav navbar-nav--footer',
							'items_wrap'        => '<ul class="%2$s">%3$s</ul>',
						) );
					?>
				</div>
			</div>
			<div class="row row--bottom">
				<div class="col-sm-7 copyright-info">
					<p><?php printf( esc_html__( '&copy; %1$s %2$s. Alle Rechte vorbehalten.', 'dock-b-hamburg' ), date_i18n( 'Y' ), get_bloginfo( 'name', 'display' ) ); ?></p>
				</div>
				<div class="col-sm-5 author-info">
					<p>Designed by <a href="https://vonsternberg.design/" target="_blank">vonsternberg.design</a></p>
				</div>
			</div>
		</div>
	</footer>
</div>
<div class="bottom-contact-section">
	<div class="section__area">
		<a href="https://www.google.de/maps/search/<?php echo get_option("vsd_street_name"); ?>+<?php echo get_option("vsd_street_number"); ?>++<?php echo get_option("vsd_code"); ?>+<?php echo get_option("vsd_place"); ?>" class="section__area__icon section__area__icon--place" target="_blank"></a>
		<div class="section__area__text">Standort</div>					
	</div>
	<div class="section__area">
		<?php if ( is_front_page() ) : ?>
			<a href="#andocken" class="section__area__icon section__area__icon--login"></a>
		<?php elseif ( is_page( 'andocken' ) ) : ?>
			<a href="#form" class="section__area__icon section__area__icon--login"></a>
		<?php else : ?>
			<a href="<?php echo get_home_url(); ?>/andocken/#form" class="section__area__icon section__area__icon--login"></a>
		<?php endif; ?>
		<div class="section__area__text">Anmelden</div>					
	</div>
	<div class="section__area">
		<a href="mailto:" class="section__area__icon section__area__icon--email" target="_blank"></a>
		<div class="section__area__text">E-Mail</div>					
	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>
