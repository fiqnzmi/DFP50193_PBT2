<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

if (!isset($_SESSION['username'])) {
    header("Location:index.php");
}

$message = "";

if (isset($_POST['submit'])) {
    $file = "reports/" . $_SESSION['username'] . "_" . time() . ".txt";
    $data =
        "Name: " . $_POST['name'] .
        "\nMatric: " . $_POST['matric'] .
        "\nBlock: " . $_POST['block'] .
        "\nRoom: " . $_POST['room'] .
        "\nDamage: " . $_POST['damage'] .
        "\nUrgency: " . $_POST['urgency'] .
        "\nDate: " . $_POST['date'] .
        "\nDescription: " . $_POST['description'] .
        "\nPhone: " . $_POST['phone'] .
        "\nStatus: Pending\n";

    $fopen = fopen($file, "w");
    fwrite($fopen, $data);
    fclose($fopen);

    $log = fopen("logs/transaction.txt", "a");
    fwrite($log, date("d-m-Y h:i A") . " " . $_SESSION['role'] . " created " . $file . "\n");
    fclose($log);

    $message = "<div class='alert-success'>Report Submitted Successfully</div>";
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Report</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="page-body">
    <div class="container">
        <h2 class="main-title">Create Maintenance Report</h2>
        <?php echo $message; ?>
        
        <form method="POST">
            <div class="form-group">
                <span class="input-label">Name:</span>
                <input type="text" name="name" class="form-input" required>
            </div>
            <div class="form-group">
                <span class="input-label">Matric Number:</span>
                <input type="text" name="matric" class="form-input" required>
            </div>
            <div class="form-group">
                <span class="input-label">Hostel Block:</span>
                <select name="block" class="form-input">
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                </select>
            </div>
            <div class="form-group">
                <span class="input-label">Room Number:</span>
                <input type="number" name="room" class="form-input">
            </div>
            <div class="form-group">
                <span class="input-label">Damage Type:</span>
                <div class="radio-group">
                    <span class="radio-item"><input type="radio" name="damage" value="Light"> Light</span>
                    <span class="radio-item"><input type="radio" name="damage" value="Fan"> Fan</span>
                    <span class="radio-item"><input type="radio" name="damage" value="Pipe"> Pipe</span>
                    <span class="radio-item"><input type="radio" name="damage" value="Sink"> Sink</span>
                    <span class="radio-item"><input type="radio" name="damage" value="Door"> Door</span>
                    <span class="radio-item"><input type="radio" name="damage" value="Furniture"> Furniture</span>
                </div>
            </div>
            <div class="form-group">
                <span class="input-label">Urgency Level:</span>
                <select name="urgency" class="form-input">
                    <option>Low</option>
                    <option>Medium</option>
                    <option>High</option>
                </select>
            </div>
            <div class="form-group">
                <span class="input-label">Date:</span>
                <input type="date" name="date" class="form-input">
            </div>
            <div class="form-group">
                <span class="input-label">Description:</span>
                <textarea name="description" class="form-input"></textarea>
            </div>
            <div class="form-group">
                <span class="input-label">Contact Number:</span>
                <input type="tel" name="phone" class="form-input">
            </div>
            <input type="submit" name="submit" value="Submit Report" class="btn-submit">
        </form>
        <a href="dashboard.php" class="back-link">Back to Dashboard</a>
    </div>
</body>
</html>