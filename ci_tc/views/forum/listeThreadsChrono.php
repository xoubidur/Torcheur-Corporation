<a href='<?php echo base_url(); ?>index.php/forum/forum/forums'>retour</a> - 
Forum <?php //echo $lesThreads[0]->f_name; ?>
&nbsp;
Vue groupée par sujet
-
chrono - quick - sujet 
<br/>
<hr/>

<div id="m">
	<table id="n" width="100%">
		<tr>
			<td bgcolor="#e0e0e0" style="border-left: thin solid rgb(204, 204, 204); border-top: thin solid rgb(204, 204, 204);">
			</td>
			<td bgcolor="#e0e0e0" style="border-left: thin solid rgb(204, 204, 204); border-top: thin solid rgb(204, 204, 204);">
				<b>
				<font color="#000000">
				Sujet
				</font>
				</b>
			</td>
			<td bgcolor="#e0e0e0" style="border-top: thin solid rgb(204, 204, 204); border-top: thin solid rgb(204, 204, 204);">
				<b>
				<center>
				<font color="#000000">
				Nb Msgs
				</font>
				</center>
				</b>
			</td>
			<td bgcolor="#e0e0e0" style="border-top: thin solid rgb(204, 204, 204); border-top: thin solid rgb(204, 204, 204);">
				<b>
				<center>
				<font color="#000000">
				Non lus
				</font>
				</center>
				</b>
			</td>
			<td bgcolor="#e0e0e0" style="border-top: thin solid rgb(204, 204, 204); border-top: thin solid rgb(204, 204, 204);">
				<b>
				<center>
				<font color="#000000">
				Participants
				</font>
				</center>
				</b>
			</td>
			<td bgcolor="#e0e0e0" style="border-top: thin solid rgb(204, 204, 204); border-top: thin solid rgb(204, 204, 204);">
				<b>
				<center>
				<font color="#000000">
				1er message
				</font>
				</center>
				</b>
			</td>
			<td bgcolor="#e0e0e0" style="border-right: thin solid rgb(204, 204, 204); border-top: thin solid rgb(204, 204, 204);">
				<b>
				<font color="#000000">
				Dernier Message
				</font>
				</b>
			</td>
		</tr>
		<?php  foreach ($lesThreads as $unT):	?>
		<tr>	
			<td valign="center" bgcolor="#ffffdd" align="center" style="color: rgb(0, 0, 0); border-top: thin dashed rgb(200, 200, 153);">
				<img src="<?php echo base_url(); ?>includes/images/forum/folder.gif">
			</td>
			<td style="border-top: thin dashed rgb(200, 200, 153);" >
				<a href='<?php echo base_url(); ?>index.php/forum/forum/thread/<?php echo $unT->id ?>' title='<?php echo $unT->t_description ?>'>
					<?php echo $unT->t_name ?>
				</a>
				<br/>
				<?php echo $unT->t_description ?>
			</td>
			<td valign="center" bgcolor="#ffffdd" align="center" style="color: rgb(0, 0, 0); border-top: thin dashed rgb(200, 200, 153);">
				
				<?php echo $unT->nbLu; ?>
			</td>
			<td valign="center" bgcolor="#ffffdd" align="center" style="color: rgb(0, 0, 0); border-top: thin dashed rgb(200, 200, 153);">
				TODO
				<?php //echo $unT->nbNonLu; ?>
			</td>
			<td valign="center" bgcolor="#ffffdd" align="center" style="color: rgb(0, 0, 0); border-top: thin dashed rgb(200, 200, 153);">
				<?php echo $unT->nbParticipants; ?>
			</td>
			<td valign="center" bgcolor="#ffffdd" align="center" style="color: rgb(0, 0, 0); border-top: thin dashed rgb(200, 200, 153);">
				<?php 
					echo $unT->t_created . '<br/>';
					echo 'Par : ' .$unT->userNameFirst;
				?>
			</td>
			<td valign="center" bgcolor="#ffffdd" align="left" style="color: rgb(0, 0, 0); border-top: thin dashed rgb(200, 200, 153);">
				<?php 
					echo $unT->t_lastmod . '<br/>';
					echo 'Par : ' .$unT->userNameLast;
				?>
			</td>
		</tr>
		<?php endforeach;?>
	</table>
</div>