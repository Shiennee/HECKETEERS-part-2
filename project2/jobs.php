<!DOCTYPE html>
<html lang="en">
<head>
    <title>Jobs Requirements</title>

        <link href="styles/style.css" rel="stylesheet">
        <meta charset="UTF-8">
        <meta name="description" content="Job applications">
        <meta name ="keywords" content="html,form,hyperlinks">
        <meta name ="Lim Ye An" content ="De Hecketeers">
</head>

<body>
 <?php include 'header.inc'; ?>
  <section id="jobs">
    <h1>Jobs Requirements</h1>
    <h2>Jobs requirements and opportunities are listed below. Please review the available positions and apply if you meet the qualifications.</h2>


<img src="images/discussion.png" alt="Join Our Team" style="height: 220px;width:auto;margin: 10px;"/>

    <aside>
      <h2>Reference </h2>
      <p><a href="https://www.youtube.com/watch?v=5L9UhOnuos0">Dave Hollingworth</a></p>
      <p><a href="https://www.w3schools.com/sql/default.asp">W3school</a></p>
      <h2>Acknowledgment</h2>
      <p>Job role descriptions and content were developed with the assistance of AI and adapted from standard industry templates.</p>
      <p>Ai was use to provide reference for learning .</p>
        

      <h2>Application Guide</h2>
      <p>Please note your preferred <strong>Job Reference Number</strong> before submitting your details on our application page.</p>                                                                                     
    </aside>

<form method="POST" action="jobs.php">

        <input type="text" name = "search" placeholder="Enter a job title or a reference number">
            <input type="submit" value="Search">
            <a href="jobs.php">Show all Jobs</a>
    </form>

<?php
require_once("settings.php");
$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

if ($conn) {

        if (isset($_POST['search']) && !empty($_POST['search'])) {
            $search = mysqli_real_escape_string($conn, $_POST['search']);
            $sql = "SELECT * FROM jobs WHERE job_title LIKE '%$search%' OR job_ref LIKE '%$search%'";

        } else {
            $sql = "SELECT * FROM jobs";
        }
        $result = mysqli_query($conn, $sql);

        if ($result) {

            if  (mysqli_num_rows($result) > 0) {
                $job_index = 1;      

            $job_styles = [
            1 => ["class" => "designer", "img" => "images/designer.png", "alt" => "Graphic Designer working on visual concepts"],
            2 => ["class" => "web",      "img" => "images/developer.png", "alt" => "Web Developer coding responsive web pages"],
            3 => ["class" => "manager",  "img" => "images/manager.png", "alt" => "Content Manager analyzing market trends"]
        ];

        while ($row = mysqli_fetch_assoc($result)) {
            $current_style = $job_styles[$job_index]["class"] ?? "job-item";
            $current_img   = $job_styles[$job_index]["img"]   ?? "images/discussion.png";
            $current_alt   = $job_styles[$job_index]["alt"]   ?? "Job Image";

            echo "<section class='" . $current_style . "' style='display: flex; justify-content: space-between; align-items: center;'>";
            echo "<div>";
            echo "<h2>Job" . $job_index . "</h2>";
            echo "<h2>" . htmlspecialchars($row['job_title']) . "</h2>";
            echo "<p><strong>Job Reference Number:</strong> " . htmlspecialchars($row['job_ref']) . "</p>";
            echo "<p><strong>Reports to:</strong> " . htmlspecialchars($row['reports_to']) . "</p>";
            echo "<p><strong>Salary:</strong> " . htmlspecialchars($row['salary']) . "</p>";
            echo "<p><strong>Description:</strong> " . htmlspecialchars($row['description']) . "</p>";
            echo "<h3>Key Responsibilities:</h3>";
            echo "<ol>";
            $resp_lines = explode("\r\n", $row['responsibilities']);
            foreach ($resp_lines as $line) {
                if (trim($line) !== "") {
                    $clean_line = preg_replace('/^\d+\.\s*/', '', trim($line));
                    echo "<li>" . htmlspecialchars($clean_line) . "</li>";
                }
            }
            echo "</ol>";
            echo "<h3>Requirements:</h3>";
            echo "<ul>";
            echo "<li><strong>Essential:</strong> " . htmlspecialchars($row['essential_req']) . "</li>";
            echo "<li><strong>Preferable:</strong> " . htmlspecialchars($row['preferable_req']) . "</li>";
            echo "</ul>";
            echo "<br>";
            
            echo "</div>";
            echo "<img src='" . $current_img . "' alt='" . $current_alt . "' style='height: 300px; width: auto; margin: 10px 0;'/>";
            echo "</section>";
            $job_index++; }
        }
        else {
        echo "<p> 🚫 No matching jobs found.</p>";}

        mysqli_free_result($result);

    } else {
        echo "<p>Query failed</p>";
    }

    mysqli_close($conn);

} else {
    echo "<p>Database connection failure.</p>";
}   
?>

<hr>
    <h3>Benefits:</h3>
    <ul>
      <li>Annual professional development; training allowance.</li>
      <li>Flexible hybrid work options.</li>
      <li>Comprehensive medical insurance.</li>
      <li>18 days of paid annual leave.</li>
      <li>Performance-based bonuses.</li>
    </ul>
  </Section>
    </body>

</html>
