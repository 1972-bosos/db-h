<?php
/**
 * Story in numbers
 */
?>

<!-- the query -->
<?php
    $args = array(
		'post_type'      => 'story-in-numbers',
        "posts_per_page" => 1
    );
	$the_query = new WP_Query( $args );
?>
<?php if ( $the_query->have_posts() ) : ?>
    <div class="story-in-numbers" style="background-image: url('<?php echo get_home_url(); ?>/wp-content/uploads/2023/02/logo_background.webp');">
        <!-- the loop -->
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <div class="container container--story-in-numbers">
                <h2 class="full-title"><?php the_title( ); ?></h2>
                <h2 class="short-title"><?php echo mb_strimwidth(get_the_title(), 0, 15); ?></h2>
                <?php if( get_field('data_name_01') && get_field('data_value_01') ): ?>
                    <div class="row">
                        <div class="col-sm-2 col-3">
                            <p class="counter-value" data-count="<?php the_field('data_value_01'); ?>">0</p>
                        </div>
                        <div class="col-sm-10 col-9">
                            <p class="counter-name"><?php the_field('data_name_01'); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if( get_field('data_name_02') && get_field('data_value_02') ): ?>
                    <div class="row">
                        <div class="col-sm-2 col-3">
                            <p class="counter-value" data-count="<?php the_field('data_value_02'); ?>">0</p>
                        </div>
                        <div class="col-sm-10 col-9">
                            <p class="counter-name"><?php the_field('data_name_02'); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if( get_field('data_name_03') && get_field('data_value_03') ): ?>
                    <div class="row">
                        <div class="col-sm-2 col-3">
                            <p class="counter-value" data-count="<?php the_field('data_value_03'); ?>">0</p>
                        </div>
                        <div class="col-sm-10 col-9">
                            <p class="counter-name"><?php the_field('data_name_03'); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if( get_field('data_name_04') && get_field('data_value_04') ): ?>
                    <div class="row">
                        <div class="col-sm-2 col-3">
                            <p class="counter-value" data-count="<?php the_field('data_value_04'); ?>">0</p>
                        </div>
                        <div class="col-sm-10 col-9">
                            <p class="counter-name"><?php the_field('data_name_04'); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
        <!-- end of the loop -->
    </div>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>