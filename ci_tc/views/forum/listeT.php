<?php
?>
<div id="m">
	<table id="n">
		<?php  foreach ($lesT as $unT):	?>
		<tr>	
			<td>
				<a href="listeTIbyT/<?php echo $unT->id ?>">
					<?php echo $unT->t_description ?>
				</a>
			</td>
		</tr>
		<?php endforeach;?>
	</table>
</div>