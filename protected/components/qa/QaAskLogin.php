<?php
class QaAskLogin extends CWidget
{
    public function run(){

    	  $model=new User();
    	  $ts = time();
        $this->render("qa_ask_login",array('model'=>$model,'ts'=>$ts));
    }
}

