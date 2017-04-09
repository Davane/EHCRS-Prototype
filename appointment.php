<?php

require_once 'core/physician/physician.inc.php';
include 'header.php';

$error = array();

if(true /* if session is set*/) {
	# get pyhsicain ID


} else {
	echo "Redirect : Login-redirect";
}




 ?>
<div id="wrapper">
	<div class="main-content-wrapper" id="p-info">
		<div class="main-content">
			  <div class="row">
				  <h4>Remaining appointments :<code><b>echo session user</b></code> </h4>
				  <br>
			  	  <p><code><b>echo session user</b></code> your next patient is : </p>
			  		<div class="panel panel-default">
			  			<div class="panel">
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
			  			</div>
			  		</div>
			  </div>

			  <div class="row">
			  	<p><code><b>echo session user</b></code> your next appointment is scheduled for : </p>
			  		<div class="panel panel-default">
			  			<div class="panel">
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
			  			</div>
			  		</div>
			  </div>
		</div>
	</div>
</div>

<?php include 'footer.php' ?>
