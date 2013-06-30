<?php
class DetailsAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->init_page();
		  
		  $this->controller->desc("易途旅游网(41ly.cn)——最简单易用方便实惠的旅游线路在线预订平台,一站式个性化旅游服务提供商;跟团游＋自助游＋公司旅游专家;周边游,国内游,出境游,公司旅游;");
		  $this->controller->kw("旅游,旅游网,旅游网站,自助游,跟团游,公司旅游");
    	return true;
    }
  protected function do_action(){	
  	  $trave_infor_id=$_GET['id'];
  	  $travel_info=new TravelInfor();
  	  
  	  $trave_infor_datas=$travel_info->with('User')->find(array('condition'=>'t.id=:id','params'=>array(':id'=>$trave_infor_id)));
  	  //$trave_infor_datas=$travel_info->get_table_datas($trave_infor_id,array());
	    $trave_infor_name=$trave_infor_datas->information_title;
  	  $this->controller->pt($this->id,array($trave_infor_name."-易途旅游网"));
  	  $this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
		  array("旅游资讯"=>array('traveinfor/index'),$trave_infor_datas->information_title=>array('traveinfor/details')));
  	  $trave_infor_datas->view_numbs+=1;
  	  $trave_infor_datas->save();
		  $this->display('travel_infor',array('trave_infor_datas'=>$trave_infor_datas));
   	
  }
 
 
    
}
?>
