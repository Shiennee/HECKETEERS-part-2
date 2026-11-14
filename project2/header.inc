<!DOCTYPE html>
<html lang="en">
<html>
    <head>
        <link href="styles/style.css" rel = "stylesheet">
        <meta charset="UTF-8">
        <meta name="description" content="Job applications">
        <meta name ="keywords" content="html,form,hyperlinks">
        <title>De Hecketeers</title>
    </head>
<body>
    <header>
    <img src="images/logo.png" alt="home" width="80px" height="80px"></p>
    <h1 class ="Main">DE_HECKETEERS</h1>
    <search>
            <nav>
                <a href="index.php">Home</a>
                <a href="jobs.php">Jobs</a>
                <a href="Apply.php">Apply</a>
                <a href="About.php">About</a>
                <a href="login.php">Login/Management</a>
                <p><a href="manage.php">HR Manager</a></p>
                
            </nav>
            
            <form action="/search" method="get">
                    <label for="search">Search:</label>
                    <input type="text" id="search" name="search">
                    <button type="submit">Search</button>
            </form>
    </search>
    </header>
</body>
</html>