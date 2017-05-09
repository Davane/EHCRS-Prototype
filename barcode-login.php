<?php

require_once 'core/init.php';
require_once 'core/patient/patient.inc.php';

//
// var_dump($_POST);

$error = array();

if(!isset($_POST['submit-apt'])) {

    include('includes/phpqrcode/qrlib.php');


    date_default_timezone_set('Jamaica');
    $rawStr = 'qrcode-healthwsie-'.mt_rand().'-'.(string)time();
    $qr = password_hash($rawStr, PASSWORD_DEFAULT);

    if(addQRCodeInDB($qr)) {

        echo $qr;
        # if QR Code was added Successfuly then create png failed
        QRcode::png($qr, 'qr-file.png');

    } else {
        // echo "Not Added to db";
        $error['error'] = "Unexpected Error Occured, Try Refreshing Page";
    }


    // outputs image directly into browser, as PNG stream
    // QRcode::png($code);
    // how to use image from example 001
    // echo '<img src="example_001_simple_png_output.php" />';

} else {

    # Attemp To log in

    if ($id = $_POST['id'] && trim($_POST['id']) !== ''){

        $id = gen_sanitize_for_datebase($_POST['id']);

        # Signing into db using qr
        $res = signInUsingQRCode($id);

        if($res[0]) {

            $type = $res[1];

            set_sign_in_session($id, $type, (string)time() /*timestamp*/);

            if(update_user_session($id, get_value_from_session(SESSION_ID))){

                set_session(USER_QR_VERIFIED, 'true');

                if ($type == 'Patient') {
                    header('Location: patient-info.php');
                } else {
                    header('Location: index.php');
                }
            } else {
                $error['error'] = "Session Error, contacting system adminsitrator for more information.";

            }

        } else {
            $error['error'] = "Loggin Failed, Ensure then your scan the barcode Using your mobile device ";
        }

    } else {
         $error['error'] = "ID Filed Empty";
    }

}

# ------------------------------------------------------------------------------
#   Functions
# ------------------------------------------------------------------------------

function addQRCodeInDB($qr){

    global $connect;

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_add_new_qr_code (?);");

    // bind string datatype to varaibles
    $stmt->bind_param("s", $qr);

    # executing and fetching he rows
    $update = $stmt->execute();

    if($stmt->affected_rows > 0) {
        #echo "string";
        $stmt->close();
        return true;
    }

    return false;
}


function signInUsingQRCode($id) {

    global $connect;

    // the prepare for update
    $stmt = $connect->prepare("CALL proc_sign_in_using_qr_code (?, @verified, @type);");

    // bind string datatype to varaibles
    $stmt->bind_param("s", $id);

    #executing and fetching he rows
    // $row = executeAndGetRowsFromSelectPreparedStatement($stmt);
    $execProc = $stmt->execute();
    $stmt->close();

    if (!$execProc) {
        /* Handle error */
        return false;
    }

    $select = $connect->query('SELECT @verified, @type');
    $result = $select->fetch_assoc();

    return [(bool)$result['@verified'], $result['@type']];

    // var_dump($verified);
    // die();
}

?>



<!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content Type" content="text/html"; charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="Garfield Gray">
		<link rel="icon" href="img/logo.png">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<title>EHR System</title>
		<link href="https://fonts.googleapis.com/css?family=Roboto:700" rel="stylesheet">
		<link href="font-awesome/css/font-awesome.css" rel="stylesheet">
		<link href="css/hover.css" rel="stylesheet">

		<style>

			body {
				background: url(/dev/EHR/img/su-bg.jpg) no-repeat center center fixed;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
	  		}

	  		input:not([type]), input[type=text], input[type=password],
			input[type=email], input[type=url], input[type=time],
			input[type=date], input[type=datetime], input[type=datetime-local],
			input[type=tel], input[type=number], input[type=search],
			input[type="telephone"],
			textarea.materialize-textarea {
			    background-color: transparent;
			    border: none;
			    border-bottom: 1px solid #00233f;
			    border-radius: 0;
			    outline: none;
			    height: 3rem;

			    font-size: 1.3rem;
			    margin: 0 0 20px 0;
			    padding: 0;
			    box-shadow: none;
			    box-sizing: content-box;
			    transition: all 0.3s;
			}
			input {
			    line-height: normal;
			}

			input::-webkit-input-placeholder {
				color: #14213c !important;
				opacity: 0.5;
			}

			input:-moz-placeholder { /* Firefox 18- */
				color: #14213c !important;
				opacity: 0.5;
			}

			input::-moz-placeholder {  /* Firefox 19+ */
				color: #14213c !important;
				opacity: 0.5;
			}

			input:-ms-input-placeholder {
				color: #14213c !important;
				opacity: 0.5;
			}

			.btn-send {
			    background-color: white;
			    border-style: solid;
			    border-width: thin;
			    border-color: #00233f;
			    border-radius: 100px;
			    padding: 5px;
			    color: #14213c;
			    letter-spacing: 1px;
			}

			.fa-long-arrow-right {
				color: #14213c;
			}

			.center {
			    margin: 10% auto 0px;
			    width: 30%;
			    padding: 10px;
			}

			.header-caption {
				font-family: 'Roboto', sans-serif;
				color: #14213c;
			}

			.login-fade {
				color: #14213c;
				font-size: 11px;
			}

			footer {
				position: absolute;
				right: 0;
				bottom: 0;
				left: 0;
				padding: 1rem;
				text-align: center;
			}

			@media screen and (max-width: 480px) {
			    .center {
			    	margin: 30% auto 0px;
			    	padding: 0px;
			    	width: 80%;
			  	}
			}

			@media screen and (max-width: 780px) {
			    .center {
			    	margin: 30% auto 0px;
			    	padding: 0px;
			    	width: 50%;
			  	}
			}
		</style>


	</head>

	<body>
	<div class="container">
		<div class="container">

			<div class="center">

                <?php   if (array_key_exists('error',$error)) {
                            echo output_error_by_key('error', $error).'<br>';
                        }
                ?>

                <div class="row">
                  <div class="col-sm-6">
                     <div class="card" style="border: 0.5px solid lightgrey; border-radius: 5px; padding-bottom: 20px; padding-left: 20px; padding-right: 15px; width:500px; height:550px;">
                        <div class="card-block">
                           <center>

                               <br>

                               <div class="row">
                                   <h4>Scan the barcode on your mobile phone</h4>
                                   <hr>
                               </div>

                               <?php

                                   // outputs image directly into browser, as PNG stream
                                   // QRcode::png('PHP QR Code :)');

                                   // how to use image from example 001
                                   echo '<img src="qr-file.png" style="width: 300px; height: 300px" />';
                                ?>

                                <div class="row">
                                    <hr>
                                    <div class="form-group">
                                    <form class="" action="<?php $_SERVER['PHP_SELF']; ?>"method="post">
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="id" placeholder="Medical ID" value="<?php isset($_POST['id']) ? $_POST['id'] : ""?>">
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="submit" name="submit-apt" class="btn btn-primary">Attempt Sign In</button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <a href="https://localhost/~davanedavis/EHCRS-Prototype/sign-up.php"> < Back to regular Sign In </a>
                                    </div>


                                    <div class="col-md-6">
                                        <form action="<?php $_SERVER['PHP_SELF']; ?>"method="post">
                                            <button type="submit" class="btn btn-link">Try Different QR Code</button>
                                        </form>
                                    </div>
                                </div>

                            </center>


                        </div>
                     </div>

                   </div>
            </div> <!-- End of center -->

		</div>

		<footer>
		<div class="container">
			<center>
	        		<p>&nbsp;&copy; <?php date_default_timezone_set('Jamaica'); echo date("Y");?> EHR System</p>
	       	</center>
	       	</div>
        </footer>
    </div>


		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
