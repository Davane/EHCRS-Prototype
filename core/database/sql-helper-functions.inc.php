<?php


function getNumberOfRowsFromPrepapredStatementResultset($statement) {

	 /* store result */
    $statement->store_result();

  	/* Getting the number of rows that were stored above*/
    return $statement->num_rows;
}


function executeAndGetRowsFromSelectPreparedStatement($statements) {

	$select = $statements->execute();

 // 	var_dump($statements->error);


	// checking is the query was executed successfully
	if (!$select) { /* Handle error */ echo "Select == False"; }

	// getting the results that were selected from the prepered statement
	$result = $statements->get_result();

	// checking to make sure that the results was not null from the query
	if ($result == null) {
		/* Handle error */
		echo "Results == null" ;
		return array();
	 }

	/* now you can fetch the results into an array */
	return $result->fetch_assoc();

}

function getLastInsertedId($connect){

    # '$stmt_insert_msg->insert_id' returns zero when called
    # with store procedures so we have to run the query manually
    # from the database to get the results
    $res = $connect->query("SELECT LAST_INSERT_ID() as LastInsertedId");
    $row = $res->fetch_assoc();

    return empty(trim($row['LastInsertedId'])) ? null : $row['LastInsertedId'];

}

?>
