<?php

    global $current_user;
    
    wp_get_current_user();

    $logged_member = $current_user->display_name;

    $args = array(
		'post_type'     => 'group-meeting',
        'category_name' => 'active',
        'meta_query'    => array(
            array(
                'key'   => 'group_members',
            ),
        )
    );
	
    $the_query = new WP_Query( $args );

?>

<?php if ( is_user_logged_in() ) : ?>
    <?php if ( $the_query->have_posts() ) : ?>
        <!-- the loop -->
        <p id="gruppentreffen">Gruppentreffen am:</p>
        <?php $counter = 1; while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <div class="row">
                <div class="col-1 number"><?php echo $counter ?>.</div>
                <div class="col-3 date"><?php  echo $post->post_name; ?></div>
                <div class="col-3 button">
                    <?php 
                        $members = get_post_meta( get_the_ID(), 'group_members' );
                        foreach ( $members as $member ) {
                            if ( $member == $logged_member ) {
                                $post_id = get_the_ID(); ?>
                                <form method="POST" action="#gruppentreffen">
                                    <input type="submit" name="check-out-<?php echo $post_id; ?>" class="button" style="background-color: red" value="Abmelden"/>
                                </form>
                                <?php if(isset($_POST['check-out-' . $post_id])) {
                                    delete_post_meta( $post_id, 'group_members', $logged_member );
                                    echo "<meta http-equiv='refresh' content='0'>";
                                }
                            }
                            elseif ( !in_array($logged_member, $members) ) {
                                $post_id = get_the_ID(); ?>
                                <form method="POST" action="#gruppentreffen">
                                    <input type="submit" name="check-in-<?php echo $post_id; ?>" class="button" style="background-color: green" value="Anmelden" />
                                </form>
                                <?php if(isset($_POST['check-in-' . $post_id])) {
                                    add_post_meta( $post_id , 'group_members', $logged_member );
                                    echo "<meta http-equiv='refresh' content='0'>";
                                }
                                break;
                            }   
                        }
                    ?>
                </div>
            </div>
        <?php $counter++; endwhile; ?>
        <!-- end of the loop -->
	    <?php wp_reset_postdata(); ?>
    <?php endif; ?>
<?php else : ?>
    <?php wp_loginout(); ?>
<?php endif; ?>