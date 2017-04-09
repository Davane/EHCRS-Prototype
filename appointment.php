<?php

require_once 'core/physician/physician.inc.php';
require_once 'session-validation.php';
#is_session_started();

$error = array();

if($work_id = get_physician_work_place(get_user_id_from_session())){
	#echo $work_id;

	$resultSet = get_appointment_for_hospital_by_id($work_id);

	if($resultSet->num_rows === 0) {
		$error['error'] = 'Not Appointments';
	}

	#var_dump($resultSet);

} else {
	echo 'error: work place not found';
	$error['error'] = 'error: work place not found';
}


include 'header.php';

 ?>
<div id="wrapper">
	<div class="main-content-wrapper" id="p-info">
		<div class="main-content">


			  <div class="row">
				  <h4><b>Emergency Appointments</b>  <span style="float: right;">Remaining appointments :<code><b><?php echo $resultSet->num_rows;?></b></code> </span> </h4>
				  <br>
			  		<div class="panel panel-default">
			  			<div class="panel">
			  				<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
									        <th>Firstname</th>
									        <th>Lastname</th>
									        <th>Date</th>
									        <th>Time</th>
									        <th>Reason</th>
											<th>Type</th>
								    	</tr>
									</thead>
										<tbody>

										<?php

										if (empty($error)) {
											$resultSet->data_seek(0);
											while ($row = $resultSet->fetch_assoc()):
												if ($row['type'] === 'inc_em' || $row['type'] === 'em') { ?>

								  	        <tr>
												<td><?php echo $row['firstname']; ?></td>
										        <td><?php echo $row['lastname']; ?></td>
										        <td><?php echo $row['date']; ?></td>
										        <td><?php echo $row['time']; ?></td>
										        <td><?php echo $row['reason']; ?></td>
										        <td><?php echo $row['type'] === 'inc_em' ? 'Incoming Emergency': 'Emergency'; ?></td>
												<th><button type="button" class="btn btn-link" name="button">complete</button></th>
											</tr>

										<?php } endwhile; } ?>

										</tbody>
									</table>
							</div>
			  			</div>
			  		</div>
			  </div>

			  <div class="row">

			  	  <p><code><b>Dr. session user</b></code> your next patient is : </p>
			  		<div class="panel panel-default">
			  			<div class="panel">
			  				<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th>Firstname</th>
										   	<th>Lastname</th>
										   	<th>Date</th>
										   	<th>Time</th>
										   	<th>Reason</th>
										   	<th>Type</th>
									    </tr>
									</thead>
										<tbody>
											<?php

											if (empty($error)) {
												$resultSet->data_seek(0);
												while ($row = $resultSet->fetch_assoc()):
													if ($row['type'] === 'wait') { ?>

									  	        <tr>
													<td><?php echo $row['firstname']; ?></td>
											        <td><?php echo $row['lastname']; ?></td>
											        <td><?php echo $row['date']; ?></td>
											        <td><?php echo $row['time']; ?></td>
											        <td><?php echo $row['reason']; ?></td>
											        <td><?php echo $row['type'] === 'wait' ? 'In hospital': ''; ?></td>
													<th><button type="button" class="btn btn-link" name="button">complete</button></th>
												</tr>

											<?php } endwhile; } ?>
										</tbody>
									</table>
							</div>
			  			</div>
			  		</div>
			  </div>

			  <div class="row">
			  	<p><code><b>Dr. session user</b></code> your next appointment is scheduled for : </p>
			  		<div class="panel panel-default">
			  			<div class="panel">
			  				<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th>#</th>
										        <th>Firstname</th>
										        <th>Lastname</th>
										        <th>Age</th>
										        <th>City</th>
										        <th>Country</th>
									    </tr>
									</thead>
										<tbody>
											<?php
											   if (empty($error)) {
												   $resultSet->data_seek(0);
												   while ($row = $resultSet->fetch_assoc()):
													   if ($row['type'] === 'reg') { ?>

												   <tr>
													   <td><?php echo $row['firstname']; ?></td>
													   <td><?php echo $row['lastname']; ?></td>
													   <td><?php echo $row['date']; ?></td>
													   <td><?php echo $row['time']; ?></td>
													   <td><?php echo $row['reason']; ?></td>
													   <td><?php echo $row['type'] === 'reg' ? 'Regular': ''; ?></td>
													   <th><button type="button" class="btn btn-link" name="button">complete</button></th>
												   </tr>

											   <?php } endwhile; } ?>
										</tbody>
									</table>
							</div>
			  			</div>
			  		</div>
			  </div>
		</div>
	</div>
</div>

<?php include 'footer.php' ?>
