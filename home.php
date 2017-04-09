<?php

include 'header.php';


 ?>
<div id="wrapper" style="margin-bottom: 50px">
	<div class="main-content-wrapper" id="p-info">
		<div class="main-content" >


            <!-- Scripts for the chart  -->
            <script type="text/javascript" src="js/fusioncharts.js"></script>
            <script type="text/javascript" src="js/themes/fusioncharts.theme.fint.js"></script>

            <script type="text/javascript">
              FusionCharts.ready(function(){
                var revenueChart = new FusionCharts({
                    "type": "column2d",
                    "renderAt": "chartContainer",
                    "width": "500",
                    "height": "300",
                    "dataFormat": "json",
                    "dataSource":  {
                      "chart": {
                        "caption": "Monthly revenue for last year",
                        "subCaption": "Harry's SuperMart",
                        "xAxisName": "Month",
                        "yAxisName": "Revenues (In USD)",
                        "theme": "fint"
                     },
                     "data": [
                        {
                           "label": "Jan",
                           "value": "420000"
                        },
                        {
                           "label": "Feb",
                           "value": "810000"
                        },
                        {
                           "label": "Mar",
                           "value": "720000"
                        },
                        {
                           "label": "Apr",
                           "value": "550000"
                        },
                        {
                           "label": "May",
                           "value": "910000"
                        },
                        {
                           "label": "Jun",
                           "value": "510000"
                        },
                        {
                           "label": "Jul",
                           "value": "680000"
                        },
                        {
                           "label": "Aug",
                           "value": "620000"
                        },
                        {
                           "label": "Sep",
                           "value": "610000"
                        },
                        {
                           "label": "Oct",
                           "value": "490000"
                        },
                        {
                           "label": "Nov",
                           "value": "900000"
                        },
                        {
                           "label": "Dec",
                           "value": "730000"
                        }
                      ]
                  }

              });
            revenueChart.render();
            })
            </script>





            <div class="jumbotron" style="padding-left: 40px; padding-right: 40px;">
              <h1>Welcome to Heath<b>Wise</b></h1>
              <p>Get started with Jamaica's First Interconnected Electronic Health Record System</p>
              <p><a class="btn btn-primary btn-lg" href="about.php" role="button">Learn more</a></p>
            </div>

            <br>
            <h3><b>Emergencies</b> &#8226; <b class="text-danger">34</b></h3>
            <br>

            <div class="row">
              <div class="col-sm-6">
                <div class="card" style="border: 0.5px solid lightgrey; border-radius: 5px; padding-bottom: 20px; padding-left: 20px; padding-right: 15px">
                  <div class="card-block">
                    <h3 class="card-title">Register New Patient</h3>
                    <p class="card-text">Register a patient in the system if they are have never been registered before.</p>
                    <a href="#" class="btn btn-primary">Register</a>
                  </div>
                </div>
              </div>

              <div class="col-sm-6">
                 <div class="card" style="border: 0.5px solid lightgrey; border-radius: 5px; padding-bottom: 20px; padding-left: 20px; padding-right: 15px">
                   <div class="card-block">
                     <h3 class="card-title">Find Patient</h3>
                     <p class="card-text">You can search for a specific pateint by first name, Last name, id and email address</p>
                     <a href="#" class="btn btn-primary">Search</a>
                   </div>
                 </div>
               </div>
            </div>

            <br>
            <h3><b>Statistics</b></h3>
            <br>

            <div class="row">
              <div class="col-sm-8">
                <div class="card" style="border: 0.5px solid lightgrey; border-radius: 5px; padding-bottom: 20px; padding-left: 20px; padding-right: 15px">
                  <div class="card-block">
                    <h3 class="card-title">Some Kind of Patient Statistics</h3>
                     <div id="chartContainer">FusionCharts XT will load here!</div>
                  </div>
                </div>
              </div>

              <div class="col-sm-4">
                 <div class="card" style="border: 0.5px solid lightgrey; border-radius: 5px; padding-bottom: 20px; padding-left: 20px; padding-right: 15px">
                   <div class="card-block">
                     <h3 class="card-title">View More Stats</h3>
                     <p class="card-text">Find more helpful statistics and generate reports</p>
                     <a href="#" class="btn btn-primary">View more</a>
                   </div>
                 </div>
               </div>
            </div>

            <br>
            <h3><b>Patient Actions</b></h3>
            <br>

            <div class="row">
              <div class="col-sm-6">
                <div class="card" style="border: 0.5px solid lightgrey; border-radius: 5px; padding-bottom: 20px; padding-left: 20px; padding-right: 15px">
                  <div class="card-block">
                    <h3 class="card-title">Register New Patient</h3>
                    <p class="card-text">Register a patient in the system if they are have never been registered before.</p>
                    <a href="#" class="btn btn-primary">Register</a>
                  </div>
                </div>
              </div>

              <div class="col-sm-6">
                 <div class="card" style="border: 0.5px solid lightgrey; border-radius: 5px; padding-bottom: 20px; padding-left: 20px; padding-right: 15px">
                   <div class="card-block">
                     <h3 class="card-title">Find Patient</h3>
                     <p class="card-text">You can search for a specific pateint by first name, Last name, id and email address</p>
                     <a href="#" class="btn btn-primary">Search</a>
                   </div>
                 </div>
               </div>
            </div>

            <br>
            <h3><b>Appointments</b></h3>
            <br>
            <div class="row">

              <div class="col-sm-6">
                <div class="card" style="border: 0.5px solid lightgrey; border-radius: 5px; padding-bottom: 20px; padding-left: 20px; padding-right: 15px">
                  <div class="card-block">
                    <h3 class="card-title">View Appointments</h3>
                    <p class="card-text">Monitor all the appointments that are schedule for the day at the hospital you are working.</p>
                    <a href="#" class="btn btn-primary">View Appointment</a>
                  </div>
                </div>
              </div>

              <div class="col-sm-6">
                 <div class="card" style="border: 0.5px solid lightgrey; border-radius: 5px; padding-bottom: 20px; padding-left: 20px; padding-right: 15px">
                   <div class="card-block">
                     <h3 class="card-title">Add appointment</h3>
                     <p class="card-text">Create new Appointments</p><br>
                     <a href="#" class="btn btn-primary">Add Appointment</a>
                   </div>
                 </div>
               </div>

            </div>

		</div>
	</div>
</div>

<?php include 'footer.php' ?>
