<?php include 'header.php' ?>

<div id="wrapper">
	<div class="sidebar-wrapper">
		<div class="sidebar">
			<ul>
				<li></li>
			</ul>
		</div>
	</div>

	<div class="main-content-wrapper" id="p-info">
		<div class="main-content">
			<div class="panel panel-default">
			  <div class="panel-body" style="padding:0 55px;">
				<div class="row">
					<div class="col-xs-5 col-md-5">
						<br>
						<br>
						<div align="center">
							<img src="img/avatar1.png" alt="profile picture" class="img-circle img-responsive" id="pro-img">
						</div>
					</div>

					<div class="col-xs-7 col-md-7">
					<div style="line-height: 0.7;margin-top: 63px; margin-left: -50px;" align="left">
						<strong><h4>Davane Davis </h4></strong>
						<p>August 01, 2001 &nbsp; 23 &nbsp; Male</p>
						<address>php script to insert address & stuff</address>
						<p>Insured by <b>Company</b> &nbsp; &nbsp; &nbsp; <span style="background:lightgrey; padding: 2px;color:black">&nbsp;&nbsp;&nbsp; Status &nbsp;&nbsp;&nbsp;</span></p>
					</div>
					</div>
				</div><br><br>
					<div class="row">
						<div class="panel-group" id="accordion">
						    <div class="panel panel-default">
						      <div class="panel-heading">
						        <h4 class="panel-title">
						          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Latest Vital</a>
						        </h4>
						      </div>
						      <div id="collapse1" class="panel-collapse collapse in">
						        <div class="panel-body">
						        	<div class="table-responsive">          
									  <table class="table">
									    <thead>
									      <tr>
									        <th>#</th>
									        <th>Firstname</th>
									        <th>Lastname</th>
									        <th>Age</th>
									        <th>City</th>
									        <th>Country</th>
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
									      </tr>
									    </tbody>
									  </table>
									</div>
									<!-- However I think the smarter thing for you to do is to write a script for each of these and include the script here -->
						        </div>
						      </div>
						    </div>
						    <div class="panel panel-default">
						      <div class="panel-heading">
						        <h4 class="panel-title">
						          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Health History</a>
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
						          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Allergies / Medications</a>
						        </h4>
						      </div>
						      <div id="collapse3" class="panel-collapse collapse">
						        <div class="panel-body">
						        	
						        </div>
						      </div>
						    </div>
						    <div class="panel panel-default">
						      <div class="panel-heading">
						        <h4 class="panel-title">
						          <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Previous Surguries / Lab Test</a>
						        </h4>
						      </div>
						      <div id="collapse4" class="panel-collapse collapse">
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
</div>

<?php include 'footer.php' ?>