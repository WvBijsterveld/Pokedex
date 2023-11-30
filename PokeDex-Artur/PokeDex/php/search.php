<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>PokeMon Search</title>
</head>
<body>

<style type="text/css">
    <?php include("../css/search.css"); ?>
    <?php include("../css/main.css"); ?>
</style>

  <!-- back btn -->
  <a class="back" href="index.php">Go back</a>

  <?php
$search_input = $_POST['search_input'];

$poke_api_url = "https://pokeapi.co/api/v2/pokemon/" . $search_input;

// Read JSON file
$json_data = file_get_contents($poke_api_url);

// Decode JSON data into PHP array
$response_data = json_decode($json_data);

// Store pokemon data in variables
$name = $response_data->name;

// Output the "You searched for" text outside of the main container
echo "<div class='search-results'>";
echo "<p>You searched for: $search_input</p>";
echo "</div>";

// Output the main container
echo "<div class='pokemon-container'>";
echo "<h1 class='pokemon-name'>$name</h1>";

$image_url = $response_data->sprites->front_default;
echo "<img class='pokemon-image' width='300px' src='$image_url' alt='$name' />";

// New container for the text under the image
echo "<div class='text-container'>";

$moves = $response_data->moves;
$moves = array_slice($moves, 0, 8);
echo "<div class='move-list'>";
foreach ($moves as $move) {
  $move_name = $move->move->name;
  // Wrap each word in a span element
  $words = explode(' ', $move_name);
  echo "<div class='move'>";
  foreach ($words as $word) {
    echo "<span class='word'>$word</span>";
  }
  echo "</div>";
}
echo "</div>";

echo "</div>"; // Close the text-container div

echo "</div>"; // Close the pokemon-container div
?>
</body>
</html>