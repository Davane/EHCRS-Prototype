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

function pateint_registration_process($firstName, $middleName, $lasttName,
                        $maidenName, $email, $trn, $password, $gender,
                        $dob, $tel_no, $age, $street_name, $parish, $country,
                        $insurance_id, $emp_name,$occupation, $tel_no, $policy,
                        $emp_street_name, $emp_parish, $emp_country, $pet_name,
                        $kin, $relationship, $religion, $father_name,
                        $mother_name, $birth_place, $birth_parish, $union,
                        $height, $weight, $temp, $pulse, $resp, $bp, $urinalysis,
                        $condition) {

    global $connect;

	/* turn autocommit off */
	$connect->autocommit(false);

    # enter in address table +

    # enter into Address table (Employment Info address)
        # - enter Employment Info

    # enter member Info

    # enter into pateint table

    # enter into register table

    # enter in medical history table

    # enter vitals +

    # enter into condition table

    $clerk_id = '305';

    # entering pateint's Address
    if(enter_new_address($connect, $street_name, $parish, $country)) {
        # get last insert id from address table
        $address_id = getLastInsertedId($connect);

        if(add_new_member($connect, $address_id, $firstName, $lasttName, $middleName,
                                $maidenName, $email, $trn, $password, $gender,
                                $dob, $tel_no, $age)) {

            # get last insert id from address table
            $member_id = getLastInsertedId($connect);

            # entering pateint's Employment Address
            if(enter_new_address($connect, $emp_street_name, $emp_parish, $emp_country)) {

                # get last insert id from address table
                $emp_address_id = getLastInsertedId($connect);

                if(enter_new_employee_info($connect, $emp_address_id, $insurance_id, $emp_name,
                                            $occupation, $tel_no, $policy)) {

                    # get last insert id from emplotment_info table
                    $emp_id = getLastInsertedId($connect);

                    if(enter_new_pateint($connect,$member_id, $emp_id, $pet_name,
                                                    $kin, $relationship, $religion, $father_name,
                                                    $mother_name, $birth_place, $birth_parish, $union)) {

                        if(register_pateint($connect, $member_id, $clerk_id, $hospital_id, $physician_id)) {

                            # get last insert id from emplotment_info table
                            $registered_patient_id = getLastInsertedId($connect);


                            if(create_new_medical_record($connect, $registered_patient_id, $hospital_id, $clerk_id)){

                                # get last insert id from emplotment_info table
                                $medical_history_id = getLastInsertedId($connect);


                                if(enter_new_vitals($connect, $medical_history_id, $clerk_id, $height, $weight, $temp,
                                                        $pulse, $resp, $bp, $urinalysis)) {

                                    if(enter_new_vitals($connect, $condition)) {

                                        echo "REGISTERED";

                                    }



                                }

                            }

                        }

                    }

                }

            }

        }

    }





}


function enter_new_pateint(&$connect = null,$member_id, $emp_info_id, $pet_name,
                            $kin, $relationship, $religion, $father_name,
                            $mother_name, $birth_place, $birth_parish, $union) {

    if($connect == null) {
        echo "pateint.inc.php : global connect patient";
        global $connect;
    }

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_enter_new_pateint (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");

    // bind string datatype to varaibles
    $stmt->bind_param("issssssssss", $member_id, $emp_info_id, $pet_name, $kin, $relationship, $religion, $father_name, $mother_name, $birth_place, $birth_parish, $union);

    $patient_insert = $stmt->execute();

    return $patient_insert;
}


function register_pateint(&$connect = null, $pateint_id, $clerk_id, $hospital_id, $physician_id) {

    if($connect == null) {
        echo "pateint.inc.php : global connect register";
        global $connect;
    }

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_register_patient (?, ?, ?, ?);");

    // bind string datatype to varaibles
    $stmt->bind_param("iiii", $pateint_id, $clerk_id, $hospital_id, $physician_id);

    $register_insert = $stmt->execute();

    return $register_insert;
}


function create_new_medical_record(&$connect = null, $pateint_id, $hospital_id, $clerk_id) {

    if($connect == null) {
        echo "pateint.inc.php : global connect medical_history";
        global $connect;
    }

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_create_new_medical_record (?, ?, ?);");

    // bind string datatype to varaibles
    $stmt->bind_param("iii", $pateint_id, $hospital_id, $clerk_id);

    $medical_insert = $stmt->execute();

    return $medical_insert;
}




function enter_new_vitals(&$connect = null, $medical_id, $who_recorded, $height = '', $weight = '', $temp  = '',
                            $pulse = '', $resp = '', $bp = '', $urinalysis = '') {

    if($connect == null) {
        echo "pateint.inc.php : global connect vitals";
        global $connect;
    }

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_enter_new_vitals (?, ?, ?, ?, ?, ?, ?, ?, ?);");

    // bind string datatype to varaibles
    $stmt->bind_param("sssssssss", $medical_id, $who_recorded, $height, $weight, $temp, $pulse, $resp, $bp, $urinalysis);

    $vitals_insert = $stmt->execute();

    return $vitals_insert;

}

function enter_new_conditions(&$connect = null, $condition) {

    if($connect == null) {
        echo "pateint.inc.php : global connect emp-info";
        global $connect;
    }

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_enter_new_condition (?);");

    // bind string datatype to varaibles
    $stmt->bind_param("s", $condition);

    $emp_insert = $stmt->execute();

    return $emp_insert;

}

function enter_new_employee_info(&$connect = null, $address_id = null, $insurance_id, $emp_name, $occupation, $tel_no, $policy) {

    if($connect == null) {
        echo "pateint.inc.php : global connect emp-info";
        global $connect;
    }

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_enter_new_empployment_info (?, ?, ?, ?, ?, ?);");

    // bind string datatype to varaibles
    $stmt->bind_param("iissss", $address_id, $insurance_id, $emp_name, $occupation, $tel_no, $policy);

    $emp_insert = $stmt->execute();

    return $emp_insert;

}
function enter_new_address(&$connect = null, $street_name = '', $parish = '', $country = 'Jamaica') {

        if($connect == null) {
            echo "pateint.inc.php : global connect Address";
            global $connect;
        }

        // the prepare for update
        $stmt = $connect->prepare("CALL proc_enter_new_address (?, ?, ?);");

        // bind string datatype to varaibles
        $stmt->bind_param("sss", $street_name, $parish, $country);

        $address_insert = $stmt->execute();

        return $address_insert;
}



function get_patient_general_info($patient_id){

        // the prepare for update
        //$stmt = $connect->prepare("CALL proc_sign_in_user (?, ?, ?);");

        // bind string datatype to varaibles
        //$stmt->bind_param("s", $id);


}

function get_patient_vitals(){


}

function get_patient_condtition(){


}

function get_patient_medication(){


}







?>
