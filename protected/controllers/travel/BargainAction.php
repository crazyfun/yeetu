<?php
class BargainAction extends  BaseAction{
  
    protected function beforeAction(){
    	$this->controller->init_bargain_page();
      $this->controller->menu_tag="bargain";
    	$this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
    	  array($this->controller->trave_sregion_name.'出发特价旅游'=>array("travel/bargain"))
    	);
    $this->controller->pt($this->id,array($this->controller->trave_sregion_name.'出发特价旅游线路-易途旅游网'));
		$this->controller->desc("易途旅游网(41ly.cn)——最简单易用方便实惠的旅游线路在线预订平台,一站式个性化旅游服务提供商;跟团游＋自助游＋公司旅游专家;周边游,国内游,出境游,公司旅游;出发地:".$this->controller->trave_sregion_name);
    $this->controller->kw("十一特价,十一旅游,十一旅游推荐,周庄水乡,杭州西湖,三清山,云南昆明,广西桂林,日本,阿联酋,泰国,温泉,西递,厦门鼓浪屿,张家界,雁荡山,九华山,莫干山,黄山,天目湖");
		
    	return true;
    }

  protected function do_action(){
		 $trave=new Trave();
		 $this->display('bargain',array("trave_model"=>$trave));
  }
 
 
    
}
?>
