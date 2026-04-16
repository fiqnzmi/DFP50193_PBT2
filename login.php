<?php
session_start();

if (isset($_POST['login'])) {
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['role'] = $_POST['role'];
    header("Location: dashboard.php");
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="page-body">
    <div class="container">
        <h2 class="main-title">Login Page</h2>
        <form method="POST">
            <div class="form-group">
                <span class="input-label">Username</span>
                <input type="text" name="username" class="form-input" required>
            </div>
            <div class="form-group">
                <span class="input-label">Role</span>
                <input type="text" name="role" value="<?php echo $_GET['role']; ?>" class="form-input" readonly>
            </div>
            <input type="submit" name="login" value="Login" class="btn-submit">
        </form>
        <a href="index.php" class="back-link">Back to Home</a>
    </div>
</body>
</html>