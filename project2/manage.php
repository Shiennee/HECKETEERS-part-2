<?php
session_start();

if (isset($_POST['logout'])) { //verify the csrf on logout  
    if (
        !isset($_SESSION['csrf_token']) ||
        !isset($_POST['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {
        die("Invalid request.");
    }
    $_SESSION = [];
    session_destroy();
    header("Location: index.php");
    exit();
}

if (!isset($_SESSION['hr_user_id'])) { //verify admin login
    header("Location: login.php");
    exit();
}

require_once("settings.php");

if (empty($_SESSION['csrf_token'])) { //generate a CSRF
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$tab = $_GET['tab'] ?? 'all'; //get tabs
$allowedTabs = [
    'all',
    'search',
    'delete',
    'update',
];

if (!in_array($tab, $allowedTabs, true)) { //validate tabs
    $tab = 'all';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>HR Dashboard</title>
</head>

<body>
    <h1>HR Dashboard</h1>
    <nav>
        <a href="manage.php?tab=all"> All EOI </a> <!-- Navi -->
        <a href="manage.php?tab=search"> Search </a>
        <a href="manage.php?tab=delete"> Delete </a>
        <a href="manage.php?tab=update"> Status Update </a>
    </nav>

    <hr>

    <form method="get" action="manage.php">
    <input type="hidden" name="tab" value="all">

    <label for="sort">Sort by</label>
    <select name="sort" id="sort">
        <option value="number">EOI Number</option>
        <option value="status">Status</option>
    </select>

    <button type="submit">Sort</button>
</form>

    <!--dashboard-->
    <?php
   if ($tab === 'all') {
    $column = ($_GET['sort'] ?? '') === 'status' ? 'status' : 'EOInumber';
    $result = $connect->query("SELECT EOInumber, status FROM eoi ORDER BY $column");

    while ($row = $result->fetch_assoc()) {
        echo (int) $row['EOInumber'] . ' — '
            . htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8') . '<br>';
    }
}   
    elseif ($tab === 'search') { } //search 
    elseif ($tab === 'delete') { } //delete 
    elseif ($tab === 'update') { } //update status 
    ?>
    <hr>
    <!--logout button-->
    <form method="post" action="manage.php">

        <input type="hidden"
               name="csrf_token"
               value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">
        <button type="submit" name="logout">
            Logout
        </button>

    </form>
</body>
</html>