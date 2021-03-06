<?php

defined('APP_RAN') or header('Location: https://172.20.10.2/~davanedavis/EHCRS-Prototype/unauthorized_access.php');
// define('APP_RAN', 'APP_RAN');

require_once(dirname(__FILE__) . '/../init.php');
require_once(dirname(__FILE__) . '/../member.inc.php');


function update_condition($med_id, $condition) {

    if(!is_all_empty($condition))

        global $connect;

        // the prepare for update
        $stmt = $connect->prepare("CALL proc_update_condition (?, ?);");

        // bind string datatype to varaibles
        $stmt->bind_param("ss", $med_id, $condition);

        #executing and fetching he rows
        $stmt->execute();

        #var_dump($connect->error);
        #var_dump($stmt->affected_rows);

        if($stmt->affected_rows > 0) {
            log_user_sign(get_user_id_from_session(), 'Update condition to ' . $condition . ' for Medical history of ' . $med_id);
            $stmt->close();
            return true;
        }

        log_user_sign(get_user_id_from_session(), 'Attempt to update condition to ' . $condition . ' for Medical history of ' . $med_id);
        return false;

}


function update_vtials($vitals_id, $height, $weight, $temp, $pulse, $bp, $resp, $urine){

    if(!is_all_empty($height, $weight, $temp, $pulse, $resp, $bp, $urine)) {

        global $connect;

        // the prepare for update
        $stmt = $connect->prepare("CALL proc_update_vitals (?, ?, ?, ?, ?, ?, ?, ?);");

        // bind string datatype to varaibles
        $stmt->bind_param("ssssssss", $vitals_id, $height, $weight, $temp, $pulse, $bp, $resp, $urine);

        #executing and fetching he rows
        $update = $stmt->execute();

        if($stmt->affected_rows > 0) {
            log_user_sign(get_user_id_from_session(), 'Update vitals of ID ' . $vitals_id);
            $stmt->close();
            return true;
        }

        log_user_sign(get_user_id_from_session(), 'Attempt vitals update of ID ' . $vitals_id);
        #var_dump($connect->error);
        return false;

    } else {
        return 'All fields cannot be empty';
    }

}

function update_sign_and_symtpom($sign_id, $sign){

    if(!is_all_empty($sign)) {

        global $connect;

        // the prepare for update
        $stmt = $connect->prepare("CALL proc_update_sign_and_symptom (?, ?);");

        // bind string datatype to varaibles
        $stmt->bind_param("ss", $sign_id, $sign);

        #executing and fetching he rows
        $update = $stmt->execute();

        if($stmt->affected_rows > 0) {
            log_user_sign(get_user_id_from_session(), 'Update sign and symptom of ID ' . $sign_id);
            $stmt->close();
            return true;
        }

        log_user_sign(get_user_id_from_session(), 'Attempt sign and symptom update of ID ' . $sign_id);
        #var_dump($connect->error);
        return false;

    } else {
        return 'All fields cannot be empty';
    }

}


function update_treatment($treat_id, $treat){

    if(!is_all_empty($treat)) {

        global $connect;

        // the prepare for update
        $stmt = $connect->prepare("CALL proc_update_treatment (?, ?);");

        // bind string datatype to varaibles
        $stmt->bind_param("ss", $treat_id, $treat);
        $stmt->execute();

        // var_dump($connect->error);
        // die();

        if($stmt->affected_rows > 0) {
            log_user_sign(get_user_id_from_session(), 'Treatment update of ID ' . $treat_id);
            $stmt->close();
            return true;
        }

        log_user_sign(get_user_id_from_session(), 'Attempt Treatment update of ID ' . $treat_id);
        #var_dump($connect->error);
        return false;

    } else {
        return 'All fields cannot be empty';
    }

}


function update_medication($med_id, $med, $dosage, $type, $cat){

    if(!is_all_empty($med, $dosage, $type, $cat)) {

        global $connect;

        // the prepare for update
        $stmt = $connect->prepare("CALL proc_update_medication (?, ?, ? ,? ,?);");

        // bind string datatype to varaibles
        $stmt->bind_param("sssss", $med_id, $med, $dosage, $type, $cat);

        #executing and fetching he rows
        $update = $stmt->execute();

        if($stmt->affected_rows > 0) {
            log_user_sign(get_user_id_from_session(), 'medication update of ID ' . $med_id);

            $stmt->close();
            return true;
        }

        log_user_sign(get_user_id_from_session(), 'Attempt medication update of ID ' . $med_id);
        // var_dump($connect->error);
        return false;

    } else {
        return 'All fields cannot be empty';
    }

}

function get_medical_history_id($id){

    global $connect;

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_get_all_medical_history_condition (?);");

    // bind string datatype to varaibles
    $stmt->bind_param("s", $id);

    #executing and fetching he rows
    $select = $stmt->execute();

    if (!$select) {
        return null;
    }

    $resultSet = $stmt->get_result();

    if ($resultSet === null) {
        return null;
	 }

    # var_dump($connect->error);
     return  $resultSet;

}

function get_patient_vitals_by_med_history_id($patient_id){

    global $connect;

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_get_patient_vitals_new (?);");

    // bind string datatype to varaibles
    $stmt->bind_param("s", $patient_id);

    #executing and fetching he rows
    $select = $stmt->execute();

    if (!$select) {
        return null;
    }

    $resultSet = $stmt->get_result();

    if ($resultSet === null) {
        return null;
	 }

    # var_dump($connect->error);
     return  $resultSet;

}

function get_sign_and_symptons_by_patient_id($patient_id){

    global $connect;

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_get_symptons_by_patient_id (?);");

    // bind string datatype to varaibles
    $stmt->bind_param("s", $patient_id);

    #executing and fetching he rows
    $select = $stmt->execute();

    if (!$select) {
        return null;
    }

    $resultSet = $stmt->get_result();

    if ($resultSet === null) {
        return null;
	 }

     return  $resultSet;

}

function get_treatment_by_patient_id($patient_id){

    global $connect;

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_get_treatment_by_patient_id (?);");

    // bind string datatype to varaibles
    $stmt->bind_param("s", $patient_id);

    #executing and fetching he rows
    $select = $stmt->execute();

    if (!$select) {
        return null;
    }

    $resultSet = $stmt->get_result();

    if ($resultSet === null) {
        return null;
	 }

    # var_dump($connect->error);
     return  $resultSet;

}

function get_medication_by_patient_id($patient_id){

    global $connect;

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_get_medication_by_patient_id (?);");

    // bind string datatype to varaibles
    $stmt->bind_param("s", $patient_id);

    #executing and fetching he rows
    $select = $stmt->execute();

    if (!$select) {
        return null;
    }

    $resultSet = $stmt->get_result();

    if ($resultSet === null) {
        return null;
	 }

    # var_dump($connect->error);
     return  $resultSet;

}


function update_personal_info($patient_id, $firstname, $middlename, $lastname,
                              $maiden_name, $email, $trn, $gender, $dob, $tel, $age, $kin,
                              $relationship, $union, $street, $parish, $country, $employer,
                              $occupation, $emp_tel, $policy, $emp_street, $emp_parish,
                              $emp_country){

    $firstname = gen_sanitize_for_display($firstname);
    $middlename = gen_sanitize_for_datebase($middlename);
    $lastname   = gen_sanitize_for_datebase($lastname);
    // $email = gen_sanitize_for_datebase($email);
    $maiden_name = gen_sanitize_for_datebase($maiden_name);
    $trn        = gen_sanitize_for_datebase($trn);
    $gender     = gen_sanitize_for_datebase($gender);
    $tel     = gen_sanitize_for_datebase($tel);
    $age        = gen_sanitize_for_datebase($age);
    //$street     = gen_sanitize_for_datebase($street);
    $parish     = gen_sanitize_for_datebase($parish);
    $country    = gen_sanitize_for_datebase($country);
    $employer   = gen_sanitize_for_datebase($employer);
    $occupation  = gen_sanitize_for_datebase($occupation);
    $emp_tel     = gen_sanitize_for_datebase($emp_tel);
    $policy      = gen_sanitize_for_datebase($policy);
    $emp_street  = gen_sanitize_for_datebase($emp_street);
    $emp_parish  = gen_sanitize_for_datebase($emp_parish);
    $emp_country = gen_sanitize_for_datebase($emp_country);
    $kin         = gen_sanitize_for_datebase($kin);
    $relationship = gen_sanitize_for_datebase($relationship);
    $union         = gen_sanitize_for_datebase($union);



    global $connect;

    $connect->autocommit(false);

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_update_personal_info (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");

    // bind string datatype to varaibles
    $stmt->bind_param("ssssssssssssssssssssssss", $patient_id, $firstname, $middlename, $lastname, $maiden_name, $email, $trn,
                                  $gender, $dob, $tel, $age, $kin, $relationship, $union, $street, $parish, $country, $employer, $occupation,
                                  $emp_tel, $policy, $emp_street, $emp_parish, $emp_country);

    $update = $stmt->execute();

    //  var_dump($connect->error);
    // die();

    if($update) {
        log_user_sign(get_user_id_from_session(), 'Update patient info of ID ' . $patient_id);
        $connect->commit();
        $stmt->close();
        return true;
    }

    log_user_sign(get_user_id_from_session(), 'Attempt to update patient info of ID ' . $patient_id);
    return false;
}


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
        return null;
    }

    $resultSet = $stmt->get_result();

    if ($resultSet == null) {
		/*  Handle error */
		// echo "ResultSet == null" ;
        return null;

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
        // echo 'Not selected';
    }

    $resultSet = $stmt->get_result();

    if ($resultSet == null) {
        /*  Handle error */
        // echo "ResultSet == null" ;
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
        // echo 'Not selected';
        return null;

    }

    $resultSet = $stmt->get_result();

    if ($resultSet == null) {
        /*  Handle error */
        // echo "ResultSet == null" ;
        return null;
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
        // echo 'Not selected';
        return null;

    }

    $resultSet = $stmt->get_result();

    if ($resultSet == null) {
        /*  Handle error */
        // echo "ResultSet == null" ;
        return null;


     }

    # var_dump($connect->error);
     return  $resultSet;

}

function add_patient_medical_hisory($physician_id, $patient_id, $hospital_id, $condition, $signs, $height,
                                    $weight, $temp, $pulse, $bp, $resp, $urinalysis){

    global $connect;
    $connect->autocommit(false);


    if(create_new_medical_record($connect, $patient_id, $hospital_id, $physician_id)) {
        # get last insert id from address table
        $med_id = getLastInsertedId($connect);

        $status = enter_new_conditions($connect, $condition, $med_id);

        if(!$status) {
            $state['error'] = 'condition insert failed';
            return $state;
        }

        $status = enter_new_vitals($connect, $med_id, $physician_id, $height, $weight, $temp,
                                    $pulse, $resp, $bp, $urinalysis);

        if(!$status) {
            $state['error'] = 'vitals insert failed';
            return $state;
        }

        $status = add_new_sign_and_sympton($med_id, $physician_id, $signs);

        if(!$status) {
            $state['error'] = 'signs insert failed';
            return $state;
        } else {
            // $connect->commit();
            $state['success'] = true;
            return $state;
        }

    }

}


function add_new_sign_and_sympton($med_id, $physician_id, $sign){

    global $connect;

    if(!is_all_empty($sign)) {

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
            log_user_sign(get_user_id_from_session(), 'Added new Sign and Symptom');
            $stmt->close();
            return true;
        }

        log_user_sign(get_user_id_from_session(), 'Attempt to added new Sign and Symptom');
        return false;

    } else {

        return true;
    }
}

function add_new_treatment($med_id, $physician_id, $treat){

    global $connect;

    if(!is_all_empty($med_id, $physician_id, $treat)) {

        // the prepare for update
        $stmt = $connect->prepare("CALL proc_enter_new_treatment (?, ?, ?);");

        // bind string datatype to varaibles
        $stmt->bind_param("sss", $med_id, $physician_id, $treat);

        #executing and fetching he rows
        $insert = $stmt->execute();

        // var_dump($stmt->error);
        // var_dump($stmt->affected_rows);
        // die();

        if($stmt->affected_rows > 0) {
            log_user_sign(get_user_id_from_session(), 'Added new Treatment');
            $stmt->close();
            return true;
        }

        log_user_sign(get_user_id_from_session(), 'Attempt to add new Treatment');
        return false;

    } else {

        return true;
    }
}
function add_new_medication($med_id, $physician_id, $med, $dosage, $type, $category){

    global $connect;

    if(!is_all_empty($med_id, $physician_id, $med, $dosage, $type, $category)) {

        // the prepare for update
        $stmt = $connect->prepare("CALL proc_enter_new_medication (?, ?, ?, ?, ?, ?);");

        // bind string datatype to varaibles
        $stmt->bind_param("ssssss", $med_id, $physician_id, $med, $dosage, $type, $category);

        #executing and fetching he rows
        $insert = $stmt->execute();

        // var_dump($stmt->error);
        // var_dump($stmt->affected_rows);
        // die();

        if($stmt->affected_rows > 0) {
            log_user_sign(get_user_id_from_session(), 'Added new Medication');
            $stmt->close();
            return true;
        }

        log_user_sign(get_user_id_from_session(), 'Added new Medication');
        return false;

    } else {

        return true;
    }
}

function create_new_medical_record(&$connect = null, $pateint_id, $hospital_id, $clerk_id) {

    if($connect == null) {
        // echo "pateint.inc.php : global connect medical_history";
        global $connect;
    }

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_create_new_medical_record (?, ?, ?);");

    // bind string datatype to varaibles
    $stmt->bind_param("sss", $pateint_id, $hospital_id, $clerk_id);

    $stmt->execute();

    // var_dump('medical history: '.$connect->error);
    // die();

    if($stmt->affected_rows > 0) {
        $stmt->close();
        return true;
    }
    return false;
}


function enter_new_pateint(&$connect = null,$member_id, $emp_info_id, $pet_name,
                            $kin, $relationship, $religion, $father_name,
                            $mother_name, $birth_place, $birth_parish, $union) {

    if($connect == null) {
        // echo "pateint.inc.php : global connect patient";
        global $connect;
    }

    if (empty(trim($union))) {
        # set default value
        $union = null;
    }

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_enter_new_pateint (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");

    // bind string datatype to varaibles
    $stmt->bind_param("issssssssss", $member_id, $emp_info_id, $pet_name, $kin,
                            $relationship, $religion, $father_name, $mother_name, $birth_place,
                    $birth_parish, $union);

    $stmt->execute();

    // var_dump('new patient: ' . $connect->error);
    // die();

    if($stmt->affected_rows > 0) {
        $stmt->close();
        return true;
    }
    return false;

    // return $patient_insert;
}

function register_pateint(&$connect = null, $pateint_id, $clerk_id, $hospital_id, $physician_id) {

    if($connect == null) {
        // echo "pateint.inc.php : global connect register";
        global $connect;
    }

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_register_patient (?, ?, ?, ?);");

    // bind string datatype to varaibles
    $stmt->bind_param("iiii", $pateint_id, $clerk_id, $hospital_id, $physician_id);

    $stmt->execute();


    // var_dump('Register: ' . $connect->error);
    // die();

    if($stmt->affected_rows > 0) {
        $stmt->close();
        return true;
    }
    return false;
}


function enter_new_vitals(&$connect = null, $medical_id, $who_recorded, $height = '', $weight = '', $temp  = '',
                            $pulse = '', $resp = '', $bp = '', $urinalysis = '') {

    if(!is_all_empty($height, $weight, $temp, $pulse, $resp, $bp, $urinalysis)) {

        if($connect == null) {
            // echo "pateint.inc.php : global connect vitals";
            global $connect;
        }

        // the prepare for update
        $stmt = $connect->prepare("CALL proc_enter_new_vitals (?, ?, ?, ?, ?, ?, ?, ?, ?);");

        // bind string datatype to varaibles
        $stmt->bind_param("sssssssss", $medical_id, $who_recorded, $height, $weight, $temp, $pulse, $resp, $bp, $urinalysis);
        $stmt->execute();


        // var_dump('Vitals: ' . $connect->error);
        // die();


        if($stmt->affected_rows > 0) {
            log_user_sign(get_user_id_from_session(), 'Added new vitals');
            $stmt->close();
            return true;
        }

        log_user_sign(get_user_id_from_session(), 'Attempt to add new vitals');
        return false;

    } else {

        return true;
    }
}

function enter_new_conditions(&$connect = null, $condition, $medical_id) {

    if(!is_all_empty($condition)) {

        if($connect == null) {
            // echo "pateint.inc.php : global connect emp-info";
            global $connect;
        }

        // the prepare for update
        $stmt = $connect->prepare("CALL proc_enter_new_condition (?, ?);");

        // bind string datatype to varaibles
        $stmt->bind_param("ss", $condition, $medical_id);

        $stmt->execute();

        // var_dump('condition: ' . $stmt->error);
        // die();

        if($stmt->affected_rows > 0) {
            $stmt->close();
            return true;
        }
        return false;

    } else {
        return true;
    }

}

function enter_new_employee_info(&$connect = null, $address_id = null, $insurance_id = null, $emp_name, $occupation, $tel_no, $policy) {

    if(!is_all_empty($insurance_id, $emp_name, $occupation, $tel_no, $policy)) {

        if($connect == null) {
            echo "pateint.inc.php : global connect emp-info";
            global $connect;
        }

        if (empty(trim($address_id))) {
            # set default value
            $address_id = null;
        }

        if (empty(trim($insurance_id))) {
            # set default value
            $insurance_id = null;
        }

        #var_dump($address_id);

        // the prepare for update
        $stmt = $connect->prepare("CALL proc_enter_new_empployment_info (?, ?, ?, ?, ?, ?);");

        // bind string datatype to varaibles
        $stmt->bind_param("ssssss", $address_id, $insurance_id, $emp_name, $occupation, $tel_no, $policy);

        $stmt->execute();

        // var_dump('Emp: ' . $connect->error);
        // die();

        if($stmt->affected_rows > 0) {
            $stmt->close();
            return true;
        }

        return false;


    } else {
        return $error['error'] = 'Empty: Didnt Insert';
    }

}

function enter_new_address(&$connect = null, $street_name = '', $parish = '', $country = '') {

    if(!is_all_empty($street_name, $parish, $country)) {

        if($connect == null) {
            // echo "pateint.inc.php : global connect Address";
            global $connect;
        }

        $street_name = is_empty_set_default($street_name, null);


        // the prepare for update
        $stmt = $connect->prepare("CALL proc_enter_new_address (?, ?, ?);");

        // bind string datatype to varaibles
        $stmt->bind_param("sss", $street_name, $parish, $country);

        $address_insert = $stmt->execute();

        // var_dump('New Address: ' . $connect->error);
        // die();

        if($stmt->affected_rows > 0) {
            $stmt->close();
            return true;
        }
        return false;

    } else {
        return $error['error'] = 'Empty: Didnt Insert';
    }
}


function get_patient_general_info_for_pyhsician($id){

    global $connect;

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_get_patient_general_info_for_physician (?);");

    // bind string datatype to varaibles
    $stmt->bind_param("s", $id);

    #executing and fetching he rows
    $select = $stmt->execute();

    if (!$select) {
        // echo 'Not selected';
        return null;
    }

    $resultSet = $stmt->get_result();

    if ($resultSet == null) {
        /*  Handle error */
        // echo "ResultSet == null" ;
        return null;

     }

    # var_dump($connect->error);
     return  $resultSet->fetch_assoc();;
}

function get_latest_patient_vital($id){

    global $connect;

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_get_the_lastest_vital_for_patient (?);");

    // bind string datatype to varaibles
    $stmt->bind_param("s", $id);

    #executing and fetching he rows
    $select = $stmt->execute();

    if (!$select) {
        // echo 'Not selected';
        return null;
    }

    $resultSet = $stmt->get_result();

    if ($resultSet == null) {
        /*  Handle error */
        // echo "ResultSet == null" ;
        return null;
     }

    # var_dump($connect->error);
     return  $resultSet->fetch_assoc();
}

function get_patient_condition_signs_treatment_medication($id){

    global $connect;

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_get_patient_condition_signs_medication_treatment (?);");

    // bind string datatype to varaibles
    $stmt->bind_param("s", $id);

    #executing and fetching he rows
    $select = $stmt->execute();

    if (!$select) {
        // echo 'Not selected';
        return null;
    }

    $resultSet = $stmt->get_result();

    if ($resultSet == null) {
        /*  Handle error */
        // echo "ResultSet == null" ;
        return null;
     }

    # var_dump($connect->error);
     return  $resultSet;
}



function uploadFile(&$connect, $patient_id){

    if (!isset($_FILES)) {
        return false;
    }

    if($connect == null) {
        // echo "pateint.inc.php : global connect Address";
        global $connect;
    }

    $uploads_folder = 'uploads';
    $user_folder = $patient_id;
    $pro_pic_folder = 'img';

    $upload_dir = getcwd() . DIRECTORY_SEPARATOR . $uploads_folder;
    $user_dir = $upload_dir . DIRECTORY_SEPARATOR . $user_folder ;
    $img_dir = $user_dir . DIRECTORY_SEPARATOR . $pro_pic_folder;
    $pro_pic_img_name = 'patient_photo.jpg';

    // var_dump($_FILES['uploadedFile']['tmp_name']);
    // die();


    if (createDirectory($img_dir, true)) {
        // echo 'created';

        // the prepare for update
        $stmt = $connect->prepare("CALL proc_update_proc_pic_url (?, ?)");

        $proPicDir = $img_dir . DIRECTORY_SEPARATOR . $pro_pic_img_name;

        // bind string datatype to varaibles
        $stmt->bind_param("ss", $patient_id, $proPicDir);

        $stmt->execute();

        // return $address_insert;
        if($stmt->affected_rows > 0) {

            $stmt->close();

            // $pro_pic_img_name = 'patient_photo.jpg';

            if(move_uploaded_file($_FILES['uploadedFile']['tmp_name'], $img_dir . DIRECTORY_SEPARATOR . $pro_pic_img_name)) {
                // echo "moved";
                return true;
            } else {
                // echo "not moved" .  $_FILES['tmp_name'];
                return false;
            }
        }

    } else {
        // echo "not created";
    }



    return false;
}

function createDirectory($dir, $recursive){

    // check if the directory already exists if not creates it (Davane Davis)
    if(file_exists($dir) === false ) {

        // making directory
        mkdir($dir, 0775 ,$recursive);

        // checking if the folders were created successfully
        if(file_exists($dir) === false) { return false; }
    }

    // directory already created
    return true;
}

 ?>
