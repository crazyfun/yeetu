<?php
class SearchtravedateAction extends BaseAction{
  
    protected function beforeAction(){
    	  $this->controller->init_travedate_page();
    	  $this->controller->bc(array("出境游"=>array('nation/index'),"出境游时间"));
        return true;
   
    }
  protected function do_action(){	
		$model=new Travedate;
		$trave_id=$_REQUEST['trave_id'];
		$start_date=$_REQUEST['start_date'];
		$model->trave_id=$trave_id;
		$model->trave_date=$start_date;
		$com_condition['线路出发时间:w%']=$start_date;
		$com_condition_search=Util::com_search_condition($com_condition);
		$this->display('trave_date',array('model'=>$model,'com_condition_search'=>$com_condition_search,'start_date'=>$start_date));
  } 
}
?>