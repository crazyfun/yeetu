<?php
class HistoryAction extends BaseAction{

	protected function beforeAction(){
		$this->controller->check_login(CV::UNLOGIN_USER,CV::RETURN_USER_HISTORY,array());
		$this->controller->init_page();
		$this->controller->user_tag='history';
		$this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
		array('用户中心'=>array("user/index"),'浏览历史记录'));
		 $this->controller->pt($this->id,array());

		return true;
	}
	 
	protected function do_action(){
		//$user=new User();
		//$user_id=$_GET['user_id'];
		$user_id=Yii::app()->user->id;
		$criteria = new CDbCriteria(array(
			'select' => 'trave_id, create_time',
			'condition' => 'create_id = :create_id',
			'order' => 'create_time DESC',
			'params' => array(':create_id' => $user_id),
		));

		$traveHistroy = new TraveHistory();
		$pages = new CPagination($traveHistroy->count($criteria));
		$pages->pageSize = 20;
		$pages->applyLimit($criteria);
		$trave_histroy_datas = $traveHistroy->findAll($criteria);
		$this->display("user_history",array('pages'=> $pages, 'trave_histroy_datas'=> $trave_histroy_datas));
	}



}
?>
