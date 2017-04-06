<?php

    include './header.php';
    require_once 'core/physician/physician.inc.php';

    #echo 'SEARCH RESULTS ';
    // var_dump($_POST);

    $error = array();

    if(isset($_POST)) {
        if(!empty($_POST['query'])){

            $search_query = gen_strip_tags_for_display($_POST['query']);

            $resultSet = search_for_patient($search_query);

            #var_dump($resultSet->num_rows);

            if ($resultSet->num_rows == 0 ){
                $error['empty-search'] = "No results found for <b>'". $_POST['query'] . "'</b>" ;
            }
        } else {
            $error['empty-search'] = "Sorry, we couldn't understand this search. Please enter a clear search";
        }
    } else {
        $error['empty-search'] = "Sorry, we couldn't understand this search. Please enter a clear search";
    }



 ?>

<div id="wrapper">
 <div class="sidebar-wrapper">
     <div class="sidebar">
         <div class="list-group">
             <a href="#" class="list-group-item active">
                 <h4 class="list-group-item-heading"><b>Filters</b></h4>
             </a>
             <a href="#" class="list-group-item">
                 <h4 class="list-group-item-heading">Address</h4>
                 <p class="list-group-item-text">Filter search results by the person's address</p>
             </a>

             <a href="#" class="list-group-item">
                 <h4 class="list-group-item-heading">Address</h4>
                 <p class="list-group-item-text">Filter search results by the person's address</p>
             </a>
         </div>
     </div>
 </div>
 <div class="main-content-wrapper" id="p-info">
     <!-- <div class="main-content"> -->

    <?php

    if (empty($error)) {

        echo "<h4>Results found for '<b>". $_POST['query'] ."</b>'</h4>";

        while ($row = $resultSet->fetch_assoc()):?>

        <div class="media" style="border: 0.5px solid lightgrey; border-radius: 5px">
           <div class="media-left">
               <a href="#">
                 <img id="search-result-image" style="margin-left: 10px; margin-top: 10px; margin-bottom: 10px;" class="media-object" src="img/avatar.png" alt="patient-image">
               </a>
           </div>
           <div class="media-body">
               <h4 class="media-heading" style="margin-top: 25px;"><b><?php echo ucfirst($row['firstname']) . ' ' . strtoupper(substr($row['middlename'],0,1)) . '. ' . ucfirst($row['lastname']); ?></b></h4>
               <p><b>ID: </b> <?php echo $row['member_id']; ?> <br>
               <b>Tel: </b><?php echo $row['tel_no']; ?>   &#0149;    <?php echo ucfirst($row['gender']); ?></p>
               <ul class="list-inline">
                  <li><a href="#">Admit Patient</a></li>
                  <li>&#0149;</li>
                  <li><a href="#">View Record</a></li>
                  <li>&#0149;</li>
                  <li><a href="#">Edit Record</a></li>
                  <li>&#0149;</li>
                  <li><a href="#">Transfer Record</a></li>
                  <!-- <li><a href="#">Admit Patient</a></li> -->
                </ul>
           </div>
       </div>

   <?php endwhile; } else {

       echo "<h4 class=''><b>". $error['empty-search'] ."</b></h4>";

   } ?>

     <!-- </div> -->
 </div>
 </div>
