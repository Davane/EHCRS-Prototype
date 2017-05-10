<?php

    include 'core/init.php';
    $reason = get_value_from_session(REASON);

    include 'patient-header.php';

?>

<div class="container content">
         <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"> <b>ACCOUNT SIGN IN REQUIRED</b></h4>
          </div>
          <div id="collapse4" class="panel-collapse">
            <div class="panel-body">
                <?php if($reason !== null) {

                    if ($reason === 'timeout') {
                        $reason = 'Your account has logged out automatically due to inactivity, in order to continue you has sign in again';
                    } else if ($reason === 'no-user' ) {
                        $reason = 'Try logging in before attempting to do this action';
                    } else {
                        $reason = 'Sign in before you can continue';
                    }

                } else {
                       $reason = 'Sign in before you can continue';
                }?>
                <p><?php echo $reason ?></p>
                <p>Go to <a href="https://localhost/~davanedavis/EHCRS-Prototype/sign-out.php">Sign In</a> page</p>
            </div>
          </div>
        </div>
</div>
<div class="container full-height">

</div>

<?php include 'footer.php' ?>
