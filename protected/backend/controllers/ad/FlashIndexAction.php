<?php
class FlashIndexAction extends BaseAction{
  protected function beforeAction(){
  	 $this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
     $this->controller->init_page();
     $this->controller->bc(array("首页flash广告管理"));
     return true;
  }
  protected function do_action(){	
  	$model=new FlashAd();
  	$ad_sregion_id=$_REQUEST['ad_sregion_id'];
  	if(!empty($ad_sregion_id)){
			$trave=new Trave(); 
			$sregion_datas=$trave->get_trave_sregion();
			 $com_condition['出发城市:w%']=$sregion_datas[$ad_sregion_id];
		}
		$com_condition_search=Util::com_search_condition($com_condition);
		$this->display('flash_index',array('model'=>$model,'com_condition_search'=>$com_condition_search,'ad_sregion_id'=>$ad_sregion_id));
  } 
}
?>
