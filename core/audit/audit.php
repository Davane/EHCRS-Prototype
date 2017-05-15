<?php

    defined('APP_RAN') or header('Location: https://localhost/~davanedavis/EHCRS-Prototype/unauthorized_access.php');

    include_once(dirname(__FILE__) . '/../physician/physician.inc.php');

    function log_user_sign($id, $action){


        global $connect;

        // the prepare for update
    	$stmt = $connect->prepare("CALL proc_log_sign_in (?, ?, ?);");

        $from_where = get_physician_work_place($id);

        // bind string datatype to varaibles
        $stmt->bind_param("sss", $id, $from_where, $action);
        $stmt->execute();

        $logged = (bool) $stmt->affected_rows;

        // var_dump($connect->error);
        // die();

        if (!$logged) {
            $stmt->close();
            # the was not logged successful then log the error in error file
            echo "error logging sign in : from audit file";
            return false;
        }

        $stmt->close();
        return true;
    }

?>
