<?php
include_once 'core/patient/patient.inc.php';
// <script>alert('test');</script>
$nameSet = null;
$status = null;
$error = array();

// echo 'ID:'.get_value_from_session('key');
if($id = get_value_from_session('key')) {

    # getting patient name
    $nameSet = get_patient_name($id);

    # getting patient medical history information
	$patient_infoSet = get_paitnet_personal_info($id);

	// var_dump($patient_infoSet);

	if(!empty($_POST)) {

		 var_dump($_POST);

		$items = array(
				'TEXT-firstName-26-required'  => $_POST['firstName'],
				'TEXT-lastName-26-required'   => $_POST['lastName'],
				'TEXT-maidenName-26' => $_POST['maidenName'],
				'TEXT-middleName-26' => $_POST['middleName'],
				// 'EMAIL-email-64-required'     => $_POST['email'],
				'TEXT-trn-15'        => $_POST['trn'],
				'TEXT-dob-26'        => $_POST['dob'],
				'INT-age-26'         => $_POST['age'],
				'TEXT-gender-5'       => $_POST['gender'],
				'TEXT-tel_no-15'  => $_POST['tel_no'],
				'TEXT-street-64' => $_POST['street'],
				'TEXT-parish-16'      => $_POST['parish'],
				'TEXT-kin-54'         => $_POST['kin'],
				'TEXT-relationship-12'  => $_POST['relationship'],
				'TEXT-union-17'  => $_POST['union'],
				'TEXT-employer-45' => $_POST['employer'],
				'TEXT-emp_street-26'   => $_POST['emp_street'],
				'TEXT-emp_parish-26'    => $_POST['emp_parish'],
				'TEXT-emp_tel_no-15'       => $_POST['emp_tel_no'],
				'TEXT-occupation-48'    => $_POST['occupation'],
				'TEXT-policy-12'        => $_POST['policy']);

		$error = gen_validate_inputs($items);

		// var_dump($error);


		if (empty($error)) {
			# update personal info
			$status = update_personal_info($id, $_POST['firstName'], $_POST['middleName'],
										  $_POST['lastName'],   $_POST['maidenName'],
										  $_POST['email'],      $_POST['trn'],
			                              $_POST['gender'],     $_POST['dob'],
										  $_POST['tel_no'],     $_POST['age'],
										  $_POST['kin'],        $_POST['relationship'], $_POST['union'],
										  $_POST['street'],     $_POST['parish'], 'ja',
										  $_POST['employer'],   $_POST['occupation'],
			                              $_POST['emp_tel_no'], $_POST['policy'],
										  $_POST['emp_street'], $_POST['emp_parish'], 'ja');

		}


	}

}

// var_dump($patient_infoSet);
include 'header.php';

?>

<<<<<<< HEAD
<div id="wrapper">
	<!-- <script>alert('test');</script> -->
	<div class="main-content-wrapper" id="p-info">
		<div class="main-content">
=======
<div class="container content">
>>>>>>> thegarfieldgray/master
			<div class="panel panel-default">
			  <div class="panel-body" style="padding:0 55px;">
				<span><h3><b>Edit Personal Record</b></h3></span>
                <p>of <b><?php
                    if ($nameSet !== null) {
                        echo $nameSet['firstname'] . ' ' . $nameSet['lastname'];
	                } ?></b></p> <br>
				<p> go to <a href="edit-medical-history.php">Edit Patient Medical History</a></p>

                <hr style="width: 98%;">
				<?php if ($status !== null): ?>
					<?php if ($status): ?>
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							Record Updated Successfully
						</div>
					<?php else: ?>
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							Record Was Not Updated Successfully
						</div>
					<?php endif; ?>
				<?php endif; ?>

				<?php if (!empty($error)): ?>
					<?php foreach ($error as $key => $value): ?>
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<p> <?php echo $value ?> for <b> <?php echo $key ?></b></p>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>



				<div class="row">
					<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
						<div class="form-group">
							<div class="col-md-3">
                                <label>First Name</label>
								<input type="text" value="<?php echo isset($patient_infoSet['firstname']) ? $patient_infoSet['firstname'] : '' ;?>" class="form-control" name="firstName" placeholder="First Name" required>
							</div>
                            <div class="col-md-3">
                                <label>Middle Name</label>
								<input type="text" value="<?php echo isset($patient_infoSet['middlename']) ? $patient_infoSet['middlename'] : '' ;?>" class="form-control" name="middleName" placeholder="Middle Name">
							</div>
                            <div class="col-md-3">
                                <label>Last Name</label>
								<input type="text" value="<?php echo isset($patient_infoSet['lastname']) ? $patient_infoSet['lastname'] : '' ;?>" class="form-control" name="lastName" placeholder="Last Name" required>
							</div>
                            <div class="col-md-3">
                                <label>Maiden Name</label>
                                <input type="text" value="<?php echo isset($patient_infoSet['maiden_name']) ? $patient_infoSet['maiden_name'] : '' ;?>" class="form-control" name="maidenName" placeholder="Maiden Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4">
                                <label>Email</label>
                                <input type="text" value="<?php echo isset($patient_infoSet['email']) ? $patient_infoSet['email'] : '' ;?>" class="form-control" name="email" placeholder="Email" readonly>
                            </div>
                            <div class="col-md-4">
                                <label>TRN</label>
                                <input type="text" value="<?php echo isset($patient_infoSet['trn']) ? $patient_infoSet['trn'] : '' ;?>" class="form-control" name="trn" placeholder="TRN" >
                            </div>
							<div class="col-md-4">
                                <label>Telephone</label>
                                <input type="text" value="<?php echo isset($patient_infoSet['tel_no']) ? $patient_infoSet['tel_no'] : '' ;?>" class="form-control" name="tel_no" placeholder="Telephone" >
                            </div>
                        </div>

						<div class="form-group">

    					    <div class="col-md-4 col-xs-12">
                                <label>DOB</label>
    					    	<input type="date" value="<?php echo isset($patient_infoSet['dob']) ? $patient_infoSet['dob'] : '' ;?>" class="form-control" name="dob" placeholder="dob">
    					    </div>
    					    <div class="col-md-4 col-xs-12">
                                <label>Age</label>
    					    	<input type="text" value="<?php echo isset($patient_infoSet['age']) ? $patient_infoSet['age'] : '' ;?>" class="form-control" name="age" placeholder="age" >
    					    </div>
							<div class="col-md-4 col-xs-12">
                                <label>Gender</label>
    					    	<!-- <input type="text" value="<?php echo isset($patient_infoSet['gender']) ? $patient_infoSet['gender'] : '' ;?>" class="form-control" name="gender" placeholder="gender" > -->
								<select name="gender" class="form-control custom-select">
									 <?php if (isset($patient_infoSet['gender']) && $patient_infoSet['gender'] === 'male'): ?>
									 	<option value="male" selected>Male</option>
										<option value="female">Female</option>
									 <?php else: ?>
										 <option value="male">Male</option>
									 	<option value="female" selected>Female</option>
									 <?php endif; ?>
								</select>
							</div>
    					 </div>

                        <div class="form-group">
                            <div class="col-md-12 col-xs-12">
                                <label><h5>Address</h5></label>
                            </div>

                            <div class="col-md-6">
                                <label>Street Name</label>
                                <input type="text" value="<?php echo isset($patient_infoSet['street']) ? $patient_infoSet['street'] : '' ;?>" class="form-control" name="street" placeholder="Street Name">
                            </div>
                            <div class="col-md-6">
                                <label>Parish</label>
                                <input type="text" value="<?php echo isset($patient_infoSet['parish']) ? $patient_infoSet['parish'] : '' ;?>" class="form-control" name="parish" placeholder="Parish">
                            </div>
                        </div>

                        <div class="form-group">

    					    <div class="col-md-12 col-xs-12">
                                <label><h5>Emergency Contact</h5></label>
                            </div>

    					    <div class="col-md-4 col-xs-12">
                                <label>Next of Kin</label>
    					    	<input type="text" value="<?php echo isset($patient_infoSet['kin']) ? $patient_infoSet['kin'] : '' ;?>" class="form-control" name="kin" placeholder="Next of Kin">
    					    </div>
    					    <div class="col-md-4 col-xs-12">
                                <label>Relationship</label>
    					    	<input type="text" value="<?php echo isset($patient_infoSet['relationship']) ? $patient_infoSet['relationship'] : '' ;?>" class="form-control" name="relationship" placeholder="Relationship" >
    					    </div>
							<div class="col-md-4 col-xs-12">
                                <label>Union</label>
								<select name="union" class="form-control custom-select">
									<?php if (isset($patient_infoSet['union'])): ?>
										<?php if ($patient_infoSet['union'] === 'single'): ?>
										   <option value="single" selected>Single</option>
										   <option value="married">Married</option>
										   <option value="divorce">Divorce</option>
										   <option value="widow">Widow</option>
									       <option value="in a relationship">In a relationship</option>
									   <?php elseif($patient_infoSet['union'] === 'married'): ?>
										   <option value="single">Single</option>
										   <option value="married" selected>Married</option>
										   <option value="divorce">Divorce</option>
										   <option value="widow">Widow</option>
										   <option value="in a relationship">In a relationship</option>
									   <?php elseif($patient_infoSet['union'] === 'divorce'): ?>
										   <option value="single">Single</option>
										   <option value="married">Married</option>
										   <option value="divorce" selected>Divorce</option>
										   <option value="widow">Widow</option>
										   <option value="in a relationship">In a relationship</option>
									   <?php elseif($patient_infoSet['union'] === 'widow'): ?>
									  	   <option value="single">Single</option>
									  	   <option value="married">Married</option>
									  	   <option value="divorce">Divorce</option>
									  	   <option value="widow" selected>Widow</option>
									  	   <option value="in a relationship">In a relationship</option>
									   <?php elseif($patient_infoSet['union'] === 'in a relationship'): ?>
									  	   <option value="single">Single</option>
									  	   <option value="married">Married</option>
									  	   <option value="divorce">Divorce</option>
									  	   <option value="widow">Widow</option>
									  	   <option value="in a relationship" selected>In a relationship</option>
										<?php endif; ?>
									<?php endif; ?>
								</select>
    					    	<!-- <input type="text" value="<?php echo isset($patient_infoSet['union']) ? $patient_infoSet['union'] : '' ;?>" class="form-control" name="union" placeholder="Union" > -->
    					    </div>
    					 </div>

                        <div class="form-group">

                            <div class="col-md-12 col-xs-12">
                                <label><h5>Employment Info</h5></label>
                            </div>

                            <div class="col-md-12 col-xs-4">
                                <input type="text" value="<?php echo isset($patient_infoSet['employer']) ? $patient_infoSet['employer'] : '' ;?>" class="form-control" name="employer" placeholder="Name of Employer">
                            </div>
							<div class="col-md-6 col-xs-4">
                                <input type="text" value="<?php echo isset($patient_infoSet['occupation']) ? $patient_infoSet['occupation'] : '' ;?>" class="form-control" name="occupation" placeholder="Occupation">
                            </div>
							<div class="col-md-6 col-xs-4">
                                <input type="text" value="<?php echo isset($patient_infoSet['emp_tel_no']) ? $patient_infoSet['emp_tel_no'] : '' ;?>" class="form-control" name="emp_tel_no" placeholder="Employer Phone Number">
                            </div>
                            <div class="col-md-8 col-xs-4">
                                <input type="address" value="<?php echo isset($patient_infoSet['emp_street']) ? $patient_infoSet['emp_street'] : '' ;?>" class="form-control" name="emp_street" placeholder="Address (Street Name)">
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <input type="text" value="<?php echo isset($patient_infoSet['emp_parish']) ? $patient_infoSet['emp_parish'] : '' ;?>" class="form-control" name="emp_parish" placeholder="Parish" >
                            </div>
							<div class="col-md-12 col-xs-4">
                                <input type="text" value="<?php echo isset($patient_infoSet['policy']) ? $patient_infoSet['policy'] : '' ;?>" class="form-control" name="policy" placeholder="Insurance Policy" >
                            </div>
                         </div>

                         <br><br>

                         <div class="form-group">
                    		<div class="col-md-3"  style="margin-bottom: 30px;margin-top: 30px;">
 								<button type="submit" class="btn btn-submit-rq">Update Personal Info</button>
 							</div>
                        </div>
                        <br><br>
					</form>

			     </div>

              </div>
		   </div>
</div>


<?php include 'footer.php' ?>
<script>
	$('td').attr('contenteditable',true);
</script>
