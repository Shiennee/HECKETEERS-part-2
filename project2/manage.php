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


if (isset($_POST['delete_eoi'])) { //EOI deletion handling
    if (
        !isset($_SESSION['csrf_token']) ||
        !isset($_POST['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {
        die("Invalid request.");
    }
    $jobRef = strtoupper(trim($_POST['JRNum'] ?? '')); //get, clean, and validate job reference
    if ($jobRef === '') {
        $deleteMessage = "Please enter a job reference.";
    } elseif (!preg_match('/^[A-Z0-9]{1,5}$/', $jobRef)) {
        $deleteMessage = "Invalid job reference format.";
    } else {
       
        $stmt = $connect->prepare(  //preparing query
            "DELETE FROM eoi WHERE JRNum = ?"
        );
        $stmt->bind_param("s", $jobRef);
        if ($stmt->execute()) {
            $deletedCount = $stmt->affected_rows;
            if ($deletedCount > 0) {
                $deleteMessage = $deletedCount .
                    " EOI record(s) deleted successfully.";
            } else {
                $deleteMessage =
                    "No EOI records found for this job reference.";
            }
        } else {
            $deleteMessage = "Unable to delete EOI records.";
        }
        $stmt->close();
    }
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
    <link rel="stylesheet" href="styles/style.css">
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

    <!--dashboard-->
    <?php
    
    if ($tab === 'all') { //get all EOI 
    $sortFields = [
    'number' => 'EOInumber',
    'job'    => 'JRNum',
    'last'   => 'lstname',
    'status' => 'status',
    ];

    $sort = $_GET['sort'] ?? 'number';
    $column = is_string($sort) ? ($sortFields[$sort] ?? 'EOInumber') : 'EOInumber';
    $sql = "SELECT * FROM eoi ORDER BY $column ASC";
    $result = $connect->query($sql);
    echo "<h2>All Expression of Interest Records</h2>";
    echo '<form method="get" action="manage.php">
    <input type="hidden" name="tab" value="all">
    <label for="sort">Sort by</label>
    <select name="sort" id="sort">
    <option value="number">EOI Number</option>
    <option value="job">Job Reference</option>
    <option value="last">Last Name</option>
    <option value="status">Status</option>
    </select>
    <button type="submit">Sort</button>
    </form>';
    if (!$result) {
    echo "<p>Unable to retrieve EOI records.</p>";
    }
    elseif ($result->num_rows > 0) {
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

    elseif ($tab === 'search') {
    echo "<h2>Search EOI Records</h2>";
    
    //search by JRNum
    echo "<h3>Search by Job Reference</h3>";
    echo "<form method='get' action='manage.php'>";
    echo "<input type='hidden' name='tab' value='search'>";
    echo "<label>Job Reference:</label>";
    echo "<input type='text' name='JRNum'>";
    echo "<button type='submit'>Search</button>";
    echo "</form>";

    //search by name
    echo "<h3>Search by Applicant Name</h3>";
    echo "<form method='get' action='manage.php'>";
    echo "<input type='hidden' name='tab' value='search'>";
    echo "<label>First Name:</label>";
    echo "<input type='text' name='fstname'>";
    echo "<label>Last Name:</label>";
    echo "<input type='text' name='lstname'>";
    echo "<button type='submit'>Search</button>";
    echo "</form>";

    if (isset($_GET['JRNum'])) { //JRNum search code
    $jobRef = trim($_GET['JRNum']);
    $stmt = $connect->prepare(
        "SELECT * FROM eoi WHERE JRNum = ?"
    );
    $stmt->bind_param("s", $jobRef);
    $stmt->execute();
    $result = $stmt->get_result();
    echo "<h3>Search Results</h3>";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<p>";
            echo "EOI Number: " . htmlspecialchars($row['EOInumber'], ENT_QUOTES, 'UTF-8');
            echo " | Applicant: " . htmlspecialchars($row['fstname'], ENT_QUOTES, 'UTF-8');
            echo " " . htmlspecialchars($row['lstname'], ENT_QUOTES, 'UTF-8');
            echo " | Job Reference: " . htmlspecialchars($row['JRNum'], ENT_QUOTES, 'UTF-8');
            echo " | Status: " . htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8');
            echo "</p>";
        }
    } else {
        echo "<p>No matching applications found.</p>";
    }
    $stmt->close();
    }
    
    if (isset($_GET['fstname']) || isset($_GET['lstname'])) { //name search code
    $firstName = trim($_GET['fstname'] ?? '');
    $lastName = trim($_GET['lstname'] ?? '');
    //at least one name  entered
    if ($firstName === '' && $lastName === '') {
        echo "<p>Please enter at least one applicant name.</p>";
    } else {
        //start building SQL query
        $sql = "SELECT * FROM eoi WHERE 1=1";
        $params = [];
        $types = "";
        //first name condition
        if ($firstName !== '') {
            $sql .= " AND fstname LIKE ?";
            $params[] = "%" . $firstName . "%";
            $types .= "s";
        }

        //last name condition
        if ($lastName !== '') {
            $sql .= " AND lstname LIKE ?";
            $params[] = "%" . $lastName . "%";
            $types .= "s";
        }
        $stmt = $connect->prepare($sql);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();

        echo "<h3>Applicant Search Results</h3>";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>";
                echo "EOI Number: " . htmlspecialchars($row['EOInumber'], ENT_QUOTES, 'UTF-8');
                echo " | Applicant: " . htmlspecialchars($row['fstname'], ENT_QUOTES, 'UTF-8');
                echo " " . htmlspecialchars($row['lstname'], ENT_QUOTES, 'UTF-8');
                echo " | Job Reference: " . htmlspecialchars($row['JRNum'], ENT_QUOTES, 'UTF-8');
                echo " | Status: " . htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8');
                echo "</p>";
            }

        } else {
            echo "<p>No matching applicants found.</p>";
        }
        $stmt->close();
    }
    }
    }
    elseif ($tab === 'delete') { //deleting EOI 
    echo "<h2>Delete EOI Records</h2>";
    echo "<p>Enter a job reference to delete all
          associated EOI records.</p>";
    echo "<form method='post' action='manage.php?tab=delete'>";
    echo "<label for='JRNum'>Job Reference:</label>";
    echo "<input type='text'
                name='JRNum'
                id='JRNum'
                maxlength='5'
                required>";
    echo "<input type='hidden'
                name='csrf_token'
                value='" . htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') . "'>";
                
    echo "<button type='submit'
             name='delete_eoi'
             onclick=\"return confirm(
                'Are you sure you want to delete all EOIs for this job reference?'
             );\">
        Delete
      </button>";
    echo "</form>"; 
    if (isset($deleteMessage)) {
    echo "<p>" .
         htmlspecialchars($deleteMessage, ENT_QUOTES, 'UTF-8') .
         "</p>";
    }
    } 
    
    elseif ($tab === 'update') { } //update status (add code in bracket here)
    
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