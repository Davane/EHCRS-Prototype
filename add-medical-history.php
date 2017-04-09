<?php
include 'header.php';

var_dump($_POST);

?>

<div id="wrapper">
	<div class="main-content-wrapper" id="p-info">
		<div class="main-content">
			<div class="panel panel-default">
			  <div class="panel-body" style="padding:0 55px;">
				<span><h3><b>New condition</b></h3></span>
				<p>For Patient: <b>First Last name </b></p>
                <hr style="width: 98%;">
					<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
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
     								<button type="submit" class="btn btn-submit-rq">Add New condition</button>
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
