<?php if(!empty($answers) && count($answers) > 0){?>
<div class="r_two">
<h2 class="title">
<?php if(empty($question->best_id)){
     echo '回答';
}else {
     echo '其他回答';
}
?>
</h2>
<?php foreach($answers as $answer){?>
<div class="r_two_box_dis">
<?php $this->renderPartial('_user_head',array('user'=>$answer->user)); ?>
<div class="r_two_box1">
  <dl>
  <dd class="r_two_box1_dd1"><?php echo nl2br(CHtml::encode($answer->content));?></dd>
  <dd><span class="xbt1"><?php echo date("Y-m-d H:i:s",$answer->create_time);?>
            <?php if(!$is_over){?>
                <?php if($question->user_id==Yii::app()->user->id){?>
                   <?php echo CHtml::form($this->createUrl("qa/bestAnswer",array('id'=>$answer->id)),'post',array('style'=>'display:inline;'));?>
                    <?php echo CHtml::link('最佳回答',"javascript:void(0)",array('class'=>'best_answer'));?>
                    <?php echo CHtml::hiddenField("id",$answer->id);?>
                    <?php echo CHtml::endForm();?>
                <?php } ?>

                <?php echo CHtml::form($this->createUrl("qa/ding",array('id'=>$answer->id)),'post',array('style'=>'display:inline;'));?>
                <?php echo CHtml::link('顶(<span class="ding_count">'.$answer->ding.'</span>)',"javascript:void(0)",array('class'=>'ding'));?>
                <?php echo CHtml::hiddenField("id",$answer->id);?>
                <?php echo CHtml::endForm();?>
            <?php } ?>
  </span></dd>
  </dl>
</div>
<div class="clear_float"></div>
</div>
<?php } ?>
</div>
<?php } ?>
