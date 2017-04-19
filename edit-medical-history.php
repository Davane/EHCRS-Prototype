<?php
include_once 'core/patient/patient.inc.php';
// is_session_started();
var_dump($_POST);
$nameSet = null;

// if($id = get_value_from_session('key')) {

    $id = '387';
    # getting patient name
    $nameSet = get_patient_name($id);

    # get medical conditions

    # get all medical history id for patient
    $med_his_id_resultset = get_medical_history_id($id);
    #var_dump($med_his_id_resultset);

    # getting patient vitals by medical history id
    $vital_resultset = get_patient_vitals_by_med_history_id($id);

    # getting patient treatment/ medication by medical history id
    $symptons_resultset = get_sign_and_symptons_by_patient_id($id);

    # getting patient signs by medical history id
    $treat_and_med_resultset = get_treatment_medication_by_patient_id($id);

    //  var_dump($vital_resultset->fetch_assoc());
// }


include 'header.php';
?>


<div id="wrapper">
	<div class="main-content-wrapper" id="p-info">
		<div class="main-content">
			<div class="panel panel-default">
			  <div class="panel-body" style="padding:0 55px;">

				<span><h3><b>Edit Medical History</b></h3></span>
				<p>of <b><code><?php
                    if ($nameSet !== null) {
                        echo $nameSet['firstname'] . ' ' . $nameSet['middlename'] . ' ' . $nameSet['lastname'];
	                } ?>
                </code></b></p> <br>
				<p><a href="edit-personal-info.php">Edit Patient Personal Record</a></p>

				<hr style="width: 98%;">

				<div class="row">
						<div class="form-group">
							<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">

    							<div class="col-md-3">
    								<label for="q">Medical Conditions</label>
    							</div>
    							<div class="col-md-7">
    								<input type="text" name='medical_condition' class="form-control" id="q" placeholder="eg. Asthma, Diabetes">
    							</div>
    							<div class="col-md-2">
    								<button type="submit" class="btn btn-submit-rq">Update</button>
    							</div>

						    </form>
						</div>
				</div>
			  </div>


              <?php
                if ($med_his_id_resultset !== null) {

                    while ($row_med_his = $med_his_id_resultset->fetch_assoc()) :
                        // var_dump($row_med_his);
                  ?>


			  <div class="panel panel-default" id="pad-panel">
				   <div class="panel-body">

				  		<div class="row">
							<div class="form-group">
								<div class="col-md-3">
									<label for="condi"><h5><b>Reported Condition:</b></h5></label>
								</div>

								<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
									<div class="col-md-3">
										<input type="text" name='condition' value="<?php echo isset($row_med_his['condition']) ? $row_med_his['condition'] : ''  ?>" class="form-control" id="condi" placeholder="">
									</div>
									<div class="col-md-1 col-xs-2">
										<button type="submit" class="btn btn-primary">Update Conditions</button>
									</div>
								</form>

								<div class="col-md-4 col-md-offset-1">
									<span style="margin-left: 15px; margin-top: 15px;"><b>Date Visited: </b><?php echo $row_med_his['date']; ?></span>
								</div>
							</div>
				  		</div>


				  		<div class="row">
				  			<div class="panel panel-default">
				  				<div class="panel-body">

				  					<h5><b>Vitals for this condition</b></h5>
				  					 	<hr style="width: 98%;">
				  							<div class="table-responsive">
											  <table class="table">
											    <thead>

    												<tr>
     		 											<th>Date</th>
     		 											<th>Weight (LB)</th>
     		 											<th>Height</th>
     		 											<th>Temp</th>
     		 											<th>Pulse</th>
     		 											<th>B/P</th>
     		 											<th>Resp</th>
     		 											<th>Urinalysis</th>
     		 											<th>Taken By</th>
     		 										  </tr>
											    </thead>
											    <tbody>

                                            <?php
                                            if ($vital_resultset !== null) {
                                                $vital_resultset->data_seek(0);
                                                while ($row_vitals = $vital_resultset->fetch_assoc()) :
                                                    if ($row_vitals['med_his_id'] === $row_med_his['med_his_id']) {?>

                                                    <form class="" action='<?php $_SERVER['PHP_SELF'];  ?>' method="post">

                                                          <tr>
                                                              <!-- Not editable -->
        											        <td><?php echo isset($row_vitals['date']) ? $row_vitals['date'] : ''; ?>
                                                                <input type="hidden" name="id" value="<?php echo isset($row_vitals['vitals_id']) ? $row_vitals['vitals_id'] : ''; /*Value from databse*/; ?>">
                                                                <!-- <input type="hidden" name="med_his_id" value="<?php echo isset($_POST['id']) ? $_POST['id'] : $row_med_his['med_his_id']; /*Value from databse*/; ?>"> -->
                                                            </td>

                                                            <?php if(!empty($_POST) && $_POST['submit'] === 'edit-vital' && $_POST['id'] == $row_vitals['vitals_id']) { ?>
                                                                   <td><input name="weight" value="<?php echo isset($_POST['weight']) ? $_POST['weight'] : ''; ?>" style="width: 60px;" type="date" class="form-control input-sm" placeholder="weight"></td>
                                                                   <td><input name="height" value="<?php echo isset($_POST['height']) ? $_POST['height'] : ''; ?>" style="width: 60px;" type="text" class="form-control input-sm" placeholder="height"></td>
                                                                   <td><input name="temp"   value="<?php echo isset($_POST['temp'])   ? $_POST['temp']   : ''; ?>" style="width: 60px;" type="text" class="form-control input-sm" placeholder="temp"></td>
                                                                   <td><input name="pulse"  value="<?php echo isset($_POST['pulse'])  ? $_POST['pulse']  : ''; ?>" style="width: 60px;" type="text" class="form-control input-sm" placeholder="pulse"></td>
                                                                   <td><input name="bp"     value="<?php echo isset($_POST['bp'])     ? $_POST['bp']     : ''; ?>" style="width: 60px;" type="text" class="form-control input-sm" placeholder="bp"></td>
                                                                   <td><input name="reps"   value="<?php echo isset($_POST['resp'])   ? $_POST['resp']   : ''; ?>" style="width: 60px;" type="text" class="form-control input-sm" placeholder="resp"></td>
                                                                   <td><input name="urine"  value="<?php echo isset($_POST['urine'])  ? $_POST['urine']  : ''; ?>" style="width: 60px;" type="text" class="form-control input-sm" placeholder="urine"></td>
                                                               <?php  } else { ?>
                                                                   <td><?php echo isset($row_vitals['weight']) ? $row_vitals['weight'] : ''; ?><input type="hidden" name="weight" value="<?php echo isset($_POST['weight']) ? $_POST['weight'] : $row_vitals['weight'];?>"></td>
                                                                   <td><?php echo isset($row_vitals['height']) ? $row_vitals['height'] : ''; ?><input type="hidden" name="height" value="<?php echo isset($_POST['height']) ? $_POST['height'] : $row_vitals['height'];?>"></td>
                   											       <td><?php echo isset($row_vitals['temp'])   ? $row_vitals['temp']   : ''; ?><input type="hidden" name="temp"   value="<?php echo isset($_POST['temp']) ?   $_POST['temp'] :   $row_vitals['temp'];?>"></td>
               											           <td><?php echo isset($row_vitals['pulse'])  ? $row_vitals['pulse']  : ''; ?><input type="hidden" name="pulse"  value="<?php echo isset($_POST['pulse']) ?  $_POST['pulse'] :  $row_vitals['pulse'];?>"></td>
               											           <td><?php echo isset($row_vitals['bp'])     ? $row_vitals['bp']     : ''; ?><input type="hidden" name="bp"     value="<?php echo isset($_POST['bp']) ?     $_POST['bp'] :     $row_vitals['bp'];?>"></td>
               													   <td><?php echo isset($row_vitals['resp'])   ? $row_vitals['resp']   : ''; ?><input type="hidden" name="resp"   value="<?php echo isset($_POST['resp']) ?   $_POST['resp'] :   $row_vitals['resp'];?>"></td>
               											           <td><?php echo isset($row_vitals['urine'])  ? $row_vitals['urine']  : ''; ?><input type="hidden" name="urine"  value="<?php echo isset($_POST['urine']) ?  $_POST['urine'] :  $row_vitals['urine'];?>"></td>
                                                               <?php } ?>

                                                              <!-- Not editable -->
        											        <td><?php echo isset($row_vitals['lastname']) ? 'Dr. ' .  $row_vitals['lastname'] : '' ; ?></td>

                                                            <?php if(!empty($_POST) && $_POST['submit'] === 'edit-vital' && $_POST['id'] == $row_vitals['vitals_id']) { ?>
                                                                        <!-- Edit mode for table row  -->
        													            <td><button type="submit"  name="submit" value='save-vital' class='btn btn-link'>Save</button></td>
                                                            <?php  } else { ?>
                                                                        <!-- Save and 'Just Loaded Paged' mode for table row  -->
                                                                        <td><button type="submit"  name="submit" value='edit-vital' class='btn btn-link'>Edit</button></td>
                                                            <?php } ?>
        											      </tr>
                                                      </form>
                                                  <?php } endwhile; }?>
											    </tbody>

											  </table>
									       </div>

										<form class="" action="<?php# $_SERVER['PHP_SELF']; ?>" method="post">

											<div class="form-group">
												<div style="width: 100px; "class="col-md-1 col-xs-1">
													<input type="text" class="form-control input-sm" name="weight" placeholder="weight">
												</div>
												<div style="width: 100px; " class="col-md-1 col-xs-1">
													<input type="text" class="form-control input-sm" name="height" placeholder="height">
												</div>
												<div style="width: 100px; "class="col-md-1 col-xs-1">
												   <input type="text" class="form-control input-sm" name="temp" placeholder="temp">
												 </div>
												 <div style="width: 100px; "class="col-md-1 col-xs-1">
 													<input type="date" class="form-control input-sm" name="pulse" placeholder="pulse">
 												</div>
 												<div style="width: 100px; "class="col-md-1 col-xs-1">
 													<input type="text" class="form-control input-sm" name="bp" placeholder="bp">
 												</div>
 												<div style="width: 100px; "class="col-md-1 col-xs-1">
 												   <input type="text" class="form-control input-sm" name="resp" placeholder="resp">
 												 </div>
												 <div style="width: 100px; "class="col-md-1 col-xs-1">
 													<input type="date" class="form-control input-sm" name="urinalysis" placeholder="urine">
 												</div>
 												<div style="width: 100px; "class="col-md-1 col-xs-1 col-md-offset-0">
 													<button type="submit" class="btn btn-primary">Add Vitals</button>
 												</div>

											</div>

										</form>
				  				</div>
				  			</div>
				  		</div>

    					<div class="row">
    						<div class="panel panel-default">
    							<div class="panel-body">
    								<h5><b>Sign and Symptons for this Condition</b></h5>
    									<hr style="width: 98%;">
    										<div class="table-responsive">
    										  <table class="table">
    											<thead>
    											  <tr>
    												<th>Date</th>
    												<th>Signs and Symptons</th>
    												<th>Recorded By</th>
    											  </tr>
    											</thead>
    											<tbody>

                                                <?php
                                                if ($symptons_resultset !== null) {
                                                    $symptons_resultset->data_seek(0);
                                                    while ($row_symptons = $symptons_resultset->fetch_assoc()) :
                                                        //  var_dump($_POST);
                                                        if ($row_symptons['med_his_id'] === $row_med_his['med_his_id']) {?>

                                                        <form  action='<?php $_SERVER['PHP_SELF'];  ?>' method="post">
            											  <tr>
                                                              <td><?php echo isset($row_symptons['date']) ? $row_symptons['date'] : ''; ?>
                                                                  <input type="hidden" name="id" value="<?php echo isset($row_symptons['symp_id']) ? $row_symptons['symp_id'] :''; ?>">
                                                              </td>

                                                              <?php if(!empty($_POST) && $_POST['submit'] === 'edit-symp' && $_POST['id'] == $row_symptons['symp_id']) { ?>
                                                                     <td>
                                                                         <input style="width: 200px;" name="symptom" value="<?php echo isset($_POST['symptom']) ? $_POST['symptom'] : ''; ?>" style="width: 60px;" type="text" class="form-control input-sm" placeholder="symptom">
                                                                     </td>
                                                              <?php  } else { ?>
                                                                     <td><?php echo isset($row_symptons['symptom']) ? $row_symptons['symptom'] : ''; ?>
                                                                         <input type="hidden" name="symptom" value="<?php echo isset($_POST['symptom']) ? $_POST['symptom'] : $row_symptons['symptom']; ?>">
                                                                     </td>
                                                              <?php } ?>

                                                              <td><?php echo isset($row_symptons['lastname']) ? 'Dr. ' .  $row_symptons['lastname'] : '' ; ?></td>

                                                              <?php if(!empty($_POST) && $_POST['submit'] === 'edit-symp' && $_POST['id'] == $row_symptons['symp_id']) { ?>
                                                                        <!-- Edit mode for table row  -->
                                                                        <td><button type="submit"  name="submit" value='save-symp' class='btn btn-link'>Save</button></td>
                                                              <?php } else { ?>
                                                                        <!-- Save and 'Just Loaded Paged' mode for table row  -->
                                                                        <td><button type="submit"  name="submit" value='edit-symp' class='btn btn-link'>Edit</button></td>
                                                              <?php } ?>
            											  </tr>
                                                      </form>
                                                <?php } endwhile; }?>
    											</tbody>

    										  </table>
    									</div>

    									<form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">

    										<div class="form-group">
    											<div class="col-md-3 col-xs-1">
    												<input type="date" class="form-control input-sm" name="signs" placeholder="Signs">
    											</div>

    											<div class="col-md-2 col-xs-1 col-md-offset-6" >
    												<button type="submit" class="btn btn-primary">Add Signs & Symptons</button>
    											</div>

    										</div>

    									</form>
    							</div>
    						</div>
    					</div>



				  		<div class="row">
				  			<div class="panel panel-default">
				  				<div class="panel-body">
				  					<h5><b>Treatment and Medication for this Condition</b></h5>
				  					 	<hr style="width: 98%;">
				  							<div class="table-responsive">
											  <table class="table">
											    <thead>
												  <tr>
  											        <th>Date</th>
  											        <th>Treatment</th>
  											        <th>Medication</th>
  											        <th>Hospital</th>
  											        <th>Treated By</th>
  											      </tr>
											    </thead>
											    <tbody>

                                                <?php
                                                if ($treat_and_med_resultset !== null) {
                                                    $treat_and_med_resultset->data_seek(0);
                                                    while ($row_treat = $treat_and_med_resultset->fetch_assoc()) :
                                                        //  var_dump($_POST);
                                                        if ($row_treat['med_his_id'] === $row_med_his['med_his_id']) {?>

                                                        <form  action='<?php $_SERVER['PHP_SELF'];  ?>' method="post">
        											      <tr>

                                                              <!-- Data Id hidden Elements -->
                                                              <td><?php echo isset($row_treat['date']) ? $row_treat['date'] : ''; ?>
                                                                  <input type="hidden" name="id-treat" value="<?php echo isset($row_treat['treat_id']) ? $row_treat['treat_id'] : ''; ?>">
                                                                  <input type="hidden" name="id-med" value="<?php echo isset($row_treat['med_id']) ? $row_treat['med_id'] : ''; ?>">
                                                              </td>

                                                              <?php if(!empty($_POST) && $_POST['submit'] === 'edit-treat-med' && ($_POST['id-treat'] == $row_treat['treat_id'] || $_POST['id-med'] == $row_treat['med_id'])) { ?>
                                                                  <td><input style="width: 200px;" name="treatment" value="<?php echo isset($_POST['treatment']) ? $_POST['treatment'] : ''; ?>" style="width: 60px;" type="text" class="form-control input-sm" placeholder="treatment"></td>
                                                                  <td><input style="width: 200px;" name="medication" value="<?php echo isset($_POST['medication']) ? $_POST['medication'] : ''; ?>" style="width: 60px;" type="text" class="form-control input-sm" placeholder="medication"></td>
                                                              <?php  } else { ?>
                                                                  <td><?php echo isset($row_treat['treatment']) ? $row_treat['treatment'] : ''; ?><input type="hidden" name="treatment" value="<?php echo isset($_POST['treatment']) ? $_POST['treatment'] : $row_treat['treatment']; ?>"></td>
                                                                  <td><?php echo isset($row_treat['medication']) ? $row_treat['medication'] : ''; ?><input type="hidden" name="medication" value="<?php echo isset($_POST['medication']) ? $_POST['medication'] : $row_treat['medication']; ?>"></td>
                                                              <?php } ?>

                                                            <td><?php echo isset($row_treat['hospital']) ? 'Dr. ' .  $row_treat['hospital'] : '' ; ?></td>
                                                            <td><?php echo isset($row_treat['lastname']) ? 'Dr. ' .  $row_treat['lastname'] : '' ; ?></td>


        													<<?php if(!empty($_POST) && $_POST['submit'] === 'edit-treat-med' && ($_POST['id-treat'] == $row_treat['treat_id'] || $_POST['id-med'] == $row_treat['med_id'])) { ?>
                                                                        <!-- Edit mode for table row  -->
                                                                        <td><button type="submit"  name="submit" value='save-treat-med' class='btn btn-link'>Save</button></td>
                                                            <?php  } else { ?>
                                                                        <!-- Save and 'Just Loaded Paged' mode for table row  -->
                                                                        <td><button type="submit"  name="submit" value='edit-treat-med' class='btn btn-link'>Edit</button></td>
                                                            <?php } ?>
											              </tr>
                                                      </form>
                                                <?php } endwhile; }?>
											    </tbody>
											  </table>
										</div>

										<form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">

											<div class="form-group">
												<div class="col-md-2 col-xs-2">
													<input type="date" class="form-control input-sm" name="treatment" placeholder="Treatment">
												</div>
												<div class="col-md-2 col-xs-2">
													<input type="text" class="form-control input-sm" name="medication" placeholder="Medication">
												</div>

												<div class="col-md-2 col-xs-2 col-md-offset-4">
													<button type="submit" class="btn btn-primary">Add Medication & Treatment</button>
												</div>

											</div>

										</form>
				  				</div>
				  			</div>
				  		</div>
			     </div>
			</div>
            <br>
            <hr style="width: 98%;">
            <br>
        <?php endwhile; } ?>
		</div>
	</div>
</div>
</div>


<?php include 'footer.php' ?>
<!-- <script>
	$('td').attr('contenteditable',true);
</script> -->
