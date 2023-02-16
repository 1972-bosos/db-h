<!-- the query -->
<?php
    $args = array(
		'post_type' => 'group-meeting',
        'orderby'   => 'meta_value',
        'order'     => 'ASC'
    );
	$the_query = new WP_Query( $args );
?>
<?php if ( $the_query->have_posts() ) : ?>
    <!-- the loop -->
    <?php $counter = 1; while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <p><?php echo $counter ?>.&nbsp;<?php the_title() ?></p>
        <?php the_content() ?>
        <!-- <?php $users = get_field('meeting_participants');
            if( $users ): ?>
                <ol class="participants-list">
                    <?php foreach( $users as $user ): ?>
                        <li><?php echo $user->display_name; ?></li>
                    <?php endforeach; ?>  
                </ol>  
            <?php endif;
        ?> -->
    <?php $counter++; endwhile; ?>
    <!-- end of the loop -->
	<?php wp_reset_postdata(); ?>
<?php endif; ?>