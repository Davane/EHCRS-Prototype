<?php

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
