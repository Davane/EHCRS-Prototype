<?php


    include_once 'core/init.php';

    $error = array();

    if(get_user_id_from_session()){

        $last_activity = (int) get_value_from_session(USER_TIMESTAMP);
        $now = time();

        var_dump(get_value_from_session(USER_TIMESTAMP));
        var_dump($now);
        var_dump(($now - $last_activity));

        if(($now - $last_activity) > SESSION_TIMEOUT) {
            echo 'SESSION TIMEOUT : RE-LOGIN';
            destroy_session();
            set_session(REASON, 'timeout');
            header('Location: login-redirect.php');
        } else {
            echo 'CONTINUE SESSION';
            set_session(USER_TIMESTAMP, $now);
        }


    } else {
        echo 'Session not set';
        set_session(REASON, 'no-user');
        header('Location: login-redirect.php');

    }


    echo "IMPLEMENT SESSION HIJACKING MITIGATION FEATURES";




 ?>
