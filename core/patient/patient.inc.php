<?php

# including 'init.php'
require_once(dirname(__FILE__) . '/../init.php');
require_once(dirname(__FILE__) . '/../member.inc.php');


function sign_in_patient($id, $email, $password) {

    global $connect;

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_sign_in_user (?, ?, ?);");

    // bind string datatype to varaibles
    $stmt->bind_param("sss", $id, $email, $password);

    #executing and fetching he rows
    $row = executeAndGetRowsFromSelectPreparedStatement($stmt);
    $stmt->close();

    $signed_in = (bool) $row['signed_in'];

    # if sign in successful
    if ($signed_in) {
        log_user_sign($id, '', 'sign_in');
        return true;
    }

    log_user_sign($id, '', 'sign_in_attempt');
    return false;

}

function get_patient_vitals(){

    
}

function get_patient_condtition(){


}

function get_patient_medication(){


}







?>
