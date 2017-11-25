<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("localhost", "root", "");
$db = mysql_select_db("chakravyuh", $connection);
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['login_user'];

// SQL Query To Fetch Complete Information Of User
$ses_sql=mysql_query("select name,id,till from user where name='$user_check'", $connection);

$row = mysql_fetch_assoc($ses_sql);

$login_session =$row['name'];
$login_id=$row['id'];
$till=$row['till'];
//echo $login_session."fuclk";
if(!isset($login_session)){
mysql_close($connection); // Closing Connection
header('Location: ../index.php'); // Redirecting To Home Page
}
?>