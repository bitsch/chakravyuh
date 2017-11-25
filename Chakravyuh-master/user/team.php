<?php
include('session.php');
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

$array = array_fill(1, 100, 0);
$sql="SELECT pl.SNO sno from player pl join relation rl on pl.SNO=rl.player_sno_fk where rl.user_sno_fk='$login_id' order by pl.price";
$result=mysqli_query($connection,$sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($connection));
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
{
	$array[$row['sno']]=1;
}
/*foreach ( $array as $var) {
	echo $var;
}*/


if(isset($_POST['submit']))
{

    if(empty($_POST['name'])||empty($_POST['age'])||empty($_POST['price'])||empty($_POST['category'])||count($_FILES) <= 0) {
        $error = "unfilled fields"; 
        }
        else
        {    
            $name=$_POST['name'];
            $age=$_POST['age'];
            $category=$_POST['category'];
            $price=$_POST['price'];
            //$password=$_POST['password'];
                
            $name = stripslashes($name);
            $age = stripslashes($age);
            $category = stripslashes($category);
            $price = stripslashes($price);
            //$password = stripslashes($password);

            $name = mysqli_real_escape_string($connection,$name);
            $age = mysqli_real_escape_string($connection,$age);
            $category = mysqli_real_escape_string($connection,$category);
            $price = mysqli_real_escape_string($connection,$price);  
            //$password = mysqli_real_escape_string($connection,$password);


            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES['image']['name']);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                $error= "File is not an image.";
                $uploadOk = 0;
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                $error= "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["image"]["size"] > 500000000) {
                $error= "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                $error= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $error= "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $sql = "INSERT INTO player(name,category,age ,image,price) VALUES('$name','$category','$age', '{$target_file}','{$price}')";
                    $current_id = mysqli_query($connection,$sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($connection));
                    $display='Player added succesfully';
                } else {
                    $error= "Sorry, there was an error uploading your file.";
                }
            }

        }
    }     

    

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/chakravyuh.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Team | Chakravyuh</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

	<!--     Fonts and icons     -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/material-kit.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="assets/css/custom.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="assets/css/demo.css" rel="stylesheet" />

<script>
                 $(document).ready(function(){
                     var val;
                      $(".button-click").click(function () {
                        val = 1;
                    });
                      var window_size = window.matchMedia('(max-width: 767px)');
                      if (window.matchMedia('(max-width: 767px)').matches)
                        {  
                      $(window).scroll(function () {
                            if ($(this).scrollTop() >= 500 && val === 1) {    
                               
                                $('.button-click').show(); 
                                $('#navbar-collapse').css({"position":"absolute","top":"unset","transition":"all 1s ease"});                         
                        } 
                                else if ($(this).scrollTop() < 500 && val === 1) {
                                    
                                    $('.button-click').hide();
                                    $('#navbar-collapse').css({"position":"fixed","top":"0%","transition":"all 1s ease"});  
                            }
                            if ($(window).scrollTop() == 0 && val === 1) {
                             
                                $('.button-click').show(); 
                                $('#navbar-collapse').css({"position":"absolute","top":"unset","transition":"all .8s ease"});

                            }
                    });
                        }
                        
                 });





function loadDoc(userid,playerid,playerprice) {
		console.log(userid);
		console.log(playerid);
        var xmlhttp = new XMLHttpRequest();
        var buttonid="button"+playerid;
        console.log(buttonid);
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(buttonid).innerHTML = "Added";
                document.getElementById(buttonid).disabled = true;
                document.getElementById("amount").innerHTML=parseInt(document.getElementById("amount").innerHTML)-parseInt(playerprice);
            }
        };
        xmlhttp.open("GET", "addrelation.php?user=" + userid+"&player="+playerid, true);
        //document.getElementById(buttonid).innerHTML = "Added";
        xmlhttp.send();
}

function removeDoc(userid,playerid,playerprice) {
		console.log(userid);
		console.log(playerid);
		console.log(playerprice);
		console.log(document.getElementById("amount").value);
        var xmlhttp = new XMLHttpRequest();
        var rbuttonid="rbutton"+playerid;
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(rbuttonid).innerHTML = "Removed";
                document.getElementById(rbuttonid).disabled = true;
                document.getElementById("amount").innerHTML=parseInt(document.getElementById("amount").innerHTML)+parseInt(playerprice);
            }
        };
        xmlhttp.open("GET", "removerelation.php?user=" + userid+"&player="+playerid, true);
        xmlhttp.send();
}


</script>
</head>

<body class="index-page">
<!-- Navbar -->
<nav class="navbar navbar-transparent navbar-fixed-top navbar-color-on-scroll">
	<div class="container">
        <div class="navbar-header">
	    	<a href="#">
	        	<div class="logo-container">
	                <div class="logo">
	                    <img src="assets/img/chakravyuh.png" alt="Logo">
	                </div>
	                <div class="brand" style="padding: 10px 5px">
	                    Chakravyuh
	                </div>
				</div>
	      	</a>
	      	<div class="navbar-header">
		        <button class="navbar-toggle button-click collapsed" type="button" data-toggle="collapse" data-target="#navigation-index">
		            <span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		        </button><!--//nav-toggle-->
   		 	</div>
	    </div>
		

	    <div class="collapse navbar-collapse" id="navigation-index">

	    	<ul class="nav navbar-nav navbar-right text-center">
	    		<li>
					<a href="profile.php">
						<?php echo "Hi! ".$login_session; ?>
					</a>
				</li>
				<li>
					<a href="profile.php" >
						<?php 
							$amountsql = "select amount from user where SNO='$login_id'";
							$current_amount = mysqli_query($connection,$amountsql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($connection));
							$amount=mysqli_fetch_array($current_amount,MYSQLI_ASSOC);

						echo "<div id='amount'>".$amount['amount']."</div>"; ?>
					</a>
				</li>
	    		<li>
					<a href="logout.php">
						logout
					</a>
				</li>
				<li>
					<a rel="tooltip" title="Follow us on Twitter" data-placement="bottom" href="#" target="_blank" class="btn btn-white btn-simple btn-just-icon">
						<i class="fa fa-twitter"></i>
					</a>
				</li>
				<li>
					<a rel="tooltip" title="Like us on Facebook" data-placement="bottom" href="https://www.facebook.com/Chakravyuh.imtg/" target="_blank" class="btn btn-white btn-simple btn-just-icon">
						<i class="fa fa-facebook-square"></i>
					</a>
				</li>
				<li>
					<a rel="tooltip" title="Follow us on Instagram" data-placement="bottom" href="#" target="_blank" class="btn btn-white btn-simple btn-just-icon">
						<i class="fa fa-instagram"></i>
					</a>
				</li>

	    	</ul>
	    </div>
	</div>
</nav>
<!-- End Navbar -->

<div class="wrapper">
	<div class="header header-filter">
					<div class="section section-basic">
	    	<div class="container">
	    		


	    		<?php
	    			$cat="price ";
	    			$order="ASC";
	    			$sql = "SELECT * from player order by ".$cat.$order;
                    $result = mysqli_query($connection,$sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($connection));
                    while($player=mysqli_fetch_array($result,MYSQLI_ASSOC))
                    {
                    	if($array[$player['SNO']]=='1')
                    	echo "<div  class='player col-md-2 col-sm-3 col-xs-6'>
				    			<div class='card card-nav-tabs'>
									<div class='header header-info'>
										<div class='nav-tabs-wrapper'>
											<ul class='nav nav-tabs' data-tabs='tabs'>
												<li>".$player['NAME']."</li>
												<li class='pull-right' >".$player['price']."</li>
											</ul>
										</div>
									</div>
									<div class='content'>
										<div class='tab-content text-center'>
										<img class='img-responsive' src='../polling/".$player['IMAGE']."'>
										</div>
									</div>
									<div class='pull-right'>
										<button onclick='removeDoc(".$login_id.",".$player['SNO'].",".$player['price'].")' id='rbutton".$player['SNO']."' class='btn btn-primary btn-sm' >Remove Me</button>
									</div>
								</div>
				    		</div>";
			        }

                    
	    		?>
	    		
	        
	        </div>
	    </div>
		
	</div>

	<div class="main main-raised">
		<div class="section section-basic">
	    	<div class="container">
	    		


	    		<?php
	    			$cat="price ";
	    			$order="ASC";
	    			$sql = "SELECT * from player order by ".$cat.$order;
                    $result = mysqli_query($connection,$sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($connection));
                    while($player=mysqli_fetch_array($result,MYSQLI_ASSOC))
                    {
                    	if($array[$player['SNO']]=='0')
                    	echo "<div  class='player col-md-2 col-sm-3 col-xs-6'>
				    			<div class='card card-nav-tabs'>
									<div class='header header-info'>
										<div class='nav-tabs-wrapper'>
											<ul class='nav nav-tabs' data-tabs='tabs'>
												<li>".$player['NAME']."</li>
												<li class='pull-right'>".$player['price']."</li>
											</ul>
										</div>
									</div>
									<div class='content'>
										<div class='tab-content text-center'>
										<img class='img-responsive' src='../polling/".$player['IMAGE']."'>
										</div>
									</div>
									<div class='pull-right'>
										<button onclick='loadDoc(".$login_id.",".$player['SNO'].",".$player['price'].")' id='button".$player['SNO']."' class='btn btn-primary btn-sm'>Add Me</button>
									</div>
								</div>
				    		</div>";
			        }

                    
	    		?>
	    		
	        
	        </div>
	    </div>
	</div>
    <footer class="footer">
	    <div class="container">
	        <nav class="pull-left">
	            <ul>
					<li>
						<a href="#">
						   About Us
						</a>
					</li>
					<li>
						<a href="#">
						   Blog
						</a>
					</li>
					
	            </ul>
	        </nav>
	        <div class="copyright pull-right">
	           
	        </div>
	    </div>
	</footer>
</div>

<!-- Sart Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="material-icons">clear</i>
				</button>
				<h4 class="modal-title">Modal title</h4>
			</div>
			<div class="modal-body">
				<p>Far far away
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-simple">Nice Button</button>
				<button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!--  End Modal -->


</body>
	<!--   Core JS Files   -->
	<script src="assets/js/jquery.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/js/material.min.js"></script>

	<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
	<script src="assets/js/nouislider.min.js" type="text/javascript"></script>

	<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
	<script src="assets/js/bootstrap-datepicker.js" type="text/javascript"></script>

	<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
	<script src="assets/js/material-kit.js" type="text/javascript"></script>

	<script type="text/javascript">

		$().ready(function(){
			// the body of this function is in assets/material-kit.js
			materialKit.initSliders();
            window_width = $(window).width();

            if (window_width >= 992){
                big_image = $('.wrapper > .header');

				$(window).on('scroll', materialKitDemo.checkScrollForParallax);
			}

		});
	</script>
</html>
