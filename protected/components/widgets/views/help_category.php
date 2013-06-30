<?php
foreach($rows as $cid => $row):
$i = 0;
?>
<div class="help_main_left_sid">
	<h2>
	<?php echo CHtml::encode($row['name']); ?>
	</h2>
	<ul>
	<?php 
	foreach($row['help'] as $help):
	$i++;
	?>
		<li><?php echo CHtml::link(CHtml::encode($help['title']), 
		$this->controller->createUrl('help/index', array('cid'=> $cid, '#' => 'q'.$i)));?></li>
	<?php endforeach;?>
	</ul>
</div>
<?php
endforeach;

?>