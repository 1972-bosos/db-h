<?php
/**
 * The header for our theme
 */
?>

<!doctype html>

<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<header id="masthead" class="site-header">
		<nav class="navbar navbar-expand-lg">
  			<div class="container">
				<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
    				<?php the_custom_logo(); ?>
				<?php else : ?>
					<a href="<?php echo get_home_url(); ?>"><?php bloginfo('name'); ?></a>
				<?php endif; ?>
    			<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
      				<span class="navbar-toggler-icon"></span>
    			</button>
    			<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      				<div class="offcanvas-header">
        				<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      				</div>
      				<div class="offcanvas-body">
						<?php
							if ( current_user_can('administrator') ) {
								wp_nav_menu( $args = array(
									'theme_location'	=> 'admin-menu',
									'container'			=>  false,
									'menu_class'		=> 'navbar-nav justify-content-end flex-grow-1',
									'items_wrap'        => '<ul class="%2$s">%3$s</ul>',
								) );
							} elseif ( current_user_can('contributor') ) {
								wp_nav_menu( $args = array(
									'theme_location'	=> 'member-menu',
									'container'			=>  false,
									'menu_class'		=> 'navbar-nav justify-content-end flex-grow-1',
									'items_wrap'        => '<ul class="%2$s">%3$s</ul>',
								) );
							} else {
								wp_nav_menu( $args = array(
									'theme_location'	=> 'main-menu',
									'container'			=>  false,
									'menu_class'		=> 'navbar-nav justify-content-end flex-grow-1',
									'items_wrap'        => '<ul class="%2$s">%3$s</ul>',
								) );
							}	
						?>
      				</div>
    			</div>
  			</div>
		</nav>
	</header>
