<?php
include 'header.php';

var_dump($_POST);

 ?>


<div id="wrapper">
	<div class="main-content-wrapper" id="p-info">
		<div class="main-content">
			<div class="panel panel-default">
			  <div class="panel-body" style="padding:0 55px;">
				<span><h3><b>Edit Medical History</b></h3></span>
				<p>of <b>First Last Name</b></p> <br>
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
 		 											<th>Weight</th>
 		 											<th>Height</th>
 		 											<th>Temp</th>
 		 											<th>Pulse</th>
 		 											<th>B/P</th>
 		 											<th>Resp</th>
 		 											<th>Urinalysis</th>
 		 											<!-- <th>Hospital</th> -->
 		 											<th>Taken By</th>
 		 										  </tr>
											    </thead>
											    <tbody>
											      <tr>
											        <td>1</td>
											        <td>Anna</td>
											        <td>Pitt</td>
											        <td>35</td>
											        <td>New York</td>
											        <td>USA</td>
													<td>35</td>
											        <td>New York</td>
											        <td>USA</td>
													<td><button type="button" class='btn btn-link' name="button">Edit</button></td>

											      </tr>
											    </tbody>
											  </table>
										</div>

										<form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">

											<div class="form-group">
												<div class="col-md-1 col-xs-1">
													<input type="date" class="form-control input-sm" name="weight" placeholder="weight">
												</div>
												<div class="col-md-1 col-xs-1">
													<input type="text" class="form-control input-sm" name="height" placeholder="height">
												</div>
												<div class="col-md-1 col-xs-1">
												   <input type="text" class="form-control input-sm" name="temp" placeholder="temp">
												 </div>
												 <div class="col-md-1 col-xs-1">
 													<input type="date" class="form-control input-sm" name="pulse" placeholder="pulse">
 												</div>
 												<div class="col-md-1 col-xs-1">
 													<input type="text" class="form-control input-sm" name="bp" placeholder="bp">
 												</div>
 												<div class="col-md-1 col-xs-1">
 												   <input type="text" class="form-control input-sm" name="resp" placeholder="resp">
 												 </div>
												 <div class="col-md-1 col-xs-1">
 													<input type="date" class="form-control input-sm" name="urinalysis" placeholder="urine">
 												</div>
 												<div class="col-md-1 col-xs-1 col-md-offset-3">
 													<button type="submit" class="btn btn-primary">Update Vitals</button>
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
</div>
</div>


<?php include 'footer.php' ?>
<!-- <script>
	$('td').attr('contenteditable',true);
</script> -->
