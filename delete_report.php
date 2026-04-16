<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

if($_SESSION['role'] != "admin") {
    header("Location:dashboard.php");
}

$file = "reports/" . $_GET['file'];

if(file_exists($file)) {
    unlink($file);
    
    $log = fopen("logs/transaction.txt","a");
    fwrite($log, date("d-m-Y h:i A") . " admin deleted " . $file . "\n");
    fclose($log);
}

header("Location:view_report.php");
?>