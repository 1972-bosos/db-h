<div id="andocken" class="registration">
    <div class="container container--registration">
        <div class="row justify-content-between">
            <div class="col-xl-7 section">
                <h2 class="section-title">Das nächste Netzwerktreffen</h2>
                <h3 class="section-text">
                    <?php
                        $manual_date = date("d.m.Y", strtotime(get_option( "vsd_meetems_manual_date" )));
                        $monat = array(
                            1  => "Januar",
                            2  => "Februar",
                            3  => "März",
                            4  => "April",
                            5  => "Mai",
                            6  => "Juni",
                            7  => "Juli",
                            8  => "August",
                            9  => "September",
                            10 => "Oktober",
                            11 => "November",
                            12 => "Dezember"
                        );
                        $day = date('j', strtotime($manual_date));
                        $month = date('n', strtotime($manual_date));
                        $year = date('Y', strtotime($manual_date));
                        $manual_date_german = ($day . '. ' . $monat[$month] . ' ' . $year);
                        if ( get_option( "vsd_meetems_manual_date" ) ) {
                            echo $manual_date_german;
                        } else {
                            echo do_shortcode( '[meeting_auto_date display="next_meeting_date"]' );
                        }
                    ?>
                    &nbsp;um&nbsp;<?php echo get_option( "vsd_meetems_start_time" ); ?>&nbsp;Uhr</h3>
                <?php echo do_shortcode( '[registration_form]' ); ?>
            </div>
            <div class="col-xxl-4 col-xl-5 address">
                <?php if ( get_option("vsd_place_name") || get_option("vsd_mail") ) : ?>
                    <div class="address__window">
                        <address>
                            <?php if ( get_option("vsd_place_name") ) : ?>
                                <p class="place-name"><?php echo get_option("vsd_place_name"); ?></p>
                            <?php endif; ?> 
                            <?php if ( get_option("vsd_street_name") && get_option("vsd_street_number") ) : ?>
                                <p class="street-number"><?php echo get_option("vsd_street_name"); ?>&nbsp;<?php echo get_option("vsd_street_number"); ?></p>
                            <?php endif; ?>
                            <?php if ( get_option("vsd_code") && get_option("vsd_place") ) : ?> 
                                <p class="post-code-place"><?php echo get_option("vsd_code"); ?>&nbsp;<?php echo get_option("vsd_place"); ?></p>
                            <?php endif; ?> 
                        </address>
                        <?php if ( get_option("vsd_mail") ) : ?>
                            <a href="mailto:<?php echo get_option("vsd_mail"); ?>" class="e-mail" target="_blank"><?php echo get_option("vsd_mail"); ?></a>
                        <?php endif; ?> 
                        <?php if ( get_option("vsd_street_name") && get_option("vsd_street_number") && get_option("vsd_code") && get_option("vsd_place") ) : ?>
                            <div class="link-to-map">
                                <a href="https://www.google.de/maps/search/<?php echo get_option("vsd_street_name"); ?>+<?php echo get_option("vsd_street_number"); ?>++<?php echo get_option("vsd_code"); ?>+<?php echo get_option("vsd_place"); ?>" target="_blank">Route anzeigen</a>
                            </div>
                        <?php endif; ?> 
                    </div>
                    <?php if ( get_option("vsd_contact_person") ) : ?>
                        <div class="contact-person">
                            <div class="contact-person__icon"></div>
                            <div class="contact-person__text">
                                <p class="contact-person__text contact-person__text--title">Ansprechpartner/in</p>
                                <a href="<?php echo get_home_url(); ?>/mitglied/<?php echo get_option("vsd_contact_person_profile"); ?>" class="contact-person__text contact-person__text--link"><?php echo get_option("vsd_contact_person"); ?></a>
                                <p class="contact-person__text contact-person__text--bottom"><?php bloginfo('name'); ?></p>
                            </div>
                            <?php if ( get_option("vsd_contact_person_photo") ) : ?>
                                <div class="contact-person__photo"><img src="<?php echo get_option("vsd_contact_person_photo"); ?>" alt="<?php echo get_option("vsd_contact_person"); ?>"></div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="registration__bottom-stripe" style="background-image: url('<?php echo get_home_url(); ?>/wp-content/uploads/2023/02/logo_stripe.webp');"></div>
</div>