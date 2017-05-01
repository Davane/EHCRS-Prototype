<?php
include_once 'core/patient/patient.inc.php';
is_session_started();

$nameSet = null;

if(isset($_SESSION['key'])) {

    $id = get_value_from_session('key');
    #destroy_session_value('key');

    # getting patient name
    if($id !== null) {
        $nameSet = get_patient_name($id);
    }

    # getting patient medical history information


}


include 'header.php';
?>

<div class="container content">
			<div class="panel panel-default">
			  <div class="panel-body" style="padding:0 55px;">
				<span><h3><b>Edit Medical History</b></h3></span>
				<p>of <b><?php
                    if ($nameSet !== null) {
                        echo $nameSet['firstname'] . ' ' . $nameSet['lastname'];
	                } ?>
                </b></p> <br>
				<p><a href="edit-personal-info.php">Edit Patient Personal Record</a></p>

				<hr style="width: 98%;">

				<div class="row">

						<div class="form-group">
							<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
							<div class="col-md-3">
								<label for="q">Medical Conditions</label>
							</div>
							<div class="col-md-7">
								<input type="text" name='medical_condition' class="form-control" id="q" placeholder="Asthmna, Diabetes">
							</div>
							<div class="col-md-2">
								<button type="submit" class="btn btn-submit-rq">Update</button>
							</div>
						</form>

						</div>

				</div>
			  </div>

				  <div class="panel panel-default" id="pad-panel">
				   <div class="panel-body">
				  		<div class="row">
							<div class="form-group">
								<div class="col-md-2">
									<label for="condi"><h5><b>Reported Condition:</b></h5></label>
								</div>

								<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
									<div class="col-md-3">
										<input type="text" name='condition' class="form-control" id="condi" placeholder="">
									</div>
									<div class="col-md-1 col-xs-2">
										<button type="submit" class="btn btn-primary">Update Conditions</button>
									</div>
								</form>

								<div class="col-md-4 col-md-offset-2">
									<span><b>Date Visited:</b> add php script</span>
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

                                                <form class="" action='<?php $_SERVER['PHP_SELF'];  ?>' method="post">
    											      <tr>

                                                          <!-- Not editable -->
    											        <td>09-09-09 <input type="hidden" name="id" value="x"></td>

                                                        <?php if(!empty($_POST) && $_POST['submit'] === 'edit') { ?>
                                                               <td><input name="weight" value="<?php echo isset($_POST['weight']) ? $_POST['weight'] : ''; ?>" style="width: 60px;" type="date" class="form-control input-sm" placeholder="weight"></td>
                                                               <td><input name="height" value="<?php echo isset($_POST['height']) ? $_POST['height'] : ''; ?>" style="width: 60px;" type="text" class="form-control input-sm" placeholder="height"></td>
                                                               <td><input name="temp"   value="<?php echo isset($_POST['temp']) ? $_POST['temp'] : ''; ?>" style="width: 60px;" type="text" class="form-control input-sm" placeholder="temp"></td>
                                                               <td><input name="pulse"  value="<?php echo isset($_POST['pulse']) ? $_POST['pulse'] : ''; ?>" style="width: 60px;" type="text" class="form-control input-sm" placeholder="pulse"></td>
                                                               <td><input name="bp" value="<?php echo isset($_POST['bp']) ? $_POST['bp'] : ''; ?>" style="width: 60px;" type="text" class="form-control input-sm" placeholder="bp"></td>
                                                               <td><input name="reps" value="<?php echo isset($_POST['resp']) ? $_POST['resp'] : ''; ?>" style="width: 60px;" type="text" class="form-control input-sm" placeholder="resp"></td>
                                                               <td><input name="urine" value="<?php echo isset($_POST['urine']) ? $_POST['urine'] : ''; ?>" style="width: 60px;" type="text" class="form-control input-sm" placeholder="urine"></td>
                                                           <?php  } else { ?>
                                                               <td><?php echo isset($_POST['weight']) ? $_POST['weight'] : ''; ?><input type="hidden" name="weight" value="<?php echo isset($_POST['weight']) ? $_POST['weight'] : '' /*Value from databse*/; ?>"></td>
                                                               <td>4'4" <input type="hidden" name="height" value="4'4''"></td>
               											       <td>94    <input type="hidden" name="temp" value="94"></td>
           											           <td>34/43 <input type="hidden" name="pulse" value="34/43"></td>
           											           <td>12/70 <input type="hidden" name="bp" value="12/70"></td>
           													   <td>33    <input type="hidden" name="resp" value="33"></td>
           											           <td>45    <input type="hidden" name="urine" value="45"></td>
                                                           <?php } ?>

                                                          <!-- Not editable -->
    											        <td>Dr. WhathisFace</td>

                                                        <?php if(!empty($_POST) && $_POST['submit'] === 'edit') { ?>
                                                                    <!-- Edit mode for table row  -->
    													            <td><button type="submit"  name="submit" value='save' class='btn btn-link'>Save</button></td>
                                                        <?php  } else { ?>
                                                                    <!-- Save and 'Just Loaded Paged' mode for table row  -->
                                                                    <td><button type="submit"  name="submit" value='edit' class='btn btn-link'>Edit</button></td>
                                                        <?php } ?>
    											      </tr>
                                                  </form>

											    </tbody>

											  </table>
									       </div>

										<!-- <form class="" action="<?php# $_SERVER['PHP_SELF']; ?>" method="post">

											<div class="form-group">
												<div class="col-md-2 col-xs-2">
													<input value="<?php #echo isset($_POST['weight']) ? $_POST['weight'] : ''; ?>" type="date" class="form-control input-sm" name="weight" placeholder="weight">
												</div>
												<div class="col-md-2 col-xs-2">
													<input type="text" class="form-control input-sm" name="height" placeholder="height">
												</div>
												<div class="col-md-2 col-xs-2">
												   <input type="text" class="form-control input-sm" name="temp" placeholder="temp">
												 </div>
												 <div class="col-md-2 col-xs-2">
 													<input type="date" class="form-control input-sm" name="pulse" placeholder="pulse">
 												</div>
 												<div class="col-md-2 col-xs-2">
 													<input type="text" class="form-control input-sm" name="bp" placeholder="bp">
 												</div>
 												<div class="col-md-2 col-xs-2">
 												   <input type="text" class="form-control input-sm" name="resp" placeholder="resp">
 												 </div>
												 <div class="col-md-2 col-xs-2">
 													<input type="date" class="form-control input-sm" name="urinalysis" placeholder="urine">
 												</div>
 												<div class="col-md-2 col-xs-2 col-md-offset-8">
 													<button type="submit" class="btn btn-primary">Update Vitals</button>
 												</div>

											</div>

										</form> -->
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
											      <tr>
											        <td>Anna</td>
											        <td>Pitt</td>
											        <td>35</td>
											        <td>New York</td>
													<td>New York</td>
													<td><button type="button" class='btn btn-link' name="button">Edit</button></td>

											      </tr>
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
													<button type="submit" class="btn btn-primary">Update Medication & Treatment</button>
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
													<th>Signs</th>
													<th>Recorded By</th>

												  </tr>
												</thead>
												<tbody>
												  <tr>
													<td>Anna</td>
													<td>Pitt</td>
													<td>35</td>
													<td><button type="button" class='btn btn-link' name="button">Edit</button></td>
												  </tr>
												</tbody>
											  </table>
										</div>

										<form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">

											<div class="form-group">
												<div class="col-md-3 col-xs-1">
													<input type="date" class="form-control input-sm" name="signs" placeholder="Signs">
												</div>

												<div class="col-md-2 col-xs-1 col-md-offset-6" >
													<button type="submit" class="btn btn-primary">Update Signs & Symptons</button>
												</div>

											</div>

										</form>
								</div>
							</div>
						</div>
			     </div>
			</div>
		
</div>
</div>


<?php include 'footer.php' ?>
<!-- <script>
	$('td').attr('contenteditable',true);
</script> -->
