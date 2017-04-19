<?php
include 'patient-header.php';

require_once 'core/physician/physician.inc.php';
require_once 'session-validation.php';

#var_dump($_POST);

$appointmentTime = ['24:00', '23:00', '22:00', '21:00', '20:00', '19:00', '18:00',
	     		   	'17:00', '16:00', '15:00', '14:00', '13:00', '12:00', '11:00',
					'10:00', '09:00', '08:00', '07:00', '06:00', '05:00', '04:00',
					'03:00', '02:00', '01:00', '00:00'];

$monthNames = ["January", "February", "March",
				"April", "May", "June", "July",
				"August", "September", "October",
				"November", "December"];
// var_dump(get_hospital_id_from_name($_POST['hospital']));
$state = array();

if (isset($_POST['datepicker']) && isset($_POST['time_select']) && isset($_POST['hospital'])) {



	$valid = false;
	$patient = $who_set = '';
	$hospital = 0;


	if(get_current_user_type() === 'Patient') {

		$patient = $who_set = get_user_id_from_session();
		$hospital = get_hospital_id_from_name($_POST['hospital']);
		$valid = true;

	} else if(get_current_user_type() === 'Medical') {

		$patient = $who_set = get_user_id_from_session();
		$hospital = get_hospital_id_from_name($_POST['hospital']);
		$valid = true;

	} else {
		echo "User Not Defined";
		//$state['error'] = 'Error: Appointment Failed to set';
	}


	if ($valid) {

		$date = $_POST['datepicker'];
		$dateArr = explode('-', $date);
		$monthIndex = array_search($dateArr[1], $monthNames) + 1;
		$date = $dateArr[2] . '-' . (string)$monthIndex . '-' . $dateArr[0];

		if(set_appointment($patient, $who_set, $hospital, $date, $_POST['time_select'])){
			echo 'Appointment Set, Send email';
			$state['success'] = true;

		} else {
			echo 'Appointment NOT Set';
			$state['error'] = 'Error: Appoinemtn Failed to set';
		}

	}


}

 ?>

<div id="wrapper">
	<div class="main-content-wrapper" id="p-info">
		<div class="main-content">
			  <div class="row">
			  	<div class="panel panel-default" id="pad-panel">

					<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">

			  		<div class="panel-body">

			  			<div align="center"><h3><b>Set Appointment</b></h3></div>
			  			<hr style="width: 98%">
						<?php if (array_key_exists('error',$state)) {
						  		echo output_error_by_key('error', $state).'<br>';
							} else if (array_key_exists('success',$state) && $state['success'] === true) {
								?>
							<div class="alert alert-success alert-dismissible" role="alert">
						    	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								Your appointment was set <b>Successfully</b>, An Email will be sent you
						    </div>
						<?php } ?>
						<div class="row">
			  			<div class="col-md-4">
							<div style="overflow:hidden;">
							    <div class="form-group">
							        <!-- <div class="row"> -->
						            <div class="col-md-">
										<center>
											<h5>Select a Date to set appointment</h5>
										</center>
										<div  name="datepicker" class="datepicker" id="datepicker"></div>
										<input type="hidden" id="datepicker_hidden" name="datepicker">
						            </div>
							        <!-- </div> -->
							    </div>

								<script type="text/javascript" src="js/jquery.js"> </script>
								<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
							    <script type="text/javascript">
								$(document).ready(function() {

									$(function () {


										var date = new Date();

										var day = date.getDate();
										var monthIndex = date.getMonth();
										var year = date.getFullYear();

										var today = new Date(year, monthIndex, day);

										var monthNames = [
										  "January", "February", "March",
										  "April", "May", "June", "July",
										  "August", "September", "October",
										  "November", "December"
										];

										document.getElementById("date").innerHTML = day + '-' + monthNames[monthIndex] + '-' + year;
										document.getElementById("datepicker_hidden").value = day + '-' + monthNames[monthIndex] + '-' + year;

							            var datepicker = $('#datepicker').datepicker({
											format: 'mm/dd/yyyy',
											startDate: today,
											todayHighlight: true,
											onSelect : function(){
        										$('#datepicker').submit();
    										}
							            }).on('changeDate', function(e) {


											var newDate = $('#datepicker').datepicker('getDate');
										    var day = newDate.getDate();
										    var monthIndex = newDate.getMonth();
										    var year = newDate.getFullYear();

											document.getElementById("date").innerHTML =  day + '-' + monthNames[monthIndex] + '-' + year;
											document.getElementById("datepicker_hidden").value =  day + '-' + monthNames[monthIndex] + '-' + year;
										});


							        });

									document.getElementById("time").innerHTML = document.getElementById("select_time").value;
									document.getElementById("hospital").innerHTML = document.getElementById("select_hospital").value;
									// document.getElementById("reason").innerHTML = document.getElementById("write_reason").value;


								});

								function timeChange() {
									document.getElementById("time").innerHTML = document.getElementById("select_time").value;
								}

								function hospitalChange() {
									document.getElementById("hospital").innerHTML = document.getElementById("select_hospital").value;
								}

								function reasonChange() {
									document.getElementById("reason").innerHTML = document.getElementById("write_reason").value;
								}


							    </script>
							</div>

						</div>

						<div class="col-md-6">
							<h5>Select an available <b>time</b> to set your appointment for</h5>
							<select name='time_select' id="select_time" onchange="timeChange()" class="form-control custom-select">
								<!-- <option value="1:30 pm" selected>1:30 pm</option> -->
								<?php for ($i=0; $i < count($appointmentTime); $i++) {?>

									<option value="<?php echo $appointmentTime[$i]; ?>" ><?php echo $appointmentTime[$i]; ?></option>
								<?php } ?>
						   	</select>
							<br>
						   <!-- <input id="date" type="text" class="form-control" name="date" value=""> -->
						   <h5>Select the <b>hospital</b> you want to visit for your appointment</h5>
						   <select name='hospital' id="select_hospital" onchange="hospitalChange()" class="form-control custom-select">
							   <option value="University Hospital" selected>University Hospital</option>
							   <option value="Kingston Public">Kingston Public</option>
						   </select>
						   <br>
						   <h5>What is the reason for your visit</h5>
						   <input type="text" class="form-control"  id="write_reason" onchange="reasonChange()" name="reason" value="" placeholder="(optional)">
						</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-12">
								<span>
									<h5>Your Appointment will be on
										<mark><span name="date" id="date">N/A</span></mark>
										<span>at</span>
										<mark><span id='time'>N/A</span></mark>
										<span>and you will be visiting the</span>
										<mark><span id='hospital'>N/A</span></mark>
										<span>for</span>
										<mark><span id='reason'>Not yet stated</span></mark>
									</h5>
								</span>
							</div>
						</div>
						<br><br>
						<div class="row">
							<div class="col-md-12">
							<center>
								<button class="btn btn-primary" type="submit"> Set Appointment </button>
							</center>
							</div>
						</div>
						<br>
			  		</div>
					</form>
			  	</div>
			  </div>
		</div>
	</div>
</div>

<?php include 'footer.php' ?>
