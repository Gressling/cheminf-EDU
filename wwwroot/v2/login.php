<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../style.css"> <!-- Link to your CSS file -->
</head>
<body>
<div class="container"> <!-- Container for styling -->
    <h2 class="title">Login</h2> <!-- Title class for the heading -->

<?php
// Placeholder for authentication logic
function authenticate($username, $password) {

    $credentials = getenv('CUSTOMCONNSTR_credentials');
    list($valid_username, $valid_password) = explode(';', $credentials);
    
    return $username === $valid_username && $password === $valid_password;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (authenticate($username, $password)) {
        // Set session variables
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
        // Redirect to a new page
        header("Location: index.php");
        exit;
    } else {
        echo "<p>Login failed. Please try again.</p>";
    }
}
?>


    <form method="post" action="login.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
    <br/><br/>
    <div class="links">
                    <a class="link" href="../index.php">Main index</a><br/>
    </div>
    <br/><br/>
    <div class="license">MIT Licence - no commercial interest</div>
</div>
</body>
</html>

