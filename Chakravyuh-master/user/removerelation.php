<?php
$connection=mysqli_connect("localhost","root","","chakravyuh");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// ...some PHP code for database "my_db"...

// Change database to "test"
mysqli_select_db($connection,"chakravyuh");

// get the q parameter from URL
$userid = $_REQUEST["user"];
$playerid = $_GET["player"];
echo $userid.$playerid;


$check = "select * from relation where player_sno_fk='$playerid' and user_sno_fk='$userid'";
$current_id = mysqli_query($connection,$check) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($connection));
if(mysqli_num_rows($current_id)==1){

$pricesql = "select price from player where SNO='$playerid'";
$current_price = mysqli_query($connection,$pricesql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($connection));
$price=mysqli_fetch_array($current_price,MYSQLI_ASSOC);


$amountsql = "select amount from user where SNO='$userid'";
$current_amount = mysqli_query($connection,$amountsql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($connection));
$amount=mysqli_fetch_array($current_amount,MYSQLI_ASSOC);

$remainingamount=$amount['amount']+$price['price'];
echo $remainingamount."=".$amount['amount']."+".$price['price'];


$sql = "DELETE from relation where player_sno_fk='$playerid' and user_sno_fk='$userid'";
$current_id = mysqli_query($connection,$sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($connection));
echo "1";


$updatesql = "UPDATE user SET amount='$remainingamount' where SNO='$userid'";
mysqli_query($connection,$updatesql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($connection));
echo "    1";
}
// Ou
?>