<?php

    function log_user_sign($id, $from_where, $action){

        global $connect;

        // the prepare for update
    	$stmt = $connect->prepare("CALL proc_log_sign_in (?, ?, ?);");

        // bind string datatype to varaibles
        $stmt->bind_param("sss", $id, $from_where, $action);

        $insert = $stmt->execute();

        $logged = (bool)$stmt->affected_rows;

        #echo "ATTEMPT";
        #var_dump($logged);

        if (!$logged) {

            # the was not logged successful then log the error in error file
            echo "error logging sign in : from audit file";
            return false;
        }

        $stmt->close();
        return true;
    }

?>
