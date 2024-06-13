<?php
session_start();
include "connection/connection.php";
include "functions/functions.php";
//date_default_timezone_set("Asia/Kolkata");
if(isset($_POST['Submit']))
{
	$user_id = $_POST['user_id'];
	$password = $_POST['password'];
	$sql = "select * from login_master where user_name='$user_id'";
	$rec = q($sql);
	$num = mysqli_num_rows($rec);

	if($num > 0)
	{
		$res = f($rec);
		
		if($res['password'] == $password)
		{
			
			$_SESSION['lid'] 		= $res['login_id'];		//LOGIN ID
			
			echo "<script>	
				alert('Welcome To Classic Pension Management System');
				location.replace('dashboard.php');
				</script>";
		}
		else
		{
			echo "<script>	
				alert('Wrong Password!');
				location.replace('index.php?');
				</script>";
		}
	}
	else
	{
		echo "<script>	
				alert('Wrong User ID!');
				location.replace('index.php?');
				</script>";
	}
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Classic Pension Management System || Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />

<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />

<!-- font-awesome icons CSS-->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons CSS-->

 <!-- side nav css file -->
 <link href='css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css'/>
 <!-- side nav css file -->
 
 <!-- js-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<!--//webfonts-->
 
<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
<!--//Metis Menu -->

</head> 
<body class="cbp-spmenu-push" style="background-color: #e4dede;">
<div class="main-content">
		<!-- //header-ends -->
		<!-- main content start--><br><br>	
		<div style="margin-left:20px;margin-right:20px;">
			<div class="main-page login-page ">
				<h2 class="title1">Member Account Login</h2>
				<div class="widget-shadow">
					<div class="login-body"><form id="form1" name="form1" method="post" action="" onSubmit="return chk_null();">
						<input name="user_id" type="text" id="user_id" class="user" required/>
							<input name="password" type="password" id="password" class="lock" required/>
							
							<div class="forgot-grid">
								<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Remember me</label>
								<div class="forgot">
									<a href="#">forgot password?</a>								</div>
								<div class="clearfix"> </div>
							</div>
							<input type="submit" name="Submit" value="Submit"  />
							
							<div class="registration">
								Don't have an account ?
								<a class="" href="home.php">
									Create an account								</a>							</div>
						</form>
					</div>
				</div>
			</div>
		</div><br><br><br><br><br><br><br>
		<!--footer-->
		<div class="footer" style="background-color: #e4dede;">
		   <p>&copy; Classic Vehicle Management Sysytem . All Rights Reserved | Developed by <a href="http://classicsoftwares.com/" target="_blank">Classic Softwares</a></p>		
		</div>
        <!--//footer-->
	</div>
	
	
</body>
</html>