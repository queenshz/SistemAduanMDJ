<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: AdminLogin.html");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
</head>
<body>
  <h2>Selamat datang, <?php echo $_SESSION['admin_id']; ?>!</h2>
  <a href="logOut.php">Log Keluar</a>
</body>
</html>
