<?php
class SregionAction extends BaseAction{
  
  protected function beforeAction(){
  	Util::reset_vars();
  	$sregion_id=$_REQUEST['sregion_id'];
  	$district=new District();
  	$district_datas=$district->get_table_datas($sregion_id,array());
  	$sregion_datas['id']=$district_datas->id;
  	$sregion_datas['name']=$district_datas->district_name;
  	$sregion_datas['en_name']=$district_datas->district_en_name;
  	Yii::app()->session->add('sregion_datas',$sregion_datas);  	
  	$this->controller->trave_sregion=$district_datas->id;
		$this->controller->trave_sregion_name=$district_datas->district_name;
		$this->controller->trave_sregion_en_name=$district_datas->district_en_name;
    return true;
  }
  protected function do_action(){	
  	
  	$this->controller->redirect($this->controller->createUrl("site/index"));
  }
}
?>
