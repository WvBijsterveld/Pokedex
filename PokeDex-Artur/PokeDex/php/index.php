<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

include("db.php");

$result = display_data();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Website</title>
    <style type="text/css">
        <?php include("../css/index.css"); ?>
        <?php include("../css/main.css"); ?>
        /* ... Your additional CSS styles ... */
    </style>
</head>
<body>
    <div class="content-container">
        <h1 class="pd-text">PokeDex</h1>

        <p class="wlc-msg">Welcome, <?php echo $user_data["user_name"]; ?>!</p>

        <!-- Search bar -->
        <form class="search-form" action="search.php" method="post">
            <input class="search_pokemon" type="text" name="search_input" placeholder="Search Pokemon...">
            <button class="search_button" type="submit">Search</button>
        </form>

        <div class="pokemon-list">
            <?php
            $poke_api_url = 'https://pokeapi.co/api/v2/pokemon?limit=28&offset=0';

            // Read JSON file
            $json_data = file_get_contents($poke_api_url);

            // Decode JSON data into PHP array
            $response_data = json_decode($json_data);

            // Store all pokemon results in a variable
            $poke_objects = $response_data->results;

            // Output HTML structure for each pokemon
            foreach ($poke_objects as $pokemon) {
                // Store each pokemon url and name in variables
                $name = $pokemon->name;
                $url = $pokemon->url;

                // Output HTML structure for each pokemon
                echo '<div class="pokemon">';
                echo "<p class='pokemon-name'>$name</p>";

                // Read JSON file from pokemon url
                $poke_json_data = file_get_contents($url);
                // Decode JSON data into PHP array
                $poke_response_data = json_decode($poke_json_data);
                // Extract the first sprite image url
                $poke_image_url = $poke_response_data->sprites->front_default;
                echo "<img class='pokemon-image' src='$poke_image_url' alt='$name' />";
                echo '</div>'; // Close the div for each pokemon
            }
            ?>
        </div>

        <div class="leader_board-container">
            <div class="leader_board">
                <h2>Leaderboard</h2>
            </div>
            <div>
                <table class="leader_board-data">
                    <tr>
                        <td> Username </td>
                        <td> Pokemons </td>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr class="leader_board-names">
                            <td><?php echo $row['user_name']; ?></td>
                            <td><?php echo $row['pokemons']; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>

        <a class="logout" href="logout.php">Logout</a>
    </div>
</body>
</html>
