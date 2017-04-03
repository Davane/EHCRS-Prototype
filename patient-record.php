<?php include 'header.php' ?>
<div id="wrapper">
	<div class="main-content-wrapper" id="p-info">
		<div class="main-content">
			  <div class="row">
			  	<div class="col-md-3">
			  		<img src="img/avatar1.png" alt="profile picture" class="img-responsive" width="125px" height="50px">
			  	</div>
			  	<div class="col-md-5">
			  		<span><h5><b>Davane D. Davis</b></h5></span>
			  		<span>August 6, 2000. 
			  		<ul class="list-inline">
					  <li>$age</li>
					  <li>$gender</li>
					</ul>
					</span>
					<span>Patient Status: eg, Breast Cancer 1 or nothing</span>
					<address>php display address</address>
			  	</div>
			  	<div class="col-md-1 col-md-offset-3">
			  		<a href="#">Edit Record</a>
			  	</div>
			  </div>
			  <br><br>
			  <div class="row">
			  	<div class="col-md-6">
			  		<div class="panel panel-default">
			  			<div class="panel">
			  				<div align="">
			  					<b>Latest Vital</b>

			  					<b>$timestamp</b>
			  				</div>

			  			<hr style="width: 98%;">
			  				<div class="row">
			  					<div class="col-md-6">
			  						<p>Temperature: 34</p>
			  						<p>Temperature: 34</p>
			  						<p>Temperature: 34</p>
			  						<p>Temperature: 34</p>
			  						<p>Temperature: 34</p>
			  					</div>
			  					<div class="col-md-6">
			  						<p>Weight: 164 lbs</p>
			  						<p>Weight: 164 lbs</p>
			  						<br>
			  					</div>
			  				</div>
			  				<div align="right">
			  		<a href="#"><sm>view history..</sm></a>
			  	</div>
			  			</div>
			  		</div>
			  	</div>
			  	<div class="col-md-6">
			  		<div class="panel panel-default">
			  			<div class="panel">

			  					<b>Current Condition</b>


			  					<sm>$timestamp</sm>

			  				<hr style="width: 98%;">
			  						<p>Flu</p>
			  					
			  					<b>Current Signs</b>
			  					<hr style="width: 98%;">
				  					
				  				<p>Flu, sufisugsu</p>
			  			</div>
			  		</div>
			  	</div>
			  </div>

			<div class="row">
				<div class="col-md-6">
					<div class="panel-group" id="accordion">
						    <div class="panel panel-default">
						      <div class="panel-heading">
						        <h4 class="panel-title">
						          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Previous Checkup</a>
						        </h4>
						      </div>
						      <div id="collapse1" class="panel-collapse collapse ">
						        <div class="panel-body">

						        </div>
						       </div>
						    </div>

						    <div class="panel panel-default">
						      <div class="panel-heading">
						        <h4 class="panel-title">
						          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Allergies / Medications</a>
						        </h4>
						      </div>
						      <div id="collapse2" class="panel-collapse collapse">
						        <div class="panel-body">
						        	
						        </div>
						      </div>
						    </div>

						    <div class="panel panel-default">
						      <div class="panel-heading">
						        <h4 class="panel-title">
						          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Prev.</a>
						        </h4>
						      </div>
						      <div id="collapse3" class="panel-collapse collapse">
						        <div class="panel-body">
						        	
						        </div>
						      </div>
						    </div>
						</div>
					</div>

				<div class="col-md-6">
				<div class="panel-group" id="accordion">
					<div class="panel panel-default">
						      <div class="panel-heading">
						        <h4 class="panel-title">
						          <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Health History</a>
						        </h4>
						      </div>
						      <div id="collapse4" class="panel-collapse collapse">
						        <div class="panel-body">
						        	
						        </div>
						      </div>
						    </div>

					<div class="panel panel-default">
						      <div class="panel-heading">
						        <h4 class="panel-title">
						          <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">Insurance</a>
						        </h4>
						      </div>
						      <div id="collapse5" class="panel-collapse collapse">
						        <div class="panel-body">
						        	
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