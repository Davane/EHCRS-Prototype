<?php
include_once 'core/physician/physician.inc.php';

var_dump($_POST);

$resultSet = get_all_patient_and_id();
$state = array();

# verify the physician infromation entered into the modal
if(isset($_POST['medical_id']) && isset($_POST['password'])){


	$id = $_POST['medical_id'];
	$passw = $_POST['password'];

	# echo $passw;
	# var_dump(get_user_id_from_session());

	# check the session medical id with the entered medical id
	if ($id === get_user_id_from_session()) {

		if (verify_user_and_password($id, $passw)){
			echo "Vefired";

			$error = add_patient_medical_hisory($id, $condition, $signs, $height, $weight, $temp, $pulse, $bp, $resp, $unrine);

		} else {
			// echo "Credentials wrong";
			$state['error'] = "Physician's credentials wrong";
		}

	} else {
		// echo " Credentials wrong";
		$state['error'] = "Physician's credentials wrong";
	}
}

add_medical_condtion();

function add_medical_condtion(){

	


	add_new_sign_and_sympton('27', '424', 'this is a new condition');
}


// var_dump($resultSet);

include 'header.php';

?>

<div id="wrapper">
	<div class="main-content-wrapper" id="p-info">
		<div class="main-content">
			<div class="panel panel-default">
			  <div class="panel-body" style="padding:0 55px;">
				<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
					<span><h3><b>New condition</b></h3></span>
					<p>For Patient:
						<select name="patient" class="custom-select">
							<?php

							if ($resultSet !== null) {
								while ($row = $resultSet->fetch_assoc()):
									$patient_info_string =  $row['firstname'] . ' ' . $row['middlename'] . ' '. $row['lastname'] . ' - ' . $row['id'];
							?>
									<option  value="<?php echo $patient_info_string; ?>"><?php echo $patient_info_string; ?></option>

							<?php endwhile; }?>
					   </select>
			   	    </p>

	                <hr style="width: 98%;">
					<?php if (array_key_exists('error',$state)) {
							echo output_error_by_key('error', $state).'<br>';
						} else if (array_key_exists('success',$state) && $state['success'] === true) {
							?>
							<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								Patient COndition was added <b>Successfully</b>
							</div>
					<?php } ?>

                    <div class="row">
						<div class="form-group">
                            <div class="col-md-12 col-xs-12">
                                <label><h5>Condition</h5></label>
                            </div>

							<div class="col-md-12">
								<input type="text" class="form-control" name="condition" placeholder="Condition">
							</div>

                        </div>

                        <div class="form-group">
                            <div class="col-md-12 col-xs-12">
                                <label><h5>Signs & Symptons</h5></label>
                                <input type="text" class="form-control" name="signs" placeholder="Signs & Symptons">
								<small id="passwordHelpBlock" class="form-text text-muted">
								  Separate each sign with and comma if you want to add multiple
							  </small>
						  </div>

                        </div>

                        <div class="form-group">

                            <div class="col-md-12 col-xs-12" style="margin-top: 25px;">
                                <label><h5>Vitals</h5></label>
                            </div>
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
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12" style="margin-left: 15px;" >
                                    <div class="checkbox">
                                        <label><input type="checkbox" checked="" name="set_appointment" value="Yes">Set Appointment to see the Doctor</label>
                                    </div>
									<br>

									<p>Is this an Emergency?</p>
										<label class="radio-inline"><input type="radio" name="emergency">Yes</label>
										<label class="radio-inline" active><input type="radio" name="emergency" checked="">No</label>
									<br>
                            </div>
                            </div>
                        </div>

                    </div>

                         <div class="row">
                             <div class="form-group">
                        		<div class="col-md-3"  style="margin-bottom: 30px; margin-top: 30px">
     								<button type="button" class="btn btn-submit-rq" data-toggle="modal" data-target="#myModal">Add New condition</button>
     							</div>
                            </div>
                        </div>


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
						       	<input type="text" class="form-control" name="medical_id" placeholder='Medial ID' required>
								<input type="password" class="form-control" name="password" placeholder='Password' required>
						      </div>

						      <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						        <button type="submit" class="btn btn-primary">Sign & Add Condition</button>
						      </div>

						    </div>
						  </div>
						</div>

					</form>
              </div>
		   </div>
	   </div>
    </div>
</div>


<?php include 'footer.php' ?>
<script>
	$('td').attr('contenteditable',true);
</script>
