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
				<span><h3><b>Edit Medical History</b></h3></span>
				<div class="row">
					<form>
						<div class="form-group">
							<div class="col-md-3">
								<label for="q">Medical Conditions</label>
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control" id="q" placeholder="Asthmne, Diabetes">
							</div>
							<div class="col-md-3">
								<button type="submit" class="btn btn-submit-rq">Update</button>
							</div> 
						</div>
					</form>
				</div>
			  </div>
			  
				  <div class="panel panel-default" id="pad-panel">
				  	<div class="panel-body">
				  		<div class="row">
				  			<form>
				  				<div class="form-group">
						  			<div class="col-md-1">
						  				<label for="condi"><h5>Condition:</h5></label>
						  			</div>
						  			<div class="col-md-3">
						  				<input type="text" class="form-control" id="condi" placeholder="Broken Leg, Flu">
						  			</div>
						  			<div class="col-md-4 col-md-offset-4">
						  				<span><b>Date Modified:</b> add php script</span>
						  			</div>
					  			</div>
				  			</form>
				  		</div>
				  		<div class="row">
				  			<div class="panel panel-default">
				  				<div class="panel-body">
				  					<h5>Vitals for this condition</h5>
				  					 	<hr style="width: 98%;">
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
		</div>
	</div>
</div>


<?php include 'footer.php' ?>
<script>
	$('td').attr('contenteditable',true);
</script>