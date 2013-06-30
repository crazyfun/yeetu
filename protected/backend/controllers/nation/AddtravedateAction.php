<?php
class AddtravedateAction extends BaseAction{
  
    protected function beforeAction(){
    	  $this->controller->init_travedate_page();
        return true;
   
    }
  protected function do_action(){	
		$id=$_REQUEST['id'];
		$trave_id=$_REQUEST['trave_id'];
		$model=new Travedate;
		if(!empty($id)){
			 $this->controller->bc(array("出境游"=>array('nation/index'),"修改出境游时间"));
			 $model=$model->get_table_datas($id,array());
			 $trave_dates=Util::get_trave_start_date($model->trave_date,$model->date_type);
		}else{
			$this->controller->bc(array("出境游"=>array('nation/index'),"增加出境游时间"));
		}
		$model->trave_id=$trave_id;
		$this->display('add_trave_date',array('model'=>$model,'trave_dates'=>$trave_dates));
  } 
}
?>
