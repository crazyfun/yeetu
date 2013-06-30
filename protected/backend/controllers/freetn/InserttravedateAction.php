<?php
class InserttravedateAction extends BaseAction{
  
    protected function beforeAction(){
    	  $this->controller->init_travedate_page();
    	  $this->controller->bc(array("国际机+酒店"=>array('freetn/index'),"增加国际机+酒店时间"));
        return true;
   
    }
  protected function do_action(){	
		$model=new Travedate;
		if(isset($_POST['Travedate'])){
			if(!empty($_POST['Travedate']['id'])){
				$model=$model->get_table_datas($_POST['Travedate']['id']);
			 }
			 $month=$_POST['month'];
		   $day=$_POST['day'];
		   $start_date=$_POST['start_date'];
		   $trave_date=$start_date.",".$month.",".$day;
			 $model->id=$_POST['Travedate']['id'];
			 $model->attributes=$_POST['Travedate'];
			 $model->trave_date=$trave_date;  
       if($model->validate()){
			  $model->insert_travedate();
			 
			  
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
			}else{
			   $this->controller->f(CV::FAILED_ADMIN_OPERATE);
			}
		}
		$com_trave_dates=Util::get_trave_start_date($trave_date);
		$this->display('add_trave_date',array('model' => $model,'trave_dates'=>$com_trave_dates));
  } 
}
?>
