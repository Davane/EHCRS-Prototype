<?php include './header.php' ?>
	
<div id="wrapper">
	<div class="sidebar-wrapper">
		<div class="sidebar">
			<ul>
				<li><a href="#">Next Appointment</a></li>
			</ul>
		</div>
	</div>

	<div class="main-content-wrapper">
		<div class="main-content">

			<div class="panel panel-default">
			  <div class="panel-body">
			  <div class="container-fluid">
			  <span><h3>Patient Registration Form</h3></span>
			  <hr style="width: 99%;color:black">
			  <p><b>Names</b></p>
			  <form>
				<div class="row">
				
					<div class="form-group">
					    <div class="col-md-4 col-xs-12">
					    	<input type="name" class="form-control" name="firstName" placeholder="First Name" required>
					    </div>
					    <div class="col-md-4 col-xs-12">
					    	<input type="name" class="form-control" name="middleName" placeholder="Middle Name" required>
					    </div>
					    <div class="col-md-4 col-xs-12">
					    	<input type="name" class="form-control" name="lastName" placeholder="Last Name" required>
					    </div>
					 </div>
				
				</div>

				<div class="row">
				
					<div class="form-group">
					    <div class="col-md-6 col-xs-12">
					    	<input type="name" class="form-control" name="maidenName" placeholder="Maiden Name">
					    </div>
					    <div class="col-md-6 col-xs-12">
					    	<input type="name" class="form-control" name="petName" placeholder="Pet Name">
					    </div>
					 </div>
				
				</div>
				<br>
				<div class="row">
				
					<div class="form-group">
					    <div class="col-md-8 col-xs-8">
					    	<input type="date" class="form-control" name="dob">
					    </div>
					    <div class="col-md-4 col-xs-4">
					    	<input type="number" class="form-control" name="age" placeholder="Age">
					    </div>
					 </div>
				
				</div>

				<div class="row">
				
					<div class="form-group">
					    <div class="col-md-4 col-xs-12">
					    	<input type="tel" class="form-control" name="telephone" placeholder="Telephone">
					    </div>
					    <div class="col-md-4 col-xs-12">
					    	<input type="text" class="form-control" name="religion" placeholder="Religion">
					    </div>
					    <div class="col-md-4 col-xs-12">
					    	<input type="text" class="form-control" name="Union" placeholder="Union">
					    </div>
					 </div>
				
				</div>
				<br>
				<p><b>Address</b></p>

				<div class="row">
				
					<div class="form-group">
					    <div class="col-md-8 col-xs-12">
					    	<input type="text" class="form-control" name="street-name" placeholder="Street Name">
					    </div>
					    <div class="col-md-4 col-xs-12">
					    	<input type="text" class="form-control" name="parish" placeholder="Parish" >
					    </div>
					 </div>
				
				</div>
				<br>
				<p><b>Emergency Contact Information</b></p>

				<div class="row">
				
					<div class="form-group">
					    <div class="col-md-4 col-xs-12">
					    	<input type="text" class="form-control" name="kin" placeholder="Next of Kin">
					    </div>
					    <div class="col-md-4 col-xs-12">
					    	<input type="text" class="form-control" name="relationship" placeholder="Relationship" >
					    </div>
					    <div class="col-md-4 col-xs-12">
					    	<input type="tel" class="form-control" name="em-telephone" placeholder="Tel No." required>
					    </div>
					 </div>
				
				</div>

				<div class="row">
				
					<div class="form-group">
					    <div class="col-md-6 col-xs-12">
					    	<input type="text" class="form-control" name="mother-name" placeholder="Mother's Name">
					    </div>
					    <div class="col-md-6 col-xs-12">
					    	<input type="text" class="form-control" name="father-name" placeholder="Father's Name" >
					    </div>
					 </div>
				
				</div>
				<br>
				<p><b>Employment Information</b></p>

				<div class="row">
				
					<div class="form-group">
					    <div class="col-md-12 col-xs-12">
					    	<input type="text" class="form-control" name="employer-name" placeholder="Name of Employer">
					    </div>
					 </div>
				
				</div>

				<div class="row">
				
					<div class="form-group">
					    <div class="col-md-8 col-xs-12">
					    	<input type="address" class="form-control" name="emp-address" placeholder="Address (Street Name)">
					    </div>
					    <div class="col-md-4 col-xs-12">
					    	<input type="text" class="form-control" name="emp-parish" placeholder="Parish" >
					    </div>
					 </div>
				
				</div>

				<div class="row">
				
					<div class="form-group">
					    <div class="col-md-7 col-xs-12">
					    	<input type="tel" class="form-control" name="emp-tel" placeholder="Tel No.">
					    </div>
					    <div class="col-md-5 col-xs-12">
					    	<input type="text" class="form-control" name="occupation" placeholder="Occupation" >
					    </div>
					 </div>
				
				</div>
				<br>
				<p><b>Presenting Complaint</b></p>

				<div class="row">
				
					<div class="form-group">
					    <div class="col-md-12 col-xs-12">
					    	<input type="tel" class="form-control" name="condition" placeholder="Condition">
					    </div>
					</div>
				
				</div>
				<br>
				<p><b>Vitals</b></p>

				<div class="row">
				
					<div class="form-group">
					    <div class="col-md-3 col-xs-6">
					    	<label for="height">Height</label>
					    	<input type="text" class="form-control" name="height" id="height">
					    </div>
					    <div class="col-md-3 col-xs-6">
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
					</div>
				
				</div>

				<div class="row">
				
					<div class="form-group">
					    <div class="col-md-4 col-xs-12">
					    	<label for="resp">Resp</label>
					    	<input type="tel" class="form-control" name="resp" id="resp">
					    </div>
					    <div class="col-md-4 col-xs-12">
					    	<label for="urinalysis">Urinalysis</label>
					    	<input type="text" class="form-control" name="urinalysis" id="urinalysis">
					    </div>
					    <div class="col-md-4 col-xs-12">
					    </div>
					 </div>
				
				</div>
				<br>

				<div class="row">
				
					<div class="form-group">
					    <div class="col-md-8 col-xs-12">
					    	<input type="file" name="pic" accept="image/*">
					    </div>
					    <div class="col-md-4 col-xs-12">
					    	<button name="submit" class="btn btn-block btn-submit-rq">Register</button>
					    </div>
					</div>
				
				</div>

				</form>
			  </div>
			</div>
			</div>
		</div>
	</div>
</div>

<?php include 'footer.php' ?>