<?php

// echo 'sign out';

include_once 'core/init.php';
destroy_session();

header('Location: sign-up.php');

?>
