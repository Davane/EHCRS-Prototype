<?php


include_once 'core/physician/physician.inc.php';
is_session_started();

include_once 'header.php';
$error = array();

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
                    "renderAt": "columnChartContainer",
                    "width": "750",
                    "height": "350",
                    "dataFormat": "json",
                    "dataSource":  {
                      "chart": {
                        "caption": "Fatalies across the island",
                        "subCaption": "Based on hospital locations",
                        "xAxisName": "Parishes",
                        "yAxisName": "Number of deaths",
                        "theme": "fint"
                     },
                     "data": [
                        {
                           "label": "Clarendon",
                           "value": "420000"
                        },
                        {
                           "label": "Portland",
                           "value": "810000"
                        },
                        {
                           "label": "Hanover",
                           "value": "720000"
                        },
                        {
                           "label": "Manchester",
                           "value": "550000"
                        },
                        {
                           "label": "St. Thomas",
                           "value": "910000"
                        },
                        {
                           "label": "Trewlawny",
                           "value": "510000"
                        },
                        {
                           "label": "St. Mary",
                           "value": "680000"
                        },
                        {
                           "label": "St. Mary",
                           "value": "620000"
                        },
                        {
                           "label": "St. Ann",
                           "value": "610000"
                        },
                        {
                           "label": "St. Elizabeth",
                           "value": "490000"
                        },
                        {
                           "label": "St. Catherine",
                           "value": "900000"
                        },
                        {
                           "label": "Westmoreland",
                           "value": "730000"
                        },
                        {
                           "label": "St. James",
                           "value": "730000"
                        },
                        {
                           "label": "St. Andrew",
                           "value": "730000"
                        }
                      ]
                  }

              });
            revenueChart.render();
            })
            </script>


            <script type="text/javascript">


              FusionCharts.ready(function(){
                var revenueChart = new FusionCharts({
                    "type": "doughnut2d",
                    "renderAt": "donutChartContainer",
                    "width": "400",
                    "height": "400",
                    "dataFormat": "json",
                    "dataSource":  {

                      "chart": {
                        "caption": "Most Common Illness",
                        "subCaption": "hospitaln name",
                        "xAxisName": "Week",
                        "yAxisName": "Number if illness",
                        "theme": "fint"
                     },
                     "data": [
                        {
                            "label": "Sun",
                            "value": "810000"
                        },
                        {
                           "label": "Mon",
                           "value": "420000"
                        },
                        {
                           "label": "Tues",
                           "value": "810000"
                        },
                        {
                           "label": "Wed",
                           "value": "720000"
                        },
                        {
                           "label": "Thur",
                           "value": "550000"
                        },
                        {
                           "label": "Fri",
                           "value": "910000"
                        },
                        {
                           "label": "Sat",
                           "value": "510000"
                        }
                      ]
                  }

              });
            revenueChart.render();
            })

            </script>



            <script type="text/javascript">


              FusionCharts.ready(function(){
                var revenueChart = new FusionCharts({
                    "type": "pie2D",
                    "renderAt": "pieChartContainer",
                    "width": "400",
                    "height": "400",
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

            <?php

            if($work_id = get_physician_work_place(get_user_id_from_session())){

                $resultSet = get_emergency_count($work_id);

                if($resultSet->num_rows === 0) {
                    $error['error'] = 'Not Appointments';
                }
            } else {
                echo 'error: work place not found';
                $error['error'] = 'error: work place not found';
            }


             ?>

            <br>
            <h3><b>Emergencies </b> &#8226; <span class="badge"><b><?php  if(empty($error)){
                $inc = (int)$resultSet->fetch_assoc()['inc_em'];
                $resultSet->data_seek(0);
                $em = (int) $resultSet->fetch_assoc()['em'] ;
                echo $inc + $em;
                }?> </b></span></h3>
            <br>

            <div class="row">



              <div class="col-sm-6">
                <div class="card bg-danger" style="border: 0.5px solid lightgrey; border-radius: 5px; padding-bottom: 20px; padding-left: 20px; padding-right: 15px">
                  <div class="card-block">
                    <h3 class="card-title">In Hospital Emergencies</h3>
                    <p class="card-text"> <mark><b><?php  if(empty($error)){  $resultSet->data_seek(0); echo $resultSet->fetch_assoc()['inc_em']; } else { echo "No";}?></b></mark> Emergency cases currently in (brought in and waiting to be attended to)</p>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                 <div class="card bg-danger" style="border: 0.5px solid lightgrey; border-radius: 5px; padding-bottom: 20px; padding-left: 20px; padding-right: 15px">
                   <div class="card-block">
                     <h3 class="card-title">Incomming Emergencies</h3>
                    <p class="card-text"> <code><b><?php  if(empty($error)){ $resultSet->data_seek(0); echo $resultSet->fetch_assoc()['em']; } else { echo "No";}?></b></code> Emergency cases currently on there way to the hospital (in ambulance or other means)</p>
                   </div>
                 </div>
               </div>
            </div>
            <h5>Go to <a href="appointment.php">Emergencies and Appointments ></a></h5>
            <br>
            <h3><b>Statistics</b></h3>
            <br>

              <div class="row">
              <div class="col-sm-12">
                <div class="card" style="border: 0.5px solid lightgrey; border-radius: 5px; padding-bottom: 20px; padding-left: 20px; padding-right: 15px">
                  <div class="card-block">
                      <center>
                          <h3 class="card-title">Fatalities across all hospitals in the last week</h3>
                          <div id="columnChartContainer">FusionCharts XT will load here!</div>
                      </center>
                  </div>
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-sm-6">
                 <div class="card" style="border: 0.5px solid lightgrey; border-radius: 5px; padding-bottom: 20px; padding-left: 20px; padding-right: 15px">
                    <div class="card-block">
                       <center>
                           <h3 class="card-title"><strong>hospital name</strong> most popular illnesses in the last week</h3>
                           <div id="donutChartContainer">FusionCharts XT will load here!</div>
                        </center>
                    </div>
                 </div>
               </div>
               <div class="col-sm-6">
                  <div class="card" style="border: 0.5px solid lightgrey; border-radius: 5px; padding-bottom: 20px; padding-left: 20px; padding-right: 15px">
                    <div class="card-block">
                        <center>
                            <h3 class="card-title">View More Stats</h3>
                            <div id="pieChartContainer">FusionCharts XT will load here!</div>
                       </center>
                    </div>
                  </div>
                </div>

            </div>



            <br>
            <h3><b>Patient Actions</b></h3>
            <br>

            <div class="row">
              <div class="col-sm-12">
                <div class="card" style="border: 0.5px solid lightgrey; border-radius: 5px; padding-bottom: 20px; padding-left: 20px; padding-right: 15px">
                  <div class="card-block">
                    <h3 class="card-title">New Illness For Patient</h3>
                    <p class="card-text">Update pateint medical information by adding new sickness.</p>
                    <a href="add-medical-history" class="btn btn-primary">New Illness</a>
                  </div>
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-sm-6">
                <div class="card" style="border: 0.5px solid lightgrey; border-radius: 5px; padding-bottom: 20px; padding-left: 20px; padding-right: 15px">
                  <div class="card-block">
                    <h3 class="card-title">Register New Patient</h3>
                    <p class="card-text">Register a patient in the system if they are have never been registered before.</p>
                    <a href="patient-registration.php" class="btn btn-primary">Register</a>
                  </div>
                </div>
              </div>

              <div class="col-sm-6">
                 <div class="card" style="border: 0.5px solid lightgrey; border-radius: 5px; padding-bottom: 20px; padding-left: 20px; padding-right: 15px">
                   <div class="card-block">
                     <h3 class="card-title">Find Patient</h3>
                     <p class="card-text">You can search for a specific pateint by first name, Last name, id and email address</p>
                     <a href="search-results.php" class="btn btn-primary">Search</a>
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
                    <a href="appointment.php" class="btn btn-primary">View Appointment</a>
                  </div>
                </div>
              </div>

              <div class="col-sm-6">
                 <div class="card" style="border: 0.5px solid lightgrey; border-radius: 5px; padding-bottom: 20px; padding-left: 20px; padding-right: 15px">
                   <div class="card-block">
                     <h3 class="card-title">Add appointment</h3>
                     <p class="card-text">Create new Appointments</p><br>
                     <a href="set-appointment.php" class="btn btn-primary">Add Appointment</a>
                   </div>
                 </div>
               </div>

            </div>

		</div>
	</div>
</div>

<?php include 'footer.php' ?>
