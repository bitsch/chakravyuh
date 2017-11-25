<?php
include('session.php');
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db( $connection,"chakravyuh");
	
session_start();

if(session_destroy()) // Destroying All Sessions
{

header("Location: ..\login.php"); // Redirecting To Home Page
}
?>