<?php

    $error = array();

    if(isset($_GET['x'], $_GET['code']) === true) {

        include_once 'core/patient/patient.inc.php';

        $email = trim($_GET['x']);
        $code = trim($_GET['code']);

        #echo $email . ' account activated, with code ' . $code;

        if (is_member_exist_by_email($email)) {

            if (is_code_and_user_valid($email, $code)) {

                if(!active_account_by_email($email)) {
                    $error['already'] = 'Account already activated';
                    #echo 'account already activated';
                }
            } else {
                $error['invalid'] = 'Invalid Information';
                #echo 'Invalid Information Provided';
            }

        } else {
            $error['incorrect'] = 'Email Incorrect';
            #echo 'email incorrect';
        }
    } else {
        $error['incorrect'] = 'Acount was not activated';

        #echo 'Acount was not activated';
    }



    include 'patient-header.php';
 ?>

 <div id="wrapper">
 	<div class="main-content-wrapper" id="p-info">
 		<div class="main-content">
            FIX THE HEADER : THIS HEADER SHOULD NOT SHOW UP ACTIVATION
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title"> <b>Account Activation</b></h4>
              </div>
              <div id="collapse4" class="panel-collapse">
                <div class="panel-body">
                    <?php
                    if (empty($error)){
                        $text = "Account Successfully Activated";
                        $type = 'text-info';
                    } else {
                        $text = reset($error);
                        $text = "Activation Failed: ".$text;
                        $type = 'text-danger';
                    }?>

                    <p class=<?php echo $type; ?>>
                        <?php echo $text; ?>
                    </p>

                    <p>Go to <a href="sign-up.php">Sign In</a> page</p>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php' ?>
