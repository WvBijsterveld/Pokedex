<?php

// connect to the database
$dbServername = "localhost";
$dbUsername = "root";
$dbName = "veelbeter";

$conn = mysqli_connect( $dbServername , $dbUsername , $dbName );
// Check if the form is submitted
if (isset($_POST['login'])) {
  // Get the user input
  $username = $_POST['Username'];
  $password = $_POST['Password'];
  // Validate the user input
  if (empty($username) || empty($password)) {
    // Display an error message
    echo "Please fill in all the fields";
  } else {
    // Prepare a SQL statement
    $sql = "SELECT * FROM users WHERE Username = ?";
    // Create a prepared statement
    $stmt = $conn->prepare($sql);
    // Bind the parameter
    $stmt->bind_param("s", $username);
    // Execute the statement
    $stmt->execute();
    // Get the result
    $result = $stmt->get_result();
    // Check if the user exists
    if ($result->num_rows > 0) {
      // Fetch the user data
      $row = $result->fetch_assoc();
      // Verify the password
      if (password_verify($password, $row['password'])) {
        // Set the session variables
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        // Redirect to the dashboard page
        header("Location: dashboard.php");
      } else {
        // Display an error message
        echo "Invalid password";
      }
    } else {
      // Display an error message
      echo "Invalid username";
    }
    // Close the statement
    $stmt->close();
  }
}
// Close the database connection
$conn->close();
?>        