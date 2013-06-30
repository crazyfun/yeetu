<?php

class SyztthemeController extends Controller
{

	//出发城市的名字
	public $trave_sregion_name="";
	//出发城市的英文名字
	public $trave_sregion_en_name="";
	//出发城市的ID号
	public $trave_sregion="";
	
	public function filters() {
		return array(
			'accessControl', // perform access control for CRUD operations
			'SregionFilter + index',
		);
	}
  public function actions()
	{
		return array(
		  'index'=>'application.controllers.syzttheme.IndexAction',
		  
		);
	}
	
	public function FilterSregionFilter($filterChain) {
    Util::get_sregion();
    $sregion_session=Yii::app()->session->get('sregion_datas');
		$trave_id=$_REQUEST['id'];
		if(!empty($trave_id)){
		 $trave=new Trave();
		 $trave_datas=$trave->find(array('select'=>'trave_sregion','condition'=>'id=:trave_id ','params'=>array(':trave_id'=>$trave_id)));
		 $t_trave_sregion=$trave_datas->trave_sregion;
		 if(intval($t_trave_sregion)!=intval($sregion_session['id'])){
			 $district=new District();
       $district_datas=$district->find(array('select'=>'id,district_name,district_en_name','condition'=>'id=:id','params'=>array(':id'=>$t_trave_sregion)));
       $sregion_datas=array();
       $sregion_datas['id']=$district_datas->id;
       $sregion_datas['name']=$district_datas->district_name;
       $sregion_datas['en_name']=$district_datas->district_en_name;
       $sregion_session=$sregion_datas;
       if(!empty($sregion_session['id'])){
          Yii::app()->session->add('sregion_datas',$sregion_session);
       }
		 }
	 }
		$this->trave_sregion=$sregion_session['id'];
		$this->trave_sregion_name=$sregion_session['name'];
		$this->trave_sregion_en_name=$sregion_session['en_name'];
		$filterChain->run();
	}
  public function f($msg_code){  
  }

	function init_page(){
		$this->layout="theme/syzt";
		Util::reset_vars();
	}
}
