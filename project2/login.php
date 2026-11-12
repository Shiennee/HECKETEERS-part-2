<?php include 'header.inc'; ?>

<h2>Login</h2>

<?php if (isset($_GET['error'])): ?>
    <p>Incorrect username or password.</p>
<?php endif; ?>

<form action="index.php" method="post">
    <p>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
    </p>

    <p>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </p>

    <button type="submit">Login</button>
</form>
