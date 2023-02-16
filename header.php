<?php
/**
 * The header for theme
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
		<nav class="navbar navbar-expand-xl">
  			<div class="container">
				<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
    				<?php the_custom_logo(); ?>
				<?php else : ?>
					<a href="<?php echo get_home_url(); ?>"><?php bloginfo('name'); ?></a>
				<?php endif; ?>
				<?php $small_logo_url = get_theme_mod( 'second_logo' ); ?>
				<?php if ( $small_logo_url ) : ?>
					<a href="<?php echo get_home_url(); ?>" class="second-logo-link"><?php echo '<img src="' . $small_logo_url . '" alt = "Dock B Hamburg" class="second-logo">'; ?></a>
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
									'menu_class'		=> 'navbar-nav navbar-nav--header',
									'items_wrap'        => '<ul class="%2$s">%3$s</ul>',
								) );
							} elseif ( current_user_can('contributor') ) {
								wp_nav_menu( $args = array(
									'theme_location'	=> 'member-menu',
									'container'			=>  false,
									'menu_class'		=> 'navbar-nav navbar-nav--header',
									'items_wrap'        => '<ul class="%2$s">%3$s</ul>',
								) );
							} else {
								wp_nav_menu( $args = array(
									'theme_location'	=> 'main-menu',
									'container'			=>  false,
									'menu_class'		=> 'navbar-nav navbar-nav--header',
									'items_wrap'        => '<ul class="%2$s">%3$s</ul>',
								) );
							}	
						?>
      				</div>
    			</div>
				<div class="small-logo">
					<img src="<?php echo get_home_url(); ?>/wp-content/uploads/2023/02/logo_icon.webp" alt="Dock B Hamburg">
				</div>
  			</div>
		</nav>
	</header>
