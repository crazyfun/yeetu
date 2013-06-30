<?php
class IndexAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
    	$this->controller->bc(array("线路区域"));
      return true;
    }

  protected function do_action(){	
	 //$id='district_index';
   // $cache_datas = Yii::app()->cache->get($id);//从缓存中取数据 
   // if($cache_datas===false){
			$model=new District;
			$model=$model->findAll(array('condition'=>'district_category=:district_category','params'=>array(':district_category'=>'1'),'order'=>'district_en_name ASC'));
			foreach($model as $key => $value){
				$edit_flag=$value->is_permissions_edit();
				$value->edit_flag=$edit_flag;
				$model[$key]=$value;
			}
			$this->display('district',array('model'=>$model));
			//$cache_datas=$this->render('district',array('model'=>$model),true);
			//Yii::app()->cache->set($id,$cache_datas,1);
		//}
		//echo $cache_datas;
   	
  }
 
 
    
}
?>
