<?php include "includes/header.php";
		
	if(isset($_GET['AN']))
	
	{
			$AN = $_GET['AN'];
			
			$file_details = qf("select * from benificiary_master where ben_id = '$AN'");
			$file_status = $file_details['file_status'];
			$new_file_status = $file_status + 2;
			//echo $new_file_status;exit;
			if( $new_file_status == 4)
			{
			echo "<script>
						alert('For This You Have to Enter A valid Cheque Number. ');
						location.replace('cheque_entry.php?AN=$AN&&ST=$new_file_status')
						</script>";
			}
			else if($new_file_status < 4)
			{
			$sql = q("update benificiary_master set file_status='$new_file_status' where ben_id = '$AN'");
			
			echo "<script>
						alert('Application Status Has Been Updated Successfully');
						location.replace('application_list.php?')
				  </script>";
			}
			else
			{
				echo "<script>
						alert('Application Has Been Already Processed ');
						location.replace('application_list.php?')
				  </script>";
			}
			
	}
	
	/*if(isset($_GET['Def']))
	{
			$id=$_GET['Def'];
			$deactive = q("update funding_account_master set fc_default = '0' ");
			$active = q("update funding_account_master set fc_default = '1' where fc_id = '$id'");
			echo "<script>
						alert(' Default Account Has Been Updated Successfully');
						location.replace('funding_account_list.php?')
				  </script>";
			
			
	}*/
//Season Activation.............................
	if(isset($_GET['SEASON']))
	{
			$id=$_GET['SEASON'];
			$check_sql = "select * from season_master where season_id = '$id'";
			$check = qf($check_sql);
			if($check['season_status'] == '1')
			{
				$up_sql = "update season_master set season_status = '1'";
				$up = q($up_sql);
				$sql = "update season_master set season_status = '0' where season_id = '$id'";
				$active = q($sql);
				echo "<script>
							alert('Season Activated Successfully');
							location.replace('season_list.php?')
					  </script>";
			}
			else
			{
				echo "<script>
							alert('Sorry !! You Can not Deactivate Season');
							location.replace('season_list.php?')
					  </script>";
			}
			
			
			
	}
//Student Approval.............................
	if(isset($_GET['STD']))
	{
			$id=$_GET['STD'];
			$sql = "update student_master set std_status = '0' where std_id = '$id'";
			$approved = q($sql);
			echo "<script>
						alert('Student Application Approved Successfully');
						location.replace('student_pending_list.php?')
				  </script>";
			
			
	}

//Employee Approval OR Rejection.............................
	if(isset($_GET['App']))
	{
			$id=$_GET['App'];
			$sql = "update emp_master set emp_status = '1' where emp_id = '$id'";
			$approved = q($sql);
			echo "<script>
						alert('Employee Application Approved Successfully');
						location.replace('emp_pending_list.php?')
				  </script>";
			
			
	}
	if(isset($_GET['Rej']))
	{
			$id=$_GET['Rej'];
			$sql = "update emp_master set emp_status = '5' where emp_id = '$id'";
			$approved = q($sql);
			echo "<script>
						alert('Employee Application Rejected Successfully');
						location.replace('emp_pending_list.php?')
				  </script>";
			
			
	}
	
/*if(isset($_GET['Dept']))
{
	$D = $_GET['Dept'];
	$gsql= "select * from dept_master where dept_id='$D'";
	$grec= q($gsql);
	$gres = f($grec);
	if($gres['dept_status']=='0')
	{
		$upsql = "update dept_master set dept_status = '1' where dept_id = '$D'";
		$uprec = q($upsql);
	}
	elseif($gres['dept_status']=='1')
	{
		$upsql = "update dept_master set dept_status = '0' where dept_id = '$D'";
		$uprec = q($upsql);
	}
	
	if($uprec>0)
	{ 
		echo "<script>
				location.replace('dept_list.php?')
				</script>";
	}
}*/
?>