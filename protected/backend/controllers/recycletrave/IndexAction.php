<?php
class IndexAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
    	$this->controller->bc(array("回收站"));
      return true;
    }

  protected function do_action(){	
		$model=new Trave;
		$model->trave_status="";
		
		$validate_sregion=$this->controller->validate_sregion();
		if($validate_sregion){
			$validate_sregion=" AND ".$validate_sregion;
		}
		$criteria=new CDbCriteria;
		
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.id DESC";
  	
		$active_data_provider=new CActiveDataProvider($model, array(
			'criteria'=>array(
			    'condition'=>'recycle=1'.$validate_sregion,
			    'params'=>array(),
			    'with'=>array(),
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
