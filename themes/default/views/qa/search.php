
<?php $this->renderPartial("_search");?>

<div class="r_two">
<h2 class="title">搜索结果 </h2>
<?php 
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_search_item',
    'ajaxUpdate'=>false,
    'template'=>"<div class='ask_w_box'>{items}</div>\n<div style='margin-bottom:20px;margin-right:10px;'>{pager}</div>",
    'emptyText'=>'<span class="empty_for_grid">没有找到相关回答</span>',
)); 
?>
</div>
