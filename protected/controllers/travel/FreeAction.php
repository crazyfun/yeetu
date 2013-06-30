<?php
class FreeAction extends  BaseAction{
  
    protected function beforeAction(){
    	$this->controller->init_free_page();
    	$this->controller->trave_category='5';
    	$this->controller->set_trave_category($this->controller->trave_category);
    	$this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
    	  array($this->controller->trave_sregion_name.'出发自助游'=>array("travel/free"))
    	);
		$this->controller->pt($this->id,array($this->controller->trave_sregion_name.'出发自助游_最新'.$this->controller->trave_sregion_name.'出发自助游线路报价_价格-易途旅游网'));
		$this->controller->desc("易途旅游网(41ly.cn)——最新的".$this->controller->trave_sregion_name."出发自助游线路报价及价格目录,详细介绍".$this->controller->trave_sregion_name."出发自助游线路报价,".$this->controller->trave_sregion_name."出发自助游线路价格,详细行程,发团日期,报价以及提供在线咨询服务,为您提供一站式服务");
		$trave=Trave::model();
    $kw_datas1=$trave->get_free_trave_distrinct("1");
    $kw_datas2=$trave->get_free_trave_distrinct("2");
    $kw_datas=array_merge($kw_datas1,$kw_datas2);
    $kw_names="";
    foreach($kw_datas as $key => $value){
    	 $district_value=$value['district_value'];
       foreach($district_value as $key1 => $value1){
       	 if(empty($kw_names)){
       	    $kw_names.=	$value1['name'];
       	 }else{
       	 	  $kw_names.=	",".$value1['name'];
       	 }
       	
       }
    }
		$this->controller->kw("自助游,".$this->controller->trave_sregion_name."出发自助游,自助游线路报价,".$kw_names);
		
    	return true;
    }

  protected function do_action(){
		 $trave=Trave::model();

		 $this->display('free',array("trave_model"=>$trave));
  }
 
 
    
}
?>
