<?php
include 'header.php';

var_dump($_POST);

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
							<option  value="userid-11043" selected>Davane Davis &#8226; ID# 11043</option>
							 <option value="userid-11043" >Garfield &#8226; ID# 11043</option>
							 <option value="userid-11043">Orville &#8226; ID# 11043</option>
							 <option value="userid-11043">Shecky &#8226; ID# 11043</option>
							 <option value="userid-11043">Darian &#8226; ID# 11043</option>
					   </select>
			   	    </p>

	                <hr style="width: 98%;">
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
