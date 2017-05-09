<?php

# SESSION

function set_sign_in_session($id, $type, $time) {
    is_session_started();
    $_SESSION[SESSION_ID] = password_hash((string)$time . (string)$id, PASSWORD_DEFAULT);
    $_SESSION[USER_KEY] = $id;
    $_SESSION[USER_TYPE] = $type;
    $_SESSION[USER_TIMESTAMP] = $time;
    $_SESSION[TIMESTAMP_CREATED] = $time;

}

function set_session($key, $value){
    is_session_started();
    $_SESSION[$key] = $value;
}


function is_session_started(){

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

}

function is_user_verified() {
    is_session_started();
     if(isset($_SESSION[USER_VERIFIED])){
         if($_SESSION[USER_VERIFIED] === 'true'){
             return true;
         }
     }

     return false;
 }

 function is_user_qr_verified() {
     is_session_started();
      if(isset($_SESSION[USER_QR_VERIFIED])){
          if($_SESSION[USER_QR_VERIFIED] === 'true'){
              return true;
          }
      }

      return false;
  }


function get_user_id_from_session(){
    is_session_started();
    return isset($_SESSION[USER_KEY]) ? $_SESSION[USER_KEY] : null;
}

function get_current_user_type() {
    is_session_started();
    return isset($_SESSION[USER_TYPE]) ? $_SESSION[USER_TYPE] : null;
}


function get_session_id() {
    is_session_started();
    return isset($_SESSION[SESSION_ID]) ? $_SESSION[SESSION_ID] : null;
}

function get_value_from_session($key){
    is_session_started();
    return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
}


function destroy_session(){
    is_session_started();
    session_unset();
    session_destroy();
}

function destroy_session_value($key){
    is_session_started();
    unset($_SESSION[$key]);
    #session_destroy();
}





# MAIL

function gen_send_mail($to, $subject, $message){

    // In case any of our lines are larger than 70 characters, we should use wordwrap()
    $message = wordwrap($message, 70, "\r\n");
    mail($to, $subject, $message /*, $headers*/);
}

# VALIDATION


function is_empty_set_default($value, $default){
    if(empty(trim($value))) {
        $value = $default;
    }

    return $value;
}

function is_all_empty(){
    foreach(func_get_args() as $arg) {
      if (!empty(trim($arg))) {
          return false;
      }
   }

   return true;
}

function gen_sanitize_list_for_database() {

    $sanitize_values = array();

    foreach (func_get_args() as $key => $value) {

        if (!empty(trim($value))) {
            $sanitize_values[$key] = gen_sanitize_for_display(gen_sanitize_for_datebase($value));
            #echo $key . ' ' . $value;
        }

    }

    return $sanitize_values;

}


# this is escaping quotes, double qustes
# \n , \r, \t , null
function gen_sanitize_for_datebase($str){
    # needs databse connection
    global $connect;
    return gen_sanitize_for_display($connect->real_escape_string($str));
}

# replace htlm special characters with ascii representation
function gen_sanitize_for_display($str){
    return htmlentities($str, ENT_QUOTES);
}

# removin html tags
function gen_strip_tags_for_display($str) {
    return strip_tags($str /*, '<p><a>'*/);
}

function gen_validate_inputs($inputs) {
    #unset($ERRORS);
    global $ERRORS;

    # removing all existing values from the error list
    foreach ($inputs as $key => $value) {

        $key_elelments = explode("-", $key);

        # First element of '$key_elelments' is the type of field
        # Second element of '$key_elelments' is the input field key
        # Third element of '$key_elelments' is the max length of field

        #check if value is Empty
        if (empty($value)) {
            if (count($key_elelments) > 3) {
                if ($key_elelments[3] === 'required') {
                    $ERRORS[$key_elelments[1]] = "field cannot be empty";
                }
            }
        } else if (strlen($value) > (int) $key_elelments[2]){
            $ERRORS[$key_elelments[1]] = "Text too long";
        } else {

            switch ($key_elelments[0]) {
                case 'INT':

                        if(!filter_var($value, FILTER_VALIDATE_INT)) {
                            $ERRORS[$key_elelments[1]] = "Not an integer value";
                        }

                    break;

                case 'EMAIL':

                        if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            $ERRORS[$key_elelments[1]] = 'Invalid E-mail';
                        }

                    break;

                case 'PASSWORD':
                        # can check password strength
                    break;

                case 'URL':
                        if(!filter_var($value, FILTER_VALIDATE_URL)) {
                            $ERRORS[$key_elelments[1]] = 'Invalid URL';
                        }
                    break;

                default:

                    break;
            }
        }

    }

    return $ERRORS;

}

function output_error($error){
    return "<small class=\"text-danger\">". $error ."</small>";
}

function output_error_by_key($key, $error){

    if(array_key_exists($key, $error)){
        // return "<small class=\"text-danger\">". $error[$key] ."</small> <br>";

        return '<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    '. $error[$key]  .'
                </div>';
    }


}

function refill_input_fields($key){
    #isset($_POST['medical_id']) ? $_POST['medical_id'] : ''
    return isset($_POST[$key]) ? $_POST[$key] : '';
}


function replace_url($original, $replace_with, $str){
    return str_replace($original, $replace_with, $str);
}

function get_pro_pic($p_url)
{
    $url = 'http://www.freeiconspng.com/uploads/profile-icon-9.png';
    if  ($p_url['pic_url'] !== null) {
        $url = replace_url("/Users/davanedavis/Sites/", "http://localhost/~davanedavis/", $p_url['pic_url']);
    }

    return $url;
}
?>
