<?php
$page_name = "Sub Incident List";
include "includes/header.php";
?>


<section class="content-header">
      <h1>
        Sub Incident List
        <small>&nbsp;</small>      </h1>
       <ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong>Incident Register</strong></li>
		 <li class="active"><strong>Sub Incident</strong></li>
		 <li class="active"><strong>Sub Incident List</strong></li>
</ol>
</section>
<br />

  <table width="98%" border="0" align="center" cellpadding="2" cellspacing="2">
    <tbody>
      <tr align="center" class="head_font" background="images\1by25.jpg">
        <td width="10%"><b>Sl. No.</b></td>
        <td width="34%" height="40"><strong>Incident</strong></td>
        <td width="44%"><strong>Description </strong></td>
        <td width="12%" height="40"><strong>Options</strong></td>
      </tr>
      <tr align="center" >
        <td height="25" colspan="16">&nbsp;</td>
      </tr>
      <?php
	
		  $fsql = "select * from incident_master where im_parent > '0' and im_status = '1' order by im_type asc";
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
        <td height="46"><?php echo $i;?></td>
        <td align="center" valign="middle"><?php echo incident($fres['im_parent']);?></td>
        <td align="center" valign="middle"><?php echo $fres['im_type'];?></td>
        <td><table width="107%" height="43" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="36%" height="32" align="center"><a href="sub_incident_register.php?Edit=<?php echo $fres['im_id'];?>">
                <input type="image" name="imageField" src="allicons/68.gif" title="Edit Record" height="30" width="35"/>
              </a>
			  
			  <!--<a href="whatsapp://send?text=<?php //echo "http://maps.google.com/?q=".$fres['site_latitude'].",".$fres['site_longitude'];?>" data-action="share/whatsapp/share" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on whatsapp"></a></td>-->
              
              <!--<td width="32%" align="center"><a href="#" onclick="delet('sub_incident_master.php?Del=<?php echo $fres['im_id'];?>')" >
                <input type="image" name="imageField22" src="allicons/70.gif" title="Delete Record" />
              </a></td>-->
            </tr>
        </table></td>
      </tr>
            <td height="25" colspan="9">&nbsp;</td>
      </tr>
	<?php $i++; }
		if($i>1){
	?>
	<!--<tr align="center" class="fnt" >
        <td height="58" colspan="28" valign="top" class="fnt" style="font-size:11px;"><strong><span class="fnt" style="font-size:11px;"><strong><a href="export_bank_list.php?"><img src="images/excel.png" height="40" border="0" /></a></strong></span>&nbsp;&nbsp;&nbsp;&nbsp;<a href="export_work_list.php"><img src="images/print.png" height="38" /></a></strong></td>
    </tr>-->
	<?php }else{?>
		<tr align="center" class="fnt" bgcolor="#CCCCCC">
				<td height="25" colspan="10"><span class="style3">No Record Found</span></td>
		</tr>
		<tr align="center" >
				<td height="25" colspan="10">&nbsp;</td>
		</tr>
	<?php }?>
    </tbody>
    <tr align="center" background="images\1by25.jpg" >
      <td height="22" colspan="16">&nbsp;</td>
    </tr>
</table>


<?php include "includes/footer.php";?>