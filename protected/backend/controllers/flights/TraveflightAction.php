<?php
class TraveflightAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     $this->controller->bc(array("航班管理"));
     return true;
  }
  protected function do_action(){
		//初始化数据判断是否登录没有登陆转到登陆页面并且过滤 $_REQUEST的数据
		$model=new TraveFlight;
		if(isset($_REQUEST['search_submit'])){
			$trave_flight=$_REQUEST['trave_flight'];
			$flight_airport=$_REQUEST['flight_airport'];
			$flight_date=$_REQUEST['flight_date'];
			$flight_type=$_REQUEST['flight_type'];
			
		 if(!empty($flight_type)){
		   $com_condition['机型:w%']=$flight_type;	
		 }
			//航班
		 if(!empty($trave_flight)){
			 $com_condition['航班:w%']=$trave_flight;
		 }
		 //航班
		 if(!empty($flight_airport)){
			 $com_condition['机场:w%']=$flight_airport;
		 }
		 //航班
		 if(!empty($flight_date)){
			 $com_condition['时间:w%']=$flight_date;
		 }
    $com_condition_search=Util::com_search_condition($com_condition);
		}
		$this->display('trave_flight',array('model'=>$model,'com_condition_search'=>$com_condition_search,'trave_flight'=>$trave_flight,'flight_airport'=>$flight_airport,'flight_date'=>$flight_date));
  } 
}
?>
