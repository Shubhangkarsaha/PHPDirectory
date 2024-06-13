<?php 
session_start();
include "config.php";
include "connection/connection.php";
include "functions/functions.php";

if(isset($_GET['get_vehicle_model'])){
	$id = $_GET['MANUFACTURER'];
	$sql = "select * from vehicle_model_master where vmodel_status = '1' and vmodel_manufacturer = '$id'";
	$rec = q($sql);
?>
		<option value="">-- Select Model --</option>
<?php
	while($res = f($rec)){
?>
		<option value="<?php echo $res['vmodel_id'];?>"><?php echo $res['vmodel_name'];?></option>
<?php
	}
}
//Incident Description
if(isset($_GET['get_description'])){
	$id = $_GET['DESCRIPTION'];
	$sql = "select * from incident_master where im_status = '1' and im_parent = '$id'";
	//echo $sql;exit;
	$rec = q($sql);
?>
		<option value="">-- Description --</option>
<?php
	while($res = f($rec)){
?>
		<option value="<?php echo $res['im_id'];?>"><?php echo $res['im_type'];?></option>
<?php
	}
}
?>
<?php
//ALLOTMENT
if(isset($_GET['GET_WARD'])){
	$id = $_GET['ID'];
	$dsql = "select * from ward_master where status = '1' and ward_borough = '$id'";
	//echo $sql;exit;
	$drec = q($dsql);
?>
		<option value="">-- Select Ward --</option>
<?php
	while($dres = f($drec)){
?>
		<option value="<?php echo $dres['ward_id'];?>"><?php echo $dres['ward_no'];?></option>
<?php
	}
}	
?>

