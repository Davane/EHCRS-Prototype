<?php

if (!isset($_POST['access']) || $_POST['access'] != '1') {
    die();
}

// if ($_POST['access'] != '1') {
//     die();
// }

require_once(dirname(__FILE__) . '/../init.php');

$user =     isset($_POST['user']) ? $_POST['user'] : "";
$password = isset($_POST['pass']) ? $_POST['pass'] : "";
$type =     isset($_POST['type']) ? $_POST['type'] : "";


$logged_in = mobileLogin($user, $password, $type) ? 'success' : 'failed';

echo $logged_in;


# ------------------------------------------------------------------------------
#   Functions
# ------------------------------------------------------------------------------

function mobileLogin($user, $password, $type){

    // sanitize and update database
    $user     = gen_sanitize_for_datebase($user);
    $password = gen_sanitize_for_datebase($password);
    $type     = gen_sanitize_for_datebase($type);

    global $connect;

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_mobile_sign_in (?, ?, ?);");

    // bind string datatype to varaibles
    $stmt->bind_param("sss", $user, $password, $type);

    #executing and fetching he rows
    $row = executeAndGetRowsFromSelectPreparedStatement($stmt);
    $stmt->close();

    #var_dump($connect->error);
    #die();

    if (array_key_exists('signed_in', $row)){

        $verified = (bool) $row['signed_in'];
        // var_dump($verified);
        # if successful
        if ($verified) {
            return true;
        }
    }
    return false;
}


 ?>
