<?php

	# checking to see whether the user is a patient or a physician
	$type_filter = array(
			'Patient' => 'Patient',
			'Medical' => 'Medical');

	$type = '';
	$error = array();

	# checking if the type of login was set
	if (!empty($_GET['type'])) {

		# checking if the type is appropriate
		if (in_array($_GET['type'], $type_filter)){

			$type = $_GET['type'];

			if (isset($_POST) && !empty($_POST)) {

				include_once 'core/patient/patient.inc.php';

				# 1. validate inputs (check if empty and if correct values)
				$items = array(
						'INT-medical_id-2147483648' => $_POST['medical_id'],
						'EMAIL-email-64'            => $_POST['email'],
						'PASSWORD-password-255'     => $_POST['password'] );

				$error = gen_validate_inputs($items);

				if (empty($error)){

					# 2. check if user exist
					if (is_member_exist($_POST['medical_id'])){
						# 3. is user active
						if (is_member_active($_POST['medical_id'])) {

							$sign_in = false;

							if ($type_filter['Patient'] == $type) {

								# 4. sign in patient and log
								$sign_in = sign_in_member($_POST['medical_id'], $_POST['email'], $_POST['password'], $type);

							} else if ($type_filter['Medical'] == $type) {

								# perform medical sign in
								echo "medical";
								$sign_in = sign_in_member($_POST['medical_id'], $_POST['email'], $_POST['password'], $type);;

							}


							if ($sign_in) {

								if(generate_and_send_verification_code_by_email($_POST['medical_id'])) {

									# 5. create seesions with encrypted id
									set_sign_in_session($_POST['medical_id'], $type, (string)time() /*timestamp*/);

									if(update_user_session($_POST['medical_id'], get_value_from_session(SESSION_ID))){

										header('Location: login-verification.php');
									}
								}

							} else {
								$error['sign_failed'] = 'Incorrect Credentials';
							}

						} else {

								# Account isnt Active
								$error['account_status'] = 'Your account is not active,
															please contact adminsitrator';
						}


					} else {

						# Account doesnt Exist
						$error['account_exist'] = 'Your account wasn\'t found,
						 						  please contact adminsitrator';

					}

				} else {
					#var_dump($error);
					#Errors
				}
			}
		}
	}


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
				<img src="img/logo.png" class="img-responsive" alt="logo" width="60px" height="60px">
				<br>
				<p class="text-center">
					<h4 class="header-caption">SIGN IN
						<?php
							# Choosing what to print beside the sign in
							//var_dump($_GET);
							if (!empty($_GET)){
								echo in_array($_GET['type'], $type_filter) ? " AS A ".strtoupper($type === $type_filter['Medical'] ? 'Pyhsician' : $type) : " ";
							}
						?>
						 </h4>
					Hello there, sign in and start managing your <a href="sign-up.php?type=<?php echo $type_filter['Patient']; ?>">Patient</a>
					or <a href="sign-up.php?type=<?php echo $type_filter['Medical']; ?>">Physician</a>
				</p>
			</center>

		<?php
			if ($type !== '') {
		?>
			<!-- sign up form -->
			<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">

				<div class="row">
					<div class="col-md-12">

						<?php

							# printing if the account is not active error
							if(array_key_exists('account_status',$error)){
								echo output_error($error['account_status']);
								echo '<br>';
							}

							# printing if the account exist error
							if(array_key_exists('account_exist',$error)){
								echo output_error($error['account_exist']);
								echo '<br>';
							}

							# printing if the account exist error
							if(array_key_exists('sign_failed',$error)){
								echo output_error($error['sign_failed']);
								echo '<br>';
							}

						?>

						<small class="login-fade">login</small>
							<?php
								if(array_key_exists('medical_id',$error)){
									echo output_error($error['medical_id']);
								}
							?><br>
						<input type="text" name="medical_id" id="medical_id" value="<?php echo isset($_POST['medical_id']) ? $_POST['medical_id'] : ''; ?>" placeholder="<?php echo $type ?> ID" class="form-control" required>

					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php
							if(array_key_exists('email',$error)){
								echo output_error($error['email']);
							}
						?>
			  			<input type="email" name="email" id="email"  value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" placeholder="Enter email" class="form-control" required>
			  		</div>
			  	</div>
			  	<div class="row">
			  		<div class="col-md-12">
						<?php
							if(array_key_exists('password', $error)){
								echo output_error($error['password']);
							}
						?>
			  			<input type="password" name="password" placeholder="Enter your password" class="form-control" required>
			  		</div>
			  	</div>
			  	<div class="row">
			  		<div class="col-md-12 col-xs-offset-0">
			  			<button type="submit" name="submit" value="submit" class="btn btn-send btn-block">Sign In Now  <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
			  		</div>
			  		<br><br><br>
					<?php if (isset($_GET['type']) && $_GET['type'] === 'Medical') { ?>
			  		<center>
			  			<small>Would you like to do an <a href="">Emergency Sign in</a></small>
			  		</center>
					<?php } ?>
			  	</div>

			</form>

		<?php } ?> <!-- end iF -->

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
