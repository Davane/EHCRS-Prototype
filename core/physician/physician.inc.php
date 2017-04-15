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

     return  $resultSet;
}

function change_appointment_status($id, $status){

    global $connect;

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_change_appointment_status (?, ?);");

    // bind string datatype to varaibles
    $stmt->bind_param("ss", $id, $status);

    #executing and fetching he rows
    $update = $stmt->execute();

    if($stmt->affected_rows > 0) {
        #echo "string";
        $stmt->close();
        return true;
    }

    #echo "2222";
    return false;
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


function get_all_patient_and_id(){

    global $connect;

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_get_all_patient_name_and_id ();");

    // bind string datatype to varaibles
    #$stmt->bind_param("s", $id);

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

function add_patient_medical_hisory($id, $condition, $signs, $height, $weight, $temp, $pulse, $bp, $resp, $unrine){

    global $connect;
    $connect->autocommit(false);


    // the prepare for update
    $stmt = $connect->prepare("CALL proc_change_appointment_status (?, ?);");

    // bind string datatype to varaibles
    $stmt->bind_param("ss", $id, $status);

    #executing and fetching he rows
    $update = $stmt->execute();

    //var_dump($connect->error);
    //var_dump($stmt->affected_rows);
    //die();

    if($stmt->affected_rows > 0) {
        #echo "string";
        $stmt->close();
        return true;
    }

    #echo "2222";
    return false;


}


function add_new_sign_and_sympton($med_id, $physician_id, $sign){

    global $connect;

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_enter_new_sign_and_symptom (?, ?, ?);");

    // bind string datatype to varaibles
    $stmt->bind_param("sss", $med_id, $physician_id, $sign);

    #executing and fetching he rows
    $insert = $stmt->execute();

    // var_dump($stmt->error);
    // var_dump($stmt->affected_rows);
    // die();

    if($stmt->affected_rows > 0) {
        #echo "string";
        $stmt->close();
        return true;
    }

    #echo "2222";
    return false;
}

function create_new_medical_record(&$connect = null, $pateint_id, $hospital_id, $clerk_id) {

    if($connect == null) {
        echo "pateint.inc.php : global connect medical_history";
        global $connect;
    }

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_create_new_medical_record (?, ?, ?);");

    // bind string datatype to varaibles
    $stmt->bind_param("sss", $pateint_id, $hospital_id, $clerk_id);

    $stmt->execute();

    #echo $connect->error;
    if($stmt->affected_rows > 0) {
        $stmt->close();
        return true;
    }
    return false;
}


 ?>
