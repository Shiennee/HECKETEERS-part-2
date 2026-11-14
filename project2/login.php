<?php
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require __DIR__ . '/settings.php';

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    try {
        $conn = new mysqli($host, $user, $pwd, $sql_db);

        $stmt = $conn->prepare(
            'SELECT id, password_hash FROM hr_users WHERE username = ?'
        );
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($id, $passwordHash);

        if ($stmt->fetch() && password_verify($password, $passwordHash)) {
            session_regenerate_id(true);
            $_SESSION['hr_user_id'] = $id;
            header('Location: manage.php');
            exit;
        }

        $error = 'Invalid username or password.';
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
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <h1>HR Manager Login</h1>

    <?php if ($error !== ''): ?>
    <p role="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>
    <form action="login.php" method="post">
        <p>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" autocomplete="username" required>
        </p>
        <p>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" autocomplete="current-password" required>
        </p>
        <button type="submit">Log in</button>
    </form>
</body>
</html>