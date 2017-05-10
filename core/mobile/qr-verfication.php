<?php


require_once(dirname(__FILE__) . '/../init.php');

$command = isset($_POST['command']) ? $_POST['command'] : "";
$email   = isset($_POST['email']) ? $_POST['email'] : "";
$qr      = isset($_POST['qr']) ? $_POST['qr'] : "";


if($command === 'login_user') {

    $verified = changeUserLoginWithQrVerifivationStatus($email, $qr, '1') ? 'success' : 'failed';

} elseif ($command === 'login_user') {


}

// echo 'Email: ' . $email . ' QR: ' . $qr / ' verified: ' . $verified;
echo  $verified;


# ------------------------------------------------------------------------------
#   Functions
# ------------------------------------------------------------------------------

function changeUserLoginWithQrVerifivationStatus($email, $qr, $status){

    $email = gen_sanitize_for_datebase($email);
    $qr    = gen_sanitize_for_datebase($qr);

    global $connect;

    # the prepare for update
    $stmt = $connect->prepare("CALL proc_update_qr_login_status (?, ?, ?, @updated);");

    # bind string datatype to varaibles
    $stmt->bind_param("sss", $email, $qr, $status);

    # executing and fetching he rows
    $stmt->execute();

    echo $stmt->error;


    $select = $connect->query('SELECT @updated');
    $result = $select->fetch_assoc();

    return (bool)  $result['@updated'];
    //
    // if($stmt->affected_rows > 0) {
    //     $stmt->close();
    //     return true;
    // }
    //
    // return false;
}


// function validateQRCode($id, $qr){
//
//     // sanitize and update database
//     $id = gen_sanitize_for_datebase($id);
//     $qr = gen_sanitize_for_datebase($qr);
//
//     global $connect;
//
//     // the prepare for update
//     $stmt = $connect->prepare("CALL  (?, ?);");
//
//     // bind string datatype to varaibles
//     $stmt->bind_param("ss", $id, $qr);
//
//     #executing and fetching he rows
//     $row = executeAndGetRowsFromSelectPreparedStatement($stmt);
//     $stmt->close();
//
//     #var_dump($connect->error);
//     #die();
//
//     if (array_key_exists('exist', $row)){
//
//         $verified = (bool) $row['exist'];
//         // var_dump($verified);
//         # if successful
//         if ($verified) {
//             return true;
//         }
//     }
//     return false;
// }



 ?>
