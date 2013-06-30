<?php $this->renderPartial("_search");?>
<div class="r_two">
   <h2 class="title"><a href="">提问</a></h2>
    <?php $this->widget('FlashInfo');?>
 	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'ask-form',
          //'action'=>$this->createUrl("login/sendphone",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
     <table class="r_two_table" >
       <tbody>
         <tr>
           <td width="75"><strong>问题标题：</strong></td>
           <td width="555">
                <?php echo $form->textField($model,"subject",array('class'=>'asking_input','onkeypress'=>"javascript:remaining_word('subject',100,'remaining_words_count')",'id'=>'subject'));?>
                <span class="xbt">您还可输入<span id="remaining_words_count" style='color:green;'>100<span>字</span><br />
            </td>
         </tr>
         <tr>
           <td><strong>问题内容：</strong></td>
           <td>
                <?php echo $form->textArea($model,"content",array('class'=>'asking_input1','onkeydown'=>"javascript:remaining_word('content',3000,'remaining_words_count2')",'id'=>'content'));?>
                <span class="xbt">您还可输入<span id="remaining_words_count2" style='color:green;'>3000</span>字</span><br/>
                
           </td>
         </tr>
         <tr>
           <td><strong>问题分类：</strong></td>
           <td>
            <?php echo $form->radioButtonList($model,"catid",CHtml::listData($categories,"id","name"),array("separator"=>"&nbsp;&nbsp;"));?>
            </td>
         </tr>
        <!--
         <tr>
            <td><strong>验 证 码：</strong></td>
            <td><input type="text" class="asking_input2"/>
                <img class="yz" src="../images/identify2.png" /> 
            </td>
         </tr>
        -->
         <tr>
            <td></td>
            <td>
            <?php echo CHtml::imageButton("/css/images/ask_wytw_btn.gif");?>
<span class="input_error"><?php 
            $error = $form->error($model,'subject');
            if(!empty($error)){
                echo $error;
            }else {
            $error = $form->error($model,'content');
                $error = $form->error($model,'content');
                echo $error;
            }

                 ?></span>
            </td>
         </tr>
      </tbody>
   </table>

     <?php $this->endWidget(); ?>
   <div class="clear_float"></div>
</div>

