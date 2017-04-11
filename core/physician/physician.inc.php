<?php

require_once(dirname(__FILE__) . '/../init.php');
require_once(dirname(__FILE__) . '/../member.inc.php');

function verify_user_and_password($id, $password){

    global $connect;

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_sign_and_register (?, ?);");

    // bind string datatype to varaibles
    $stmt->bind_param("ss", $id, $password);

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


function search_for_patient($search_query){

    global $connect;

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_search_for_patient (?);");

    // bind string datatype to varaibles
    $stmt->bind_param("s", $search_query);

    #executing and fetching he rows
    $select = $stmt->execute();

    if (!$select) {
        echo 'Not selected';
    }

    $resultSet = $stmt->get_result();

    if ($resultSet == null) {
		/*  Handle error */
		echo "ResultSet == null" ;

	 }

    # var_dump($connect->error);
     return  $resultSet;
}

function get_physician_work_place($id){

    global $connect;

    $stmt = $connect->prepare("CALL proc_get_physician_working_hosptial (?);");

    $stmt->bind_param("s", $id);

    #executing and fetching he rows
    $row = executeAndGetRowsFromSelectPreparedStatement($stmt);
    $stmt->close();

    #var_dump($row);
    //die();


    if ($row !== null && array_key_exists('hospital', $row)){
        return $row['hospital'];
    }

    return null;
}

function get_hospital_id_from_name($hospital) {

    global $connect;

    $stmt = $connect->prepare("CALL proc_get_hospital_id_by_name (?);");

    $stmt->bind_param("s", $hospital);

    #executing and fetching he rows
    $row = executeAndGetRowsFromSelectPreparedStatement($stmt);
    $stmt->close();

    #var_dump($row);
    //die();


    if ($row !== null && array_key_exists('hospital', $row)){
        return $row['hospital'];
    }

    return null;

}
function get_appointment_for_hospital_by_id($id) {

    global $connect;

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_get_appointments_for_hospital (?);");

    // bind string datatype to varaibles
    $stmt->bind_param("s", $id);

    #executing and fetching he rows
    $select = $stmt->execute();

    if (!$select) {
        echo 'Not selected';
    }

    $resultSet = $stmt->get_result();

    if ($resultSet == null) {
        /*  Handle error */
        echo "ResultSet == null" ;

     }

    # var_dump($connect->error);
     return  $resultSet;
}


function get_emergency_count($id) {

    global $connect;

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_get_em_and_inc_em_count (?);");

    // bind string datatype to varaibles
    $stmt->bind_param("s", $id);

    #executing and fetching he rows
    $select = $stmt->execute();

    if (!$select) {
        echo 'Not selected';
    }

    $resultSet = $stmt->get_result();

    if ($resultSet == null) {
        /*  Handle error */
        echo "ResultSet == null" ;

     }

    # var_dump($connect->error);
     return  $resultSet;
}

 ?>
