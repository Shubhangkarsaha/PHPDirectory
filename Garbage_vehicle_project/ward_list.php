<?php 
$page_name = "Ward List";
include "includes/header.php";
if(isset($_GET['Del']))
{
	$D = $_GET['Del'];
	$gsql= "update ward_master set status = '0' where ward_id='$D'";
	$grec= q($gsql);
	
	
	if($grec)
	{ 
		echo "<script>
				alert('Ward Details Deleted Successfully');
				location.replace('ward_list.php')
				</script>";
	}
}
?>
<style type="text/css">
<!--
.style1 {
	font-size: 16px;
	font-weight: bold;
}
-->
</style>

<section class="content-header">
      <h1>
         Ward List
       <small>&nbsp;</small>      </h1>
       <ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong>Ward Register</strong></li>
		 <li class="active"><strong>Ward List</strong></li>
</ol>
</section>
<br>

<table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" class="main_bod">
  
  <tbody>
    <tr align="center" class="head_font" background="images\1by25.jpg">
      <td width="5%" height="40">Sl. No. </td>
	   <td width="7%" height="40"> Ward No. </td>
       <td width="17%">Ward Master Name </td>
       <td width="12%"> Master Contact No. </td>
      <td width="15%" height="40"> Ward Councilor </td>
      <td width="13%" height="40">Councilor Contact No.</td>
	  <td width="17%">Email ID </td>
	  <td width="14%" height="40">Options</td>
    </tr>
	<tr align="center" >
            <td height="25" colspan="10">&nbsp;</td>
    </tr>
	<?php
	  $fsql = "select * from ward_master where status = '1'" ;
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
	  <td><?php echo $fres['ward_no'];?></td>
	  <td><?php echo $fres['ward_master_name'];?></td>
	  <td><?php echo $fres['master_no'];?></td>
      <td><?php echo $fres['ward_councilor'];?></td>
      <td><?php echo $fres['councilor_no'];?></td>
	  <td><?php echo $fres['councilor_email'];?></td>
	  <td><table width="95%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center"><a href="ward_register.php?Edit=<?php echo $fres['ward_id'];?>">
            <input type="image" name="imageField" src="allicons/68.gif" title="Edit Record" height="30" width="35"/>
          </a></td>
          <!--<td align="center"><a href="ward_list.php?Del=<?php //echo @$fres['ward_id'];?>">
            <input type="image" name="imageField2" src="allicons/70.gif" title="Delete Record" />
          </a></td>-->
        </tr>
		
      </table></td>
    </tr>
    <tr align="center" >
            <td height="25" colspan="10">&nbsp;</td>
    </tr>
	<?php $i++; }if($i==1){?>
	<tr align="center" >
            <td height="25" colspan="10"><span class="style1">NO RECORD FOUND </span></td>
    </tr>
	<tr align="center" >
            <td height="25" colspan="10">&nbsp;</td>
    </tr>
	<?php }?>
  </tbody>
  <tr align="center" background="images\1by25.jpg" >
            <td height="22" colspan="10">&nbsp;</td>
    </tr>
</table>  
  
  
  
  
<br />  
  <?php include "includes/footer.php";?>


