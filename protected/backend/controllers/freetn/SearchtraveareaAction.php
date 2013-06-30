<?php
class SearchtraveareaAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_travearea_page();
     $this->controller->bc(array("国际机+酒店"=>array('freetn/index'),"国际机+酒店景区"));
     return true;
  }
  protected function do_action(){	
		$model=new Travearea;
		$trave_id=$_REQUEST['trave_id'];
		$trave_area=$_REQUEST['trave_area'];
		$model->trave_id=$trave_id;
		$model->trave_area=$trave_area;
		$com_condition['线路景区:w%']=$trave_area;
		$com_condition_search=Util::com_search_condition($com_condition);
		$this->display('trave_area',array('model'=>$model,'com_condition_search'=>$com_condition_search));
  } 
}
?>
