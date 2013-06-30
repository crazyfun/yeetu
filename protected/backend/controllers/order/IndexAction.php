<?php
class IndexAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
    	$this->controller->bc(array("订单管理"));
      return true;
    }

  protected function do_action(){	
		$model=new Traveorder();
		$validate_sregion=$this->controller->validate_sregion();
	  if($validate_sregion){
	    $validate_sregion=" AND ".$validate_sregion;
	  }
		$criteria=new CDbCriteria;
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.create_time DESC";
		$active_data_provider=new CActiveDataProvider($model, array(
			'criteria'=>array(
			    'select'=>'*',
			    'condition'=>'',
			    'params'=>array(),
			    'with'=>array('trave'=>array('select'=>'trave.trave_name,trave.trave_category,trave.trave_sregion,trave.trave_region','condition'=>'(1=1)'.$validate_sregion,'params'=>array(),'together'=>true),'user'=>array('select'=>"user.user_login")),
			),
			'pagination'=>array(
          'pageSize'=>'20',
          
      ),
      'sort'=>$sort,
		));
		$this->display('index',array('model'=>$model,'active_data_provider'=>$active_data_provider));
   	
  }
 
 
    
}
?>
