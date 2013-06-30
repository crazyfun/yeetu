<?php
class FinanAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
        $this->controller->bc(array("结算信息"));
      return true;
    }

  protected function do_action(){	
  	
		$model=new AgencyFinan();
		 $validate_sregion=$this->controller->validate_sregion();
	  if($validate_sregion){
	    $validate_sregion=" AND ".$validate_sregion;
	  }
	  $sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.create_time DESC";
  	$sort->params=$page_params;
		$criteria=new CDbCriteria;
		$active_data_provider=new CActiveDataProvider($model, array(
			'criteria'=>array(
			    'select'=>'*',
			    'condition'=>'',
			    'params'=>array(),
			    'with'=>array('Trave'=>array('select'=>'trave.trave_name,trave.trave_category,trave.trave_sregion,trave.trave_region','condition'=>'(1=1)'.$validate_sregion,'params'=>array(),'together'=>true)),
			),
			'pagination'=>array(
          'pageSize'=>'20',
          
      ),
      'sort'=>$sort,
		));
		$this->display('finan',array('model'=>$model,'active_data_provider'=>$active_data_provider));
   	
  }
 
 
    
}
?>
