<?php
class IndexAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->init_page();
		  $this->controller->menu_tag="home";
		  $this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,array($this->controller->trave_sregion_name.'出发首页'=>array('site/index')));
		  $st=$_REQUEST['st'];
		  if(!empty($st)){
		  	$this->controller->pt($this->id,array());
		  	$this->controller->desc("易途旅游网(41ly.cn)——最简单易用方便实惠的旅游线路在线预订平台,一站式个性化旅游服务提供商;跟团游＋自助游＋公司旅游专家;周边游,国内游,出境游,公司旅游;出发地:".$this->controller->trave_sregion_name);
		    $this->controller->kw("旅游,旅游网,旅游网站,自助游,跟团游,公司旅游,".$this->controller->trave_sregion_name.",".$this->controller->trave_sregion_name."出发");
		  }else{
		  	$this->controller->pt($this->id,array());
		  	$this->controller->desc("易途旅游网(41ly.cn)——最简单易用方便实惠的旅游线路在线预订平台,一站式个性化旅游服务提供商;跟团游＋自助游＋公司旅游专家;周边游,国内游,出境游,公司旅游;");
		    $this->controller->kw("旅游,旅游网,旅游网站,自助游,跟团游,公司旅游");
		  }
    	return true;
    }
  protected function do_action(){	
		   $this->display('index',array());
  }
 
 
    
}
?>
