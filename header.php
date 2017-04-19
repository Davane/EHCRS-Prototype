<!DOCtype html>
<html lang="en">
<<<<<<< HEAD
<? require 'header-styles.php' ?>
=======
	<head>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="Garfield Gray"/>
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content=""/>
        <meta name="keywords" content="">
    	<title>HeathWise</title>
    	<link rel="icon" href="img/logo.png">
    	<link href="css/bootstrap.min.css" rel="stylesheet">
    	<link rel="stylesheet" type="text/css" href="css/styles.css">
    	<!--<link rel="stylesheet" type="text/css" href="css/animate.css">-->
    	<link rel="stylesheet" type="text/css" href="css/hover.css">
        <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">
        <!-- Main font -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
        <!-- Calendar -->
        <link rel='stylesheet' href='http://fullcalendar.io/js/fullcalendar-2.2.3/fullcalendar.css' />
	</head>

>>>>>>> origin/master
<body>
<nav class="navbar navbar-greyscale navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" style="margin-left: 15px" href="#">Health<b>Wise</b></a>
    </div>


    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav navbar-right">
		  <form action="search-results.php" method="post" class="navbar-form navbar-left" style='margin-right: 25px'>

			  <div class="input-group">
			       <input type="text" class="form-control" name="query" placeholder="Search by ID, Name, Email ...">
			       <span class="input-group-btn">
			 	 		<button type="submit" class="btn btn-default">Search</button>
			       </span>
			     </div><!-- /input-group -->

  		</form>

        <li><a href="#">My Profile</a></li>
        <!-- <li><a href="set-appointment.php" style="margin-right: 25px" >Set Appointment</a></li> -->

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="margin-right: 25px"> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Appoinments</a></li>
			<li><a href="#">Patient Registration</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="sign-out.php">Sign Out</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>



<!--



<!DOCtype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="Garfield Gray"/>
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content=""/>
        <meta name="keywords" content="">
    	<title>EHCS</title>
    	<link rel="icon" href="img/logo.png">
    	<link href="css/bootstrap.min.css" rel="stylesheet">
    	<link rel="stylesheet" type="text/css" href="css/styles.css">
    	<!--<link rel="stylesheet" type="text/css" href="css/animate.css">
    	<link rel="stylesheet" type="text/css" href="css/hover.css">
        <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">
        <!-- Main font
        <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
        <!-- Calendar -
        <link rel='stylesheet' href='http://fullcalendar.io/js/fullcalendar-2.2.3/fullcalendar.css' />
	</head>

<body>
<div class="container-fluid">
<<<<<<< HEAD
 <!-- Begin Navigation Container -->
        <nav class="navbar-xs navbar-greyscale navbar-fixed-top">
            <div class="container">
=======
 <!-- Begin Navigation Container --
        <nav class="navbar navbar-greyscale navbar-fixed-top">
            <div class="container" style="margin-top: 25px;">
>>>>>>> origin/master
                <div class="navbar-header">
                    <div onclick="navX(this)">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-bar-mobile-menu">
                            <span class="sr-only"></span>
                            <span class="icon-bar bar1"></span>
                            <span class="icon-bar bar3"></span>
                        </button>
                    </div>

<<<<<<< HEAD
                    <!--Logo-->
                    <a class="navbar-left" href="#">
                    <img src="img/logo.png" alt="logo" width="20px" style="margin-top: -4px">
                        &nbsp;&nbsp;Health<b>Wise</b></a>
                    
=======
                    <!--Logo--
                    <div class="navbar-brand-logo">
                        <a class="navbar-brand" href="#"><span>Health<b>Wise</b></span></a>
                    </div>
>>>>>>> origin/master
                </div>

                <div class="collapse navbar-collapse" id="nav-bar-mobile-menu">
                    <ul class="nav navbar-nav navbar-right navbar-header">
                        <li>
                            <form class="navbar-form" role="search">

                            	<div class="form-group">
                            		<div class="row">
                            			<div class="col-xs-12">

                                			<input type="text" class="form-control" id="ipt"
											placeholder="Search for Patient..." name="q">

                            			</div>
                            		</div>
                            	</div>

                            </form>
                        </li>
                        <!--<li class="avatar">
                            <div class="circle">

                                <img class="img-cirlce" src="img/avatar.png" alt="user-avatar" height="20px">-->
                                <li>                      
                                <a href="#" class="dropdown-toggle" id="menu1" data-toggle="dropdown"><span id="dp-style">
                                Dr. Davis
                                <span class="caret"></span></span></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Sign Out</a></li>
                                </ul>

                            </div>
    
                        </li>
                    </ul>
                </div>

            </div>
<<<<<<< HEAD
        </nav><!-- END NAVIGATION MENU -->
    </div> <!-- End Nav Main Container -->
        <!--Nav 2-->

        <div class="navbar navbar-green navbar-static-top">
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
            <ul class="nav navbar-nav">
                <li><a href="#">Item1</a></li>
                <li class="divider-vertical"></li>
                <li><a href="#about">Item2</a></li>
                <li class="divider-vertical"></li>
            </ul>
        </div>
    </div>
</div> <!-- End Nav 2 -->
    
<script type="text/javascript">
    document.getElementById('ipt').style.height="25px";
</script>

<? include 'footer.php' ?>
=======
        </nav><!-- END NAVIGATION MENU --
    </div> <!-- End Nav Main Container -- -->
>>>>>>> origin/master
