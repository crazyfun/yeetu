<?php
class PeripheralAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->init_page();
    	$this->controller->trave_category='2';
    	$this->controller->set_trave_category($this->controller->trave_category);
    	$this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
    	  array($this->controller->trave_sregion_name.'出发周边旅游'=>array("travel/peripheral"))
    	);
		$this->controller->pt($this->id,array($this->controller->trave_sregion_name.'周边旅游_最新'.$this->controller->trave_sregion_name.'周边旅游线路报价_价格-易途旅游网'));
		$this->controller->desc("易途旅游网(41ly.cn)——最新的".$this->controller->trave_sregion_name."周边旅游线路报价及价格目录,详细介绍".$this->controller->trave_sregion_name."周边旅游线路报价,".$this->controller->trave_sregion_name."周边旅游线路价格,详细行程,发团日期,报价以及提供在线咨询服务,为您提供一站式服务");
		$this->controller->kw("周边旅游,".$this->controller->trave_sregion_name."周边旅游,周边旅游线路报价,".CV::$SEARCH_KEYWORDS['2']);
    	return true;
    }
   
  protected function do_action(){
		 $trave=Trave::model();
		 $this->display('peripheral',array("trave_model"=>$trave));
  }
 
 
    
}
?>
