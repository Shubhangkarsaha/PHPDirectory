<?php
$page_name = "Reminder List";
include "includes/header.php";

$rm_today 	= date('Y-m-d');
$rm_time 	= date('H:i'); 
$dsql  = "update reminder_master set rm_status = '0' where rm_date <= '$rm_today' and rm_time < '$rm_time' and rm_for = '$_SESSION[lid]'";
$drec = q($dsql);
?>


<section class="content-header">
      <h1>
        Remainder List
        <small>&nbsp;</small>      </h1>
      <ol class="breadcrumb">
  <li><a href="dashboard.php"><strong><i class="fa fa-dashboard"></i> Home</strong></a></li>
        <li class="active"><strong>Remainder Register</strong></li>
		 <li class="active"><strong>Remainder List</strong></li>
</ol>
</section>
<br />
  <table width="98%" border="0" align="center" cellpadding="2" cellspacing="2" class="main_bod">
    <tbody>
      <tr align="center" class="head_font" background="images\1by25.jpg">
        <td width="5%"><b>Sl. No.</b></td>
        <td width="20%" height="40"><strong>Title </strong></td>
        <td width="42%"> Description </td>
        <td width="12%">Date </td>
        <td width="9%">Time</td>
        <td width="12%" height="40"><strong>Options</strong></td>
      </tr>
      <tr align="center" >
        <td height="25" colspan="19">&nbsp;</td>
      </tr>
      <?php
	
		  $fsql = "select * from reminder_master where rm_status = '1' and rm_for = '$_SESSION[lid]' order by rm_date, rm_time, rm_title asc";
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
        <td align="center" valign="middle"><?php echo $fres['rm_title'];?></td>
        <td align="center" valign="middle"><?php echo $fres['rm_description'];?></td>
        <td align="center" valign="middle"><?php echo date('d-m-Y',strtotime($fres['rm_date']));?></td>
        <td><?php echo date('h:i a',strtotime($fres['rm_time']));?></td>
        <td><table width="111%" height="42" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="36%" height="42" align="center"><a href="reminder_register.php?Edit=<?php echo $fres['rm_id'];?>">
                <input type="image" name="imageField" src="allicons/68.gif" title="Edit Record" height="30" width="35"/>
              </a>
            <!-- <td width="32%" align="center"><a href="#" >
                <input type="image" name="imageField22" src="allicons/70.gif" title="Delete Record" />
              </a></td>-->            </tr>
        </table></td>
      </tr>
	  <tr align="center" >
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
      <td height="22" colspan="19">&nbsp;</td>
    </tr>
</table>


<?php include "includes/footer.php";?>