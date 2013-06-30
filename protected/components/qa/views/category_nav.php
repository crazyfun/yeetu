<div class="l_one1">
    <h2 class="title"><a href="">问题分类</a></h2>
    <?php foreach($categories as $c) {?>
    <?php if($c->id != QuestionCategory::OTHER){?>
    <h3><?php echo CHtml::link($c->name,array("qa/category","id"=>$c->id));?></h3>
    <ul class="l-count">
        <li>问题总数：<?php echo $info[$c->id]['questionCount'];?></li>
        <li>回答总数：<?php echo $info[$c->id]['answerCount'];?></li>
        <li>已解决数：<?php echo $info[$c->id]['solvedCount'];?></li>
        <li>待解决数：<?php echo $info[$c->id]['unsolvedCount'];?></li>
    </ul>
    <?php } } ?>
</div>

