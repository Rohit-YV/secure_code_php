<!-- // increcure Code -->

<!-- <?php
$valid_username="admin@gmail.com";
$valid_password="password";

$username = $_POST["email"];
$password = $_POST["password"];

if($valid_password === $password && $valid_username === $username){
          echo "login sucessfull";
}
else {
          echo "incorrect username and password";
          echo '<a href="index.php">go back to the login page</a>' ;
}

?> -->
<!-- // secure  code -->
<?php
session_start();

// Corrected variable name
$valid_username = "admin@gmail.com";

// Hash the password (only needed once during setup or in a registration script)
$hashed_password = password_hash("password123", PASSWORD_BCRYPT);

// Initialize the login attempt counter if it does not exist
if (!isset($_SESSION['login_attempt'])) {
    $_SESSION['login_attempt'] = 0;
}

// Check if the user has exceeded the login attempt limit
if ($_SESSION['login_attempt'] >= 5) {
    die("Too many attempts. Please try again later.");
}

// Get the submitted form data
$username = $_POST["email"];
$password = $_POST["password"];

// Check if the credentials are correct
if ($username === $valid_username && password_verify($password, $hashed_password)) {
    echo "Login successful!";
    // Reset login attempts after successful login
    $_SESSION["login_attempt"] = 0;
} else {
    // Increment the login attempt counter on failure
    $_SESSION['login_attempt']++;
    echo "Wrong username or password.<br>";
    echo '<a href="index.php">Go back to the login page</a>';
}
?>
