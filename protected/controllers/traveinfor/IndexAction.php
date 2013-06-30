<?php
class IndexAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->init_page();
		  $this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
		  array('旅游资讯'=>array('traveinfor/index'))
		  );
		  $this->controller->pt($this->id,array());
		  $this->controller->desc("易途旅游网(41ly.cn)——最简单易用方便实惠的旅游线路在线预订平台,一站式个性化旅游服务提供商;跟团游＋自助游＋公司旅游专家;周边游,国内游,出境游,公司旅游;");
		  $this->controller->kw("旅游,旅游网,旅游网站,自助游,跟团游,公司旅游");
    	return true;
    }
  protected function do_action(){	
  	   $information_search=$_REQUEST['information_search'];
  	   $information_theme=$_REQUEST['information_theme'];
  	   $conditions=array();
  	   $params=array();
  	   $page_params=array();
  	   if(!empty($information_search)){
  	   	array_push($conditions," (t.information_title LIKE :information_search OR t.information_desc LIKE :information_search OR t.information_content LIKE :information_search)");
  	   	$params[':information_search']="%$information_search%";
  	   	$page_params['information_search']=$information_search;
  	   }
  	   if(!empty($information_theme)){
  	   	array_push($conditions," information_theme=:information_theme");
  	   	$params[':information_theme']=$information_theme;
  	   	$page_params['information_theme']=$information_theme;
  	  }
  	   array_push($conditions,"t.information_status=:information_status");
  	   $params[':information_status']="2";
  	   $page_params['information_status']=$information_status;

  	   $travel_info=new TravelInfor();
		   $info_dataProvider = new CActiveDataProvider($travel_info,array(
		    'criteria'=>array(
			    'condition'=>implode(" AND ",$conditions),
			    'params'=>$params,
			    'order'=>'create_time DESC',
			  ),
			 'pagination'=>array(
          'pageSize'=>'20',
          'params'=>$page_params,
        ),
		  ));
		   $re_conditions=
		   $info_recommendProvider = new CActiveDataProvider($travel_info,array(
		    'criteria'=>array(
			    'condition'=>implode(" AND ",$conditions),
			    'params'=>$params,
			    'order'=>'create_time DESC',
			  ),
			 'pagination'=>array(
          'pageSize'=>'20',
          'params'=>$page_params,
        ),
		  ));
		   
		  $this->display('index',array('info_dataProvider'=>$info_dataProvider,'information_theme'=>$information_theme,'information_search'=>$information_search));
   	
  }
 
 
    
}
?>
