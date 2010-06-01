<a href='../listeT'>retour</a><br/>
<div id="m">
	<table id="n">
		<tr>
			
		</tr>
			<?php  foreach ($lesTIChrono as $unTI):	?>		
		<tr>	
			<td><?php echo $unTI->ti_date ?></td>
			<td><?php echo $unTI->ti_contents ?></td>
			<td><?php echo $unTI->t_description ?></td>
			
			
		</tr>
		<?php endforeach;?>
	</table>
</div>