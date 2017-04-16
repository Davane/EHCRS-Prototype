<?php
include 'header.php';

var_dump($_POST);

?>

<div id="wrapper">
	<div class="main-content-wrapper" id="p-info">
		<div class="main-content">
			<div class="panel panel-default">
			  <div class="panel-body" style="padding:0 55px;">
				<span><h3><b>Edit Personal Record</b></h3></span>
                <p>of <b>First Last Name</b></p> <br>
				<p> go to <a href="medical-history.php">Edit Patient Medical History</a></p>

                <hr style="width: 98%;">

				<div class="row">
					<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
						<div class="form-group">
							<div class="col-md-3">
                                <label>First Name</label>
								<input type="text" class="form-control" name="firstName" placeholder="First Name">
							</div>
                            <div class="col-md-3">
                                <label>Middle Name</label>
								<input type="text" class="form-control" name="middleName" placeholder="Middle Name">
							</div>
                            <div class="col-md-3">
                                <label>Last Name</label>
								<input type="text" class="form-control" name="lastName" placeholder="Last Name">
							</div>
                            <div class="col-md-3">
                                <label>Maiden Name</label>
                                <input type="text" class="form-control" name="maidenName" placeholder="Maiden Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Email">
                            </div>
                            <div class="col-md-6">
                                <label>TRN</label>
                                <input type="text" class="form-control" name="trn" placeholder="TRN">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 col-xs-12">
                                <label><h5>Address</h5></label>
                            </div>

                            <div class="col-md-6">
                                <label>Street Name</label>
                                <input type="text" class="form-control" name="address" placeholder="Street Name">
                            </div>
                            <div class="col-md-6">
                                <label>Parish</label>
                                <input type="text" class="form-control" name="parish" placeholder="Parish">
                            </div>
                        </div>

                        <div class="form-group">

    					    <div class="col-md-12 col-xs-12">
                                <label><h5>Emergency Contact</h5></label>
                            </div>

    					    <div class="col-md-4 col-xs-12">
                                <label>Next of Kin</label>
    					    	<input type="text" class="form-control" name="kin" placeholder="Next of Kin">
    					    </div>
    					    <div class="col-md-4 col-xs-12">
                                <label>Relationship</label>
    					    	<input type="text" class="form-control" name="relationship" placeholder="Relationship" >
    					    </div>
    					    <div class="col-md-4 col-xs-12">
                                <label>Tel No</label>
    					    	<input type="tel" class="form-control" name="em_telephone" placeholder="Tel No.">
    					    </div>
    					 </div>

                        <div class="form-group">

                            <div class="col-md-12 col-xs-12">
                                <label><h5>Employment Info</h5></label>
                            </div>

                            <div class="col-md-12 col-xs-4">
                                <input type="text" class="form-control" name="employer_name" placeholder="Name of Employer">
                            </div>
                            <div class="col-md-8 col-xs-4">
                                <input type="address" class="form-control" name="emp_address" placeholder="Address (Street Name)">
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <input type="text" class="form-control" name="emp_parish" placeholder="Parish" >
                            </div>
                         </div>

                         <br><br>

                         <div class="form-group">
                    		<div class="col-md-3"  style="margin-bottom: 30px;margin-top: 30px;">
 								<button type="submit" class="btn btn-submit-rq">Update Personal Info</button>
 							</div>
                        </div>

                         <br><br>

					</form>

			     </div>

              </div>
		   </div>
	   </div>
    </div>
</div>


<?php include 'footer.php' ?>
<script>
	$('td').attr('contenteditable',true);
</script>
