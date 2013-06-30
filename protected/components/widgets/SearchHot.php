<?php
class SearchHot extends CWidget
{
	public function run(){
    $trave=new Trave();
    $trave_sregion=Yii::app()->getController()->trave_sregion;
    $sql="SELECT id,trave_name,trave_title FROM {{trave}} WHERE trave_sregion=:trave_sregion AND trave_status=:trave_status AND recycle=0 ORDER BY trave_numbers DESC LIMIT 5";
    $hot_datas=$trave->findAllBySql($sql,array(':trave_sregion'=>$trave_sregion,':trave_status'=>'2'));
		$this->render('search_hot',array('hot_datas'=>$hot_datas));
	}

}