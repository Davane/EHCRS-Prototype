<?php
define('APP_RAN', 'APP_RAN');

// echo 'sign out';

include_once 'core/init.php';

log_user_sign(get_user_id_from_session(), 'sign_out');

destroy_session();
header('Location: sign-up.php');

?>
