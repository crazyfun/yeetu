<h1>您好，<?php echo CHtml::link(Yii::app()->user->name,array('user/index'));?><?php echo CHtml::link("[退出]",array("site/logout"));?></h1>
<div class="t_bt">
    <?php echo CHtml::link(CHtml::image("/css/images/t_bt.gif",'我的提问',array('width'=>212,'height'=>41,'border'=>0)),array("qa/self",'t'=>CV::SELF_QUESTION));?>
</div>
<div class="h_bt">
    <?php echo CHtml::link(CHtml::image("/css/images/h_bt.gif",'我的回答',array('width'=>212,'height'=>41)),array("qa/self",'t'=>CV::SELF_ANSWER));?>
</div>

