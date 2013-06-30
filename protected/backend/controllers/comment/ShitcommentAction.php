<?php
class ShitcommentAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
		$model=new TraveComment();
		$id=$_REQUEST['id'];
		$shit_comment=$_REQUEST['shit_comment'];
		if(!empty($id)){
			$attributes['shit_comment']=$shit_comment;
			$result=$model->update_table_datas($id,$attributes,array());
			if($result){
				$credit=new Credit();
				$comment_datas=$model->get_table_datas($id);
				if(!empty($shit_comment)){
				 $trave_name=$comment_datas->Trave->trave_name;
				 $user_id=$comment_datas->create_id;
				 $credit_desc="设置线路:".$trave_name."的评论为乱评论,扣除积分";
       	 $credit->set_credit_vars($user_id,"shit_comment",'2',$credit_desc);
     	  }
				
			}
		}
		$this->controller->redirect($this->controller->createUrl("comment/index",array()));
  } 
}
?>
