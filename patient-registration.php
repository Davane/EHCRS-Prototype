
<?php
// var_dump($_POST);
// var_dump($_FILES);

require_once 'core/physician/physician.inc.php';
// require_once 'session-validation.php';

is_session_started();

$error = array();



// $error = register_patient($error);

# verify the physician infromation entered into the modal
if(isset($_POST['medical_id']) && isset($_POST['password'])){


	$id = $_POST['medical_id'];
	$passw = $_POST['password'];

	# echo $passw;
	# var_dump(get_user_id_from_session());

	# check the session medical id with the entered medical id
	if ($id === get_user_id_from_session()) {

		if (verify_user_and_password($id, $passw)){
			// echo "Vefired";
			$error = register_patient($error);
		} else {
			// echo "Credentials wrong";
			$error['credentials'] = "Credentials wrong";
		}

	} else {
		// echo " Credentials wrong";
		$error['credentials'] = "Credentials wrong";
	}
}



function register_patient($error) {

	# Check if user has been logged in and verfied

	# when registered generate medical ID for user

	# pateint need to set password after they are registered by physician


	if (isset($_POST['firstName']) && isset($_POST['lastName'])
			&& isset($_POST['maidenName']) && isset($_POST['condition'])) {

		# validating the user inputs
		$items = array(
				'TEXT-firstName-26-required'  => $_POST['firstName'],
				'TEXT-lastName-26-required'   => $_POST['lastName'],
				'TEXT-maidenName-26-required' => $_POST['maidenName'],
				'TEXT-middleName-26' => $_POST['middleName'],
				'TEXT-petName-26'    => $_POST['petName'],
				'EMAIL-email-64-required'     => $_POST['email'],
				'TEXT-trn-15'        => $_POST['trn'],
				'TEXT-dob-26'        => $_POST['dob'],
				'INT-age-26'         => $_POST['age'],
				'TEXT-gender-5'       => $_POST['gender'],
				'TEXT-telephone-15'  => $_POST['telephone'],
				'TEXT-religion-18'   => $_POST['religion'],
				'TEXT-union-12'      => $_POST['union'],
				'TEXT-street_name-64' => $_POST['street_name'],
				'TEXT-parish-16'      => $_POST['parish'],
				'TEXT-kin-54'         => $_POST['kin'],
				'TEXT-relationship-12'  => $_POST['relationship'],
				'TEXT-mother_name-24'   => $_POST['mother_name'],
				'TEXT-father_name-24'   => $_POST['father_name'],
				'TEXT-employer_name-45' => $_POST['employer_name'],
				'TEXT-emp_address-26'   => $_POST['emp_address'],
				'TEXT-emp_parish-26'    => $_POST['emp_parish'],
				'TEXT-emp_tel-15'       => $_POST['emp_tel'],
				'TEXT-occupation-48'    => $_POST['occupation'],
				'TEXT-condition-128-required' => $_POST['condition'],
				'TEXT-height-10'         => $_POST['height'],
				'TEXT-weight-10'         => $_POST['weight'],
				'TEXT-bp-10'            => $_POST['bp'],
				'TEXT-temp-10'          => $_POST['temp'],
				'TEXT-pulse-10'         => $_POST['pulse'],
				'TEXT-resp-10'          => $_POST['resp'],
				'TEXT-urinalysis-10'    => $_POST['urinalysis']);

		$error = gen_validate_inputs($items);

		#var_dump($error);

		if (empty($error)) {

			include_once 'core/patient/patient.inc.php';

			# register pateint
			$error = pateint_registration_process($_POST['firstName'], $_POST['middleName'], $_POST['lastName'],
										 $_POST['maidenName'],$_POST['email'], $_POST['trn'], 'password',
										 $_POST['gender'], $_POST['dob'], $_POST['telephone'], $_POST['age'], $_POST['street_name'],
										 $_POST['parish'], ''/*country*/, '0'/*insurance_id*/, $_POST['employer_name'], $_POST['occupation'],
										 $_POST['emp_tel'], '' /*Policy*/, $_POST['emp_address'], $_POST['emp_parish'],
										  ''/*employer_country*/, $_POST['petName'], $_POST['kin'], $_POST['relationship'], $_POST['religion'],
										 $_POST['father_name'],	$_POST['mother_name'], ''/*birth_place*/, ''/*birth_parish*/, $_POST['union'],
										 $_POST['height'], $_POST['weight'], $_POST['temp'], $_POST['pulse'],$_POST['resp'], $_POST['bp'],
										 $_POST['urinalysis'], $_POST['condition']);


		}

	} else {
		#$error['required_field'] = "Enter the required fields";
	}

	return $error;
}

include 'header.php';

?>


<div class="container content">

			<div class="panel panel-default">
			  <div class="panel-body">
			  <div class="container-fluid">
			  <span><h3><b>Patient Registration Form</b></h3></span>


<!-- TEST IF REGISTRATON IS WORKING  -->

			  <p><?php if(isset($error['error'])) { echo output_error_by_key('error', $error); } ?></p>
			  <hr style="width: 99%;color:black">
			  <?php if (!empty($error)) {
					  echo output_error_by_key('credentials', $error).'<br>';
					 } ?>

			  <p><b>Names  </b>
				  <?php if (!empty($error)) {
 				  	echo output_error_by_key('required_field', $error);
	 			  } ?>
			  </p>


			  <form enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
				<div class="row">

					<div class="form-group">
					    <div class="col-md-4 col-xs-12">
					    	<input type="name" class="form-control" name="firstName" placeholder="First Name (Required)" required>
							<?php if (!empty($error)) {
			   				  echo output_error_by_key('firstName', $error).'<br>';
			   			  } ?>

					    </div>
					    <div class="col-md-4 col-xs-12">
					    	<input type="name" class="form-control" name="middleName" placeholder="Middle Name">
					    </div>
					    <div class="col-md-4 col-xs-12">
					    	<input type="name" class="form-control" name="lastName" placeholder="Last Name (Required)" required>
							<?php if (!empty($error)) {
							  echo output_error_by_key('lastName', $error).'<br>';
							} ?>
					    </div>
					 </div>
				</div>
				<div class="row">

					<div class="form-group">
					    <div class="col-md-6 col-xs-12">
					    	<input type="name" class="form-control" name="maidenName" placeholder="Maiden Name (Required)" required>
							<?php if (!empty($error)) {
							  echo output_error_by_key('maidenName', $error).'<br>';
							} ?>
					    </div>
					    <div class="col-md-6 col-xs-12">
					    	<input type="name" class="form-control" name="petName" placeholder="Pet Name">
					    </div>
					 </div>

				</div>

				<br>

				<div class="row">
					<div class="form-group">
						<div class="col-md-6 col-xs-12">
							<input type="email" class="form-control" name="email" placeholder="Email (Required)" required>
							<?php if (!empty($error)) {
							  echo output_error_by_key('email', $error).'<br>';
							} ?>
						</div>
						<div class="col-md-6 col-xs-12">
							<input type="text" class="form-control" name="trn" placeholder="TRN" >
						</div>

					 </div>
				</div>

				<br>

				<div class="row">
					<div class="form-group">
					    <div class="col-md-4 col-xs-4">
					    	<input type="date" class="form-control" name="dob">
					    </div>
					    <div class="col-md-4 col-xs-4">
					    	<input type="number" class="form-control" name="age" placeholder="Age">
					    </div>
						<div class="col-md-4 col-xs-4">
						   <!-- <input type="text" class="form-control" name="gender" placeholder="Gender"> -->
						   <select name="gender" class="form-control custom-select">
							  <option value="male" selected>Male</option>
							  <option value="female">Female</option>
						  </select>
					   </div>
					</div>
				</div>

				<div class="row">
					<div class="form-group">
					    <div class="col-md-4 col-xs-12">
					    	<input type="tel" class="form-control" name="telephone" placeholder="Telephone">
					    </div>
					    <div class="col-md-4 col-xs-12">
					    	<input type="text" class="form-control" name="religion" placeholder="Religion">
					    </div>
					    <div class="col-md-4 col-xs-12">
					    	<input type="text" class="form-control" name="union" placeholder="Union">
					    </div>
					 </div>

				</div>

				<br>

				<p><b>Address</b></p>

				<div class="row">

					<div class="form-group">
					    <div class="col-md-8 col-xs-12">
					    	<input type="text" class="form-control" name="street_name" placeholder="Street Name">
					    </div>
					    <div class="col-md-4 col-xs-12">
					    	<!-- <input type="text" class="form-control" name="parish" placeholder="Parish" > -->
							<select name='parish' class="form-control custom-select">
								<option value="Kingston" selected>Kingston</option>
								 <option value="Portland" >Portland</option>
								 <option value="Clarendon">Clarendon</option>
								 <option value="Manchester">Manchester</option>
								 <option value="Trelawny">Trelawny</option>
								 <option value="Westmorland">Westmorland</option>
								 <option value="Hanover">Hanover</option>
								 <option value="St. Elizabeth">St. Elizabeth</option>
								 <option value="St. James" >St. James</option>
								 <option value="St. Ann">St. Ann</option>
								 <option value="St. Thomas" >St. Thomas</option>
								 <option value="St. Mary" >St. Mary</option>
								 <option value="St. Andrew" >St. Andrew</option>
								 <option value="St. Catherine">St. Catherine</option>
						   </select>
					    </div>
					 </div>

				</div>
				<br>
				<p><b>Emergency Contact Information</b></p>

				<div class="row">

					<div class="form-group">
					    <div class="col-md-4 col-xs-12">
					    	<input type="text" class="form-control" name="kin" placeholder="Next of Kin">
					    </div>
					    <div class="col-md-4 col-xs-12">
					    	<input type="text" class="form-control" name="relationship" placeholder="Relationship" >
					    </div>
					    <div class="col-md-4 col-xs-12">
					    	<input type="tel" class="form-control" name="em_telephone" placeholder="Tel No.">
					    </div>
					 </div>

				</div>

				<div class="row">

					<div class="form-group">
					    <div class="col-md-6 col-xs-12">
					    	<input type="text" class="form-control" name="mother_name" placeholder="Mother's Name">
					    </div>
					    <div class="col-md-6 col-xs-12">
					    	<input type="text" class="form-control" name="father_name" placeholder="Father's Name" >
					    </div>
					 </div>

				</div>
				<br>

				<p><b>Employment Information</b></p>

				<div class="row">

					<div class="form-group">
					    <div class="col-md-12 col-xs-12">
					    	<input type="text" class="form-control" name="employer_name" placeholder="Name of Employer">
					    </div>
					 </div>

				</div>

				<div class="row">

					<div class="form-group">
					    <div class="col-md-8 col-xs-12">
					    	<input type="address" class="form-control" name="emp_address" placeholder="Address (Street Name)">
					    </div>
					    <div class="col-md-4 col-xs-12">
					    	<!-- <input type="text" class="form-control" name="emp_parish" placeholder="Parish" > -->
							<select name="emp_parish" class="form-control custom-select">
								<option value="Kingston" selected>Kingston</option>
								 <option value="Portland" >Portland</option>
								 <option value="Clarendon">Clarendon</option>
								 <option value="Manchester">Manchester</option>
								 <option value="Trelawny">Trelawny</option>
								 <option value="Westmorland">Westmorland</option>
								 <option value="Hanover">Hanover</option>
								 <option value="St. Elizabeth">St. Elizabeth</option>
								 <option value="St. James" >St. James</option>
								 <option value="St. Ann">St. Ann</option>
								 <option value="St. Thomas" >St. Thomas</option>
								 <option value="St. Mary" >St. Mary</option>
								 <option value="St. Andrew" >St. Andrew</option>
								 <option value="St. Catherine">St. Catherine</option>

						   </select>
					    </div>
					 </div>

				</div>

				<div class="row">

					<div class="form-group">
					    <div class="col-md-7 col-xs-12">
					    	<input type="tel" class="form-control" name="emp_tel" placeholder="Tel No.">
					    </div>
					    <div class="col-md-5 col-xs-12">
					    	<input type="text" class="form-control" name="occupation" placeholder="Occupation" >
					    </div>
					 </div>

				</div>
				<br>

				<p><b>Presenting Complaint</b></p>

				<div class="row">

					<div class="form-group">
					    <div class="col-md-12 col-xs-12">
					    	<input type="tel" class="form-control" name="condition" placeholder="Condition (Required)" required>
							<?php if (!empty($error)) {
							  echo output_error_by_key('condition', $error).'<br>';
							} ?>
					    </div>
					</div>

				</div>
				<br>
				<p><b>Vitals</b></p>

				<div class="row">

					<div class="form-group">
					    <div class="col-md-2 col-xs-6">
					    	<label for="height">Height</label>
					    	<input type="text" class="form-control" name="height" id="height">
					    </div>
					    <div class="col-md-2 col-xs-6">
					    	<label for="weight">Weight</label>
					    	<input type="text" class="form-control" name="weight" id="weight">
					    </div>
					    <div class="col-md-2 col-xs-6">
					    	<label for="bp">B/P</label>
					    	<input type="text" class="form-control" name="bp" id="bp">
					    </div>
					    <div class="col-md-2 col-xs-6">
					    	<label for="temp">Temp</label>
					    	<input type="text" class="form-control" name="temp" id="temp">
					    </div>
					    <div class="col-md-2 col-xs-12">
					    	<label for="Pulse">Pulse</label>
					    	<input type="text" class="form-control" name="pulse" id="pulse">
					    </div>
					    <div class="col-md-2 col-xs-12">
					    	<label for="resp">Resp</label>
					    	<input type="tel" class="form-control" name="resp" id="resp">
					    </div>
					    <div class="col-md-2 col-xs-12">
					    	<label for="urinalysis">Urinalysis</label>
					    	<input type="text" class="form-control" name="urinalysis" id="urinalysis">
					    </div>
					 </div>

				</div>
				<br>

				<div class="row">

					<div class="form-group">
					    <div class="col-md-8 col-xs-12">
							<!-- <label class="custom-file">
							 <input type="file" id="file" class="custom-file-input">
							 <span class="custom-file-control"></span>
							</label> -->
							<label class="btn btn-default btn-file">
    							<b>Browse</b> <input type="file" name="uploadedFile" hidden>
							</label>
					    </div>
					    <div class="col-md-4 col-xs-12">
					    	<!-- <button name="submit" class="btn btn-block btn-submit-rq">Register</button> -->
							<button type="button" class="btn btn-block btn-submit-rq" data-toggle="modal" data-target="#myModal">
							  Register
							</button>
					    </div>
					</div>

				</div>

				<!-- Button trigger modal -->
				<!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
				  Launch demo modal
				</button> -->

				<!-- Modal -->
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">

					  <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel"><b>Verify User</b></h4>
				      </div>

					  <div class="modal-body">
						  <p>Enter your account credential before you can continue</p>
						  <!-- <?php var_dump(get_user_id_from_session()); ?> -->
				       	<input type="text" class="form-control" name="medical_id" placeholder='Medial ID' value="<?php echo get_user_id_from_session() == null ? "": get_user_id_from_session() ; ?>" required readonly>
						<input type="password" class="form-control" name="password" placeholder='Password' required>
				      </div>

				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary">Sign & Register Patient</button>
				      </div>

				    </div>
				  </div>
				</div>


				</form>
				<!-- <br /><b>Warning</b>:  session_start(): Cannot send session cookie - headers already sent by (output started at /Users/davanedavis/Sites/EHCRS-Prototype/header.php:155) in <b>/Users/davanedavis/Sites/EHCRS-Prototype/core/general.inc.php</b> on line <b>23</b><br /><br /><b>Warning</b>:  session_start(): Cannot send session cache limiter - headers already sent (output started at /Users/davanedavis/Sites/EHCRS-Prototype/header.php:155) in <b>/Users/davanedavis/Sites/EHCRS-Prototype/core/general.inc.php</b> on line <b>23</b><br /> -->

			  </div>
			</div>

	</div>

</div>

<?php include 'footer.php' ?>
