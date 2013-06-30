<ul <?php if($index % 2 != 0){echo 'class="ask_color"';}?>>
<li>
<span class="ask_w_box_span">问题：</span>
<span class="ask_w_box_time">
<?php echo CHtml::link(CHtml::encode($data->question->subject),array('qa/view','id'=>$data->question->id));?><?php echo $data->question->get_status_image();?>
</span>
<span class="ask_w_box_time" style="margin-left:46px;color:#ccc">
<?php echo date("Y-m-d H:i:s",$data->question->create_time);?>
&nbsp;<strong>提问者：</strong><?php echo CHtml::link($data->question->user->user_login,array('qa/self','user_id'=>$data->question->user->id)); ?>
&nbsp;<strong>分类：</strong><?php echo CHtml::link($data->question->category->name,array('qa/category','id'=>$data->question->category->id)); ?>

</span></li>
<li>
<span class="ask_w_box_span">回答：</span>
<span class="ask_w_box_content"><?php echo CHtml::encode($data->content);?></span>
<span class="ask_w_box_time asktime"><?php echo date("Y-m-d H:i:s",$data->create_time);?></span>
</li>
</ul>

<?php 
    $pagination= $widget->dataProvider->getPagination();
    $total = $pagination->getPageSize();
    if($index == $total-1){?>
          </ul><div class="clear_float"></div>
<?php }?>
