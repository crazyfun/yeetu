<div class="r_two">
<h2 class="title"><a name="submit-answer">我来回答</a></h2>
<div class=r_two-p>回答内容:</div>
<div>
<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'answer_form',
	        'enableAjaxValidation'=>false,
)); ?>
  <?php echo $form->textArea($answerModel,"content",array('class'=>'two1_input','rows'=>10,'onkeydown'=>"javascript:remaining_word('answer_content',1000,'remaining_words_count')",'id'=>'answer_content'));?>
<div class=ansi>您还可输入<span id="remaining_words_count" style='color:green'>1000</span>个字</div>
  <?php echo CHtml::imageButton("/css/images/ask_tjhd_btn.gif",array('class'=>'r_two_bnt1','id'=>'answer'));?><span class="ansispan" id="msg"></span>
<?php $this->endWidget(); ?>
 </div>
<div class="clear_float"></div>
</div>

