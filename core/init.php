<?php
    defined('APP_RAN') or header('Location: https://172.20.10.2/~davanedavis/EHCRS-Prototype/unauthorized_access.php');

    $ERRORS = array();

    require_once 'extras/constants.inc.php';

    require_once 'database/databaseInit.php';

    require_once 'database/sql-helper-functions.inc.php';

    require_once 'general.inc.php';

    require_once 'audit/audit.php';

?>
