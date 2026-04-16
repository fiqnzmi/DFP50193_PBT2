<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location:index.php");
}

$files = @scandir("reports");
if (!$files) {
    $files = [];
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Report</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="page-body">
    <div class="container">
        <h2 class="main-title">Reports List</h2>
        
        <?php
        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                if ($_SESSION['role'] == "admin") {
                    echo "<a href='?file=$file' class='report-link'>$file</a>";
                } elseif ($_SESSION['role'] == "student" && strpos($file, $_SESSION['username'] . "_") === 0) {
                    echo "<a href='?file=$file' class='report-link'>$file</a>";
                }
            }
        }
        ?>

        <?php
        if (isset($_GET['file'])) {
            echo "<hr><br>";
            $file = "reports/" . $_GET['file'];
            if(file_exists($file)) {
                $open = fopen($file, "r");
                echo "<div class='report-content'>" . nl2br(fread($open, filesize($file))) . "</div>";
                fclose($open);

                if ($_SESSION['role'] == "admin") {
                    echo "<a href='update_report.php?file=" . $_GET['file'] . "' class='action-btn'>Update</a> ";
                    echo "<a href='delete_report.php?file=" . $_GET['file'] . "' class='action-btn action-btn-danger'>Delete</a>";
                }
            }
        }
        ?>
        <br><br>
        <a href="dashboard.php" class="back-link">Back to Dashboard</a>
    </div>
</body>
</html>