<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php 
		$this->publish_assert("global","css");
		Yii::app()->clientScript->registerCoreScript('jquery');
		Yii::app()->clientScript->registerScriptFile('/js/basic.js');
		Yii::app()->clientScript->registerScriptFile("/js/autocompleted/jquery.autocomplete-min.js");
    ?>
	<meta name="description" content="<?php echo CHtml::encode($this->description);?>">
	<meta name="keywords" content="<?php echo CHtml::encode($this->keywords);?>">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<div id="page_body">
  <?php $this->renderPartial("../main/header",array(),false);?>

      <div id="page_content" class="content">
         <div class="main">
                 <div class="ask_left">
                    <div class="l_one">
                        <div class="l_box">
                        <?php if(Yii::app()->user->isGuest){?>
                          
                         <?php $this->widget("QaAskLogin");?>

                        <?php }else { $this->widget("QaLoggedInPanel"); } ?>

                        </div>
                    </div>
                    <?php $this->widget("CategoryNav");?>
                    <div class="l_one2">
                        <h2 class="title"><a href="">我可以做什么</a></h2>
                        <div class="l_one2_1">提出问题</div>
                        <div class="l_one2_2">旅途中总有你未知的东西需要你来提出问题，我们就是要给你一个方便的提问平台。</div>
                        <div class="l_one2_1">分享知道的东西</div>
                        <div class="l_one2_2">回答提问者的提问，可以简单或详尽的解答，分享你的旅游经验和心得。</div>
                        <div class="l_one2_1">评价和体验</div>
                        <div class="l_one2_2">评价他人的提问和回答，不仅仅可以维护一个好的问答环境，也有助于提高你自己的学习和辨别能力。</div>
                    </div>

                </div>
                <!--ask_left end-->

               <div class="ask_right">
                <?php echo $content;?>
                </div>
                <!--ask_right end-->
         </div><!--main end-->
    </div>
  
   <?php $this->renderPartial("../main/footer",array(),false);?>
</div><!-- page_body -->
</body>
</html>
