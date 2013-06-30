<?php $this->renderPartial("_search");?>
<div class="wj_tab_title2">
   <ul>
   <li><a  <?php if(empty($t) || $t == CV::SELF_QUESTION) echo 'class="wj_tab_d"';?> href="<?php echo $this->createUrl("qa/self",array("t"=>CV::SELF_QUESTION,'user_id'=>$user->id)); ?>">
<?php if($user->id == Yii::app()->user->id){
    echo "我的提问";
}else{
    echo $user->user_login."的提问";
}
?>
</a></li>
   <li><a <?php if($t == CV::SELF_ANSWER) echo 'class="wj_tab_d"';?> href="<?php echo $this->createUrl("qa/self",array("t"=>CV::SELF_ANSWER,'user_id'=>$user->id,)); ?>">
<?php if($user->id == Yii::app()->user->id){
    echo "我的回答";
}else{
    echo $user->user_login."的回答";
}
?>
</a></li>
       <div class="clear_float"></div>
   </ul>
</div>
<div class="r_two1"> 
<?php if($t == CV::SELF_ANSWER){
    $this->renderPartial('_self_answer',array('dataProvider'=>$dataProvider));
}else {
    $this->renderPartial("_question_list",array('dataProvider'=>$dataProvider)); 
}
?>
</div>

