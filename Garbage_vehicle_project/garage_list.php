<?php
$page_name = "Garage List";
include "includes/header.php";
//DELETE
if(isset($_GET['Del']))
{
	$D = $_GET['Del'];
	$today = date('Y-m-d');
	$check = row_count("SELECT * FROM garage_master WHERE gm_id = '$D' and gm_status > '0'");
	if($check > 0){
		$gsql= "UPDATE garage_master SET gm_status = '0', gm_delete_date = '$today', gm_delete_by = '$_SESSION[lid]' WHERE gm_id='$D'";
		//echo $gsql;exit;
		$grec= q($gsql);
		if($grec)
			echo alert_location_replace('Garage Details removed from the list.','garage_list.php');
		else
			echo error_alert_location_replace('garage_list.php');
	}
	else
		echo alert_location_replace('Garage Details already removed.', 'garage_list.php');
}
?>


<section class="content-header">
      <h1>
        Garage List
        <small>&nbsp;</small>      </h1>
      <ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong>Garage Register</strong></li>
		 <li class="active"><strong>Garage List</strong></li>
</ol>
</section>
<br />
  <table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" class="main_bod">
    <tbody>
      <tr align="center" class="head_font" background="images\1by25.jpg">
        <td width="5%"><b>Sl. No.</b></td>
        <td width="17%" height="40"><strong>Garage Name </strong></td>
        <td width="13%"><strong>Owner</strong></td>
        <td width="21%"><strong>Contact No. </strong></td>
        <td width="32%"><strong>Address</strong></td>
        <td width="12%" height="40"><strong>Options</strong></td>
      </tr>
      <tr align="center" >
        <td height="25" colspan="15">&nbsp;</td>
      </tr>
      <?php
	
		  $fsql = "select * from garage_master where gm_status = '1' order by gm_name asc";
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
        <td height="75"><?php echo $i;?></td>
        <td align="center"><?php echo $fres['gm_name'];?></td>
        <td align="center"><?php echo $fres['gm_owner'];?></td>
        <td align="center"><table width="100%" border="0" cellspacing="1" cellpadding="1">

          <tr>
            <td width="45%" height="23" align="right"><strong>Mobile No. 1 </strong></td>
            <td width="9%" align="center"><strong>:</strong></td>
            <td width="46%" align="left"><?php echo $fres['gm_mobile_1'];?></td>
          </tr>
          <tr>
            <td align="right"><strong>Mobile No. 2 </strong></td>
            <td align="center"><strong>:</strong></td>
            <td align="left"><?php echo $fres['gm_mobile_2'];?></td>
          </tr>
        </table></td>
        <td align="center"><table width="100%" border="0" cellspacing="1" cellpadding="1">

          <tr>
            <td width="37%" align="right"><strong>Ward No. </strong></td>
            <td width="5%" align="center"><strong>:</strong></td>
            <td width="58%" align="left"><?php echo $fres['gm_ward'];?></td>
          </tr>
          <tr>
            <td align="right"><strong>PIN</strong></td>
            <td align="center"><strong>:</strong></td>
            <td align="left"><?php echo $fres['gm_pin'];?></td>
          </tr>
          <tr>
            <td align="right"><strong>Address</strong></td>
            <td align="center"><strong>:</strong></td>
            <td align="left"><?php echo $fres['gm_address'];?></td>
          </tr>
        </table></td>
        <td><table width="96%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="36%" height="43" align="center"><a href="garage_register.php?Edit=<?php echo $fres['gm_id'];?>">
                <input type="image" name="imageField" src="allicons/68.gif" title="Edit Record" height="30" width="35"/>
              </a>
			  
			  <!--<a href="whatsapp://send?text=<?php //echo "http://maps.google.com/?q=".$fres['site_latitude'].",".$fres['site_longitude'];?>" data-action="share/whatsapp/share" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on whatsapp"></a></td>-->
              
              <td width="32%" align="center"><a href="#" onclick="delet('garage_list.php?Del=<?php echo $fres['gm_id'];?>')" >
                <input type="image" name="imageField22" src="allicons/70.gif" title="Delete Record" />
              </a></td>
            </tr>
        </table></td>
      </tr>
      <tr align="center" >
            <td height="25" colspan="10">&nbsp;</td>
    </tr>
	<?php $i++; }
		if($i>1){
	?>
	<!--<tr align="center" class="fnt" >
        <td height="58" colspan="28" valign="top" class="fnt" style="font-size:11px;"><strong><span class="fnt" style="font-size:11px;"><strong><a href="export_bank_list.php?"><img src="images/excel.png" height="40" border="0" /></a></strong></span>&nbsp;&nbsp;&nbsp;&nbsp;<a href="export_work_list.php"><img src="images/print.png" height="38" /></a></strong></td>
    </tr>-->
	<?php }else{?>
	<tr align="center" class="fnt" bgcolor="#CCCCCC">
            <td height="25" colspan="11"><span class="style3">No Record Found</span></td>
    </tr>
	<tr align="center" >
            <td height="25" colspan="11">&nbsp;</td>
    </tr>
	<?php }?>
    </tbody>
    <tr align="center" background="images\1by25.jpg" >
      <td height="22" colspan="15">&nbsp;</td>
    </tr>
</table>


<?php include "includes/footer.php";?>