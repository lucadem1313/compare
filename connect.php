<?php
    define('DB_NAME','RETRACTED' );
    define('DB_USER', 'RETRACTED');
    define('DB_PASSWORD', 'RETRACTED');
    define('DB_HOST', 'RETRACTED');

   // define('DB_NAME','circlestory' );
    //define('DB_USER', 'root');
   // define('DB_PASSWORD', '');
    //define('DB_HOST', 'localhost');

    $conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
    if (!$conn) {
        die("CONNECTION ERROR:  " . mysql_error());
    }
    
    $db_selected = mysql_select_db(DB_NAME, $conn);
    if(!$db_selected) {
        die( header("Location: ".$path."connectionerror"));
    }
?>