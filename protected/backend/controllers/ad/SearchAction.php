<?php
class SearchAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     $this->controller->bc(array("广告位管理"));
     return true;
  }
  protected function do_action(){	
		$model=new Ad();
	  $ad_area_id=$_REQUEST['ad_area_id'];
    $ad_sregion_id=$_REQUEST['ad_sregion_id'];
    $ad_type=$_REQUEST['ad_type'];
		if(!empty($ad_area_id)){
			$downListData = $model->get_areas_list();
			 $com_condition['广告位:w%']=$downListData[$ad_area_id];
		}
		
		if(!empty($ad_sregion_id)){
			$trave=new Trave(); 
			$sregion_datas=$trave->get_trave_sregion();
			 $com_condition['出发城市:w%']=$sregion_datas[$ad_sregion_id];
		}
		
		if(!empty($ad_type)){
			$ad_type_datas=CV::$AD_TYPE;
			 $com_condition['广告类型:w%']=$ad_type_datas[$ad_type];
		}

		$com_condition_search=Util::com_search_condition($com_condition);

		$this->display('index',array('model'=>$model,'com_condition_search'=>$com_condition_search,'ad_area_id'=>$ad_area_id,'ad_sregion_id'=>$ad_sregion_id,'ad_type'=>$ad_type));
  } 
}
?>
