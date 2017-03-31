<?php

    require_once 'core/patient/patient.inc.php';

    if (isset($_POST['code'])) {
        if(!empty($_POST['code'])){

            #echo "SET " . $_POST['code'];

            $code = $_POST['code'];
            # read from session to get ID;

            if(confirm_verification('303', $code)) {
                echo 'confirmed';

            } else  {
                echo 'not confirmed';
            }
        }

    } else if (isset($_GET['send'])) {
        
            # send email again
            echo 'send again';
            unset($_GET['send']);

            if(generate_and_send_verification_code_by_email('303')) {
                echo 'sent';
            }

    } else {
        echo 'Not Set';
    }
    # 5. create seesions with encrypted id

?>


<!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content Type" content="text/html"; charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="Garfield Gray">
		<link rel="icon" href="img/logo.png">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<title>EHR System</title>
		<link href="https://fonts.googleapis.com/css?family=Roboto:700" rel="stylesheet">
		<link href="font-awesome/css/font-awesome.css" rel="stylesheet">
		<link href="css/hover.css" rel="stylesheet">

		<style>

			body {
				background: url(/dev/EHR/img/su-bg.jpg) no-repeat center center fixed;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
	  		}

	  		input:not([type]), input[type=text], input[type=password],
			input[type=email], input[type=url], input[type=time],
			input[type=date], input[type=datetime], input[type=datetime-local],
			input[type=tel], input[type=number], input[type=search],
			input[type="telephone"],
			textarea.materialize-textarea {
			    background-color: transparent;
			    border: none;
			    border-bottom: 1px solid #00233f;
			    border-radius: 0;
			    outline: none;
			    height: 3rem;

			    font-size: 1.3rem;
			    margin: 0 0 20px 0;
			    padding: 0;
			    box-shadow: none;
			    box-sizing: content-box;
			    transition: all 0.3s;
			}
			input {
			    line-height: normal;
			}

			input::-webkit-input-placeholder {
				color: #14213c !important;
				opacity: 0.5;
			}

			input:-moz-placeholder { /* Firefox 18- */
				color: #14213c !important;
				opacity: 0.5;
			}

			input::-moz-placeholder {  /* Firefox 19+ */
				color: #14213c !important;
				opacity: 0.5;
			}

			input:-ms-input-placeholder {
				color: #14213c !important;
				opacity: 0.5;
			}

			.btn-send {
			    background-color: white;
			    border-style: solid;
			    border-width: thin;
			    border-color: #00233f;
			    border-radius: 100px;
			    padding: 5px;
			    color: #14213c;
			    letter-spacing: 1px;
			}

			.fa-long-arrow-right {
				color: #14213c;
			}

			.center {
			    margin: 10% auto 0px;
			    width: 30%;
			    padding: 10px;
			}

			.header-caption {
				font-family: 'Roboto', sans-serif;
				color: #14213c;
			}

			.login-fade {
				color: #14213c;
				font-size: 11px;
			}

			footer {
				position: absolute;
				right: 0;
				bottom: 0;
				left: 0;
				padding: 1rem;
				text-align: center;
			}

			@media screen and (max-width: 480px) {
			    .center {
			    	margin: 30% auto 0px;
			    	padding: 0px;
			    	width: 80%;
			  	}
			}

			@media screen and (max-width: 780px) {
			    .center {
			    	margin: 30% auto 0px;
			    	padding: 0px;
			    	width: 50%;
			  	}
			}
		</style>


	</head>

	<body>
    	<div class="container">
    		<div class="container">

    			<div class="center">
        			<!-- logo -->
        			<center>
        				<img src="img/secure-flat.png" class="img-responsive" alt="logo" width="60px" height="60px">
        				<br>
        				<p class="text-center">
        					<h4 class="header-caption">LOGIN VERIFICATION</h4>
        					A confirmation code was sent to your email, if you did not reveice it, click here to <a href="login_verification.php?send=true">Send Again</a>
        				</p>
        			</center>
        			<!-- sign up form -->
        			<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
        				<br>
                        <div class="row">
        					<div class="col-md-12">
                                <center>
        						    <p class="lead">Enter Code Here</p>
                                </center>

        						<input type="text" name="code" id="code" placeholder="" class="form-control" required>
        					</div>
        				</div>
                        <br>
        			  	<div class="row">
        			  		<div class="col-md-12 col-xs-offset-0">
        			  			<button type="submit" name="submit" value="submit" class="btn btn-send btn-block"> Continue </button>
        			  		</div>
        			  	</div>

        			</form>

    			</div><!--End Center-->

    		</div>

    		<footer>
        		<div class="container">
        			<center>
        	        		<p>&nbsp;&copy; <?php date_default_timezone_set('Jamaica'); echo date("Y");?> EHR System</p>
        	       	</center>
    	       	</div>
            </footer>
        </div>


		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
