<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.phptutorial.net/app/css/style.css">
    <title>Register</title>
</head>
<body>
<main>
    <form action="register.php" method="post">
        <h1>Sign Up</h1>
        <div>
            <label for="name">Naam:</label>
            <input type="text" name="name" id="name">
        </div>
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email">
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <label for="agree">
                <input type="checkbox" name="agree" id="agree" value="yes"/> I agree
                with the
                <a href="#" title="term of services">term of services</a>
            </label>
        </div>
        <button type="submit">Register</button>
        <footer>Already a member? <a href="login.php">Login here</a></footer>
    </form>
</main>
</body>
</html>

<?php


// connect to the database
$dbServername = "localhost";
$dbUsername = "regis";
$dbName = "veelbeter";
$dbPassword = "JcUiKjOE3pFsX@np";

$conn = mysqli_connect( $dbServername, $dbUsername, $dbPassword, $dbName);

$Username = $_POST["username"];

$Name     = $_POST["name"];
$Email    = $_POST["email"];

// Check if the form is submitted
if (isset($_POST['register'])) {
  // Get the user input
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  // Validate the user input
  if (empty($username) || empty($email) || empty($password)) {
    // Display an error message
    echo "Please fill in all the fields";
  } else {
    // Hash the password
    $password = password_hash($password, PASSWORD_DEFAULT);
    // Prepare a SQL statement
    $sql = "INSERT INTO users (Username, Password, Name, Email) VALUES ('$Username', '$Password', '$Name', '$Email')";
    // Create a prepared statement
    $stmt = $conn->prepare($sql);
    // Bind the parameters
    $stmt->bind_param("sss", $username, $email, $password);
    // Execute the statement
    if ($stmt->execute()) {
      // Display a success message
      echo "User registered successfully";
    } else {
      // Display an error message
      echo "User registration failed";
    }
    // Close the statement
    $stmt->close();
  }
}
// Close the database connection
$conn->close();
?>        