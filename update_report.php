<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

if ($_SESSION['role'] != "admin") {
    header("Location:dashboard.php");
}

$file = "reports/" . $_GET['file'];
$message = "";

if (isset($_POST['update'])) {
    $open_read = fopen($file, "r");
    $content = fread($open_read, filesize($file));
    fclose($open_read);

    $content = preg_replace('/Status: .*/', 'Status: ' . $_POST['status'], $content);

    $fopen = fopen($file, "w");
    fwrite($fopen, $content);
    fclose($fopen);

    $log = fopen("logs/transaction.txt", "a");
    fwrite($log, date("d-m-Y h:i A") . " admin updated " . $file . "\n");
    fclose($log);

    $message = "<div class='alert-success'>Updated Successfully</div>";
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Report</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="page-body">
    <div class="container">
        <h2 class="main-title">Update Status</h2>
        <?php echo $message; ?>
        
        <form method="POST">
            <div class="form-group">
                <select name="status" class="form-input">
                    <option>Pending</option>
                    <option>In Progress</option>
                    <option>Fixed</option>
                </select>
            </div>
            <input type="submit" name="update" value="Update Status" class="btn-submit">
        </form>
        <a href="view_report.php" class="back-link">Back to Reports</a>
    </div>
</body>
</html>