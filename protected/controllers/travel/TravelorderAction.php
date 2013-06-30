<?php
class TravelorderAction extends BaseAction{
  
    protected function beforeAction(){
    	
    	$trave_id=$_REQUEST['trave_id'];
			$select_trave_date=$_REQUEST['select_trave_date'];
			$adult_nums=$_REQUEST['adult_nums'];
			$child_nums=$_REQUEST['child_nums'];
    	$this->controller->check_login(CV::UNLOGIN_ORDER,CV::RETURN_TRAVE_ORDER,array('trave_id'=>$trave_id,'select_trave_date'=>strftime('%Y-%m-%d',strtotime($select_trave_date)),'adult_nums'=>$adult_nums,'child_nums'=>$child_nums));
    	$this->controller->init_order_page();
		$this->controller->desc("易途旅游网(41ly.cn)——最简单易用方便实惠的旅游线路在线预订平台,一站式个性化旅游服务提供商;跟团游＋自助游＋公司旅游专家;周边游,国内游,出境游,公司旅游;");
		 $this->controller->kw("旅游,旅游网,旅游网站,自助游,跟团游,公司旅游");
		  
    	return true;
    	
    }
   
  protected function do_action(){
		$trave_id=$_REQUEST['trave_id'];
		$select_trave_date=$_REQUEST['select_trave_date'];
		$select_trave_date=strftime('%Y/%m/%d',strtotime($select_trave_date));
		$adult_nums=$_REQUEST['adult_nums'];
		$child_nums=$_REQUEST['child_nums'];
		$trave=new Trave();
		$trave=$trave->find(array('select'=>'id,trave_name,trave_title,trave_sregion,trave_receptionstandards,trave_recommended,trave_tour,trave_booknotice','condition'=>'id=:trave_id','params'=>array(':trave_id'=>$trave_id)));
    $this->controller->pt($this->id,array($trave->trave_name.'旅游线路在线预定_订单信息-易途旅游网'));
		$this->display('travel_order',array('model'=>$trave,'select_trave_date'=>$select_trave_date,'adult_nums'=>$adult_nums,'child_nums'=>$child_nums,'user_datas'=>$user_datas));
  }
 
 
    
}
?>
