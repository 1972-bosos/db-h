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
    <div class="registration-form">
        <form method="POST">
            <div class="accordion accordion-flush" id="accordionFlush">
                <div class="accordion-item">
                    <p class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">für
                            <?php   
                                $tag = array(
                                    "Sonntag",
                                    "Montag",
                                    "Dienstag",
                                    "Mittwoch",
                                    "Donnerstag",
                                    "Freitag",
                                    "Samstag"
                                );
                                $week_day_german = (date("w", strtotime(get_option( "vsd_meetems_week_day" ))));
                                echo $tag[$week_day_german];
                            ?>,
                        den: *</button>
                    </p>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlush">
                        <div class="accordion-body">
                            <!-- the loop -->
                            <?php $meetings_counter = 1; while ( $the_query->have_posts() && $meetings_counter <=4 ) : $the_query->the_post(); ?>
                                <?php if ( strtotime(get_post_field( 'post_name', get_post() )) > strtotime(date("Y.m.d")) ) : ?>
                                    <input type="radio" class="selected-meeting-date" name="selected_meeting_date" value="<?php echo get_post_field( 'post_name', get_post() ); ?>"><span class="date-text"><?php echo get_post_field( 'post_name', get_post() ); ?></span><br>
                                <?php endif ?> 
                            <?php $meetings_counter++; endwhile; ?>
                            <!-- end of the loop -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row__name-company">
                <div class="col-md-6"><input type="text" class="guest guest__name" name="guest_name" placeholder="Name *"></div>
                <div class="col-md-6"><input type="text" class="guest guest__company" name="guest_company" placeholder="Firmenname"></div>
            </div>
            <div class="row row__mail-phone">
                <div class="col-md-6"><input type="text" class="guest guest__mail" name="guest_mail" placeholder="E-Mail *"></div>
                <div class="col-md-6"><input type="text" class="guest guest__phone" name="guest_phone" placeholder="Telefon"></div>
            </div>
            <div class="acceptance">
                <input type="checkbox" class="accept" name="accept" value="accept"><span class="accept-text">Ich stimme zu, dass meine Daten für den weiteren Verlauf und die Bearbeitung meiner Anfrage gespeichert werden. Weitere Information finden Sie in unserer <a href="<?php echo get_home_url(); ?>/datenschutz" target="_blank">Datenschutzerklärung</a>.</span>
            </div>
            <div class="register-button">
                <input type="submit" class="button" value="Anmelden"/>
            </div>
        </form>
    </div>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>