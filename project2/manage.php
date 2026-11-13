<?php
session_start();

if (empty($_SESSION['hr_user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HR Manager</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <h1>HR Manager</h1>
</body>
</html>