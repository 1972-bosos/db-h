<!-- the query -->
<?php
    $args = array(
		'post_type'     => 'group-meeting',
        'category_name' => 'active',
        'orderby'       => 'title',
        'order'         => 'ASC'
    );
	$the_query = new WP_Query( $args );
?>

<?php if ( $the_query->have_posts() ) : ?>
    <div class="registration-form">
        <form method="POST" action="#andocken">
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
                                <?php if ( strtotime(get_post_field( 'post_name', get_post() )) > strtotime(date("Y-m-d")) ) : ?>
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
            <div class="row row__type-media">
                <div class="col-md-6">
                    <p>Ich werde teilnehmen: *</p>
                    <input type="radio" class="guest guest__type" name="guest_meeting_type" value="present" checked><span class="title-text">persönlich (20&euro;)</span><br>
                    <input type="radio" class="guest guest__type" name="guest_meeting_type" value="online"><span class="title-text">online</span>
                </div>
                <div class="col-md-6">
                    <p>Von Ihren Netzwerkertreffen habe ich durch erfahren:</p>
                    <input type="radio" class="guest guest__media" name="guest_media" value="xing"><span class="title-text">Xing</span><br>
                    <input type="radio" class="guest guest__media" name="guest_media" value="linkedin"><span class="title-text">LinkedIn</span><br>
                    <input type="radio" class="guest guest__media" name="guest_media" value="instagram"><span class="title-text">Instagram</span><br>
                    <input type="radio" class="guest guest__media" name="guest_media" value="facebook"><span class="title-text">Facebook</span><br>
                    <input type="radio" class="guest guest__media" name="guest_media" value="newsletter"><span class="title-text">Newsletter</span>
                </div>
            </div>
            <div class="acceptance">
                <input type="checkbox" class="accept" name="accept" value="accept"><span class="accept-text">Ich stimme zu, dass meine Daten für den weiteren Verlauf und die Bearbeitung meiner Anfrage gespeichert werden. Weitere Information finden Sie in unserer <a href="<?php echo get_home_url(); ?>/datenschutz" target="_blank">Datenschutzerklärung</a> *.</span>
            </div>
            <div class="register-button">
                <input type="submit" class="button" value="Anmelden"/>
            </div>
        </form>
    </div>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>

<?php
// Register guest
if ( $_POST ) {

    $selected_meeting_date = $_POST['selected_meeting_date'];
    $guest_slug_name = sanitize_user(str_replace(' ', '-', strtolower($_POST['guest_name'])));
    $guest_mail = ($_POST['guest_mail']);
    $guest_name = $_POST['guest_name'];
    $guest_meeting_type = $_POST['guest_meeting_type'];
    $guest_company = $_POST['guest_company'];
    $guest_phone = $_POST['guest_phone'];
    $guest_media = $_POST['guest_media'];
    $accept = $_POST['accept'];

    //Validation
    $error = array();
    if ( null == $selected_meeting_date ) {
        $error['date_empty'] = "Bitte wählen Sie einen Termin aus";
    }
    if ( null == $guest_slug_name ) {
        $error['name_empty'] = "Bitte geben Sie Ihren Namen ein.";
    }
    if ( username_exists($guest_slug_name) ) {
        $error['name_exists'] = "Dieser Name ist bereits registriert.";
    }
    if ( null == $guest_mail ) {
        $error['email_empty'] = "Bitte geben Sie ihre E-Mail-Adresse ein.";
    }
    if ( !is_email($guest_mail) ) {
        $error['email_invalid'] = "Diese Email-Adresse ist ist nicht gültig. ";
    }
    if ( email_exists($guest_mail) ) {
        $error['email_exists'] = "Diese Email-Adresse ist bereits registriert.";
    }
    if ( null == $accept ) {
        $error['accept_empty'] = "Bitte akzeptieren Sie unsere Datenschutzerklärung.";
    }

    if ( count($error) == 0 ) {

        $guest_data = array(
            'user_pass'  => NULL,
            'user_login' => $guest_slug_name,
            'user_email' => $guest_mail,
            'first_name' => $guest_name,
            'role'       => 'external_guest',
            'meta_input' => array(
                'meeting_date' => $selected_meeting_date,
                'meeting_type' => $guest_meeting_type,
                'company_name' => $guest_company,
                'phone'        => $guest_phone,
                'media'        => $guest_media,
                'guest_type'   => 'outside visitor',
                'invited_by'   => 'self'
            ),
        );

        $user_id = wp_insert_user($guest_data); 

        //E-mail confirmation for guest
        $to = $guest_mail;
        $subject = 'Anmeldebestätigung für das Gruppentreffen.';
        $body = '
    	    <html>
    			<head>
    				<title>Anmeldebestätigung für das Gruppentreffen.</title>
    			</head>
    			<body>
    				<div>
                        <p>Sehr geehrte(r) ' . $guest_name .',</p>
						<p>vielen Dank für Ihre Anmeldung zum Dock B Gruppentreffen, das am ' . $selected_meeting_date . ' um ' . get_option( "vsd_meetems_start_time") . ' Uhr stattfindet.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ac magna neque. In varius fermentum nunc eget bibendum. Quisque blandit.</p>
                        <a href="https://www.paypal.com/" target="_blank">Link zu PayPal</a>
                        <p> </p>
						<p>Mit freundlichen Grüßen</p>
                        <p>Dock B Hamburg Team</p>					
    				</div>
    			</body>
    			</html>
    		';
        $admin_email = get_option( 'admin_email' );
        $headers = array(
            "MIME-Version: 1.0",
            "Content-type: text/html; charset=utf-8",
            "From: Dock B Hamburg <{$admin_email}>",
            "Reply-To: {$admin_email}"
        );

        wp_mail( $to, $subject, $body, $headers ); ?>
        
        <div class="form-status-text form-status-text--success"><?php echo "Vielen Dank für die Anmeldung zum Gruppentreffen."; ?></div>
        <?php
        
        exit();
    
    } else { ?>
        <div class="form-status-text form-status-text--error"><?php echo "Alle erforderlichen Formularfelder (mit * gekennzeichnet) müssen korrekt ausgefüllt werden."; ?></div>
    
        <!-- <?php if ( $error['date_empty'] ) : ?>
            <div class="form-status-text form-status-text--error"><?php echo($error['date_empty']); ?></div>
        <?php endif ?> -->
        <!-- <?php if ( $error['name_empty'] ) : ?>
            <div class="form-status-text form-status-text--error"><?php echo($error['name_empty']); ?></div>
        <?php endif ?> -->
        <?php if ( $error['name_exists'] ) : ?>
            <div class="form-status-text form-status-text--error"><?php echo($error['name_exists']); ?></div>
        <?php endif ?>
        <!-- <?php if ( $error['email_empty'] ) : ?>
            <div class="form-status-text form-status-text--error"><?php echo($error['email_empty']); ?></div>
        <?php endif ?> -->
        <!-- <?php if ( $error['email_invalid'] ) : ?>
            <div class="form-status-text form-status-text--error"><?php echo($error['email_invalid']); ?></div>
        <?php endif ?> -->
        <?php if ( $error['email_exists'] ) : ?>
            <div class="form-status-text form-status-text--error"><?php echo($error['email_exists']); ?></div>
        <?php endif ?>
        <!-- <?php if ( $error['accept_empty'] ) : ?>
            <div class="form-status-text form-status-text--error"><?php echo($error['accept_empty']); ?></div>
        <?php endif ?> -->
    <?php }
}
?>