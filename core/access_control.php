<?php

defined('APP_RAN') or header('Location: https://172.20.10.2/~davanedavis/EHCRS-Prototype/unauthorized_access.php');


# It would probably be better to put all of your included
# files above your DocumentRoot though.

# For example, if your index page is at
# /my/server/domain/public_html

# You should put the included files in
# /my/server/domain/


// define("REGISTRATION_PAGE_ACCESSS_LELVEL", 4);
// define("PATIENT_RECORD_PAGE_ACCESSS_LELVEL", 4);
// define("EDIT_MEDICAL_HISTORY__ACCESSS_LELVEL", 3);
// define("EDIT_PERSONAL_INFO_ACCESSS_LELVEL", 2);
// define("APPOINTMENT_PAGE_ACCESSS_LELVEL", 1);
// define("SET_APPOINTMENT_PAGE_ACCESSS_LELVEL", 2);
// define("SEARCH_RESULTS_PAGE_ACCESSS_LELVEL", 3);
// define("ADD_TREATMENT_MEDICATION_PAGE_ACCESSS_LELVEL", 3);
// define("ADD_MEDICAL_HISTORY_PAGE_ACCESSS_LELVEL", 3);
// define("ABOUT_PAGE_ACCESSS_LELVEL", 1);


# ---------------------------------------------------------------------
# functino checking access here
# ---------------------------------------------------------------------

hasAccess(get_user_id_from_session(), PAGE_ACCESS_LEVEL);

// ----------------------------------------------------------------------------
//  Functions
// ----------------------------------------------------------------------------

function hasAccess($userId, $pageAccessLevel){

    $userAccessLevel = getAccessPrivilegeFromDB($userId);

    if($userAccessLevel == null) {
        header('Location: 404.php');
    }


    # if the user dooesnt have access then deny then access
    if($userAccessLevel < $pageAccessLevel){
        header('Location: access_denied.php');
    }

    return true;
}



function getAccessPrivilegeFromDB($id) {

    global $connect;

    # the prepare for update
    $stmt = $connect->prepare("CALL proc_get_access_level_by_id (?);");

    # bind string datatype to varaibles
    $stmt->bind_param("s", $id);

    # executing and fetching he rows
    $row = executeAndGetRowsFromSelectPreparedStatement($stmt);
    $stmt->close();

    #var_dump($connect->error);
    #die();

    if (array_key_exists('access_level', $row)){
        return $row['access_level'];
    }

    return null;
}

 ?>
