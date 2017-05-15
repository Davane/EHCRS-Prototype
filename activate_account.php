<?php
define('APP_RAN', 'APP_RAN');


include_once 'core/patient/patient.inc.php';


// var_dump($_POST);
$error = array();
$success = null;

if (!empty($_POST)) {

    // echo "set password for account";

    $success = false;

    if(!empty($_POST['password']) && !empty($_POST['password'])) {
        if ($_POST['password'] === $_POST['repassword']) {
            // echo "password ok";
            $success = update_password($_POST['email'], $_POST['password']);
        } else {
            $error["perror"] = "Passsword does not match";
        }
    } else {
        $error["perror"] = "Passsword cannont be empty";
    }

}

if ($success === null) {

    // echo "validating account";
    if(isset($_GET['x'], $_GET['code']) === true) {

        $email = trim($_GET['x']);
        $code  = trim($_GET['code']);

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
            $error['incorrect'] = 'Incorrect Information';
            #echo 'email incorrect';
        }
    } else {
        $error['incorrect'] = 'Acount was not activated';
        #echo 'Acount was not activated';
    }
}


include 'patient-header.php';
 ?>

<div class="container content">

        <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title"> <b>Account Activation</b></h4>
              </div>
              <div id="collapse4" class="panel-collapse">
                <div class="panel-body">
                    <?php

                    // var_dump($error);
                    if (empty($error)){
                        if($success === null) {
                            $text = "Account Successfully Activated";
                            $type = 'alert-info';
                        } else {

                            if ($success) {
                                $text = "Password Set Successfully";
                                $type = 'alert-success';
                            } else {
                                $text = "Password was no set.";
                                $type = 'alert-danger';
                            }
                        }
                    ?>

                    <!-- <div class="row">
                       <hr>
                       <p style="margin-left: 16px;">To create a password to access your account.</p>
                       <div class="form-group">
                           <form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">

                               <div class="col-sm-12">
                                   <input type="hidden" class="form-control" name="email" value="<?php echo isset($_GET['x']) ? $_GET['x'] : ""?>">
                                   <input type="text" class="form-control" name="password" placeholder="Password" value="<?php isset($_POST['password']) ? $_POST['password'] : ""?>">
                               </div>
                               <div class="col-sm-12">
                                   <input type="text" class="form-control" name="repassword" placeholder="Re-Type Password" value="<?php isset($_POST['repassword']) ? $_POST['repassword'] : ""?>">
                               </div>
                               <div  style="float: right; margin-right: 16px">
                                   <button type="submit" class="btn btn-primary">Set Password</button>
                               </div>
                           </form>
                       </div>

                   </div>
                   <hr> -->

                    <?php

                    } else {
                        $text = reset($error);
                        $text = "Activation Failed: ".$text;
                        $type = 'alert-danger';
                    }?>


                    <div class="alert <?php echo $type ?> alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo $text; ?>
                    </div>

                    <?php if (empty($error) || array_key_exists('perror',$error)) { ?>
                        <div class="row">
                            <hr>
                            <p style="margin-left: 16px;">To create a password to access your account.</p>
                            <div class="form-group">
                                <form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">

                                    <div class="col-sm-12">
                                        <input type="hidden" class="form-control" name="email" value="<?php echo isset($_GET['x']) ? $_GET['x'] : ""?>">
                                        <input type="text" class="form-control" name="password" placeholder="Password" value="<?php isset($_POST['password']) ? $_POST['password'] : ""?>">
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="repassword" placeholder="Re-Type Password" value="<?php isset($_POST['repassword']) ? $_POST['repassword'] : ""?>">
                                    </div>
                                    <div  style="float: right; margin-right: 16px">
                                        <button type="submit" class="btn btn-primary">Set Password</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <hr>

                    <?php } ?>

                    <!-- <div class="row">
                        <hr>
                        <p style="margin-left: 16px;">To create a password to access your account.</p>
                        <div class="form-group">
                            <form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">

                                <div class="col-sm-12">
                                    <input type="hidden" class="form-control" name="email" value="<?php echo isset($_GET['x']) ? $_GET['x'] : ""?>">
                                    <input type="text" class="form-control" name="password" placeholder="Password" value="<?php isset($_POST['password']) ? $_POST['password'] : ""?>">
                                </div>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="repassword" placeholder="Re-Type Password" value="<?php isset($_POST['repassword']) ? $_POST['repassword'] : ""?>">
                                </div>
                                <div  style="float: right; margin-right: 16px">
                                    <button type="submit" class="btn btn-primary">Set Password</button>
                                </div>
                            </form>
                        </div>

                    </div>
                    <hr> -->


                    <p>Go to <a href="sign-up.php">Sign In</a> page</p>
                </div>
              </div>

    </div>
</div>
<div class="container full-height">

</div>

<?php include 'footer.php' ?>
