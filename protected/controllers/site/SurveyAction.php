<?php
class SurveyAction extends BaseAction{
  
    protected function beforeAction(){
     if(Yii::app()->request->isAjaxRequest){
      	Util::reset_vars();
       	return true;
      }else{
      	return false;
      }
    	
    }
  protected function do_action(){	
  	
  	$survey_type=$_REQUEST['survey_type'];
  	$online_survey=new OnlineSurvey();
  	$remote_ip=Util::getip();
  	$ip_convert=new IpConvert();
  	$survey_area=$ip_convert->convertip($remote_ip);
  	$survey_ip_datas=$remote_ip."(".$survey_area.")";
  	$conditions=array('remote_ip'=>$survey_ip_datas);
    $return_array=array(); 
  	$survey_datas=$online_survey->get_table_datas("",$conditions);
  	if(empty($survey_datas)){
       $online_survey->survey_type=$survey_type;
       $online_survey->remote_ip=$survey_ip_datas;
       $result=$online_survey->insert_online_survey();
       if($result){
       	$return_array['result']="success";
       }else{
       	$return_array['result']="failed";
      }
  	}else{
  		  $return_array['result']="failed";
  	}
		
   	echo json_encode($return_array);
  }
 
 
    
}
?>
