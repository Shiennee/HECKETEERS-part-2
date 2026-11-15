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
    'sort'
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
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <h1>HR Dashboard</h1>
    <nav>
        <a href="manage.php?tab=all"> All EOI </a> <!-- Navi -->
        <a href="manage.php?tab=search"> Search </a>
        <a href="manage.php?tab=delete"> Delete </a>
        <a href="manage.php?tab=update"> Status Update </a>
        <a href="manage.php?tab=sort"> Sort </a>
    </nav>

    <hr>

    <!--dashboard-->
    <?php
    
    if ($tab === 'all') { //get all EOI 
    $sql = "SELECT * FROM eoi ORDER BY EOInumber ASC";
    $result = $connect->query($sql);
    echo "<h2>All Expression of Interest Records</h2>";
    if (!$result) {
    echo "<p>Unable to retrieve EOI records.</p>";
    }
    elseif ($result && $result->num_rows > 0) {
    echo "<div class='table-container'>";
    echo "<table border='1'>";
        echo "<tr>";
        echo "<th>EOI Number</th>";
        echo "<th>Job Reference</th>";
        echo "<th>First Name</th>";
        echo "<th>Last Name</th>";
        echo "<th>Date of Birth</th>";
        echo "<th>Gender</th>";
        echo "<th>Other Gender</th>";
        echo "<th>Address</th>";
        echo "<th>Suburb/Town</th>";
        echo "<th>State</th>";
        echo "<th>Postcode</th>";
        echo "<th>Email</th>";
        echo "<th>Phone</th>";
        echo "<th>Skills</th>";
        echo "<th>Other Skills</th>";
        echo "<th>Status</th>";
        echo "</tr>";
    echo "</table>";
    echo "</div>";

        //get and display each EOI record
        while ($row = $result->fetch_assoc()) {

            echo "<tr>";

            echo "<td>" . htmlspecialchars($row['EOInumber']) . "</td>";
            echo "<td>" . htmlspecialchars($row['JRNum']) . "</td>";
            echo "<td>" . htmlspecialchars($row['fstname']) . "</td>";
            echo "<td>" . htmlspecialchars($row['lstname']) . "</td>";
            echo "<td>" . htmlspecialchars($row['dob']) . "</td>";
            echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
            echo "<td>" . htmlspecialchars($row['gender_other'] ?? '') . "</td>";
            echo "<td>" . htmlspecialchars($row['address']) . "</td>";
            echo "<td>" . htmlspecialchars($row['suburbtown']) . "</td>";
            echo "<td>" . htmlspecialchars($row['state']) . "</td>";
            echo "<td>" . htmlspecialchars($row['postcode']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
            echo "<td>" . htmlspecialchars($row['slist']) . "</td>";
            echo "<td>" . htmlspecialchars($row['oskills'] ?? '') . "</td>";
            echo "<td>" . htmlspecialchars($row['status']) . "</td>";

            echo "</tr>";

        }

        echo "</table>";
    } else {echo "<p> No EOI records found </p>"; }
}

    elseif ($tab === 'search') { } //search 
    elseif ($tab === 'delete') { } //delete 
    elseif ($tab === 'update') { } //update status
    elseif ($tab === 'sort') { } //sorting 
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