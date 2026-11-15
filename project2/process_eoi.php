    
<?php
//section 1 = preventing direct url access
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: apply.php");
    exit();
}

$required_fields = [
    "JRNum",
    "fstname",
    "lstname",
    "dob",
    "gender",
    "address",
    "suburbtown",
    "state",
    "postcode",
    "email",
    "phone"
];

foreach ($required_fields as $field) {
    if (!isset($_POST[$field]) || !is_string($_POST[$field])) {
        header("Location: apply.php");
        exit();
    }
}
//section 2 = get and sanitize data from form 
function clean_input($data) {
    if (!is_string($data)) {
        return "";
    }
    return trim(stripslashes($data));
}

$JRNum = clean_input($_POST["JRNum"]);
$fstname = clean_input($_POST["fstname"]);
$lstname = clean_input($_POST["lstname"]);
$dob = clean_input($_POST["dob"]);
$gender = clean_input($_POST["gender"]);
$gender_other = clean_input($_POST["gender_other"] ?? "");

$address = clean_input($_POST["address"]);
$suburbtown = clean_input($_POST["suburbtown"]);
$state = clean_input($_POST["state"]);
$postcode = clean_input($_POST["postcode"]);

$email = clean_input($_POST["email"]);
$phone = clean_input($_POST["phone"]);

$oskills = clean_input($_POST["oskills"] ?? "");

// Retrieve checkbox values
$slist = $_POST["slist"] ?? [];

if (!is_array($slist)) {
    $slist = [];
}

$slist = array_map("clean_input", $slist);

//section 3 = validate user's input

$errors = [];

// Job reference validation
$valid_jobs = ["1GRPH", "2WDEV", "3CONM"];

if (!in_array($JRNum, $valid_jobs, true)) {
    $errors[] = "Please select a valid job reference.";
}

// First name validation
if ($fstname === "" || strlen($fstname) > 25) {
    $errors[] = "First name is required and must not exceed 25 characters.";
}

// Last name validation
if ($lstname === "" || strlen($lstname) > 25) {
    $errors[] = "Last name is required and must not exceed 25 characters.";
}

// Date of birth validation
$date = DateTime::createFromFormat("!Y-m-d", $dob);
$date_errors = DateTime::getLastErrors();

if (
    !$date ||
    ($date_errors !== false &&
    ($date_errors["warning_count"] > 0 ||
    $date_errors["error_count"] > 0)) ||
    $date->format("Y-m-d") !== $dob ||
    $date > new DateTime("today")
) {
    $errors[] = "Please enter a valid date of birth.";
}

// Gender validation
$valid_genders = ["male", "female", "other"];

if (!in_array($gender, $valid_genders, true)) {
    $errors[] = "Please select a valid gender.";
}

if ($gender_other !== "" && strlen($gender_other) > 50) {
    $errors[] = "Gender specification must not exceed 50 characters.";
}

// Address validation
if ($address === "" || strlen($address) > 100) {
    $errors[] = "Please enter a valid street address.";
}

if ($suburbtown === "" || strlen($suburbtown) > 50) {
    $errors[] = "Please enter a valid suburb or town.";
}

// State validation
$valid_states = [
    "vic", "nsw", "qld", "nt",
    "wa", "sa", "tas", "act"
];

if (!in_array($state, $valid_states, true)) {
    $errors[] = "Please select a valid state.";
}

// Postcode validation
if (!preg_match("/^[0-9]{4}$/", $postcode)) {
    $errors[] = "Postcode must contain exactly 4 numbers.";
}

// Email validation
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Please enter a valid email address.";
}

if (strlen($email) > 100) {
    $errors[] = "Email address is too long.";
}

// Phone validation
if (
    strlen($phone) > 20 ||
    !preg_match("/^[0-9+() -]{8,20}$/", $phone)
) {
    $errors[] = "Please enter a valid phone number.";
}

// Skills validation
$valid_skills = [
    "skill1", "skill2", "skill3",
    "skill4", "skill5"
];

if (empty($slist)) {
    $errors[] = "Please select at least one skill.";
} else {
    foreach ($slist as $skill) {
        if (!is_string($skill) ||
            !in_array($skill, $valid_skills, true)) {
            $errors[] = "Invalid skill selection.";
            break;
        }
    }
}

// Other skills validation
if (strlen($oskills) > 10000) {
    $errors[] = "Other skills description is too long.";
}

//section 4 = connect to eoi.sql

if (empty($errors)) {

    require_once(__DIR__ . "/settings.php");

    // Convert checkbox array into a string
    $skills_string = implode(", ", $slist);

    $sql = "INSERT INTO eoi (
        JRNum,
        fstname,
        lstname,
        dob,
        gender,
        gender_other,
        address,
        suburbtown,
        state,
        postcode,
        email,
        phone,
        slist,
        oskills
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $connect->prepare($sql);

    if ($stmt) {

        $stmt->bind_param(
            "ssssssssssssss",
            $JRNum,
            $fstname,
            $lstname,
            $dob,
            $gender,
            $gender_other,
            $address,
            $suburbtown,
            $state,
            $postcode,
            $email,
            $phone,
            $skills_string,
            $oskills
        );

        if ($stmt->execute()) {

            //get generated EOI nmbr 
            $EOInumber = $connect->insert_id;

            $success = true;

        } else {
            $errors[] = "Unable to submit your application. Please try again.";
        }

        $stmt->close();

    } else {
        $errors[] = "Unable to prepare the database query.";
    }

    $connect->close();
}

?>

<!-- section 5 = display error if available -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Application Result - De Hacketeers</title>
    <link href="styles/style.css" rel="stylesheet">
</head>

<body>

<?php include 'header.inc'; ?>
<?php include 'nav.inc';?>

<section id="signup">

    <?php if (!empty($success)) { ?>

        <h1>Application Submitted Successfully!</h1>

        <p>Thank you for applying to De Hacketeers.</p>

        <p>
            Your Expression of Interest number is:
            <strong>
                <?php echo htmlspecialchars((string)$EOInumber, ENT_QUOTES, 'UTF-8'); ?>
            </strong>
        </p>

        <p>Please keep this number for future reference.</p>

    <?php } else { ?>

        <h1>Application Submission Failed</h1>

        <p>Please correct the following errors:</p>

        <ul>
            <?php foreach ($errors as $error) { ?>
                <li>
                    <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
                </li>
            <?php } ?>
        </ul>

        <p>
            <a href="apply.php">Return to Application Form</a>
        </p>

    <?php } ?>

</section>

</body>
</html>

