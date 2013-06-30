<?php
class InserttravedateAction extends BaseAction{
  
    protected function beforeAction(){
    	  $this->controller->init_travedate_page();
    	  $this->controller->bc(array("周边游"=>array('peripheral/index'),"增加周边游时间"));
        return true;
   
    }
  protected function do_action(){	
		$model=new Travedate;
		if(isset($_POST['Travedate'])){
			if(!empty($_POST['Travedate']['id'])){
				$model=$model->get_table_datas($_POST['Travedate']['id']);
			 }
			 $model->id=$_POST['Travedate']['id'];
			 $model->attributes=$_POST['Travedate'];
		
			 if($model->date_type=='1'){
			 	$month=$_POST['month'];
		   	$day=$_POST['day'];
		   	$start_date=$_POST['start_date'];
		   	$trave_date=$start_date.",".$month.",".$day;
		   }else{
		      $start_date=$_POST['start_date'];
		      $open_date=$_POST['open_date'];
		      $close_date=$_POST['close_date'];
		      $trave_date=$start_date.",".$open_date.",".$close_date;	
		   }
			 $model->trave_date=$trave_date;  
       if($model->validate()){
			  $model->insert_travedate();
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
			}else{
			   $this->controller->f(CV::FAILED_ADMIN_OPERATE);
			}
		}
		$com_trave_dates=Util::get_trave_start_date($trave_date,$model->date_type);
		$this->display('add_trave_date',array('model' => $model,'trave_dates'=>$com_trave_dates));
  } 
}
?>
