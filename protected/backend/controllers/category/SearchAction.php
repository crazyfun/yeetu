<?php
class SearchAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
    	$this->controller->bc(array("线路分类"));
      return true;
    }

  protected function do_action(){	
		$model=new Category;
		$category_name=$_REQUEST['category_name'];
		$model=$model->get_table_datas("",array('category_name'=>"$category_name"));
    $com_condition['线路分类名称:w%']=$category_name;
    $com_condition_search=Util::com_search_condition($com_condition);
		$this->display('category',array('model'=>$model,'com_condition_search'=>$com_condition_search,"category_name"=>$category_name));
  }
 
 
    
}
?>
