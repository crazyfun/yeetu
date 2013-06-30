
<?php $this->renderPartial("_search");?>
<div class="wj_tab_title3">
<ul>
    <li><?php echo CHtml::link("最新问题",array("qa/category","t"=>CV::CAT_Q_LATEST,'id'=>$category->id),array('class'=>$tabOn[CV::CAT_Q_LATEST]));?></li>
    <li><?php echo CHtml::link("待解决问题",array("qa/category","t"=>CV::CAT_Q_UNSOLVED,'id'=>$category->id),array('class'=>$tabOn[CV::CAT_Q_UNSOLVED]));?></li>
    <li><?php echo CHtml::link("已解决问题",array("qa/category","t"=>CV::CAT_Q_SOLVED,'id'=>$category->id),array('class'=>$tabOn[CV::CAT_Q_SOLVED]));?></li>
    <li><?php echo CHtml::link("热门问题",array("qa/category","t"=>CV::CAT_Q_HOT,'id'=>$category->id),array('class'=>$tabOn[CV::CAT_Q_HOT]));?></li>
    <li class="ask_classify" style="width:170px">
        <?php echo CHtml::form(array('qa/category'),"GET");?>
        问题分类：
        <?php echo CHtml::dropdownList("id",$_GET['id'],CHtml::listData($categories,"id","name"),array('class'=>'ask_classify_select'));?>
        <input type="submit" value="确定" style="display:none;" id="filter_by_cat"/>
        <?php echo CHtml::endForm();?>
    </li>
</ul>
<div class="clear_float"></div>
</div>
<div class="r_two1"> 
<?php $this->renderPartial("_question_list",array('dataProvider'=>$dataProvider)); ?>
</div>
 
