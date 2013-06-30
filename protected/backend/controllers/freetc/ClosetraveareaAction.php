<?php
class ClosetraveareaAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_travearea_page();
     return true;
  }
  protected function do_action(){	
		$model=new Travearea;
		$id=$_REQUEST['id'];
		$trave_id=$_REQUEST['trave_id'];
		if(!empty($id)){
			$add_datas['trave_status']='2';
	  	$add_datas['create_id']="";
	  	$add_datas['create_time']=Util::current_time('timestamp');
	  	$update_flag=$model->update_table_datas($id,$add_datas);
		}
		
		$this->controller->redirect($this->controller->createUrl("travearea",array('trave_id'=>$trave_id)));
  } 
}
?>
