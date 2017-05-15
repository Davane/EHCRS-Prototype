<?php
define('APP_RAN', 'APP_RAN');

require_once 'core/physician/physician.inc.php';

# user and session validation file
require_once 'session-validation.php';

# Access Contol File
define('PAGE_ACCESS_LEVEL', 2);
require_once 'core/access_control.php';

$error = array();
$resultSet = null;


if($work_id = get_physician_work_place(get_user_id_from_session())){

	if(isset($_POST['submit']) && $_POST['submit'] === 'complete') {
		#echo 'Remove From List';

		if(isset($_POST['id'])) {
			log_user_sign(get_user_id_from_session(), 'Change appointment with id '.$_POST['id'].' to complete');
			change_appointment_status($_POST['id'], 'complete');
		}
	}


	$resultSet = get_appointment_for_hospital_by_id($work_id);

	// var_dump($resultSet->fetch_assoc());

	if($resultSet->num_rows === 0) {
		$error['error'] = 'No Appointments';
	}

	#var_dump($resultSet);

} else {
	#echo 'error: work place not found';
	$error['error'] = 'error: work place not found';
}

include 'header.php';

 ?>
<div class="container content hei">


			  <div class="row">
				  <?php if (array_key_exists('error',$error)) {
						  echo output_error_by_key('error', $error).'<br>';
					  }  ?>
				  <h4><b>Emergency Appointments</b>  <span style="float: right;">Remaining appointments :<code><b><?php if($resultSet !== null) { echo $resultSet->num_rows; }?></b></code> </span> </h4>
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

										if (empty($error) && $resultSet != null) {
											$resultSet->data_seek(0);
											while ($row = $resultSet->fetch_assoc()):
												if ($row['type'] === 'inc_em' || $row['type'] === 'em') { ?>
												<form  action="<?php $_SERVER['PHP_SELF']?>" method="post">
													<tr>
														<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
														<td><?php echo $row['firstname']; ?></td>
												        <td><?php echo $row['lastname']; ?></td>
												        <td><?php echo $row['date']; ?></td>
												        <td><?php echo $row['time']; ?></td>
												        <td><?php echo $row['reason']; ?></td>
												        <td><?php echo $row['type'] === 'inc_em' ? 'Incoming Emergency': 'Emergency'; ?></td>
														<th><button type="submit" class="btn btn-link" name="submit" value="complete">complete</button></th>
													</tr>
												</form>

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

													<form  action="<?php $_SERVER['PHP_SELF']?>" method="post">
														<tr>
															<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
															<td><?php echo $row['firstname']; ?></td>
													        <td><?php echo $row['lastname']; ?></td>
													        <td><?php echo $row['date']; ?></td>
													        <td><?php echo $row['time']; ?></td>
													        <td><?php echo $row['reason']; ?></td>
													        <td><?php echo $row['type'] === 'wait' ? 'In hospital': ''; ?></td>
															<th><button type="submit" class="btn btn-link" name="submit" value="complete">complete</button></th>
														</tr>
   													</form>
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
													   if ($row['type'] === 'reg') { ?>

													   	<form  action="<?php $_SERVER['PHP_SELF']?>" method="post">
														   <tr>
															   <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
															   <td><?php echo $row['firstname']; ?></td>
															   <td><?php echo $row['lastname']; ?></td>
															   <td><?php echo $row['date']; ?></td>
															   <td><?php echo $row['time']; ?></td>
															   <td><?php echo $row['reason']; ?></td>
															   <td><?php echo $row['type'] === 'reg' ? 'Regular': ''; ?></td>
															   <th><button type="submit" class="btn btn-link" name="submit" value="complete">complete</button></th>
														   </tr>
													   </form>

											   <?php } endwhile; } ?>
										</tbody>
									</table>
							</div>
			  			</div>
			  		</div>
			  </div>

</div>
<br><br><br><br>
<?php include 'footer.php' ?>
