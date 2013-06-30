<?php $this->renderPartial("_search");?>
<?php $this->widget("QuestionListPanel",array('type'=>CV::UNSOLVED_QUESTION));?>
<?php $this->widget("QuestionListPanel",array('type'=>CV::SOLVED_QUESTION));?>
<?php $this->widget("QuestionListPanel",array('type'=>CV::LATEST_ZHOUBIAN));?>
<?php $this->widget("QuestionListPanel",array('type'=>CV::LATEST_GUONEI));?>
<?php $this->widget("QuestionListPanel",array('type'=>CV::LATEST_CHUJING));?>
<?php $this->widget("QuestionListPanel",array('type'=>CV::LATEST_ZIYOU));?>

