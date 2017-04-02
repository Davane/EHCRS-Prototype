<?php

function add_new_member(&$connect, $address_id, $firstName, $lasttName, $middleName,
                        $maidenName, $email, $trn, $password = '', $gender,
                        $dob = '0000-00-00', $tel_no, $age = 0){
    if($connect == null) {
        echo "pateint.inc.php : global connect member";
        global $connect;
    }

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_enter_new_member (?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,? ,?);");

    // bind string datatype to varaibles
    $stmt->bind_param("isssssssssss", $address_id, $firstName, $lasttName, $middleName, $maidenName, $email, $trn, $password, $gender, $dob, $tel_no, $age);

    $member_insert = $stmt->execute();

    return $member_insert;
}

function generate_and_send_verification_code_by_email($id) {

    $code = generate_verification_code();

    if(update_verification_code($id, $code))
    {
        gen_send_mail('dlen366@gmail.com', 'Hello' , 'PLease Verify your account by entering the following code on the verfication page of our site: ' .$code );
        return true;
    }

    return false;
}

function confirm_verification($id, $code){
    global $connect;

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_confirm_verfication_code (?, ?);");

    // bind string datatype to varaibles
    $stmt->bind_param("ss", $id, $code);

    #executing and fetching he rows
    $row = executeAndGetRowsFromSelectPreparedStatement($stmt);
    $stmt->close();

    if (array_key_exists('verify',$row)){

        $verified = (bool) $row['verify'];

        # if successful
        if ($verified) {
            return true;
        }
    }

    return false;

}

function generate_verification_code() {
    return rand(999,99999);
}

function update_verification_code($id, $code) {

        global $connect;

        // the prepare for update
        $stmt = $connect->prepare("CALL proc_update_verification_code (?, ?);");

        // bind string datatype to varaibles
        $stmt->bind_param("ss", $id, $code);

        /* execute statement */
        $stmt->execute();

        //var_dump($stmt->affected_rows);

        return (bool) $stmt->affected_rows;
}

function is_member_exist($id) {

        global $connect;

        // the prepare for update
    	$stmt = $connect->prepare("CALL proc_check_if_memebr_exist (?);");

        // bind string datatype to varaibles
        $stmt->bind_param("i", $id);


        #executing and fetching he rows
        $row = executeAndGetRowsFromSelectPreparedStatement($stmt);

        #var_dump($row);

        $stmt->close();
        #$connect->close();

        return (bool) $row['exist'];
}

function is_member_active($id) {

    global $connect;

    # the prepare for update
	$stmt = $connect->prepare("CALL proc_check_if_member_is_active_by_id (?);");

    # bind string datatype to varaibles
    $stmt->bind_param("i", $id);

    #executing and fetching he rows
    $row = array();
    $row = executeAndGetRowsFromSelectPreparedStatement($stmt);

    #var_dump($row);

    $stmt->close();

    return !array_key_exists('active' , $row) ? false : (bool) $row['active'];
}










  ?>
