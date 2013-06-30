<?php 
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_self_answer_item',
    'ajaxUpdate'=>false,
    'template'=>"<div class='ask_w_box'>{items}</div>\n<div style='margin-bottom:20px;margin-right:10px;margin-top:10px;'>{pager}</div>",
    'emptyText'=>'<span class="empty_for_grid">没有相关回答</span>',
)); 
?>


