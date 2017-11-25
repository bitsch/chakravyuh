<?php
$error10='';
//echo "in";
//error_reporting(0);
include('session.php');
//include('options.php');
/* if(isset($_POST['edit']))
  {
    echo "<div id='overlay'><th><form action='' method='post'>
    <label>new password</label>
          <input type='password'  name='pass' ><label>confirm password</label>
          <input type='password'  name='newpass' >
          <input type='hidden'  name='name' value=\"$_POST[name] \" >
          <input id='confirm' name='yes' type='submit' value='edit'>
          <input id='abort' name='yes' type='submit' value='abort'>
          </form></th>
          </div>";
    
      
  } 
  
if(isset($_POST['yes']))
  {
     
      if($_POST['yes']=='edit')
      {
        if(empty($_POST['pass']) || empty($_POST['newpass']) ||$_POST['pass']=$_POST['newpass']) {
        $error2 = "unfilled fields";  
        }
            
        $newpass=$_POST['newpass'];
        $pass=$_POST['pass'];

      $newpass = stripslashes($newpass);      
      $pass = stripslashes($pass);
      $pass = mysql_real_escape_string($pass);
      $newpass = mysql_real_escape_string($newpass);
      
        mysql_query("UPDATE user set password='$pass' where id='$login_id' ", $connection);
        $display2="User UPDATED SUCCESSFULLY";
      
      } 
    
      }
*/
?>
<!DOCTYPE html>
<html>
<head>
<title>Your Home Page</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="profile">
<b id="welcome">Welcome : <i><?php echo $login_session; echo $login_id; ?></i></b>
<b id="logout"><a href="logout.php">Log Out</a></b>
<b id="change"><a href="change.php">change password</a></b>
</div>
<br \><br \>



</body>
</html>