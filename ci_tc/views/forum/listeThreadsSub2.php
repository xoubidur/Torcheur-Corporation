<?php 

//print_r($lesThreads);
?>


<a href='<?php echo base_url(); ?>index.php/forum/forum/forums'>retour</a> - 
Forum <?php //echo $this->table->row[0]; ?>
Forum <?php //echo $lesThreads[0]->f_name; ?>
Forum <?php //echo $lesThreads->f_name; ?>

&nbsp;
Vue groupée par sujet
-
chrono - 
<a href='<?php echo base_url(); ?>index.php/forum/forum/forumQuick/<?php //echo $lesThreads[0]->fid; ?> '>quick</a>
 - 
<a href='<?php echo base_url(); ?>index.php/forum/forum/forumSubject/<?php //echo $lesThreads[0]->fid; ?> '>sujet</a> 
<br/>
<hr/>

<div id="m">
<?php 
	echo $this->pagination->create_links();
	echo $this->table->generate($lesThreads);
	/* 
	foreach ($lesThreads as $row){
		$row->f_name;
		$row->t_name;
	}
	endforeach;
	*/
	
?>
<?php echo $this->pagination->create_links(); // $links;?>
</div>