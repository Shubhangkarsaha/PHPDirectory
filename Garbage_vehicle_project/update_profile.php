<?php
$page_name = "Update Profile";
include "includes/header.php";
	
if(isset($_POST['Submit']))
{
		$full_name = $_POST['full_name'];
		
		$user_name = $_POST['user_name'];
		
		
		
		//$image = $_FILES['user_image']['name'];
		
		
		
//update..............................................................
		 if($_POST['Submit']=='Edit')
		 {
			    $image = $_FILES['user_image']['name'];
			    $pk = $_POST['pk'];
			    //echo $pk;exit;
			    $sql = "update login_master set full_name='$full_name' ";
					if($image != "")
					{
							list($n,$e) = explode("." ,$image);
							if(($e == "jpg")||($e == "png"))
							{
								$new_image = $pk.".".$e;
								if(move_uploaded_file($_FILES['user_image']['tmp_name'],"profile_images/".$new_image))
								{
									$sql = $sql.", image='$new_image'";
								}
							}
							else
							{
								echo "<script>
									alert('File extension is not jpg or png!!')
									location.replace('sign_up.php?Edit=$pk')
									</script>";
							}						
					 }
					 
					
			    $sql = $sql." where login_id = '$pk'";
				$rec = q($sql);
				if($rec>0)
				{
					echo "<script>
						alert('User Account Updated Successfully');
						location.replace('dashboard.php?');
					</script>";
				}
				else
				{
					echo "<script>
						alert('Error ! Please contact your Developer as soon as possible');
						location.replace('sign_up.php?Edit=$pk')
						</script>";
				}
		}		
}
	
if(isset($_POST['profile']))
{
	$edit = $_SESSION['lid'];
	$eres = qf("SELECT * FROM login_master WHERE login_id = '$edit'");
}

?>
<link href="style/style.css" rel="stylesheet" type="text/css" />


<section class="content-header"><h1>
       Create Your Profile Details <small>&nbsp;</small>      </h1>
      
      </section>
<br>
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
  <table width="90%" border="0" align="center" cellpadding="1" cellspacing="1" class="main_bod">
    <tr>
      <th height="36" colspan="6" background="images\1by25.jpg" scope="col">&nbsp;</th>
    </tr>
    <tr>
      <td colspan="6">&nbsp;</td>
    </tr>
    <tr>
      <td width="18%" align="right"><strong>Full Name</strong></td>
      <td width="2%" align="center"><strong>:</strong></td>
      <td width="30%" align="left"><input name="full_name" type="text" id="full_name" value="<?php echo $eres['full_name'];?>" size="23"/></td>
      <td width="22%" align="right"><strong>Change Photo </strong></td>
      <td width="2%" align="center"><strong>:</strong></td>
      <td width="26%" align="left"><input name="user_image" type="file" id="user_image" /></td>
    </tr>
    <tr>
      <td height="32" align="right"><strong>User ID </strong></td>
      <td align="center"><strong>:</strong></td>
      <td align="left"><input name="user_name" type="text" id="user_name" value="<?php echo $eres['user_name'];?>" readonly="" size="23" /></td>
      <td align="right"></td>
      <td align="center"></td>
      <td rowspan="2" align="left"><img src="login_images/<?php echo $_SESSION['user_image'];?>" height="50" width="50" />	  </td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="6" align="center"> <input type="hidden" name="pk" value="<?php echo $eres['login_id'];?>" />
        <input type="submit" name="Submit" value="Edit" /></td>
    </tr>
    <tr>
      <td colspan="6"></td>
    </tr>
    <tr>
      <td colspan="6" background="images\1by25.jpg">&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>







<?php include "includes/footer.php";?>