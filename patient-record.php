<?php
define('APP_RAN', 'APP_RAN');

require_once 'core/physician/physician.inc.php';

# user and session validation file
require_once 'session-validation.php';

# Access Contol File
define('PAGE_ACCESS_LEVEL', 4);
require_once 'core/access_control.php';


$id = get_value_from_session('key');
$patient_info_result = get_patient_general_info_for_pyhsician($id);
$patient_vital = get_latest_patient_vital($id);
$patient_lastest_cond_and_treat = get_patient_condition_signs_treatment_medication($id);

// var_dump($_POST);

$state = array();

if (empty($patient_info_result)) {
	$state['error'] = 'Patient Record was not found';
}

if (empty($patient_vital)) {
		$state['error'] = 'No Vitals for this patient';
}

if (empty($patient_lastest_cond_and_treat)) {
		$state['error'] = 'Lastest condition not found for this patient';
}


include 'header.php'
?>


<div class="container content">

			  <div class="row">

				<?php if($patient_info_result !== null && !empty($patient_info_result)) { ?>

					<div class="col-md-3">
						<img src="<?php echo get_pro_pic($patient_info_result); ?>" alt="profile picture" class="img-responsive" width="200px" height="200px">
					</div>

					<div class="col-md-6">
						<h4><b>Full Name</b></h4>
						<h4><?php echo $patient_info_result['firstname'] . ' ' . $patient_info_result['middlename']. ' ' . $patient_info_result['lastname']?></h4>

						<br>
						<span>
							<ul class="list-inline">
								<li style="padding-right: 25px;"><p><b>DOB    <br></b><?php echo $patient_info_result['dob'] ?></p></li>
								<li style="padding-right: 25px;"><p><b>Age    <br></b><?php echo $patient_info_result['age'] ?></p></li>
								<li style="padding-right: 25px;"><p><b>Gender <br></b><?php echo $patient_info_result['gender']  ?></p></li>
							</ul>
							<!-- <p><b>Address: <br></b><?php echo $patient_info_result['street_name'] . ', ' . $patient_info_result['parish'] . ', ' . $patient_info_result['country']   ?></p> -->
						</span>
						<span>
							<ul class="list-inline">
								<li style="padding-right: 25px;"><p><b>Address:       </b><br> <?php echo $patient_info_result['street_name'] . ', ' . $patient_info_result['parish'] . ', ' . $patient_info_result['country']?></p></li>
								<li style="padding-right: 25px;"><p><b>Patient Status:</b><br> <?php echo isset($patient_info_result['status']) ? $patient_info_result['status'] : 'No status' ?></p></li>
							</ul>
						</span>
						<!-- <span><b>Patient Status:</b> <?php echo isset($patient_info_result['status']) ? $patient_info_result['status'] : 'No status' ?></span> -->
					</div>
				  	<div class="col-md-2 col-md-offset-1">
						<form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
							<input type="hidden" name="patient_id" value="<?php echo $id; ?>">
							<a href="edit-medical-history.php">Edit Record</a>
					  		<!-- <button class="btn btn-link" type="submit" name="edit" value="edit">Edit Record</a> -->
						</form>
				  	</div>

				<?php } else {

							if (array_key_exists('error',$state)) {
		  				       echo output_error_by_key('error', $state).'<br>';
		  					}
						} ?>
			  </div>
			  <br><br>

			  <div class="row">
			  	<div class="col-md-6">
				  <div class="panel panel-primary">
				   <div class="panel-heading">
				     <h4 class="panel-title">
				  	 <b>Current Condition</b>
					 <?php
					 		if($patient_lastest_cond_and_treat !== null && !empty($patient_lastest_cond_and_treat)) {
							    $lastest_cond_treat = $patient_lastest_cond_and_treat->fetch_assoc(); ?>
							  	   <div style="float: right;">
							  	       <span class="badge"><?php echo $lastest_cond_treat['date'] ?></span>
							  	   </div>
							       </h4>
								   </div>
								   <div class="panel-collapse">
								     <div class="panel-body">
									  	   <div class="row">
									  		  <div class="col-md-12">
									  			<b><p>Condition</p></b>
									  			<p><?php echo isset($lastest_cond_treat['condition']) ? $lastest_cond_treat['condition'] : 'None recorded' ; ?></p>
									  		  </div>
									  	   </div>
									  	   <hr style="width: 98%;">
									  	   <div class="row">
										  		<div class="col-md-6">
										  			<b>Current Signs</b>
										  		</div>
										  		<div class="col-md-6">
										  			<p><?php echo isset($lastest_cond_treat['symptom']) ? $lastest_cond_treat['symptom'] : 'None recorded' ; ?></p>
										  			<!-- <p>Headacher</p> -->
										  		</div>
									  		</div>
											<hr style="width: 98%;">
											<div class="row">
											   <div class="col-md-12">
												    <b><p>Nurse's/Doctor's Notes</p></b>
										  				<sm>some addtional details about the patient conditions</sm><br>
													<small style="color: #99a6b2;"> - Dr. Whatever</small>
											   </div>
										   </div>
					   <?php } else { ?>

				   		<div class="alert alert-info" role="alert">
				   			<!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
				   			Vitals <b>could not be found</b> for this patient
				   		</div>

				   	<?php } ?>


				    	</div>
				    </div>
				  </div>
			  	</div>

			  	<div class="col-md-6">
					<div class="panel panel-info">
					 <div class="panel-heading">
					   <h4 class="panel-title">
						 <b>Latest Vitals</b>
						 <div style="float: right;">
						 	<span class="badge"><?php echo isset($patient_vital['date']) ? $patient_vital['date'] : 'No date'; ?></span>
					     </div>
					   </h4>
					 </div>
					 <div class="panel-collapse">
					   <div class="panel-body">

						   <?php if($patient_vital !== null && !empty($patient_vital)) { ?>
							   <div class="row">
							      <div class="col-md-6">
								   	<b><p>Height: <?php echo isset($patient_vital['height']) ? $patient_vital['height'] : 'No height'; ?> inches</p></b>
							   	  </div>
								  <div class="col-md-6">
								  	<b><p>Weight: <?php echo isset($patient_vital['weight']) ? $patient_vital['weight'] : 'No weight'; ?> lb</p></b>
							      </div>
							   </div>
							   <br>
							   <div class="row">
						   		<div class="col-md-6">
						   			<p>Temperature: <?php echo isset($patient_vital['temp']) ? $patient_vital['temp'] : 'No temperature'; ?></p>
						   			<p>Pulse: <?php echo isset($patient_vital['pulse']) ? $patient_vital['pulse'] : 'No pulse'; ?></p>
						   			<p>Urinalysis: <?php echo isset($patient_vital['urine']) ? $patient_vital['urine'] : 'No urine'; ?></p>
						   		</div>
								<div class="col-md-6">
									<p>Blood Pressure: <?php echo isset($patient_vital['bp']) ? $patient_vital['bp'] : 'No blood pressure'; ?></p>
									<p>Respiratory: <?php echo isset($patient_vital['resp']) ? $patient_vital['resp'] : 'No resp'; ?></p>
								</div>
						   	 </div>
							 <hr style="width: 98%;">
							 <div align="left" style="margin-left: 10px;">
			  					<!-- <a href="#"><sm>View previous ...</sm></a> -->
			  				 </div>

						<?php } else { ?>

							<div class="alert alert-info alert-dismissible" role="alert">
						    	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								Vitals could not be found for this patient
						    </div>

					  	<?php } ?>

					   </div>
					  </div>
				  </div>
			  	</div>
			  </div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel-group" id="accordion">
						    <div class="panel panel-default">
						      <div class="panel-heading">
						        <h4 class="panel-title">
						          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><b>Medical Problem</b></a>
						        </h4>
						      </div>
						      <div class="panel-collapse">
						        <div class="panel-body">
									<p>Asthma, Diabetes</p>
						        </div>
						       </div>
						    </div>
						    <div class="panel panel-default">
						      <div class="panel-heading">
						        <h4 class="panel-title">
						          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><b>Previous Conditions / Treatment / Medications</b></a>
						        </h4>
						      </div>
						      <div id="collapse2" class="panel-collapse collapse">
						        <div class="panel-body">
									<small id="passwordHelpBlock" class="form-text text-muted">
									  Separate each sign with and comma if you want to add multiple
									</small>
						        </div>
									<table class="table">
										<thead>
											<tr>
												<th>Date</th>
												<th>Condition</th>
												<th>Signs</th>
												<th>Treatment</th>
												<th>Medication</th>
												<th>Hospital</th>
											</tr>
										</thead>
										<tbody>
											<?php
											if (empty($error) && $patient_lastest_cond_and_treat !== null) {
												$patient_lastest_cond_and_treat->data_seek(0);
												while ($row = $patient_lastest_cond_and_treat->fetch_assoc()): ?>
													<tr>
														<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
														<td><?php echo $row['date']; ?></td>
														<td><?php echo $row['condition']; ?></td>
														<td><?php echo $row['symptom']; ?></td>
														<td><?php echo $row['treatment']; ?></td>
														<td><?php echo $row['med']; ?></td>
														<td><?php echo $row['hospital']; ?></td>
														<!-- <th><button type="submit" class="btn btn-link" name="submit" value="complete">complete</button></th> -->
													</tr>
											<?php endwhile; } ?>

										</tbody>
									</table>
								</div>
						    </div>
						</div>
					</div>
	</div>
</div>

<?php include 'footer.php' ?>
