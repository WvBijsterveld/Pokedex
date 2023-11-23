<html>
<body>
Welkom <?php echo $_POST["name"]; ?><br>
Je email is: <?php echo $_POST["email"]; ?> <br>
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
$Password = $_POST["password"];
$Name     = $_POST["name"];
$Email    = $_POST["email"];

$sql = "INSERT INTO users (Username, Password, Name, Email) VALUES ('$Username', '$Password', '$Name', '$Email')";
if (mysqli_query($conn, $sql)) {
    echo "Account aangemaakt!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}