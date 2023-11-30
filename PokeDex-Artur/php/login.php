<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
</head>
<body>

<style type="text/css">
    <?php include("../css/main.css"); ?>
    <?php include("../css/login.css"); ?>
</style>

    <div id="box">
        <form method="post">
            <div style="font-size: 20px;margin: 10px;color: white;text-align: center;">LOGIN</div>
            <input id="text" type="text" name="user_name"><br><br>
            <input id="text" type="password" name="password"><br><br>

            <input id="button" type="submit" value="Login"><br><br>

            <a href="signup.php">Click To Signup</a>
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

        //read from database
        $query = "select * from users where user_name = '$user_name' limit 1";

        $result = mysqli_query($con, $query);

        if($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);
                if($user_data['password'] === $password)
                {

                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: index.php");
                    die;
                }
            }
            echo '<div class="wrong user-pass">Wrong username or password!</div>';

        }
    }else
    {
        echo '<div class="wrong">Invalid Information.</div>';
    }
}
?>
