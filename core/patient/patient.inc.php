<?php

defined('APP_RAN') or header('Location: https://localhost/~davanedavis/EHCRS-Prototype/unauthorized_access.php');
// define('APP_RAN', 'APP_RAN');

# including 'init.php'
require_once(dirname(__FILE__) . '/../init.php');
require_once(dirname(__FILE__) . '/../member.inc.php');
require_once(dirname(__FILE__) . '/../physician/physician.inc.php');


function update_password($email, $password){

    global $connect;

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_update_password_by_email (?, ?);");

    // bind string datatype to varaibles
    $stmt->bind_param("ss", $email, $password);

    $stmt->execute();

    if($stmt->affected_rows > 0) {
        $stmt->close();
        return true;
    }

    return false;
}

function get_paitnet_personal_info($patient_id) {

    global $connect;

    // the prepare query
    $stmt = $connect->prepare("CALL proc_get_patient_personal_info (?);");

    // bind string datatype to varaibles
    $stmt->bind_param("s", $patient_id);

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

function get_patient_general_info($patient_id){

    global $connect;

    // the prepare query
    $stmt = $connect->prepare("CALL proc_get_pateint_profile_info (?);");

    // bind string datatype to varaibles
    $stmt->bind_param("s", $patient_id);

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

function get_patient_name($patient_id){

    global $connect;

    $stmt = $connect->prepare("CALL proc_get_patient_name (?);");
    $stmt->bind_param("s", $patient_id);
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
     return  $resultSet->fetch_assoc();;

}


function pateint_registration_process($firstname, $middleName ='', $lastname,
                        $maidenName, $email, $trn, $password, $gender = '',
                        $dob, $tel_no, $age, $street_name, $parish, $country,
                        $insurance_id, $emp_name,$occupation, $emp_tel_no, $policy,
                        $emp_street_name, $emp_parish, $emp_country, $pet_name,
                        $kin, $relationship, $religion, $father_name,
                        $mother_name, $birth_place, $birth_parish, $union,
                        $height, $weight, $temp, $pulse, $resp, $bp, $urinalysis,
                        $condition) {

    # preventing against XSS attacks
    $firstname  = gen_sanitize_for_datebase($firstname);
    $middleName = gen_sanitize_for_datebase($middleName);
    $lastname   = gen_sanitize_for_datebase($lastname);
    $maidenName = gen_sanitize_for_datebase($maidenName);
    $trn        = gen_sanitize_for_datebase($trn);
    $password   = gen_sanitize_for_datebase($password);
    $gender     = gen_sanitize_for_datebase($gender);
    $tel_no     = gen_sanitize_for_datebase($tel_no);
    $age        = gen_sanitize_for_datebase($age);
    $street_name     = gen_sanitize_for_datebase($street_name);
    $parish     = gen_sanitize_for_datebase($parish);
    $country    = gen_sanitize_for_datebase($country);
    $emp_name   = gen_sanitize_for_datebase($emp_name);
    $occupation = gen_sanitize_for_datebase($occupation);
    $emp_tel_no = gen_sanitize_for_datebase($emp_tel_no);
    $policy     = gen_sanitize_for_datebase($policy);
    $emp_street_name = gen_sanitize_for_datebase($emp_street_name);
    $emp_parish  = gen_sanitize_for_datebase($emp_parish);
    $emp_country = gen_sanitize_for_datebase($emp_country);
    $pet_name    = gen_sanitize_for_datebase($pet_name);
    $kin         = gen_sanitize_for_datebase($kin);
    $relationship = gen_sanitize_for_datebase($relationship);
    $religion    = gen_sanitize_for_datebase($religion);
    $father_name = gen_sanitize_for_datebase($father_name);
    $mother_name = gen_sanitize_for_datebase($mother_name);
    $birth_place = gen_sanitize_for_datebase($birth_place);
    $birth_parish = gen_sanitize_for_datebase($birth_parish);
    $height      = gen_sanitize_for_datebase($height);
    $weight      = gen_sanitize_for_datebase($weight);
    $temp        = gen_sanitize_for_datebase($temp);
    $pulse       = gen_sanitize_for_datebase($pulse);
    $resp        = gen_sanitize_for_datebase($resp);
    $bp          = gen_sanitize_for_datebase($bp);
    $urinalysis  = gen_sanitize_for_datebase($urinalysis);
    $condition   = gen_sanitize_for_datebase($condition);


    global $connect;

	/* turn autocommit off */
	$connect->autocommit(false);

    $error = array();

    $physician_id = $clerk_id = get_user_id_from_session();
    $hospital_id = get_physician_work_place($physician_id);

    # entering pateint's Address
    if($status = enter_new_address($connect, $street_name, $parish, $country)) {
        # get last insert id from address table
        #var_dump($status);

        if ($status === true) {
            $address_id = getLastInsertedId($connect);

        } else {
            $address_id = null;
        }

        if(add_new_member($connect, $address_id, $firstname, $lastname, $middleName,
                                $maidenName, $email, $trn, $password, $gender,
                                $dob, $tel_no, $age)) {

            # get last insert id from address table
            $member_id = getLastInsertedId($connect);

            # entering pateint's Employment Address
            if($emp_add_status = enter_new_address($connect, $emp_street_name, $emp_parish, $emp_country)) {

                # get last insert id from address table
                if ($emp_add_status === true) {
                    $emp_address_id = getLastInsertedId($connect);
                } else {
                    $emp_address_id = null;
                }

                if($emp_info_status = enter_new_employee_info($connect, $emp_address_id, $insurance_id, $emp_name,
                                            $occupation, $emp_tel_no, $policy)) {


                    if ($emp_info_status === true) {
                        $emp_id = getLastInsertedId($connect);
                    } else {
                        $emp_id = null;
                    }

                    if(enter_new_pateint($connect, $member_id, $emp_id, $pet_name,
                                                    $kin, $relationship, $religion, $father_name,
                                                    $mother_name, $birth_place, $birth_parish, $union)) {

                        if(register_pateint($connect, $member_id, $clerk_id, $hospital_id, $physician_id)) {


                            if(create_new_medical_record($connect, $member_id, $hospital_id, $clerk_id)){

                                # get last insert id from emplotment_info table
                                $medical_history_id = getLastInsertedId($connect);


                                if(enter_new_vitals($connect, $medical_history_id, $clerk_id, $height, $weight, $temp,
                                                        $pulse, $resp, $bp, $urinalysis)) {

                                    if(enter_new_conditions($connect, $condition, $medical_history_id)) {

                                        // #upload File
                                        uploadFile($connect, $member_id);

                                        if(generate_activation_code_and_email($connect, $member_id, $email, $firstname, $lastname)){
                                            #echo "REGISTERED";

                                            log_user_sign(get_user_id_from_session(), 'New Patient was Registered with ID ' . $member_id);

                                            // Change the line below to your timezone!
                                            date_default_timezone_set('Jamaica');
                                            $date = date('Y-m-d', time());
                                            $time = date('H:i:s', time());

                                            set_appointment($member_id, $physician_id, $hospital_id, $date, $time, 'wait');

                                            $connect->commit();

                                            set_session('user', $member_id);
                                            set_session('name', $firstname .' ' . $lastname);

                                            header('Location: success.php?type=reg');

                                        } else {
                                            // echo 'activation code not Sent';
                                            $error['error'] = 'activation code not Sent';
                                        }

                                    } else {
                                        // echo "create new condition error:" . $connect->error;
                                        $error['error'] = 'create new condition error';
                                    }

                                } else {
                                    // echo "create new Vitals error:" . $connect->error;
                                    $error['error'] = 'create new Vitals error';
                                }

                            } else {
                                // echo "create new medical record error:" . $connect->error;
                                $error['error'] = 'create new medical record error:';
                            }

                        } else {
                            // echo "Register Patient error:" . $connect->error;
                            $error['error'] = 'Register Patient error';
                        }

                    } else {
                        // echo "new Patient error:" . $connect->error;
                        $error['error'] = 'New Patient error';
                    }

                } else {
                    // echo "Employment Info error:" . $connect->error;
                    $error['error'] = 'Employment Info error';
                }

            } else {
                // echo "Employment Address error:" . $connect->error;
                $error['error'] = 'Employment Address error';
            }

        } else {
            // echo "Member error:" . $connect->error;
            $error['error'] = 'Member error : Email Already Exist';
        }

    } else {

        // echo "Pateint Address Wrong error:" . $connect->error;
        $error['error'] = 'Pateint Address  Error';
    }

    return $error;

}

function generate_activation_code($key){
    return md5((string)$key + (string)microtime());
}

function generate_activation_code_and_email(&$connect = null, $member_id, $email, $firstname, $lastname) {

    if($connect == null) {
        // echo "pateint.inc.php : global connect patient";
        global $connect;
    }

    $activation_code = generate_activation_code($email);

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_update_activation_code (?, ?);");

    // bind string datatype to varaibles
    $stmt->bind_param("ss", $member_id, $activation_code);

    $activation_code_inserted = $stmt->execute();

    // echo $connect->error;

    if ($activation_code_inserted) {

        $ip = '192.168.43.157';// $_SERVER['SERVER_ADDR'];

        gen_send_mail($email, "Account Activation",
                      "Hello ". $firstname ." ". $lastname .",\n\nclick the link below to activate your account \n\nhttps://". $ip ."/~davanedavis/EHCRS-Prototype/activate_account.php?x=". $email ."&code=". $activation_code ."
                        \n\n\t- Healthwise Interconnected Health Record System");
        return true;
    } else {
        return $error = 'insert_error';
    }

}



function get_patient_condtition_and_treatment($id) {

    global $connect;

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_get_condition_treatment_medication (?);");

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
		/* Handle error */
		// echo "ResultSet == null" ;
        return null;

	 }

     return $resultSet;
}

function get_patient_vitals($id){

    global $connect;

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_get_patient_vitals (?);");

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
        /* Handle error */
        // echo "ResultSet == null" ;
        return null;


     }

     return $resultSet;
}

function get_patient_medication($id){

    global $connect;

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_get_patient_medication (?);");

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
        /* Handle error */
        // echo "ResultSet == null" ;
        return null;

     }

     return $resultSet;
}








?>
