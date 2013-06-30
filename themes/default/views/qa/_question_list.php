<?php 
$header = '<table class="ask_table">
          <tr class="ask_tr_b">
            <th width="3"></th>
            <th class="lb"  width="378">问题</th>
            <th class="lb1" width="70">提问时间</th>
            <th class="lb1" width="76">提问者</th>
            <th class="lb1" width="53">分类</th>
            <th class="lb1" width="44">状态</th>
            <th class="lb1" width="44">回答数</th>
          </tr>';
$footer = '</table>';
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_question_item',
    'ajaxUpdate'=>false,
    'template'=>$header."{items}".$footer."\n<div style='margin-bottom:20px;margin-right:10px;'>{pager}</div>",
    'emptyText'=>'',
)); 
?>

