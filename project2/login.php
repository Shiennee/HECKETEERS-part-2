<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HR Manager Login</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <h1>HR Manager Login</h1>

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