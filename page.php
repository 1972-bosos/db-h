<?php
/**
 * The template for displaying all pages
 */

get_header(); ?>

	<main id="primary" class="site-main">

		<?php get_template_part( 'template-parts/content', 'top-page-banner' ); ?>
		
		<?php while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', 'page' );
		endwhile; ?>

	</main>

<?php get_footer();