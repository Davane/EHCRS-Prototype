<?php

# this is escaping quotes, double qustes
# \n , \r, \t , null
function gen_sanitize_for_datebase($str){
    # needs databse connection
    global $connect;
    return $connect->real_escape_string($str);
}

# replace htlm special characters with ascii representation
function gen_sanitize_for_display($str){
    return htmlspecialchars($str, ENT_QUOTES);
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
        if (empty($value)){
            $ERRORS[$key_elelments[1]] = "Field cannot be empty";
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


?>
