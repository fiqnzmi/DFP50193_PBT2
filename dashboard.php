<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location:index.php");
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="page-body">
    <div class="container">
        <h2 class="main-title">Welcome <?php echo $_SESSION['username']; ?></h2>

        <?php if ($_SESSION['role'] == "student") { ?>
            <a href="create_report.php" class="report-link">Create Report</a>
            <a href="view_report.php" class="report-link">View My Reports</a>
        <?php } ?>

        <?php if ($_SESSION['role'] == "admin") { ?>
            <a href="create_report.php" class="report-link">Create Report</a>
            <a href="view_report.php" class="report-link">View All Reports</a>
            <a href="transaction_log.php" class="report-link">Transaction Log</a>
        <?php } ?>

        <a href="logout.php" class="back-link">Logout</a>
    </div>
</body>
</html>