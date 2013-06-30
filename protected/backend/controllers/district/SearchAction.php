<?php
class SearchAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
    	$this->controller->bc(array("线路区域"));
      return true;
    }

  protected function do_action(){	
	  $model=new District;
		$district_name=$_REQUEST['district_name'];
		if(!empty($district_name)){
			$district_name_condition=" district_name='$district_name' ";
		}
		$model=$model->findAll(array('condition'=>$district_name_condition,'params'=>array(),'order'=>'district_en_name ASC'));
    $com_condition['线路区域名称:w%']=$district_name;
    $com_condition_search=Util::com_search_condition($com_condition);
		$this->display('district',array('model'=>$model,'com_condition_search'=>$com_condition_search,"district_name"=>$district_name));
   	
  }
 
 
    
}
?>
