<?php
    define('APP_RAN', 'APP_RAN');


    require_once 'session-validation.php';
    include_once 'core/init.php';

    $type = '';

    if(isset($_GET['type']) == 'reg'){

        $type = $_GET['type'];

    }

    is_session_started();


    include 'header.php';
?>

     <div id="wrapper">
     	<div class="main-content-wrapper" id="p-info">
     		<!-- <div class="main-content"> -->
                <div class="panel panel-default">
                  <!-- <div class="panel-heading">
                    <h4 class="panel-title"> <b>Account Activation</b></h4>
                  </div> -->
                  <div id="collapse4" class="panel-collapse">
                    <div class="panel-body">
                        <div class="center">
                            <!-- logo -->
                            <center>
                                <img src="img/tick-icon.png" class="img-responsive" alt="logo" width="60px" height="60px">
                                <p class="text-center">
                                    <h3 class="header-caption"><b>Registered</b></h3>
                                    <br>
                                    Patient '<b><?php
                                                if(isset($_SESSION['name'])){
                                                    echo get_value_from_session('name');
                                                    destroy_session_value('name');
                                                }?>

                                                </b>' was successfully Registered with an ID of '<b><?php

                                                if(isset($_SESSION['user'])){
                                                     echo get_value_from_session('user');
                                                     destroy_session_value('user');
                                                 }?></b>'
                                    <br>
                                    An Email was sent to you for you to activate your account
                                    <br><br><br>
                                    Go back to <a href="patient-registration.php">Registration Page</a>
                                </p>
                            </center>
                        </div>
                    </div>
                  </div>
                </div>
            <!-- </div> -->
        </div>
    </div>

    <?php include 'footer.php' ?>
