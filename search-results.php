<?php


require_once 'core/physician/physician.inc.php';


 is_session_started();

#echo 'SEARCH RESULTS ';
// var_dump($_SESSION);

$error = array();

if(!empty($_POST)) {

    if (isset($_POST['submit'])) {

        $action = $_POST['submit'];
        $id = $_POST['key'];

        set_session('key', $id);

        switch ($action) {
            case 'view':
                    echo "view";
                    break;
            case 'edit':
                    echo 'edit';
                    header('location: edit-medical-history.php');
                    break;
            case 'transfer':
                    echo 'transfer';
                break;
            case 'admit':
                    echo 'add';
                    header('location: add-medical-history.php');
                break;
            default:
                # code...
                break;
        }

    } else if(!empty($_POST['query'])){

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
    $error['empty-search'] = "Enter a 'Search Query' in the Search Box Above";
}


include './header.php';
?>

<div id="wrapper">

     <div class="sidebar-wrapper">
         <div class="sidebar">
             <div id='sidebar-list-group' class="list-group">
                 <div class="list-group-item active">
                     <h4 class="list-group-item-heading"><b>Filters</b></h4>
                 </div>
                 <div class="list-group-item">
                     <h4 class="list-group-item-heading">Address</h4>
                     <p class="list-group-item-text">Filter search results by the person's address</p>
                     <input type="text" class="form-control" name="filter-address" placeholder="Enter a place ..." style='margin-right: 10px'>
                 </div>

                 <div class="list-group-item">
                     <h4 class="list-group-item-heading">Gender</h4>
                     <div class="btn-group" data-toggle="buttons">
                          <label class="btn btn-primary active">
                            <input type="radio" name="options" id="option1" autocomplete="off" checked> Male
                          </label>
                          <label class="btn btn-primary">
                            <input type="radio" name="options" id="option2" autocomplete="off"> Female
                          </label>

                    </div>
                 </div>
             </div>
         </div>
     </div>

     <div class="main-content-wrapper" id="p-info">
         <!-- <div class="main-content"> -->

        <?php

        if (empty($error)) {

            if(isset($_POST['query'])) {
                echo "<h4>Results found for '<b>". $_POST['query'] ."</b>'</h4>";

                while ($row = $resultSet->fetch_assoc()):?>
                <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">

                <div class="media" style="border: 0.5px solid lightgrey; border-radius: 5px">
                   <div class="media-left">
                       <a href="#">
                         <img id="search-result-image" style="margin-left: 10px; margin-top: 10px; margin-bottom: 10px;" class="media-object" src="img/avatar.png" alt="patient-image">
                       </a>
                   </div>
                   <div class="media-body">
                       <h4 class="media-heading" style="margin-top: 25px;"><b><?php echo ucfirst($row['firstname']) . ' ' . strtoupper(substr($row['middlename'],0,1)) . '. ' . ucfirst($row['lastname']); ?></b></h4>

                       <p><b>ID: </b> <?php echo $row['member_id']; ?> <input type="hidden" name="key" value="<?php echo $row['member_id']; ?>"> <br>

                       <b>Tel: </b><?php echo $row['tel_no']; ?>   &#0149;    <?php echo ucfirst($row['gender']); ?></p>

                       <ul class="list-inline">
                          <li><button class="btn btn-link" type="submit" name="submit" value='edit'>Edit Record</button></li>
                          <li>&#0149;</li>
                          <li><button class="btn btn-link" type="submit" name="submit" value='view'>View Record</button></li>
                          <li>&#0149;</li>
                          <li><button class="btn btn-link" type="submit" name="submit" value='add'>Add Condition Patient</button></li>
                          <li>&#0149;</li>
                          <li><button class="btn btn-link" type="submit" name="submit" value='transfer'>Tranfer Record</button></li>
                         <!-- <li><a href="#">Admit Patient</a></li> -->
                        </ul>
                   </div>
               </div>
           </form>

       <?php endwhile;
            }
        } else {

            echo "<h4 class=''><b>". $error['empty-search'] ."</b></h4>";

        }

        ?>

       <!-- Modal -->
       <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
         <div class="modal-dialog" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title" id="myModalLabel"><b>Verify User</b></h4>
             </div>
             <div class="modal-body">
                 <p>Enter your account credential before you can continue</p>
               <input type="text" class="form-control" name="medical_id" placeholder='Medial ID' >
               <input type="password" class="form-control" name="password" placeholder='Password'>
             </div>
             <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <!-- <button type="submit" class="btn btn-primary">Sign & Register Patient</button> -->
             </div>
           </div>
         </div>
       </div>

         <!-- </div> -->
     </div>






</div>
