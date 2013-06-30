<?php
class GroupAction extends  BaseAction{
  
   protected function beforeAction(){
    	$this->controller->init_page();
    	$this->controller->trave_category='4';
    	$this->controller->set_trave_category($this->controller->trave_category);
    	$this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
    	  array($this->controller->trave_sregion_name.'出发公司旅游'=>array("travel/group"))
    	);
		$this->controller->pt($this->id,array($this->controller->trave_sregion_name.'出发公司旅游_最新'.$this->controller->trave_sregion_name.'出发公司旅游线路价格-易途旅游网'));
		$this->controller->desc("易途旅游网(41ly.cn)提供在线公司企业团队旅游咨询,为您提供专业的公司旅游策划方案,".$this->controller->trave_sregion_name."出发专业的企业团队旅游线路,为您制定个性化的团队旅游需求.专业,个性,一站式的公司团队旅游服务就在易途旅游网.");
		$this->controller->kw("公司旅游,".$this->controller->trave_sregion_name."出发公司旅游,".$this->controller->trave_sregion_name."出发公司旅游线路报价,消夏游,年会游,度假游,拓展游,奖励游,公关游,会议游");
    return true;
    	
    }
    
  protected function do_action(){
		 $trave=Trave::model();
		 $group_customize=new GroupCustomize();
		 if(isset($_POST['GroupCustomize'])){
		 	  $group_customize->attributes=$_POST['GroupCustomize'];
		 	  $group_customize->reply_time=$_POST['reply_time'];
		 	  $group_customize->transport=$_POST['transport'];
		 	  $group_customize->stay=$_POST['stay'];
		 	  $group_customize->dinning=$_POST['dinning'];
		 	  $group_customize->guide=$_POST['guide'];
		 	  $group_customize->shopping=$_POST['shopping'];
		 	  $group_customize->meeting=$_POST['meeting'];
		 	  if($group_customize->validate()){
		 	  	$group_customize->insert_group();
		 	  	$this->controller->f(CV::SUCCESS_TRAVE_OPERATE);
		 	  	$this->controller->refresh();
		 	  	
		 	  }else{
		 	  	$this->controller->f(CV::FAILED_TRAVE_OPERATE);
		 	  }
		 	
		 }

		 
		 $this->display('group',array("trave_model"=>$trave,'model'=>$group_customize));
  }
   
}
?>
