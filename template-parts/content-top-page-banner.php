<?php
/**
 * Top pages banners
 */
?>

<!-- the query -->
<?php
    $args = array(
		'post_type' => 'pages-top-banners',
    );
	$the_query = new WP_Query( $args );
?>

<?php $page_title = get_the_title($post); ?>
<?php if ( $the_query->have_posts() ) : ?>
	<div id="carouselControls" class="carousel slide carousel-fade" data-bs-ride="carousel">
  		<div class="carousel-inner">
			<!-- the loop -->
			<?php $loop = 1; $banner_counter = 0; while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<?php $pages_target = get_field('top_banner_on_page'); ?>
				<?php foreach( $pages_target as $page_target ) : ?>
					<?php if ( $page_title === get_the_title($page_target) ) : ?>
						<?php $banner_counter++ ?>
						<?php if ( $banner_counter > 1) : ?>
							<?php if ( $loop == 1 ) : ?>
								<?php if ( get_field('top_banner_type') == 'picture' ) : ?>
									<div class="carousel-item active" style="background-image: url(<?php the_field('top_banner_picture'); ?>)">
								<?php elseif ( get_field('top_banner_type') == 'video' ) : ?>
									<div class="carousel-item active">
										<video class="background-video" autoplay loop muted>
											<source src="<?php the_field('top_banner_video'); ?>" type="video/webm">
										</video>
								<?php endif; ?>
									<?php $top_banner_blackout = get_field('top_banner_blackout'); ?> 
									<?php if ( $top_banner_blackout && in_array('blackout', $top_banner_blackout) ) : ?> 
										<div class="blackout"></div>
									<?php endif; ?>
									<div class="banner-text-box">
										<div class="container container--on-banner">
											<h1 class="main-title"><?php bloginfo('name'); ?></h1>
											<?php if( get_field('top_banner_text') ): ?>
												<h2 class="top-banner-text"><?php the_field('top_banner_text'); ?></h2>
											<?php endif; ?>
											<?php $top_banner_register_button = get_field('top_banner_register_button'); ?>
											<?php if( $top_banner_register_button && in_array('show', $top_banner_register_button) ): ?>
												<?php if ( is_front_page() ) : ?>
													<a href="#andocken" class="button--register">Jetzt andocken!</a>
												<?php elseif ( is_page( 'andocken' ) ) : ?>
													<a href="#form" class="button--register">Jetzt andocken!</a>
												<?php else : ?>
													<a href="<?php echo get_home_url(); ?>/andocken/#form" class="button--register">Jetzt andocken!</a>
												<?php endif; ?>
											<?php endif; ?>
										</div>
									</div>
									<?php $top_banner_social_media_stripe = get_field('top_banner_social_media_stripe'); ?>
									<?php if( $top_banner_social_media_stripe && in_array('show', $top_banner_social_media_stripe) ): ?>
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
									<?php endif; ?>
								</div>
							<?php else : ?>
    							<?php if ( get_field('top_banner_type') == 'picture' ) : ?>
									<div class="carousel-item active" style="background-image: url(<?php the_field('top_banner_picture'); ?>)">
								<?php elseif ( get_field('top_banner_type') == 'video' ) : ?>
									<div class="carousel-item active">
										<video class="background-video" autoplay loop muted>
											<source src="<?php the_field('top_banner_video'); ?>" type="video/webm">
										</video>
								<?php endif; ?>
									<?php $top_banner_blackout = get_field('top_banner_blackout'); ?> 
									<?php if ( $top_banner_blackout && in_array('blackout', $top_banner_blackout) ) : ?> 
										<div class="blackout"></div>
									<?php endif; ?>
									<div class="banner-text-box">
										<div class="container container--on-banner">
											<h1 class="main-title"><?php bloginfo('name'); ?></h1>
											<?php if( get_field('top_banner_text') ): ?>
												<h2 class="top-banner-text"><?php the_field('top_banner_text'); ?></h2>
											<?php endif; ?>
											<?php $top_banner_register_button = get_field('top_banner_register_button'); ?>
											<?php if( $top_banner_register_button && in_array('show', $top_banner_register_button) ): ?>
												<?php if ( is_front_page() ) : ?>
													<a href="#andocken" class="button--register">Jetzt andocken!</a>
												<?php elseif ( is_page( 'andocken' ) ) : ?>
													<a href="#form" class="button--register">Jetzt andocken!</a>
												<?php else : ?>
													<a href="<?php echo get_home_url(); ?>/andocken/#form" class="button--register">Jetzt andocken!</a>
												<?php endif; ?>
											<?php endif; ?>
										</div>
									</div>
									<?php $top_banner_social_media_stripe = get_field('top_banner_social_media_stripe'); ?>
									<?php if( $top_banner_social_media_stripe && in_array('show', $top_banner_social_media_stripe) ): ?>
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
									<?php endif; ?>
								</div>
							<?php endif; ?>
						<?php else : ?>
							<?php if ( get_field('top_banner_type') == 'picture' ) : ?>
								<div class="carousel-item active" style="background-image: url(<?php the_field('top_banner_picture'); ?>)">
							<?php elseif ( get_field('top_banner_type') == 'video' ) : ?>
								<div class="carousel-item active">
									<video class="background-video" autoplay loop muted>
										<source src="<?php the_field('top_banner_video'); ?>" type="video/webm">
									</video>
							<?php endif; ?>
								<?php $top_banner_blackout = get_field('top_banner_blackout'); ?> 
								<?php if ( $top_banner_blackout && in_array('blackout', $top_banner_blackout) ) : ?> 
									<div class="blackout"></div>
								<?php endif; ?>
								<div class="banner-text-box">
									<div class="container container--on-banner">
										<h1 class="main-title"><?php bloginfo('name'); ?></h1>
										<?php if( get_field('top_banner_text') ): ?>
											<h2 class="top-banner-text"><?php the_field('top_banner_text'); ?></h2>
										<?php endif; ?>
										<?php $top_banner_register_button = get_field('top_banner_register_button'); ?>
										<?php if( $top_banner_register_button && in_array('show', $top_banner_register_button) ): ?>
											<?php if ( is_front_page() ) : ?>
												<a href="#andocken" class="button--register">Jetzt andocken!</a>
											<?php elseif ( is_page( 'andocken' ) ) : ?>
												<a href="#form" class="button--register">Jetzt andocken!</a>
											<?php else : ?>
												<a href="<?php echo get_home_url(); ?>/andocken/#form" class="button--register">Jetzt andocken!</a>
											<?php endif; ?>
										<?php endif; ?>
									</div>
								</div>
								<?php $top_banner_social_media_stripe = get_field('top_banner_social_media_stripe'); ?>
								<?php if( $top_banner_social_media_stripe && in_array('show', $top_banner_social_media_stripe) ): ?>
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
								<?php endif; ?>
							</div>
						<?php endif; ?>
					<?php endif; ?>
				<?php endforeach ?>
				<?php $loop++; ?>
			<?php endwhile; ?>
            <!-- end of the loop -->
  		</div>
		<?php if ( $banner_counter > 1) : ?>
  			<button class="carousel-control-prev" type="button" data-bs-target="#carouselControls" data-bs-slide="prev">
    			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
  			</button>
  			<button class="carousel-control-next" type="button" data-bs-target="#carouselControls" data-bs-slide="next">
    			<span class="carousel-control-next-icon" aria-hidden="true"></span>
  			</button>
		<?php endif; ?>
	</div>
	<?php wp_reset_postdata(); ?>
<?php endif; ?>