<?php
class IndexAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
    	$this->controller->bc(array("线路分类"));
      return true;
    }

  protected function do_action(){	
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
   	
  }
 
 
    
}
?>
