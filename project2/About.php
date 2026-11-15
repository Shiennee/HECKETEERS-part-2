<?php 
require_once("settings.php");
$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn){
    die("Database connection failure: " . mysqli_connect_error());}

$sql = "SELECT * FROM about";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Database query failure: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
	
	<head>
        <link href="styles/style.css" rel="stylesheet">
  		<meta charset="utf-8">
        <meta name="description" content="About us">
        <meta name ="keywords" content="html,images,hyperlinks">
        <meta name ="Lim Shien Nee" content ="De Hecketeers">
  		<title> De Hacketeers apply.html </title>

        <style>
            h3 {color:#8b261d ;}
        </style>
       
	</head>
<body>
    <?php include 'header.inc';?>

<h1>About us</h1>
<section id="About">


        <h2>Company policy:</h2>
        <h3>we do not discriminate race, gender … including Aboriginal & Torres Strait Islanders !!!!</h3>
        
        <table>
        <caption>FUN FACTS </caption>
        <thead>
        <th></th>
        <th>Yau Chee Xuen</th>
        <th>Lim Shien Nee</th>
        <th>Teh Xuan Bin</th>
        <th>Lim Ye An</th>
        </thead>
        <tr>
        <td>Likes to drink</td>
        <td>H2O💧</td>
        <td>matcha🍵</td>
        <td>chinese tea🫖</td>
        <td>ice lemon tea🍹</td>
        </tr>
        <tr>
        <td></td>
        <td>powered by chocolate🍫, fueled by cheese🧀</td>
        <td>i want a snake python</td>
        <td>Born in highland, but scared of cold</td>
        <td>Food is the source of happiness</td>
        </tr>
        <tr>
        <td></td>
        <td>immune to coffee and tea</td>
        <td>🎵matcha is your best of friends🎵</td>
        <td>Loves ice cream</td>
        <td>Low battery mode by default</td>
        </tr>
        <tr>
        <td></td>
        <td>prefers “terrible” jokes</td> 
        <td>procrastination my greatest enemy</td>
        <td>Keep beetle as pets but scared of cockroaches 🪳</td>
        <td>Can calculate Mahjong tiles faster than math🀄</td>

    </table>

<ul>
    <li><h2>Group name</h2></li>
    <ul>
        <li>De hecketeers</li>
    </ul>

    <li><h2>Class day</h2></li>
    <ul>
        <li>Monday </li>
        <li>Thursday</li>
    </ul>

    <li><h2>time</h2></li>
    <ul>
        <li>16:00-18:00</li>
        <li>14:00-16:00</li>
    </ul>
    <br>

<section id="group">
<figure><figcaption>De_Hecketeers</figcaption>
<img src="images/Group.png" alt="Group Photo" style="width:40%"></figure>

</section>

<dl>
        
    <h2>Yau Chee Xuen</h2> 
        <dt>Quotes</dt>
        <dd>-' 牛逼了，兄弟 ' (no way, bro)</dd>
    <h2>Lim Shien Nee</h2> 
        <dt>Quotes</dt>
        <dd>' 没有期望就没有失望 '</dd>
        <dd>if there is no expectation there will be no dissapointment </dd>
    <h2>Teh Xuan Bin</h2> 
        <dt>Quotes</dt>
        <dd>-'GGWP' (well played)</dd>
    <h2>Lim Ye An </h2> 
        <dt>Quotes</dt>
        <dd>-'Patience is key'</dd>

</dl>
</ul>

</section>
<h2>Group members contributions</h2>
<table>
    <tr>
        <th>Member name</th>
        <th>Project1 Contribution</th>
        <th>Project2 Contribution</th>
    </tr>
    <?php 
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['member_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['project1_contribution']) . "</td>";
            echo "<td>" . htmlspecialchars($row['project2_contribution']) . "</td>";
            echo "</tr>";
        }
    ?>
</table>
</body>
</html>
