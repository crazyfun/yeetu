<?php
class IndexAction extends BaseAction{
  
  protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
    	$this->controller->bc(array("酒店管理"));
      return true;
    }
  protected function do_action(){	
  	
  	$model=new Hotels();
		$criteria=new CDbCriteria;
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.create_time DESC";
		$active_data_provider=new CActiveDataProvider($model, array(
			'criteria'=>array(
			    'condition'=>'',
			    'params'=>array(),
			    'with'=>array('User'=>array('select'=>'id,user_login,permissions_type','condition'=>'','params'=>array(),'together'=>true)),
			),
			'pagination'=>array(
          'pageSize'=>'20',
      ),
      'sort'=>$sort,
		));
		$this->display('index',array('model'=>$model,'active_data_provider'=>$active_data_provider));
		
		/*
		//$id='category_index';
    //$cache_datas = Yii::app()->cache->get($id);//从缓存中取数据 
    //if($cache_datas===false){
			$model=new Category;
			$model=$model->get_table_datas("",array('parent_id'=>"'0'"));
			$this->display('category',array('model'=>$model));
			//$cache_datas=$this->render('category',array('model'=>$model),true);
			//Yii::app()->cache->set($id,$cache_datas,1);
		//}
		//echo $cache_datas;
		*/
   	
  }  
}
?>
