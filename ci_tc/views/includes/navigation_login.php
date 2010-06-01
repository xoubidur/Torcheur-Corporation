<?php 
	$lit_welcome="Bienvenue sur ";
	$lit_HTVUN="HT-VUN";
	$lit_important="Important ";
	$lit_must="Vous devez vous <b>identifier</b> pour entrer dans ce site";
	$lit_wait="<u>HT-VUN est en construction, merci de r&eacute;essayer en <b>avril</b></u>";
?>	
<table border=0 align="center">
	<font face='Verdana' size='2'>
	<tr>
		<td width='90' rowspan=2>
			<img src='<?php echo base_url(); ?>includes/images/tc/logo.jpg' border='0'>
		</td>
		<td rowspan=2 valign=center bgcolor=#F0F0F0>
			<b><font face='Verdana' size='2'><center><?php echo $lit_welcome; ?><br><?php echo $lit_HTVUN; ?></center></font></b>
		</td>
		<td rowspan=2 bgcolor=#FFFFFF>
			&nbsp;
		</td>
		<td colspan=3 bgcolor=#F0F0F0>
			<b><font face='Verdana' size='1'>&nbsp;<?php echo $lit_important; ?></font></b>
		</td>
		<td bgcolor=#F0F0F0 align=right>
			<?php //include "../lang/language.bar.php"; ?>
		</td>
	</tr>
	<tr>
		<td>
			&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
		<td>
			<font face='Verdana' size='1'><b><?php echo $lit_must; ?></font>
		</td>
		<td>
			<!-- <img src='<?php echo base_url(); ?>includes/images/tc/chpp_logotype.gif'>  -->
		</td>
	</tr>
</table>
<br><br>
