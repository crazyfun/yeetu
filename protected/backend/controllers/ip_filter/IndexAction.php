<?php
class IndexAction extends BaseAction{
	protected function beforeAction(){
		$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
		$this->controller->init_page();
		$this->controller->bc(array("限制IP"));
		return true;
	}
	protected function do_action(){
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.id asc";

		$dataProvider = new CActiveDataProvider("IpFilter", array(
			'criteria'=>array(
				
			),
			'pagination'=>array(
				'pageSize'=>'20',
			),
			'sort'=>$sort,
		));

		$this->display('index',array('dataProvider'=>$dataProvider));
	} 
}
?>
