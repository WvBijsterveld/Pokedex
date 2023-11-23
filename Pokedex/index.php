<html>
<head>
    <link rel="stylesheet" href="https://www.phptutorial.net/app/css/style.css">
    <link rel="stylesheet" href="css/styles.css">
    <!-- <style>
        .error {
            color: red;
        }

            .Regisform {
                width: auto;
                height: auto;
                margin: auto;
            }
           body{
        background-image : url('pokedexxxxx.png');
        background-size: cover;
        background-repeat: no-repeat;
    }
    </style> -->
</head>
<body>
 

<form class="Regisform" action="welcome.php" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
Naam: <input type="text" name="name"><br>
Gebruikersnaam: <input type="text" name="username"><br>
E-mail: <input type="email" name="email"><br>
Wachtwoord:<input type="password" name="password"><br>
<input type="submit">
</form>



</body>
</html> 