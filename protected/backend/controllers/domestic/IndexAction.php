<?php
class IndexAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->bc(array("国内游"));
    	$this->controller->init_page();
      return true;
    }

  protected function do_action(){	
  	
		$model=new Trave;
		$model->trave_status="";
		$validate_sregion=$this->controller->validate_sregion();
		if($validate_sregion){
			$validate_sregion=" AND ".$validate_sregion;
		}
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.create_time DESC";
		$criteria=new CDbCriteria;
		$active_data_provider=new CActiveDataProvider($model, array(
			'criteria'=>array(
			    'condition'=>'trave_category=:trave_category AND recycle=0'.$validate_sregion,
			    'params'=>array(":trave_category"=>$this->controller->trave_category),
			    'with'=>array(),
			    
			),
			'pagination'=>array(
          'pageSize'=>'20',
          
      ),
      'sort'=>$sort,
		));
		$this->display('domestic',array('model'=>$model,'active_data_provider'=>$active_data_provider));
   	
  }
 
 
    
}
?>
