<div id="m">
	<table id="n">
		<tr>
			<th>ID</th>
			<th>Qui</th>
			<th>Quoi</th>
		</tr>
		<?php  foreach ($lesTI as $unTI):	?>
		<tr>	
			<td>
				<?php echo $unTI->id ?>
				
			</td>
			<td><?php echo $unTI->ti_author ?></td>
			<td><?php echo $unTI->ti_contents ?></td>
		</tr>
		<?php endforeach;?>
	</table>
</div>