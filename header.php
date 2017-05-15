<!DOCtype html>
<html lang="en">
<?php require 'header-styles.php' ?>

<body>
<div class="container-fluid">
 <!-- Begin Navigation Container -->
        <nav class="navbar-xs navbar-greyscale navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <div onclick="navX(this)">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-bar-mobile-menu">
                            <span class="sr-only"></span>
                            <span class="icon-bar bar1"></span>
                            <span class="icon-bar bar3"></span>
                        </button>
                    </div>

                    <!--Logo-->
                    <div class="nav-logo">
                        <a class="navbar-left" href="index.php">
                        <img src="img/logo.png" alt="logo" width="20px" >
                            &nbsp;&nbsp;Health<b>Wise</b></a>
                    </div>

                </div>

                <div class="collapse navbar-collapse" id="nav-bar-mobile-menu">
                    <ul class="nav navbar-nav navbar-right navbar-header">
                        <li>
                            <form action="https://172.20.10.2/~davanedavis/EHCRS-Prototype/search-results.php" method="POST" class="navbar-form" role="search">
                            	<div class="form-group">
                            		<div class="row">
                            			<div class="col-xs-12">

                                			<input type="text" name="query" class="form-control" id="ipt" placeholder="Search for Patient...">

                            			</div>
                            		</div>
                            	</div>

                            </form>
                        </li>
                                <li>
                                <a href="#" class="dropdown-toggle" id="menu1" data-toggle="dropdown">
                                    <span id="dp-style">
                                    user
                                        <span class="caret"></span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1" id="signout-on-small">
                                  <li><a href="about.php">About</a></li>
                                  <li role="presentation"><a role="menuitem" tabindex="-1" href="https://172.20.10.2/~davanedavis/EHCRS-Prototype/sign-out.php">
                                  <span style="color:#e7604a;">Sign Out
                                  </span></a></li>
                                </ul>
                                </li>
                    </ul>
                </div>

            </div>
        </nav><!-- END NAVIGATION MENU -->
    </div> <!-- End Nav Main Container -->
        <!--Nav 2-->
<div class="visible-lg">
<nav class="navbar navbar-green navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="navbar-brand logo"></div>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav ">
                <li class="hvr-overline-reveal-blue"><a href="https://172.20.10.2/~davanedavis/EHCRS-Prototype/index.php">DashBoard</a></li>
                <li class="divider-vertical"></li>
                <!-- <li class="hvr-overline-reveal-blue"><a href="https://172.20.10.2/~davanedavis/EHCRS-Prototype/patient-registration.php">Register Pateint</a></li> -->
                <li class="divider-vertical"></li>
                <!-- <li class="hvr-overline-reveal-blue"><a href="https://172.20.10.2/~davanedavis/EHCRS-Prototype/appointment.php">Appointments</a></li> -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Appoinments <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="https://172.20.10.2/~davanedavis/EHCRS-Prototype/appointment.php">View Appoinments</a></li>
                    <li><a href="https://172.20.10.2/~davanedavis/EHCRS-Prototype/set-appointment.php">Set Appointment</a></li>
                  </ul>
                </li>

                <li class="divider-vertical"></li>
                <!-- <li class="hvr-overline-reveal-blue"><a href="https://172.20.10.2/~davanedavis/EHCRS-Prototype/Patient">Menu-Item4</a></li> -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Patient <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="https://172.20.10.2/~davanedavis/EHCRS-Prototype/patient-registration.php">Register Patient</a></li>
                    <li><a href="https://172.20.10.2/~davanedavis/EHCRS-Prototype/search-results.php">Find Patient</a></li>
                    <li role="separator" class="divider"></li>
                    <!-- <li><a href="https://172.20.10.2/~davanedavis/EHCRS-Prototype/edit-personal-info.php">Update Patient Personal Info</a></li> -->
                    <li><a href="https://172.20.10.2/~davanedavis/EHCRS-Prototype/add-medical-history.php">Add Patient Condtion</a></li>
                  </ul>
                </li>
                <li class="divider-vertical"></li>
            </ul>
        </div>
    </div>
</nav> <!-- End Nav 2 -->
</div>

<script type="text/javascript">
    document.getElementById('ipt').style.height="25px";
</script>
