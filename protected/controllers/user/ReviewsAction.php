<?php
class ReviewsAction extends  BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login(CV::UNLOGIN_USER,CV::RETURN_USER_REVIEWS,array());
      $this->controller->init_page();
      $this->controller->user_tag='reviews';
      $this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
    	     array('用户中心'=>array("user/index"),'我的点评')
      );
	  $this->controller->pt($this->id,array());
    	return true;
    }
   
  protected function do_action(){
   	$user_id=$_GET['user_id'];
		$user_id=empty($user_id)?(Yii::app()->user->id):($user_id);
		$trave_name=$_REQUEST['trave_name'];
		$criteria=new CDbCriteria();
		
		if(!empty($trave_name)){
			$criteria->condition="t.create_id=:user_id AND Trave.trave_name LIKE '%$trave_name%'";
			$criteria->params=array(':user_id'=>$user_id);
		}else{
		 $criteria->condition="t.create_id=:user_id";
		 $criteria->params=array(':user_id'=>$user_id);
		}
		$criteria->with=array("Trave");
		$criteria->order='t.create_time DESC';
		$trave_comment=new TraveComment();
		$trave_comment_number=$trave_comment->count($criteria);
		$pages=new CPagination($trave_comment_number);
		$pages->pageSize=20;
		$pages->applyLimit($criteria);//给$criteria->limit offset等符值
		$pages->params=array('trave_name'=>$trave_name);
		$trave_comment_datas=$trave_comment->findAll($criteria);
		$this->display("user_reviews",array('pages'=>$pages,'trave_comment_datas'=>$trave_comment_datas,'trave_name'=>$trave_name));
  }
 
 
    
}
?>
