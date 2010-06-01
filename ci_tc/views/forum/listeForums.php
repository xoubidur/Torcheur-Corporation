<div id="m">
	<table id="n">
		<tr>
			<td valign="top" bgcolor="#ffffff">
				<img src="<?php echo base_url(); ?>includes/images/forum/forum.jpg">
			</td>
			<td valign="bottom">
				<h3><a href='<?php echo base_url(); ?>index.php/forum/forum/forums'>FORUMS</a></h3>
			</td>
		</tr>
		<?php  foreach ($lesForums as $unF):	?>		
			<tr>	
				<td valign="center" height="20" bgcolor="#e0e0e0" colspan="2" style="">
					<a href='<?php echo base_url(); ?>index.php/forum/forum/forumSubject/<?php echo $unF->id ?>' title='<?php echo $unF->f_description ?>'
					 style="color: rgb(153, 0, 0); text-decoration: underline;" >
					<?php echo $unF->f_name ?>
					</a>
					 (<?php //echo $unF->unread ?>)
				</td>
				
			</tr>
		<?php endforeach;?>
	</table>
</div>