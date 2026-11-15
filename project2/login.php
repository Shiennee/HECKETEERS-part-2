<?php
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    require_once __DIR__ . '/settings.php';
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    try {
        $stmt = $connect->prepare(
            'SELECT id, password_hash
             FROM login
             WHERE username = ?'
        );
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($id, $passwordHash);
        if ($stmt->fetch() &&
            password_verify($password, $passwordHash)) {
            session_regenerate_id(true);
            $_SESSION['hr_user_id'] = $id;
            header('Location: manage.php');
            exit();
        } else {
            $error = 'Invalid username or password.';
        }
        $stmt->close();
    } catch (mysqli_sql_exception $e) {
        error_log($e->getMessage());
        $error = 'The login database is unavailable.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HR Manager Login</title>
</head>
<body>
    <h1>HR Manager Login</h1>
    <?php if ($error !== ''): ?>
        <p role="alert">
            <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
        </p>
    <?php endif; ?>
    <form action="login.php" method="post">
        <p>
            <label for="username">Username</label>
            <input
                type="text"
                id="username"
                name="username"
                autocomplete="username"
                required>
        </p>
        <p>
            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                autocomplete="current-password"
                required>
        </p>
        <button type="submit">Log in</button>
    </form>
</body>
</html>