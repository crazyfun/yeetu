<?php
class SearchRecommend extends CWidget
{
	public function run(){
    $trave=new Trave();
    $trave_sregion=Yii::app()->getController()->trave_sregion;
    //$sql="SELECT t.id,t.trave_name FROM {{trave}} AS t JOIN (SELECT ROUND(RAND() * ((SELECT MAX(id) FROM {{trave}})-(SELECT MIN(id) FROM {{trave}}))+(SELECT MIN(id) FROM {{trave}})) AS id) AS t1 WHERE t.id >= t1.id AND t.trave_sregion=:trave_sregion AND t.trave_recommend=:trave_recommend AND t.trave_status=:trave_status AND t.recycle=:recycle ORDER BY t.id LIMIT 5";
    
    $sql="SELECT t.id,t.trave_name,trave_title FROM {{trave}} AS t  WHERE id >= (SELECT floor(RAND() * (SELECT MAX(id) FROM {{trave}} ))) AND t.trave_sregion=:trave_sregion AND t.trave_recommend=:trave_recommend AND t.trave_status=:trave_status AND t.recycle=:recycle ORDER BY t.id LIMIT 5";
    
    $recommend_datas=$trave->findAllBySql($sql,array(':trave_sregion'=>$trave_sregion,':trave_recommend'=>'2',':trave_status'=>'2',':recycle'=>0));
		$this->render('search_recommend',array('recommend_datas'=>$recommend_datas));
	}

}