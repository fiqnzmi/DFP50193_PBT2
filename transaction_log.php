<?php
session_start();

if ($_SESSION['role'] != "admin") {
    header("Location:dashboard.php");
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Log</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="page-body">
    <div class="container">
        <h2 class="main-title">Transaction Log</h2>

        <?php
        $file = "logs/transaction.txt";
        if(file_exists($file)) {
            $open = fopen($file, "r");
            if(filesize($file) > 0) {
                echo "<div class='report-content'>" . nl2br(fread($open, filesize($file))) . "</div>";
            } else {
                echo "<p>Log is currently empty.</p>";
            }
            fclose($open);
        } else {
            echo "<p>Log file does not exist yet.</p>";
        }
        ?>

        <a href="dashboard.php" class="back-link">Back to Dashboard</a>
    </div>
</body>
</html>