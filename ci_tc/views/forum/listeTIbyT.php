<a href='<?php echo base_url(); ?>index.php/forum/forum/forumSubject/<?php echo $lesTIbyT[0]->t_fori ;?>'>retour</a><br/>

<div id="m">
	<table id="n">
		<tr>
			<th><?php echo $lesTIbyT[0]->t_name ?></th>
			<th><?php echo $lesTIbyT[0]->t_description ?></th>
			
		</tr>
			<?php  foreach ($lesTIbyT as $unTI):	?>		
		<tr>
			<td>
				<?php echo $unTI->User_Name ?> : 
				<?php 
				/*
				$re = str_repeat("Re: ", $unTI->ti_insidenum); 
				if (substr_count($re, 'Re: ') > 5) {
					$re = str_repeat("Re: ", 5);
					$re = $re .'...';
				}
				*/
				$re = 'Re: '.($unTI->ti_insidenum);
				//$unTI->ti_insidenum
				echo $re .' ';
				?>
				
				
				
				(<?php echo $unTI->ti_date ?>) 
				</td>
		</tr>	
		<tr>	
			<td><?php echo $unTI->ti_contents ?></td>
			
		</tr>
		<?php endforeach;?>
	</table>
</div>