<?php
class AjaxorderAction extends BaseAction{
  protected function beforeAction(){
  	if(Yii::app()->request->isAjaxRequest){
     Util::reset_vars();
     return true;
   }
  }
  protected function do_action(){	
  	$traveorder=Traveorder::model();
  	$current_time=time();
  	$difftime=60;
  	$diff_time=$current_time-$difftime;
  	$traveorder_data=$traveorder->with("trave","user")->find("t.create_time>=:diff_time",array(':diff_time'=>$diff_time));
		$json_array=array();
		if(empty($traveorder_data)){
			 $json_array['result']="N";
		}else{
			$json_array['result']=$traveorder_data->user->user_login."预定了线路:".$traveorder_data->trave->trave_name.",预定时间:".date("Y-m-d H:i:s",$traveorder_data->create_time);
		}
	  echo json_encode($json_array);
 }
}
?>
