<?php

    include_once './header.php';
    require_once 'core/physician/physician.inc.php';

    #echo 'SEARCH RESULTS ';
    var_dump($_POST);

    if(isset($_POST)) {
        if(!empty($_POST['query'])){

            $search_query = gen_strip_tags_for_display($_POST['query']);

            $resultSet = search_for_patient($search_query);

            var_dump($resultSet);
        }
    }



 ?>
