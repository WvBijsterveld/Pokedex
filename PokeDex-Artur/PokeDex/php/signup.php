<!DOCTYPE html>
<html lang="en">
<head>
    <title>Signup</title>
</head>
<body>
    

<style type="text/css">
    <?php include("../css/login.css"); ?>
    <?php include("../css/main.css"); ?>
</style>

    <div id="box">
        <form method="post">
            <div style="font-size: 20px;margin: 10px;color: white;text-align: center;">SIGNUP</div>
            <input id="text" type="text" name="user_name"><br><br>
            <input id="text" type="password" name="password"><br><br>

            <input id="button" type="submit" value="Signup"><br><br>

            <a href="login.php">Click To Login</a>
        </form>
    </div>
</body>
</html>

<!-- PHP -->

<?php
session_start();

    include("connection.php");
    include("functions.php");


    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //something was posted
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        if(!empty($user_name) && !empty($password))
        {

            //save to database
            $user_id = random_num(20);
            $query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";

            mysqli_query($con, $query);

            header("Location: login.php");
            die;
        }else
        {
            echo '<div class="wrong">Invalid Information.</div>';
        }
    }
?>
