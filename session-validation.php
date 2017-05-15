<?php

    defined('APP_RAN') or header('Location: https://172.20.10.2/~davanedavis/EHCRS-Prototype/unauthorized_access.php');

    require_once 'core/init.php';
    require_once 'core/member.inc.php';

    $error = array();

    if (get_user_id_from_session() !== null) {
    
        if(validate_user_from_session(get_user_id_from_session(), get_current_user_type(), get_session_id())) {

            if (!is_user_verified() && !is_user_qr_verified()) {
                if (basename($_SERVER['PHP_SELF']) !== 'login-verification.php'){
                    // echo 'USER NOT VRIFIED';
                    header('Location: login-redirect.php');
                }
            }

        } else {
            // echo 'SESSION NOT VALID';
            header('Location: login-redirect.php');
        }

        $last_activity = (int) get_value_from_session(USER_TIMESTAMP);
        $now = time();

        if(($now - $last_activity) > SESSION_TIMEOUT) {

            // echo 'SESSION TIMEOUT : RE-LOGIN';
            destroy_session();
            set_session(REASON, 'timeout');
            header('Location: login-redirect.php');

        } else {
            #echo 'CONTINUE SESSION';
            set_session(USER_TIMESTAMP, $now);
        }


    } else {
        // echo 'Session not set';
        set_session(REASON, 'no-user');
        header('Location: login-redirect.php');
    }


    // echo " SESSION VALIDATION : IMPLEMENT
    //             [SESSION HIJACKING],
    //             [TIMING ATTACKS],
    //             [XSS - CROSS SITE SCRIPTING],
    //             [PROPER ENCRYPTION WITH REASON 'password_hash() function']
    //         MITIGATION FEATURES  ";

    # PASSWORD_BCRYPT and PASSWORD_DEAFULT are constants for the password_hash()
    # function and php offcial documattion failed to mention the encryption method
    # used in to encrpt the data. must be some security features

    # XSS - strip html tags before saving to database or display to site

    # TIMING ATTACKS - by analyzing the time it takes to get a response, can probably
    # figure out where the first difference is between his fake_msg and the real one. He
    # can try all possibilities for that one byte, find the correct one, and then
    # work on the next byte secure in the knowledge that the first k bytes are right.
    # PREVENTION - 'hash_equals(known_string, user_string)' - use has
    # hash_equals(Timing attack safe string comparison) Compares two strings using
    ## the same time whether they're equal or not.

    # GEOLOACTION APIs are not secure - s


 ?>
