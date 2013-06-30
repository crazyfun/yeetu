<?php
class IndexAction extends BaseAction
{
	protected function beforeAction()
	{
		$this->controller->check_login(CV::UNLOGIN_USER,CV::RETURN_USER_INDEX,array());
		$this->controller->init_page();
		$this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
		array('用户中心'=>array("user/index"),'用户中心'));
		$this->controller->pt($this->id,array());
		return true;
	}
	
	protected function do_action()
	{

		$user = User::model()->findByPk(Yii::app()->user->id);
		$trave_histroy_datas = $user->get_recently_history(5);
		$trave_order_datas = $user->get_recently_order(5);
	//	$trave_recommend_datas = Trave::model()->rand(5, 'recommend')->findAll(array('select'=>'id, trave_name'));
	//	$trave_bargain_datas = Trave::model()->rand(5, 'bargain')->findAll(array('select'=>'id, trave_name'));
		$trave=new Trave();
		$sql_recommend="SELECT t.id,t.trave_name,t.trave_title FROM {{trave}} AS t  WHERE id >= (SELECT floor(RAND() * (SELECT MAX(id) FROM {{trave}} ))) AND t.trave_recommend=:trave_recommend AND t.trave_status=:trave_status AND t.recycle=0 ORDER BY t.id LIMIT 5";
		
		$sql_bargain="SELECT t.id,t.trave_name,t.trave_title FROM {{trave}} AS t  WHERE id >= (SELECT floor(RAND() * (SELECT MAX(id) FROM {{trave}} ))) AND t.trave_bargain=:trave_bargain AND t.trave_status=:trave_status AND t.recycle=0 ORDER BY t.id LIMIT 5";

		$trave_recommend_datas = $trave->findAllBySql($sql_recommend,array(':trave_recommend'=>'2',':trave_status'=>'2'));
		
		$trave_bargain_datas = $trave->findAllBySql($sql_bargain,array(':trave_bargain'=>'2',':trave_status'=>'2'));
		$values = compact('user', 'trave_histroy_datas', 'trave_order_datas', 'trave_recommend_datas', 'trave_bargain_datas');

	//	print_r($trave_recommend);
		$this->display('user_index', $values);
	}
}