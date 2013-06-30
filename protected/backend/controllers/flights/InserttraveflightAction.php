<?php
class InserttraveflightAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
		$model=new TraveFlight;
		if(isset($_POST['TraveFlight'])){
			if(!empty($_POST['TraveFlight']['id'])){
				$model=$model->get_table_datas($_POST['TraveFlight']['id']);
			}
			$model->id=$_POST['TraveFlight']['id'];
			$model->attributes=$_POST['TraveFlight'];
			//if(!empty($_POST['gtransfer_flight']))
			   // $model->gtransfer_flight=implode(",",$_POST['gtransfer_flight']);
			//if(!empty($_POST['btransfer_flight']))
		      //$model->btransfer_flight=implode(",",$_POST['btransfer_flight']);
			//$model->start_date=$_POST['start_date'];
			//$model->end_date=$_POST['end_date'];
			
			$model->go_flight_time=$_POST['go_flight_time'];
			$model->go_flight_rtime=$_POST['go_flight_rtime'];
			//$model->back_flight_time=$_POST['back_flight_time'];
			//$model->back_flight_rtime=$_POST['back_flight_rtime'];

			if($model->validate()){
			  $model->insert_traveflight();
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		  }else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
		}
		
		$this->display('add_trave_flight',array('model' => $model));
  } 
}
?>
