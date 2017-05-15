<?php
define('APP_RAN', 'APP_RAN');

include_once 'core/patient/patient.inc.php';

# user and session validation file
require_once 'session-validation.php';

# Access Contol File
define('PAGE_ACCESS_LEVEL', 4);
require_once 'core/access_control.php';


// var_dump($_POST);
$nameSet = null;

if (!empty($_POST)) {

    // echo 'Submt Type: ' . $_POST['submit'];
    switch ($_POST['submit']) {

        case 'save-vital':
            // echo "SAVING VITALS";
            if(isset($_POST['vitals_id']) && !empty($_POST['vitals_id'])) {
                $update = update_vtials($_POST['vitals_id'], $_POST['height'],
                            $_POST['weight'], $_POST['temp'], $_POST['pulse'],
                            $_POST['bp'], $_POST['resp'], $_POST['urine']);
            }

            break;
        case 'save-symp':
            // echo "SAVING SYMPTOMS";
            if(isset($_POST['symp_id']) && !empty($_POST['symp_id'])) {
                $update = update_sign_and_symtpom($_POST['symp_id'], $_POST['symptom']);
            }
            break;
        case 'save-treat':
            // echo "SAVING TREATMENT";
            // die();
            if(isset($_POST['id-treat']) && !empty($_POST['id-treat'])) {
                $update = update_treatment($_POST['id-treat'], $_POST['treatment']);
            }
            break;
        case 'save-med':
            // echo "SAVING MEDICATION";
            if(isset($_POST['id-med']) && !empty($_POST['id-med'])) {
                $update = update_medication($_POST['id-med'], $_POST['medication'],$_POST['dosage'] , $_POST['type'], $_POST['category']);
            }
            break;

        //  ADDING NEW RECORDS

        case 'add-vital-submit':
            // echo "ADD SIGN";
            global $connect;

            # get logged in physician_id
            $physician_id = get_user_id_from_session();
            enter_new_vitals($connect, $_POST['med_his_id'], $physician_id, $_POST['height'], $_POST['weight'], $_POST['temp'],
                                        $_POST['pulse'], $_POST['resp'], $_POST['bp'], $_POST['urine']);
            break;

        case 'add-sign-submit':

            // echo "ADD SING";
            $physician_id = get_user_id_from_session();

            add_new_sign_and_sympton($_POST['med_his_id'], $physician_id, $_POST['symptom']);

            break;

        case 'add-treat-submit':

            // echo "ADD TREATMENT";
            $physician_id = get_user_id_from_session();
            add_new_treatment($_POST['med_his_id'], $physician_id, $_POST['treatment']);

            break;

        case 'add-med-submit':

            // echo "ADD MEDICATION";
            $physician_id = get_user_id_from_session();
            add_new_medication($_POST['med_his_id'], $physician_id, $_POST['medication'], $_POST['dosage'], $_POST['type'], $_POST['category']);

            break;

        case 'update-cond':
                if (!empty($_POST['condition'])) {
                    $condition = $_POST['condition'];
                    $med_id = $_POST['med_his_id'];
                    update_condition($med_id, $condition);
                }

            break;


        default:
            break;
    }
}

$med_his_id_resultset = null;


if($id = get_value_from_session('key')) {

    $id = get_value_from_session('key');
    # getting patient name
    $nameSet = get_patient_name($id);

    # get medical conditions

    # get all medical history id for patient
    $med_his_id_resultset = get_medical_history_id($id);
    #var_dump($med_his_id_resultset);

    # getting patient vitals
    $vital_resultset = get_patient_vitals_by_med_history_id($id);

    # getting patient treatment/ medication
    $symptons_resultset = get_sign_and_symptons_by_patient_id($id);

    # getting patient treatment
    $treatment_resultset = get_treatment_by_patient_id($id);

    # getting patient medication
    $medication_resultset = get_medication_by_patient_id($id);


 // var_dump($medication_resultset->fetch_assoc());
}


include_once 'header.php';
?>

<div class="container content">
    <div class="panel panel-default">
        <div class="panel-body" style="padding:0 55px;">
            <span><h3><b>Edit Medical History</b></h3></span>
            <p>of
                <b><code>
                <?php
                if ($nameSet !== null) {
                    echo $nameSet['firstname'] . ' ' . $nameSet['middlename'] . ' ' . $nameSet['lastname'];
                } ?>
                </code></b>
            </p>
            <br>
            <p><a href="edit-personal-info.php">Edit Patient Personal Record</a></p>
            <hr style="width: 98%;">
            <!-- <div class="row">
                <div class="form-group">
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                            <div class="col-md-3">
                                    <label for="q">Medical Conditions</label>
                            </div>
                            <div class="col-md-7">
                                    <input type="text" name='medical_condition' class="form-control" id="q" placeholder="eg. Asthma, Diabetes">
                            </div>
                            <div class="col-md-2">
                                    <button type="submit" class="btn btn-submit-rq">Update</button>
                            </div>
                    </form>
                </div>
            </div> -->
        </div>


        <?php
        if ($med_his_id_resultset !== null) {
            while ($row_med_his = $med_his_id_resultset->fetch_assoc()) :
                // var_dump($row_med_his);
        ?>


        <div class="panel panel-default" id="pad-panel">
            <div class="panel-body">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-3">
                                <label for="condi"><h5><b>Reported Condition:</b></h5></label>
                        </div>
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                                <div class="col-md-3">
                                    <input type="text" name='condition' value="<?php echo isset($row_med_his['condition']) ? $row_med_his['condition'] : ''  ?>" class="form-control" id="condi" placeholder="">
                                    <input type="hidden" name="med_his_id" value="<?php echo isset($row_med_his['med_his_id']) ? $row_med_his['med_his_id'] : ''; ?>">

                                </div>
                                <div class="col-md-1 col-xs-2">
                                    <button type="submit" class="btn btn-primary" name="submit" value="update-cond">Update Conditions</button>
                                </div>
                        </form>
                        <div class="col-md-4 col-md-offset-1">
                                <span style="margin-left: 15px; margin-top: 15px;"><b>Date Visited: </b><?php echo $row_med_his['date']; ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-10">
                                <h5><b>Vitals for this condition</b></h5>
                            </div>
                            <div class="col-md-2" >
                                <form action="<?php $_SERVER['PHP_SELF'];  ?>" method="post">
                                   <input type="hidden" name="med_his_id" value="<?php echo isset($row_med_his['med_his_id']) ? $row_med_his['med_his_id'] : ''; ?>">
                                   <button class="btn btn-link" style="margin-left: 30px" type="submit" name="submit" value="add-vital">Add vital</button>
                               </form>
                            </div>
                            <hr style="width: 98%;">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Weight (lb)</th>
                                            <th>Height</th>
                                            <th>Temp</th>
                                            <th>Pulse</th>
                                            <th>B/P</th>
                                            <th>Resp</th>
                                            <th>Urinalysis</th>
                                            <th>Taken By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if ($vital_resultset !== null) {
                                        $vital_resultset->data_seek(0);
                                        while ($row_vitals = $vital_resultset->fetch_assoc()) :
                                            if ($row_vitals['med_his_id'] === $row_med_his['med_his_id']) {?>
                                                <form class="" action='<?php $_SERVER['PHP_SELF'];  ?>' method="post">
                                                    <tr>
                                                        <!-- Not editable -->
                                                        <td><?php echo isset($row_vitals['date']) ? $row_vitals['date'] : ''; ?>
                                                            <input type="hidden" name="vitals_id" value="<?php echo isset($row_vitals['vitals_id']) ? $row_vitals['vitals_id'] : ''; /*Value from databse*/; ?>">
                                                        </td>
                                                        <?php if(!empty($_POST) && $_POST['submit'] === 'edit-vital' && $_POST['vitals_id'] == $row_vitals['vitals_id']) { ?>
                                                               <td><input name="weight" value="<?php echo isset($_POST['weight']) ? $_POST['weight'] : ''; ?>" style="width: 60px;" type="text" class="form-control input-sm" placeholder="weight"></td>
                                                               <td><input name="height" value="<?php echo isset($_POST['height']) ? $_POST['height'] : ''; ?>" style="width: 60px;" type="text" class="form-control input-sm" placeholder="height"></td>
                                                               <td><input name="temp"   value="<?php echo isset($_POST['temp'])   ? $_POST['temp']   : ''; ?>" style="width: 60px;" type="text" class="form-control input-sm" placeholder="temp"></td>
                                                               <td><input name="pulse"  value="<?php echo isset($_POST['pulse'])  ? $_POST['pulse']  : ''; ?>" style="width: 60px;" type="text" class="form-control input-sm" placeholder="pulse"></td>
                                                               <td><input name="bp"     value="<?php echo isset($_POST['bp'])     ? $_POST['bp']     : ''; ?>" style="width: 60px;" type="text" class="form-control input-sm" placeholder="bp"></td>
                                                               <td><input name="resp"   value="<?php echo isset($_POST['resp'])   ? $_POST['resp']   : ''; ?>" style="width: 60px;" type="text" class="form-control input-sm" placeholder="resp"></td>
                                                               <td><input name="urine"  value="<?php echo isset($_POST['urine'])  ? $_POST['urine']  : ''; ?>" style="width: 60px;" type="text" class="form-control input-sm" placeholder="urine"></td>
                                                           <?php  } else { ?>
                                                               <td><?php echo isset($row_vitals['weight']) ? $row_vitals['weight'] : ''; ?><input type="hidden" name="weight" value="<?php echo isset($row_vitals['weight']) ? $row_vitals['weight'] : '';?>"></td>
                                                               <td><?php echo isset($row_vitals['height']) ? $row_vitals['height'] : ''; ?><input type="hidden" name="height" value="<?php echo isset($row_vitals['height']) ? $row_vitals['height'] : '';?>"></td>
                                                               <td><?php echo isset($row_vitals['temp'])   ? $row_vitals['temp']   : ''; ?><input type="hidden" name="temp"   value="<?php echo isset($row_vitals['temp']) ?   $row_vitals['temp'] :   '';?>"></td>
                                                               <td><?php echo isset($row_vitals['pulse'])  ? $row_vitals['pulse']  : ''; ?><input type="hidden" name="pulse"  value="<?php echo isset($row_vitals['pulse']) ?  $row_vitals['pulse'] :  '';?>"></td>
                                                               <td><?php echo isset($row_vitals['bp'])     ? $row_vitals['bp']     : ''; ?><input type="hidden" name="bp"     value="<?php echo isset($row_vitals['bp']) ?     $row_vitals['bp'] :     '';?>"></td>
                                                               <td><?php echo isset($row_vitals['resp'])   ? $row_vitals['resp']   : ''; ?><input type="hidden" name="resp"   value="<?php echo isset($row_vitals['resp']) ?   $row_vitals['resp'] :   '';?>"></td>
                                                               <td><?php echo isset($row_vitals['urine'])  ? $row_vitals['urine']  : ''; ?><input type="hidden" name="urine"  value="<?php echo isset($row_vitals['urine']) ?  $row_vitals['urine'] :  '';?>"></td>
                                                           <?php } ?>
                                                            <!-- Not editable -->
                                                            <td><?php echo isset($row_vitals['lastname']) ? 'Dr. ' .  $row_vitals['lastname'] : '' ; ?></td>
                                                            <?php if(!empty($_POST) && $_POST['submit'] === 'edit-vital' && $_POST['vitals_id'] == $row_vitals['vitals_id']) { ?>
                                                                      <!-- Edit mode for table row  -->
                                                                      <td><button type="submit"  name="submit" value='save-vital' class='btn btn-link'>Save</button></td>
                                                            <?php  } else { ?>
                                                                      <!-- Save and 'Just Loaded Paged' mode for table row  -->
                                                                      <td><button type="submit"  name="submit" value='edit-vital' class='btn btn-link'>Edit</button></td>
                                                            <?php } ?>
                                                    </tr>
                                                </form>
                                                <?php } endwhile; }?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                            if (isset($_POST['submit']) && $_POST['submit'] === 'add-vital' && $_POST['med_his_id'] == $row_med_his['med_his_id']): ?>
                                <form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                                        <input type="hidden" name="med_his_id" value="<?php echo isset($row_med_his['med_his_id']) ? $row_med_his['med_his_id'] : ''; ?>">
                                            <div class="form-group">
                                                    <div style="width: 100px; "class="col-md-1 col-xs-1">
                                                            <input type="text" class="form-control input-sm" name="weight" placeholder="weight">
                                                    </div>
                                                    <div style="width: 100px; " class="col-md-1 col-xs-1">
                                                            <input type="text" class="form-control input-sm" name="height" placeholder="height">
                                                    </div>
                                                    <div style="width: 100px; "class="col-md-1 col-xs-1">
                                                        <input type="text" class="form-control input-sm" name="temp" placeholder="temp">
                                                    </div>
                                                    <div style="width: 100px; "class="col-md-1 col-xs-1">
                                                        <input type="text" class="form-control input-sm" name="pulse" placeholder="pulse">
                                                </div>
                                                    <div style="width: 100px; "class="col-md-1 col-xs-1">
                                                            <input type="text" class="form-control input-sm" name="bp" placeholder="bp">
                                                    </div>
                                                    <div style="width: 100px; "class="col-md-1 col-xs-1">
                                                            <input type="text" class="form-control input-sm" name="resp" placeholder="resp">
                                                    </div>
                                                    <div style="width: 100px; "class="col-md-1 col-xs-1">
                                                            <input type="text" class="form-control input-sm" name="urine" placeholder="urinalysis">
                                                    </div>
                                                    <div style="width: 100px; "class="col-md-1 col-xs-1 col-md-offset-0">
                                                            <button type="submit" name="submit" value="add-vital-submit" class="btn btn-primary">Add Vitals</button>
                                                    </div>
                                            </div>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-md-9">
                                    <h5><b>Sign and Symptons for this Condition</b></h5>
                                </div>
                            <div class="col-md-3" >
                                <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
                                    <input type="hidden" name="med_his_id" value="<?php echo isset($row_med_his['med_his_id']) ? $row_med_his['med_his_id'] : ''; ?>">
                                    <button class="btn btn-link" style="margin-left: 15px" type="submit" name="submit" value="add-sign">Add Sign and Sympton</button>
                                </form>
                            </div>
                            <hr style="width: 98%;">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Signs and Symptons</th>
                                            <th>Recorded By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($symptons_resultset !== null) {
                                            $symptons_resultset->data_seek(0);
                                            while ($row_symptons = $symptons_resultset->fetch_assoc()) :
                                                //  var_dump($_POST);
                                                if ($row_symptons['med_his_id'] === $row_med_his['med_his_id']) { ?>
                                                <form  action="<?php $_SERVER['PHP_SELF'];?>" method="post">
                                                    <tr>
                                                        <td><?php echo isset($row_symptons['date']) ? $row_symptons['date'] : ''; ?>
                                                            <input type="hidden" name="symp_id" value="<?php echo isset($row_symptons['symp_id']) ? $row_symptons['symp_id'] :''; ?>">
                                                        </td>
                                                        <?php if(!empty($_POST) && $_POST['submit'] === 'edit-symp' && $_POST['symp_id'] == $row_symptons['symp_id']) { ?>
                                                            <td>
                                                                <input style="width: 200px;" name="symptom" value="<?php echo isset($row_symptons['symptom']) ? $row_symptons['symptom'] : ''; ?>" style="width: 60px;" type="text" class="form-control input-sm" placeholder="symptom">
                                                            </td>
                                                        <?php  } else { ?>
                                                            <td><?php echo isset($row_symptons['symptom']) ? $row_symptons['symptom'] : ''; ?>
                                                                <input type="hidden" name="symptom" value="<?php echo isset($row_symptons['symptom']) ? $row_symptons['symptom'] : ''; ?>">
                                                            </td>
                                                        <?php } ?>
                                                        <td><?php echo isset($row_symptons['lastname']) ? 'Dr. ' .  $row_symptons['lastname'] : '' ; ?></td>
                                                        <?php if(!empty($_POST) && $_POST['submit'] === 'edit-symp' && $_POST['symp_id'] == $row_symptons['symp_id']) { ?>
                                                            <!-- Edit mode for table row  -->
                                                            <td><button type="submit"  name="submit" value='save-symp' class='btn btn-link'>Save</button></td>
                                                        <?php } else { ?>
                                                            <!-- Save and 'Just Loaded Paged' mode for table row  -->
                                                            <td><button type="submit"  name="submit" value='edit-symp' class='btn btn-link'>Edit</button></td>
                                                        <?php } ?>
                                                      </tr>
                                                  </form>
                                        <?php } endwhile; }?>
                                    </tbody>
                                </table>
                            </div>
                            <?php if (isset($_POST['submit']) && $_POST['submit'] === 'add-sign'  && $_POST['med_his_id'] == $row_med_his['med_his_id']): ?>
                                <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
                                    <input type="hidden" name="med_his_id" value="<?php echo isset($row_med_his['med_his_id']) ? $row_med_his['med_his_id'] : ''; ?>">
                                    <div class="form-group">
                                        <div class="col-md-3 col-xs-1">
                                                <input type="text" class="form-control input-sm" style="width: 400px" name="symptom" placeholder="Signs & Symptons">
                                        </div>
                                        <div class="col-md-2 col-xs-1 col-md-offset-6" >
                                                <button type="submit" name="submit" value="add-sign-submit" class="btn btn-primary">Add Signs & Symptons</button>
                                        </div>
                                    </div>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-9">
                                <h5><b>Treatment for this Condition</b></h5>
                            </div>
                            <div class="col-md-3" >
                                <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
                                    <input type="hidden" name="med_his_id" value="<?php echo isset($row_med_his['med_his_id']) ? $row_med_his['med_his_id'] : ''; ?>">
                                    <button class="btn btn-link" style="margin-left: 50px" type="submit" name="submit" value="add-treat">Add Treatment</button>
                                </form>
                            </div>
                            <hr style="width: 98%;">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Treatment</th>
                                            <th>Hospital</th>
                                            <th>Treated By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($treatment_resultset !== null) {
                                            $treatment_resultset->data_seek(0);
                                            while ($row_treat = $treatment_resultset->fetch_assoc()) :
                                                //  var_dump($_POST);
                                                if ($row_treat['med_his_id'] === $row_med_his['med_his_id']) {?>
                                                <form  action="<?php $_SERVER['PHP_SELF'];  ?>" method="post">
                                                    <tr>
                                                        <!-- Data Id hidden Elements -->
                                                        <td><?php echo isset($row_treat['date']) ? $row_treat['date'] : ''; ?>
                                                            <input type="hidden" name="id-treat" value="<?php echo isset($row_treat['treat_id']) ? $row_treat['treat_id'] : ''; ?>">
                                                        </td>
                                                        <?php if(!empty($_POST) && $_POST['submit'] === 'edit-treat' && $_POST['id-treat'] == $row_treat['treat_id']) { ?>
                                                            <td><input style="width: 200px;" name="treatment" value="<?php echo isset($row_treat['treatment']) ? $row_treat['treatment'] : ''; ?>" style="width: 60px;" type="text" class="form-control input-sm" placeholder="treatment"></td>
                                                        <?php  } else { ?>
                                                            <td><?php echo isset($row_treat['treatment']) ? $row_treat['treatment'] : ''; ?><input type="hidden" name="treatment" value="<?php echo isset($row_treat['treatment']) ? $row_treat['treatment'] : ''; ?>"></td>
                                                        <?php } ?>

                                                        <td><?php echo isset($row_treat['hospital']) ? $row_treat['hospital'] : '' ; ?></td>
                                                        <td><?php echo isset($row_treat['lastname']) ? 'Dr. ' .  $row_treat['lastname'] : '' ; ?></td>

                                                        <?php if(!empty($_POST) && $_POST['submit'] === 'edit-treat' && $_POST['id-treat'] == $row_treat['treat_id']) { ?>
                                                            <!-- Edit mode for table row  -->
                                                            <td><button type="submit"  name="submit" value='save-treat' class='btn btn-link'>Save</button></td>
                                                        <?php  } else { ?>
                                                            <!-- Save and 'Just Loaded Paged' mode for table row  -->
                                                            <td><button type="submit"  name="submit" value='edit-treat' class='btn btn-link'>Edit</button></td>
                                                        <?php } ?>
                                                    </tr>
                                                </form>
                                                <?php } endwhile; }?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php if (isset($_POST['submit']) && $_POST['submit'] === 'add-treat' && $_POST['med_his_id'] == $row_med_his['med_his_id']): ?>
                                    <form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                                        <div class="form-group">
                                            <input type="hidden" name="med_his_id" value="<?php echo isset($row_med_his['med_his_id']) ? $row_med_his['med_his_id'] : ''; ?>">
                                                <div class="col-md-3 col-xs-3">
                                                    <input type="text" style="width: 400px" class="form-control input-sm" name="treatment" placeholder="Treatment">
                                                </div>
                                                <div class="col-md-2 col-xs-1 col-md-offset-6">
                                                    <button type="submit" name="submit" value="add-treat-submit"class="btn btn-primary">Add Treatment</button>
                                                </div>
                                        </div>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-md-9">
                                    <h5><b>Medication for this Condition</b></h5>
                                </div>
                                <div class="col-md-3" >
                                    <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
                                        <input type="hidden" name="med_his_id" value="<?php echo isset($row_med_his['med_his_id']) ? $row_med_his['med_his_id'] : ''; ?>">
                                        <button class="btn btn-link" style="margin-left: 50px" type="submit" name="submit" value="add-med">Add Medication</button>
                                    </form>
                                </div>
                                <hr style="width: 98%;">
                                        <div class="table-responsive">
                                          <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Medication</th>
                                                    <th>Dosage</th>
                                                    <th>type</th>
                                                    <th>Category</th>
                                                    <th>Hospital</th>
                                                    <th>Administered By</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($medication_resultset !== null) {
                                                    $medication_resultset->data_seek(0);
                                                    while ($row_med = $medication_resultset->fetch_assoc()) :
                                                        //  var_dump($_POST);
                                                        if ($row_med['med_his_id'] === $row_med_his['med_his_id']) {?>
                                                            <form  action="<?php $_SERVER['PHP_SELF'];  ?>" method="post">
                                                                <tr>
                                                                    <!-- Data Id hidden Elements -->
                                                                    <td><?php echo isset($row_med['date']) ? $row_med['date'] : ''; ?>
                                                                        <input type="hidden" name="id-med" value="<?php echo isset($row_med['med_id']) ? $row_med['med_id'] : ''; ?>">
                                                                    </td>


                                                                    <?php if(!empty($_POST) && $_POST['submit'] === 'edit-med' && $_POST['id-med'] == $row_med['med_id']) { ?>
                                                                        <td><input style="width: 150px;" name="medication" value="<?php echo isset($row_med['medication']) ? $row_med['medication'] : ''; ?>" style="width: 60px;" type="text" class="form-control input-sm" placeholder="medication"></td>
                                                                        <td><input style="width: 100px;" name="dosage" value="<?php echo isset($row_med['dosage']) ? $row_med['dosage'] : ''; ?>" style="width: 60px;" type="text" class="form-control input-sm" placeholder="medication"></td>
                                                                        <td>
                                                                            <select name="type" class="form-control custom-select">
                                                                                <option value="prescribe" <?php echo (isset($row_med['type']) && $row_med['type'] === 'prescribe') ? 'selected' : '' ?>>Prescribe</option>
                                                                                <option value="over the counter" <?php echo (isset($row_med['type']) && $row_med['type'] === 'over the counter') ? 'selected' : '' ?>>Over The Counter</option>
                                                                                <option value="other" <?php echo (isset($row_med['type']) && $row_med['type'] === 'other') ? 'selected' : '' ?>>Other</option>
                                                                            </select>
                                                                        </td>
                                                                        <td>
                                                                            <select name="category" class="form-control custom-select">
                                                                                <option value="antibiotic" <?php echo (isset($row_med['category']) && $row_med['category'] === 'antibiotic') ? 'selected' : '' ?>>Antibiotic</option>
                                                                                <option value="dangerous" <?php echo (isset($row_med['category']) && $row_med['category'] === 'dangerous') ? 'selected' : '' ?>>Dangerous</option>
                                                                                <option value="other" <?php echo (isset($row_med['category']) && $row_med['category'] === 'other') ? 'selected' : '' ?>>Other</option>
                                                                            </select>
                                                                        </td>
                                                                    <?php  } else { ?>
                                                                        <td><?php echo isset($row_med['medication']) ? $row_med['medication'] : ''; ?><input type="hidden" name="medication" value="<?php echo isset($row_med['medication']) ? $row_med['medication'] : ''; ?>"></td>
                                                                        <td><?php echo isset($row_med['dosage']) ? $row_med['dosage'] : ''; ?><input type="hidden" name="dosage" value="<?php echo isset($row_med['dosage']) ? $row_med['dosage'] : ''; ?>"></td>
                                                                        <td><?php echo isset($row_med['type']) ? $row_med['type'] : ''; ?><input type="hidden" name="type" value="<?php echo isset($row_med['type']) ? $row_med['type'] : ''; ?>"></td>
                                                                        <td><?php echo isset($row_med['category']) ? $row_med['category'] : ''; ?><input type="hidden" name="category" value="<?php echo isset($row_med['category']) ? $row_med['category'] : ''; ?>"></td>
                                                                    <?php } ?>

                                                                    <td><?php echo isset($row_med['hospital']) ? $row_med['hospital'] : '' ; ?></td>
                                                                    <td><?php echo isset($row_med['lastname']) ? 'Dr. ' .  $row_med['lastname'] : '' ; ?></td>

                                                                    <?php if(!empty($_POST) && $_POST['submit'] === 'edit-med' && $_POST['id-med'] == $row_med['med_id']) { ?>
                                                                        <!-- Edit mode for table row  -->
                                                                        <td><button type="submit"  name="submit" value='save-med' class='btn btn-link'>Save</button></td>
                                                                    <?php  } else { ?>
                                                                            <!-- Save and 'Just Loaded Paged' mode for table row  -->
                                                                            <td><button type="submit"  name="submit" value='edit-med' class='btn btn-link'>Edit</button></td>
                                                                    <?php } ?>
                                                                </tr>
                                                            </form>
                                                <?php } endwhile; }?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php if (isset($_POST['submit']) && $_POST['submit'] === 'add-med'  && $_POST['med_his_id'] == $row_med_his['med_his_id']): ?>
                                        <form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                                            <div class="form-group">
                                                <input type="hidden" name="med_his_id" value="<?php echo isset($row_med_his['med_his_id']) ? $row_med_his['med_his_id'] : ''; ?>">
                                                <div class="col-md-3 col-xs-3">
                                                    <input type="text" class="form-control input-sm" name="medication" placeholder="Medication">
                                                </div>
                                                <div class="col-md-2 col-xs-3">
                                                    <input type="text" class="form-control input-sm" name="dosage" placeholder="Dosage">
                                                </div>
                                                <div class="col-md-2 col-xs-3">
                                                    <!-- <input type="text" class="form-control input-sm" name="type" placeholder="Type"> -->
                                                    <select name="type" class="form-control custom-select">
                                                       <option value="prescribe">Prescribe</option>
                                                       <option value="over the counter">Over The Counter</option>
                                                       <option value="other" selected>Other</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 col-xs-3">
                                                    <!-- <input type="text" class="form-control input-sm" name="category" placeholder="Category"> -->
                                                    <select name="category" class="form-control custom-select">
                                                       <option value="antibiotic">Antibiotic</option>
                                                       <option value="dangerous" >Dangerous</option>
                                                       <option value="other" selected>Other</option>
                                                   </select>
                                                </div>
                                                <div class="col-md-2 col-xs-1 col-md-offset-1">
                                                    <button type="submit" name="submit" value="add-med-submit"class="btn btn-primary">Add Medication</button>
                                                </div>
                                            </div>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <hr style="width: 98%;">
                <br>
                <?php endwhile; } ?>
            </div>
        </div>
<?php include_once 'footer.php'; ?>
