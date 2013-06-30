<?php
class DeletetraveareaAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_travearea_page();
     return true;
  }
  protected function do_action(){	
		$model=new Travearea;
		$id=$_REQUEST['id'];
		$trave_id=$_REQUEST['trave_id'];
		if(!empty($id)){
			if(is_array($id)){
				foreach($id as $key => $value){
					$model->delete_table_datas($value);
				}
			}else{
			  $model->delete_table_datas($id);
			}
		}
		
		$this->controller->redirect($this->controller->createUrl("travearea",array('trave_id'=>$trave_id)));
  } 
}
?>
