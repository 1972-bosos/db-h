<?php

    global $current_user;

    wp_get_current_user();

    $logged_member = $current_user->display_name;

    $args = array(
		'post_type' => 'group-meeting',
        'orderby'   => 'meta_value',
        'order'     => 'ASC'
    );
	$the_query = new WP_Query( $args );

?>

<?php if ( $the_query->have_posts() ) : ?>
    <p id="einladung">Einladung / Vertretung</p>
    <div class="invitation-form">
        <form method="POST" action="#einladung">
            <div class="invitation-replacement">
                <input type="radio" class="guest guest__type" name="guest_type" value="visitor">&nbsp;Gast<br>
                <input type="radio" class="guest guest__type" name="guest_type" value="deputy">&nbsp;Vertreter
            </div>
            <div class="name">
                <input type="text" class="guest guest__name" name="guest_name" placeholder="Name *">
            </div>
            <div class="mail">
                <input type="text" class="guest guest__mail" name="guest_mail" placeholder="E-Mail *">
            </div>
            <div class="company">
                <input type="text" class="guest guest__company" name="guest_company" placeholder="Firmenname">
            </div>
            <div class="phone">
                <input type="text" class="guest guest__phone" name="guest_phone" placeholder="Telefon">
            </div>
            <div class="term">
                <p>Datum des Treffens: *</p>
                <!-- the loop -->
                <?php $meetings_counter = 1; while ( $the_query->have_posts() && $meetings_counter <=4 ) : $the_query->the_post(); ?>
                    <?php if ( strtotime(get_post_field( 'post_name', get_post() )) > strtotime(date("Y-m-d")) ) : ?>
                        <input type="radio" class="selected-meeting-date" name="selected_meeting_date" value="<?php echo get_post_field( 'post_name', get_post() ); ?>">&nbsp;<span class="date-text"><?php echo get_post_field( 'post_name', get_post() ); ?></span><br>
                    <?php endif ?> 
                <?php $meetings_counter++; endwhile; ?>
                <!-- end of the loop -->
            </div>
            <input type="hidden" name="invited_by" value="<?php echo $logged_member; ?>" />
            <div class="register-button">
                <input type="submit" class="button" value="Einladen"/>
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
    $guest_company = $_POST['guest_company'];
    $guest_phone = $_POST['guest_phone'];
    $guest_type = $_POST['guest_type'];
    $invited_by = $_POST['invited_by'];

    //Validation
    $error = array();
    if ( null == $selected_meeting_date ) {
        $error['date_empty'] = "Bitte wählen Sie einen Termin aus";
    }
    if ( null == $guest_slug_name ) {
        $error['name_empty'] = "Bitte geben Sie den Namen des Gastes ein.";
    }
    if ( username_exists($guest_slug_name) ) {
        $error['name_exists'] = "Dieser Name ist bereits registriert.";
    }
    if ( null == $guest_mail ) {
        $error['email_empty'] = "Bitte geben Sie die E-Mail Adresse des Gastes ein";
    }
    if ( !is_email($guest_mail) ) {
        $error['email_invalid'] = "Diese Email-Adresse ist ist nicht gültig. ";
    }
    if ( email_exists($guest_mail) ) {
        $error['email_exists'] = "Diese Email-Adresse ist bereits registriert.";
    }
    if ( null == $guest_type ) {
        $error['type_empty'] = "Bitte wählen Sie einen Einladungstyp aus";
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
                'company_name' => $guest_company,
                'phone'        => $guest_phone,
                'guest_type'   => $guest_type,
                'invited by'   => $invited_by
            ),
        );

        $user_id = wp_insert_user($guest_data); 

        //E-mail confirmation for guest
        $to = $guest_mail;
        $subject = 'Anmeldebestätigung für das Gruppentreffen.';
        if ( $guest_type == 'visitor') {
            $body = '
    	    <html>
    			<head>
    				<title>Anmeldebestätigung für das Gruppentreffen.</title>
    			</head>
    			<body>
    				<div>
                        <p>Sehr geehrte(r) ' . $guest_name .',</p>
						<p>Wir freuen uns, Ihnen mitteilen zu können, dass Sie von Frau/Herrn ' . $logged_member . ' zu einem Treffen der Dock B Gruppe eingeladen wurden, welches am ' . $selected_meeting_date . ' um ' . get_option( "vsd_meetems_start_time") . ' Uhr stattfinden wird.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ac magna neque. In varius fermentum nunc eget bibendum. Quisque blandit.</p>
                        <a href="https://www.paypal.com/" target="_blank">Link zu PayPal</a>
                        <p> </p>
						<p>Mit freundlichen Grüßen</p>
                        <p>Dock B Hamburg Team</p>					
    				</div>
    			</body>
    			</html>
    		';
        }
        if ( $guest_type == 'deputy') {
            $body = '
    	    <html>
    			<head>
    				<title>Anmeldebestätigung für das Gruppentreffen.</title>
    			</head>
    			<body>
    				<div>
                        <p>Sehr geehrte(r) ' . $guest_name .',</p>
						<p>Wir freuen uns, Ihnen mitteilen zu können, dass Sie von Frau/Herrn ' . $logged_member . ' zu einem Treffen der Dock B Gruppe eingeladen wurden, welches am ' . $selected_meeting_date . ' um ' . get_option( "vsd_meetems_start_time") . ' Uhr stattfinden wird.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ac magna neque. In varius fermentum nunc eget bibendum. Quisque blandit.</p>
                        <p> </p>
						<p>Mit freundlichen Grüßen</p>
                        <p>Dock B Hamburg Team</p>					
    				</div>
    			</body>
    			</html>
    		';
        }
        $admin_email = get_option( 'admin_email' );
        $headers = array(
            "MIME-Version: 1.0",
            "Content-type: text/html; charset=utf-8",
            "From: Dock B Hamburg <{$admin_email}>",
            "Reply-To: {$admin_email}"
        );

        wp_mail( $to, $subject, $body, $headers ); ?>
        
        <div class="form-status-text form-status-text--success"><?php echo $guest_name . " ist eingeladen."; ?></div>
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