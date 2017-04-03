<?php
include_once 'core/patient/patient.inc.php';
include 'header.php';


# var_dump($_SESSION);
#var_dump(get_user_id_from_session());
$user_id = null;

if(get_user_id_from_session() !== null && get_current_user_type() !== null && get_current_user_type() === 'Patient') {
	$user_id = get_user_id_from_session();
} else {

	echo "Session not set: logout user";
}

?>

<div id="wrapper">
	<div class="sidebar-wrapper">
		<div class="sidebar">
			<ul>
				<li></li>
			</ul>
		</div>
	</div>

	<div class="main-content-wrapper" id="p-info">
		<div class="main-content">
			<div class="panel panel-default">
			  <div class="panel-body" style="padding:0 55px;">
				<div class="row">
					<?php

						$patientInfo = get_patient_general_info('387');



					?>
					<div class="col-xs-5 col-md-5">
						<br>
						<br>
						<div align="center">
							<img src="img/avatar1.png" alt="profile picture" class="img-circle img-responsive" id="pro-img">
						</div>
					</div>

					<div class="col-xs-7 col-md-7">
					<div style="line-height: 0.7;margin-top: 63px; margin-left: -50px;" align="left">
						<strong><h4><?php echo $patientInfo['firstname'].' '.$patientInfo['middlename'].' '.$patientInfo['lastname']. ' (a.k.a ' . $patientInfo['pet_name'] .')'; ?></h4></strong>
						<p><?php echo $patientInfo['dob']; ?> &nbsp; <?php echo $patientInfo['age']; ?> &nbsp; <?php echo $patientInfo['gender']; ?></p>
						<address><?php echo $patientInfo['street_name'] . ', ' . $patientInfo['parish']. ', ' . $patientInfo['country']; ?></address>
						<p>Insured by <b><?php echo isset($patientInfo['insurance']) ? $patientInfo['insurance'] : 'None'; ?></b> &nbsp; &nbsp; &nbsp; <span style="background:lightgrey; padding: 2px;color:black">&nbsp;&nbsp;&nbsp; Status &nbsp;&nbsp;&nbsp;</span></p>
					</div>
					</div>
				</div><br><br>
					<div class="row">
						<div class="panel-group" id="accordion">

						    <div class="panel panel-default">
						      <div class="panel-heading">
						        <h4 class="panel-title">
						          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Health History</a>
						        </h4>
						      </div>
						      <div id="collapse1" class="panel-collapse collapse in">
						        <div class="panel-body">
						        	<div class="table-responsive">
									  <table class="table">

									    <thead>
									      <tr>
									        <th>Date</th>
									        <th>Diagnosis</th>
									        <th>Treatment</th>
									        <th>Medication</th>
									        <th>Hospital</th>
									        <th>Treated By</th>
									      </tr>
									    </thead>
										<?php



										$resutlSet = get_patient_condtition_and_treatment('386');

										while ($row = $resutlSet->fetch_assoc()): ?>
											<tbody>
											  <tr>
												<td><?php echo $row['date'];?></td>
												<td><?php echo $row['diagnosis'];?></td>
												<td><?php echo $row['treatment'];?></td>
												<td><?php echo $row['medication'];?></td>
												<td><?php echo $row['hospital'];?></td>
												<td><?php echo $row['treated by'];?></td>
											  </tr>
											</tbody>
			                            <?php endwhile; ?>

									  </table>
									</div>
									<!-- However I think the smarter thing for you to do is to write a script for each of these and include the script here -->
						        </div>
						      </div>
						    </div>

						    <div class="panel panel-default">
						      <div class="panel-heading">
						        <h4 class="panel-title">
						          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Lastest Vitals</a>
						        </h4>
						      </div>
						      <div id="collapse2" class="panel-collapse collapse">
						        <div class="panel-body">


									<div class="table-responsive">
									  <table class="table">

										<thead>
										  <tr>
											<th>Date</th>
											<th>Weight</th>
											<th>Height</th>
											<th>Temperature</th>
											<th>Pulse</th>
											<th>Blood Pressure</th>
											<th>Respiratory</th>
											<th>Urinalysis</th>
											<!-- <th>Hospital</th> -->
											<th>Taken By</th>
										  </tr>
										</thead>

										<?php

										$resutlSet = get_patient_vitals('386');

									 	while ($row = $resutlSet->fetch_assoc()):
											?>
											<tbody>
											  <tr>
												<td><?php echo $row['date'];?></td>
												<td><?php echo $row['height'];?></td>
												<td><?php echo $row['weight'];?></td>
												<td><?php echo $row['temp'];?></td>
												<td><?php echo $row['pulse'];?></td>
												<td><?php echo $row['resp'];?></td>
												<td><?php echo $row['bp'];?></td>
												<td><?php echo $row['urinalysis'];?></td>
												<td><?php echo $row['taken_by'];?></td>
											  </tr>
											</tbody>
										<?php endwhile;
										 ?>

									  </table>
									</div>



						        </div>
						      </div>
						    </div>

						    <div class="panel panel-default">
						      <div class="panel-heading">
						        <h4 class="panel-title">
						          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Allergies / Medications</a>
						        </h4>
						      </div>
						      <div id="collapse3" class="panel-collapse collapse">
						        <div class="panel-body">
									<div class="table-responsive">
									  <table class="table">

										<thead>
										  <tr>
											<th>Date</th>
											<th>Medication</th>
											<th>Type</th>
											<th>Dosage</th>
											<th>Given By</th>
										  </tr>
										</thead>

										<?php

										$resutlSet = get_patient_medication('387');

									 	while ($row = $resutlSet->fetch_assoc()):
											?>
											<tbody>
											  <tr>
												<td><?php echo $row['date'];?></td>
												<td><?php echo $row['medication'];?></td>
												<td><?php echo $row['type'];?></td>
												<td><?php echo $row['dosage'];?></td>
												<td><?php echo $row['given_by'];?></td>
											  </tr>
											</tbody>
										<?php endwhile;
										 ?>

									  </table>
									</div>

						        </div>
						      </div>
						    </div>
						    <div class="panel panel-default">
						      <div class="panel-heading">
						        <h4 class="panel-title">
						          <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Previous Surguries / Lab Test</a>
						        </h4>
						      </div>
						      <div id="collapse4" class="panel-collapse collapse">
						        <div class="panel-body">

						        </div>
						      </div>
						    </div>
						  </div>
					</div>
			</div>
		</div>
		</div>
	</div>
</div>

<?php include 'footer.php' ?>
