<?php

$dbhost = "localhost";
$dbuser = "Artur";
$dbpass = "Artur123.";
$dbname = "login_sample_db";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

	die("failed to connect!");
}
