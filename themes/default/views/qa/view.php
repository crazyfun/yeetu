<?php $this->renderPartial("_search");?>
<?php $this->widget('FlashInfo');?>
<div class="r_two">
<h2 class="title"><a href="">问题</a></h2>
<?php $this->renderPartial("_user_head",array('user'=>$question->user));?>
<div class="r_two_box1">
  <dl>
  <dt><?php echo CHtml::encode($question->subject);?><?php echo $question->get_status_image();?></dt>
  <dd class="ainfo"><?php echo date("Y-m-d H:i:s",$question->create_time);?>&nbsp;&nbsp;回答：<?php echo $question->answer_count;?>&nbsp;&nbsp;浏览：<?php echo $question->views;?> </dd>
  <dd class="r_two_box1_dd1"><?php echo nl2br(CHtml::encode($question->content));?></dd>
    <dd><!-- <a class="r_two_bnt"  href="#"><img src="../css/images/ask_wlhd_btn.gif" border="0"  /></a> --><span class="xbt1">
<?php if($question->status == Question::CLOSED){
    echo "(此问题已关闭)";
}else if($question->status == Question::SOLVED){
}else {?>
    <a href="#submit-answer">我来回答</a>(离问题结束还有<?php echo $distance;?>)
<?php }?>
</span></dd>
  </dl>
</div>
<div class="clear_float"></div>
</div>
<?php if(!empty($question->best_id)){?>
 <div class="r_two">
        <h2 class="title"><a href="">最佳回答</a><img class="best_img" src="/css/images/best_btn.gif"/></h2>
        <div class="rdis">
<?php $this->renderPartial('_user_head',array('user'=>$question->best_answer->user)); ?>
<div class="r_two_box1">
  <dl>
      <dd class="r_two_box1_dd1"><?php echo nl2br(CHtml::encode($question->best_answer->content));?></dd>
      <dd><span class="xbt1"><?php echo date("Y-m-d H:i:s",$question->best_answer->create_time);?> </span></dd>
  </dl>
</div>
</div>
</div>

<?php }?>
<div id="answers_list">
<?php $this->renderPartial("_answers",array('answers'=>$answers,'question'=>$question,'is_over'=>$is_over)); ?>
</div>
<?php
//回答form
if(!$is_over){
    $this->renderPartial("_answer_form",array('answerModel'=>$answerModel));
}

//if(
//相关问题
//$this->renderPartial("_related_questions");
//待解决问题
$this->widget("QuestionListPanel",array('type'=>CV::UNSOLVED_QUESTION));
?>
<div id="show_operate_tips" style="display:none;" >
    <div id="show_operate_tips_content" class="show_operate_tips"> </div>	
</div>


