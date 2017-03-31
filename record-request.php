<?php include 'header.php'; ?>

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
			<div class="col-md-12">

			<h2><b>Patient Record Request</b></h2>
					<br><br>
					<p>To request
						 <b class="thicker">Fenise Hamilton's
						 </b> record from <b>X</b> please enter the following information.</p>
					<br>


			<form action="" method="POST">
						<div class="row">
						<div class="col-xs-12 col-md-6">
							<div class="form-group">
								<input class="form-control" type="text" name="hw_id" placeholder="Healthwise ID" required>
							</div>
						</div>
						</div>
						<div class="row">
						<div class="col-xs-12 col-md-6">
							<div class="form-group">
								<input type="text" class="form-control" name="full_name" placeholder="Full Name" required>
							</div>
						</div>
						</div>
						<div class="row">
						<div class="col-xs-12 col-md-6">
							<div class="form-group">
								<input type="password" class="form-control" name="password" placeholder="Password" required>
							</div>
						</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-md-3">
							<div style="margin-bottom: 5px;">
								<button name="submit" class="btn btn-block btn-submit-rq">Request Record</button>
							</div>
							</div>
							<div class="col-xs-12 col-md-3">
								<button class="btn btn-block btn-cancel-rq" onclick="reset();">Cancel</button>
							</div>
							<div class="col-xs-6 col-md-6 hidden-md-down">
							</div>
						</div>
					</form>
			</div>

		</div>
	</div>
</div>

<!-- <div class="record-request">
<div class="wrapper">
	<div class="sidebar">
		<div style="margin-top:10px; display: inline-block;">
			<p>Next Appointment</p>
		</div>
	</div>
		<div class="main-content">
		<div class="container">
		<div class="row">

			<div class="col-md-12">

			<h2><b>Patient Record Request</b></h2>
					<br><br>
					<p>To request <b class="thicker">Fenise Hamilton</b>'s record from <b>X</b> please enter the following information.</p>
					<br>


			<form action="" method="POST">
						<div class="row">
						<div class="col-xs-6">
							<div class="form-group">
								<input class="form-control" type="text" id="hw_id" name="hw_id" placeholder="Healthwise ID" required>
							</div>
						</div>
						</div>
						<div class="row">
						<div class="col-xs-6">
							<div class="form-group">
								<input type="text" class="form-control" id="name" name="full_name" placeholder="Full Name" required>
							</div>
						</div>
						</div>
						<div class="row">
						<div class="col-xs-6">
							<div class="form-group">
								<input type="password" class="form-control" id="dav" name="password" placeholder="Password" required>
							</div>
						</div>
						</div>
					</form>
			</div>
			</div>
		</div>
	</div>
	</div>

</div> -->

<?php include 'footer.php'; ?>
