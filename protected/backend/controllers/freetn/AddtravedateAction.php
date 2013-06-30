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
			 $this->controller->bc(array("国际机+酒店"=>array('freetn/index'),"修改国际机+酒店时间"));
			 $model=$model->get_table_datas($id,array());
			 $trave_dates=Util::get_trave_start_date($model->trave_date);
		}else{
			$this->controller->bc(array("国际机+酒店"=>array('freetn/index'),"增加国际机+酒店时间"));
		}
		$model->trave_id=$trave_id;
		$this->display('add_trave_date',array('model'=>$model,'trave_dates'=>$trave_dates));
  } 
}
?>
