<?php
class IndexAction extends BaseAction{
	protected function beforeAction(){
		$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
		$this->controller->init_page();
		$this->controller->bc(array("首页热景/主题管理"));
		return true;
	}
	protected function do_action(){	

		$conditions=array();
		$params=array();
		$page_params=array();
		$ad_sregion_id=$_REQUEST['ad_sregion_id'];
		if(!empty($ad_sregion_id)){
			 array_push($conditions," t.ad_sregion_id=:ad_sregion_id");
			 $params[':ad_sregion_id']=$ad_sregion_id;
			 $page_params['ad_sregion_id']=$ad_sregion_id;
		}
		
		$user_permissions_type=Yii::app()->getController()->validate_user_permissions_type();
		if($user_permissions_type){
			$user_permissions_type=" AND ".$user_permissions_type;
		}
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.type asc,t.display asc";
  	$sort->params=$page_params;
  	
		$dataProvider = new CActiveDataProvider("HotView", array(
			'criteria'=>array(
			  'condition'=>implode(" AND ",$conditions),
			  'params'=>$params,
			  'with'=>array("User"=>array('select'=>'id,user_login,permissions_type','condition'=>'(1=1)'.$user_permissions_type,'params'=>array(),'together'=>true)),
			),
			'pagination'=>array(
				'pageSize'=>'20',
				'params'=>$page_params,
			),
			'sort'=>$sort,
		));

		$this->display('index',array('dataProvider'=>$dataProvider,'ad_sregion_id'=>$ad_sregion_id));
	} 
}
?>
