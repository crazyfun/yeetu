<?php
class ShitquestionAction extends BaseAction
{
	protected function do_action()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];
		$shit_status=$_REQUEST['shit_status'];
		$question=new Question();
		$question=$question->findByPk($id);
		$question->shit_status=$shit_status;
		if($question->save()){
			$question_id=$question->user_id;
			$question_title=$question->subject;
			$credit=new Credit();
			if(!empty($shit_status)){
			 echo $question_id."===";
			 echo $question_title;
	
			 $credit_desc="设置提问:".$question_title."为乱提问,扣除积分";
       $credit->set_credit_vars($question_id,"shit_ask",'2',$credit_desc);
      }
			$this->controller->redirect(array('index'));
		}
		
	}
}
