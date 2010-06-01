<a href='<?php echo base_url(); ?>index.php/forum/forum/forums'>retour</a> - 
Forum <?php echo $lesThreads[0]->f_name; ?>
&nbsp;
Vue groupée par sujet
-
chrono - 
<a href='<?php echo base_url(); ?>index.php/forum/forum/forumQuick/<?php echo $lesThreads[0]->fid; ?> '>quick</a>
 - 
<a href='<?php echo base_url(); ?>index.php/forum/forum/forumSubject/<?php echo $lesThreads[0]->fid; ?> '>sujet</a> 
<br/>
<hr/>

<div id="m">
<?php 
	echo $this->pagination->create_links();
	//echo $this->table->generate($lesThreads);
?>
	<table id="n" width="100%">
		<tr>
		</tr>
		<?php //$i = 0; ?>
		<?php  foreach ($lesThreads as $unT):	?>
		<tr>	
			<td valign="center" height="17" style="border-top: thin solid rgb(204, 204, 204); border-right: thin solid rgb(204, 204, 204);">
				
				<?php 
					echo $unT->userName .' : ';
					if ($unT->ti_insidenum > 0) {
						if ($unT->ti_insidenum >1) {
							$re = 'Re ('.$unT->ti_insidenum.') : ';
						}
						else {
							$re = 'Re : ';
							
						}
						echo $re ;
					} 
					?>
					<a href='<?php echo base_url(); ?>index.php/forum/forum/thread/<?php echo $unT->tid;?>'>
					<?php 
					echo $unT->t_name.'</a><br/>';
					echo '<p align="justify">'.$unT->ti_contents .'</p> ('.$unT->ti_date.')'; 
				?>
			</td>
		</tr>
		<?php //$i++; ?>
		<?php endforeach;?>
	</table>
	
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>	
	<script type="text/javascript" charset="utf-8">
		$('tr:odd').css('background', '#e3e3e3');
	</script>
	<?php 
		echo $this->pagination->create_links();
		//echo $this->table->generate($lesThreads);
	?>
</div>