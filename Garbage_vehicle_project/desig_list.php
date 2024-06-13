<?php 
$page_name = "Designation List";
include "includes/header.php";
//DELETE
/*if(isset($_GET['Del']))
{
	$D = $_GET['Del'];
	$today = date('Y-m-d');
	$count = row_count("SELECT * FROM `desig_master` WHERE desig_status = '1' AND desig_id = '$D'");
	if($count == 0)
		echo alert_location_replace('Designarion already removed from the list.','desig_list.php');
	else{
		$gsql= "UPDATE desig_master SET desig_status = '0' WHERE desig_id='$D'";
		$grec= q($gsql);
		if($grec)
			echo alert_location_replace('Designation removed from the list.',$_SERVER['HTTP_REFERER']);
		else
			echo error_alert_location_replace($_SERVER['HTTP_REFERER']);
	}
}*/
?>
<section class="content-header">
      <h1>
         Designation List
        <small>&nbsp;</small>
      </h1>
      <ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong>Designation Register</strong></li>
		 <li class="active"><strong>Designation List</strong></li>
</ol>
</section>
<br>

<table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" class="main_bod">
  
  <tbody>
    <tr align="center" class="head_font" background="images\1by25.jpg">
      <td width="10%" height="40"><b>Sl. No.</b> </td>
      <td width="37%" height="40"><b>Designation</b></td>
      <td width="12%" height="40">Options</td>
    </tr>
	<tr align="center" >
            <td height="25" colspan="7">&nbsp;</td>
    </tr>
	<?php
	  $fsql = "select * from designation_master where desig_status = '1' order by desig_name asc" ;
	  $frec = q($fsql);
	  $i = 1;
	  while($fres = f($frec))
	  {
		if($i % 2 == 0)
		$col = "bgcolor='#E5E5E5'";
		else
		$col = "bgcolor='#D5D5D5'";
	  ?>
    <tr align="center" <?php echo $col;?>>
      <td height="35"><?php echo $i;?></td>
      <td><?php echo $fres['desig_name'];?></td>
      <td><table width="95%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center">
		  	<a href="desig_register.php?Edit=<?php echo @$fres['desig_id'];?>">
            	<input type="image" name="imageField" src="allicons/68.gif" title="Edit Record" height="30" width="35" />
			</a>
          </td>
          <!--<td align="center"><a href="#">
            <input type="image" name="imageField2" src="allicons/69.gif" title="View Record"/>
          </a></td>-->
          <td align="center">
            <!--<input type="image" name="imageField22" src="allicons/70.gif" title="Delete Record" onclick="delet('desig_list.php?Del=<?php //echo @$fres['desig_id'];?>')"/>-->
          </td>
        </tr>
		
      </table></td>
    </tr>
    <tr align="center" >
            <td height="25" colspan="7">&nbsp;</td>
    </tr>
	<?php $i++; }
		if($i>1){
	?>
	<!--<tr align="center" class="fnt" >
        <td height="58" colspan="28" valign="top" class="fnt" style="font-size:11px;"><strong><span class="fnt" style="font-size:11px;"><strong><a href="export_bank_list.php?"><img src="images/excel.png" height="40" border="0" /></a></strong></span>&nbsp;&nbsp;&nbsp;&nbsp;<a href="export_work_list.php"><img src="images/print.png" height="38" /></a></strong></td>
    </tr>-->
	<?php }else{?>
	<tr align="center" class="fnt" bgcolor="#CCCCCC">
            <td height="25" colspan="8"><span class="style3">No Record Found</span></td>
    </tr>
	<tr align="center" >
            <td height="25" colspan="8">&nbsp;</td>
    </tr>
	<?php }?>
  </tbody>
  <tr align="center" background="images\1by25.jpg" >
            <td height="22" colspan="7">&nbsp;</td>
    </tr>
</table>  
  <br />
  
  
  
  
  <?php include "includes/footer.php";?>


