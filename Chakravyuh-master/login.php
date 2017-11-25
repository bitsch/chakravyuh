<?php
//include('session.php');
session_start(); 
$display="";
$error="";
$connection=mysqli_connect("localhost","root","","chakravyuh");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// ...some PHP code for database "my_db"...

// Change database to "test"
mysqli_select_db($connection,"chakravyuh");

// ...some PHP code for database "test"...


if(isset($_POST['submit']))
{
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $error = "Email or Password is empty";
        }   
    else
    {
        // Define $email and $password

        $email=$_POST['email'];
        $password=$_POST['password'];
        // To protect MySQL injection for Security 
        $email = stripslashes($email);
        $password = stripslashes($password);
        $email = mysqli_real_escape_string($connection,$email);
        $password = mysqli_real_escape_string($connection,$password);
        // Selecting Database
        //$db =mysql_select_db("a8202403_company", $connection);
        // SQL query to fetch information of registerd users and finds user match.
        $query = mysqli_query($connection,"select password from user where email='$email'");
         
        
        $rows = mysqli_num_rows($query);
        if ($rows == 1) {
            $row=mysqli_fetch_array($query,MYSQLI_ASSOC);
            $rpassword=$row["password"];
            if($rpassword==$password)
            {
                $_SESSION['login_email']=$email; // Initializing Session
                header("location: user\profile.php"); // Redirecting To Other Page   
            }
            else {
                $error = "Incorrect password, try <a href=' id='forgotPswrd' target='_blank' data-toggle='modal' data-target='#forgotPswrdModal' style='color: #0264AD;'>Forgot your password?</a>";
            }
        }
        else {
        $error = "Email is not registered! <a href='signup.php'>Register Now</a>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
        <link rel="stylesheet" type="text/css"  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css" />
        <link rel="stylesheet" type="text/css" href="css/custom.css">
        <!-- jQuery 2.0.2 -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    </head>
    <style>

    </style>
    <body>

        <div class="page-signin">
            <div class="">
                <div class="loginModal container col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12">
                    <div class="form-container">
                        
                        <form  id="login" class="form-horizontal" action="#" method="post" name="submit">
                            <fieldset>
                                <div class="form-group">
                                     <div class="input-group col-xs-10 col-xs-offset-1 ">
                                         <span class="input-group-addon" style="background-color: #fff;"> <i class="fa fa-user fa-sm" aria-hidden="true" style=" "></i></span>
                                            <input type="text" class="form-control required" name="email" placeholder="Email" autocomplete="off" >
                                          </div>

                                </div>
                                <div class="form-group">
                                    <div class="input-group col-xs-10 col-xs-offset-1">
                                            <span class="input-group-addon"  style="background-color: #fff;"><i class="fa fa-key fa-sm" aria-hidden="true" style=""></i></span>
                                            <input  type="password" class="form-control required" name="password" placeholder="Password" autocomplete="off" id="password">
                                          </div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="submit" value="1" />
                                </div>
                                <div class="col-xs-8 col-xs-offset-2" style="text-align: center;">
                                     <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-home" style="margin-right: 5px;" aria-hidden="true"></i>Log in</button>
                                </div>
                                
                            </fieldset>
                        </form>
                        <section style="margin-top: 30px;">
                                <div style="margin-left: 30px;">
                                    <span><?php echo $display.$error;?></span>
                                </div>
                        </section>

                        <section style="margin-top: 30px;">
                            <p class="text-center">
                                <a href="" id="forgotPswrd" target="_blank" data-toggle="modal" data-target="#forgotPswrdModal" style="color: #0264AD;">Forgot your password?</a>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="signup.php" style="color: #0264AD;">Create an account.</a>
                           </p>
                            
                        </section>

                    </div>
                </div>
            </div>

        <div id="particles-js"></div>
        </div>

 <!--particle.js custom  start-->
<script>
$(document).ready(function() {

particlesJS("particles-js", {"particles":{"number":{"value":80,"density":{"enable":true,"value_area":800}},"color":{"value":"#ffffff"},"shape":{"type":"circle","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":0.5,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":3,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":true,"distance":150,"color":"#ffffff","opacity":0.4,"width":1},"move":{"enable":true,"speed":6,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":true,"mode":"bubble"},"onclick":{"enable":true,"mode":"repulse"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":250,"size":16,"duration":2,"opacity":0.2,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true});
});
</script>
<!--particle.js custom  end-->

<!-- forgot password dialog -->
<div class="modal fade " id="forgotPswrdModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="text-align:center;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header" style="border-bottom: none;">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="text-align: center;">&times;</button>

        </div>
        <div class="modal-body" style="text-align: center;">
            <h4 class="modal-title"> Forgot Password </h4>
            <form class="form-horizontal" id='addEmail' style="margin:15px 0px 15px 0px;">
                <div class="form-group">

                    <div class="input-group col-xs-10 col-xs-offset-1 ">

                        <span class="input-group-addon" style="    background-color: #fff;"> <i class="fa fa-envelope fa-sm" aria-hidden="true" style=" "></i></span>
                           <input class="form-control required" name="email" type="text" value = "" placeholder="Email" >
                     </div>
                </div>
                <div class="form-group" style="text-align: center; padding-bottom: 40px;">
                     <button class = "emailSubmit btn btn-primary" type="submit"  value="update">submit</button>
                </div>
    	    </form>
        </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <!-- mainJQ-->
        <script src="script/main.js" type="text/javascript" charset="utf-8"></script>

    </body>
</html>
