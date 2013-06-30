<?php
class SearchAction extends BaseAction{
  
    protected function beforeAction(){
     $this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
     $this->controller->bc(array("问答"));
      return true;
    }

  protected function do_action(){	
	   $model=new Question();
//	   $user_id=$_REQUEST['user_id'];
//	   $user=User::model()->findByPk($user_id);
//	   $username=$user->user_login;
		switch($_REQUEST['status']){
			case Question::UNSOLVED :
				$status="未解决";
				break;
			case Question::SOLVED :
				$status="已解决";
				break;
			case Question::CLOSED :
				$status="已关闭";
				break;
			break;
		}
		//搜索
		$subject=$_REQUEST['subject'];
//		$user_name=$username;
		$user_name =$_REQUEST['user_name'];

		$category_id=$_REQUEST['category_id'];
		$category_name=QuestionCategory::model()->find('id=:id',array(':id'=>$category_id))->name;
				
		$com_condition['标题:w%']=$subject;		
		$com_condition['用户:w%']=$user_name;
		$com_condition['问题状态:w%']=$status;
		$com_condition['问题类型:w%']=$category_name;
		$com_condition_search=Util::com_search_condition($com_condition);
		$this->display('index',array('model'=>$model,'com_condition_search'=>$com_condition_search,'subject'=>$subject,'user_name'=>$user_name));
  }
   
}
?>
