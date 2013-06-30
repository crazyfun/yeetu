<?php
class PayAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
    	$this->controller->bc(array("付款信息管理"));
      return true;
    }

  protected function do_action(){	
  	
		$model=new Orderpay();
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
			    'with'=>array('Order'=>array('select'=>'id','condition'=>'','params'=>array(),'with'=>array('trave'=>array('select'=>'trave_sregion','condition'=>'(1=1)'.$validate_sregion,'params'=>array(),'together'=>true)),'together'=>true)),
			    'params'=>array(),
			),
			'pagination'=>array(
          'pageSize'=>'20',
          
      ),
      'sort'=>$sort,
		));
		$this->display('order_pay',array('model'=>$model,'active_data_provider'=>$active_data_provider));
   	
  }
 
 
    
}
?>
