<div class="menu_breadcrumbs"><?php $this->widget('zii.widgets.CBreadcrumbs', array(
								'links'=>$this->breadcrumbs,
							)); ?>

	      </div>
<?php
if($this->action->is_home) :
	if($type_list) :
		$size = round(count($type_list) / 2);
		$split_type_list = array_chunk($type_list, $size, true);
		foreach($split_type_list as $rows):
?>
<div class="help_fg<?php echo empty($alt) ? '' : '1';?>">
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
					$this->createUrl('help/index', array('cid'=> $cid, '#' => 'q'.$i)));?></li>
				<?php endforeach;?>
	</ul>
</div>
<?php
			endforeach;
?>
</div>
<?php 
		$alt = true;
		endforeach;
	endif;
?>

<?php else:?>
<p>
<?php echo CHtml::link('返回帮助中心首页', $this->createUrl('help/index')); ?>
</p>
<?php 
$i = 0;
foreach($rows as $row):
$i++;
?>
<p class="qt" id="q<?php echo $i;?>"><strong><?php echo CHtml::encode($row->title)?></strong></p>
<div class="paragraph"><?php echo $row->content ?></div>
<p class="totop"><a href="#page_content">返回顶部</a></p>
<?php 
endforeach;
endif;
?>
