<?php 
$page_name = "Select Daily Report Date";
include "includes/header.php";

?>
<section class="content-header">
      <h1>Select Daily Report Date
	  		<small>&nbsp;</small>
	  </h1>
</section>
<br>








<form name="form1" method="post" action="daily_report.php">
  <table width="70%" border="0" align="center" cellpadding="1" cellspacing="1" class="main_bod">
    <tr background="images\1by25.jpg">
      <td height="31" colspan="3" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="right">&nbsp;</td>
    </tr>
    <tr class="fnt">
      <td width="47%" align="right">Report Date</td>
      <td width="3%" align="center">:</td>
      <td width="50%" align="left"><input name="dd_date" type="date" required/></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="center"><input type="submit" class="head_font" name="Submit" <?php if(isset($_GET['Edit'])){echo "value='Edit'";}else{?>value="Submit"<?php }?> />
      <input name="pk" type="hidden" id="pk" value="<?php echo $eres['ftm_id'];?>" /></td>
    </tr>
    <tr background="images\1by25.jpg">
      <td colspan="3">&nbsp;</td>
    </tr>
  </table>
</form>










	<?php include "includes/footer.php";?>
 