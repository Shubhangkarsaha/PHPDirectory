<?php
session_start();
include "config.php";
include "connection/connection.php";
include "functions/functions.php";
//DELETE
?>
<title>Print Employee List</title>

<section class="content-header">
      <h1>
        Employee List
        <small>&nbsp;</small></h1>
</section>
<br />

  <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0">
    <tbody>
      <tr align="center">
        <td width="6%"><b>Sl. No.</b></td>
		 <td width="12%"><b>Employee Image </b></td>
        <td width="24%" height="40"><strong>Employee Details </strong></td>
        <td width="19%"><strong>Contact  Details </strong></td>
        <td width="25%"><strong>Other Details </strong></td>
      </tr>
      <tr align="center" >
        <td height="25" colspan="14">&nbsp;</td>
      </tr>
      <?php
	
		  $fsql = "select * from emp_master where emp_status = '1' order by emp_name asc";
		  $frec = q($fsql);
		  $i = 1;
		  while($fres = f($frec))
		  {
			
			
	  ?>
        <td height="122" align="center"><?php echo $i;?></td>
		<td height="122" align="center"><img src="emp_image/<?php echo $fres['emp_image'];?>" width="75" height="75" /></td>
        <td align="center"><table width="100%" border="0" cellspacing="1" cellpadding="1">
          <tr align="center">
            <td align="right"><strong>Employee ID </strong></td>
            <td><strong>:</strong></td>
            <td align="left">
			<?php 
				if($fres['emp_id']>0 && $fres['emp_id']<10)
					$emp_id = "000".$fres['emp_id'];
				elseif($fres['emp_id']>=10 && $fres['emp_id']<100)
					$emp_id = "00".$fres['emp_id'];
				elseif($fres['emp_id']>=100 && $fres['emp_id']<1000)
					$emp_id = "0".$fres['emp_id'];
				else
					$emp_id = $fres['emp_id'];
				echo $emp_id;
			?>			</td>
          </tr>
          <tr align="center">
            <td width="45%" align="right"><strong>Employee Name </strong></td>
            <td width="6%"><strong>:</strong></td>
            <td width="49%" align="left"><?php echo $fres['emp_name'];?></td>
          </tr>
          <tr align="center">
            <td align="right"><strong> Father's Name</strong></td>
            <td><strong>:</strong></td>
            <td align="left"><?php echo $fres['emp_fname'];?></td>
          </tr>
          <tr align="center" >
            <td align="right"><strong>DOB</strong></td>
            <td><strong>:</strong></td>
            <td align="left"><?php echo dateu($fres['emp_dob']);?></td>
          </tr>
          <tr align="center">
            <td align="right"><strong>DOJ</strong></td>
            <td><strong>:</strong></td>
            <td align="left"><?php echo dateu($fres['emp_doj']);?></td>
          </tr>
        </table></td>
        <td align="center"><table width="101%" border="0" cellspacing="1" cellpadding="1">
          <tr align="center">
            <td align="right"><strong>Mobile 1 </strong></td>
            <td><strong>:</strong></td>
            <td align="left"><?php echo $fres['emp_mobile_1'];?></td>
          </tr>
          <tr align="center">
            <td align="right"><strong>Mobile 2 </strong></td>
            <td><strong>:</strong></td>
            <td align="left"><?php echo $fres['emp_mobile_2'];?></td>
          </tr>
          <tr align="center">
            <td width="52%" align="right"><strong>Address</strong></td>
            <td width="7%"><strong>:</strong></td>
            <td width="41%" align="left"><?php echo $fres['emp_address'];?></td>
          </tr>
          <tr align="center">
            <td align="right"><strong>Ward No. </strong></td>
            <td><strong>:</strong></td>
            <td align="left"><?php echo $fres['emp_ward'];?></td>
          </tr>
          <tr align="center">
            <td align="right"><strong>PIN</strong></td>
            <td><strong>:</strong></td>
            <td align="left"><?php echo $fres['emp_pin'];?></td>
          </tr>
        </table></td>
        <td align="center"><table width="100%" border="0" cellspacing="1" cellpadding="1">
            <tr align="center">
              <td align="right"><strong>Designation</strong></td>
              <td><strong>:</strong></td>
              <td align="left"><?php echo desig_name($fres['emp_desig']);?></td>
            </tr>
            <tr align="center" >
              <td align="right"><strong>Licence No </strong></td>
              <td><strong>:</strong></td>
              <td align="left"><?php echo $fres['emp_licence'];?></td>
            </tr>
            <tr align="center" >
              <td align="right"><strong>Aadhaar No </strong></td>
              <td><strong>:</strong></td>
              <td align="left"><?php echo $fres['emp_aadhaar'];?></td>
            </tr>
            <tr align="center" >
              <td align="right"><strong>PAN No. </strong></td>
              <td><strong>:</strong></td>
              <td align="left"><?php echo $fres['emp_pan'];?></td>
            </tr>
            <tr align="center" >
              <td width="41%" align="right"><strong>Qualification </strong></td>
              <td width="6%"><strong>:</strong></td>
              <td width="53%" align="left"><?php echo qual_name($fres['emp_qualification']);?></td>
            </tr>
        </table></td>
       
      </tr>
      <tr align="center" >
            <td height="25" colspan="9">&nbsp;</td>
    </tr>
	<?php $i++; }
		if($i>1){
	?>
	<?php }else{?>
	<tr align="center" class="fnt">
            <td height="25" colspan="10"><span class="style3">No Record Found</span></td>
    </tr>
	<tr align="center" >
            <td height="25" colspan="10">&nbsp;</td>
    </tr>
	<?php }?>
   
</table>
<br />

<script>
      window.print();
</script>