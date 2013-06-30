<?php
class AddAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
      return true;
    }

  protected function do_action(){	
		$id=$_REQUEST['id'];
		$model=new Category;
		if(!empty($id)){
			$this->controller->bc(array("线路分类"=>array('category/index'),'修改线路分类'));
			 $model=$model->get_table_datas($id,array(),false);
		}else{
			$this->controller->bc(array("线路分类"=>array('category/index'),'增加线路分类'));
		}
		$this->display('add_category',array('model'=>$model));
  }
 
 
    
}
?>
