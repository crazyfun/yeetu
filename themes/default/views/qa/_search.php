<div class="ask_search">
    <?php echo CHtml::form($this->createUrl("qa/search"),'get',array('style'=>'display:inline;'));?>
    <?php echo CHtml::textField("s",$_GET['s'],array('class'=>'ask_input'));?>
    <?php echo CHtml::imageButton("/css/images/ask_ss_btn.gif",array('class'=>'btn_search'));?>
    <?php echo CHtml::endForm();?>

    <!--
    <input class="ask_input" name="asktitle" />
    <input type="image" src="../images/ask_ss_btn.gif" class="btn_search" />
    !-->
    <?php echo CHtml::imageButton("/css/images/ask_tw_btn.gif",array('class'=>'btn_ask','onclick'=>'window.location.href="'.$this->createUrl("qa/ask").'"'));?>

</div>

