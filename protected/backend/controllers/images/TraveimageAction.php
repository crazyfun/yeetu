<?php
class TraveimageAction extends BaseAction{
  protected function beforeAction(){
  	 $this->controller->init_page();
     return true;
 
  }
  protected function do_action(){	
  	
		//初始化数据判断是否登录没有登陆转到登陆页面并且过滤 $_REQUEST的数据
		$model=new Images();
		$image_title=$_REQUEST['image_title'];
		$image_category=$_REQUEST['image_category'];
		$conditions=array();
		$params=array();
		$page_params=array();
		$image_category=$_REQUEST['image_category'];
		$image_title=$_REQUEST['image_title'];
    if(!empty($image_category)){
			 array_push($conditions,"image_category LIKE :image_category");
			 $params[':image_category']=$image_category;
			 $page_params['image_category']=$image_category;
		}
		
		if(!empty($image_title)){
			 array_push($conditions,"image_title LIKE :image_title");
			 $params[':image_title']="%$image_title%";
			 $page_params['image_title']=$image_title;
		}
		
	  $sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.create_time DESC";
  	$sort->params=$page_params;
  	
		$active_dataprovider= new CActiveDataProvider($model, array(
			'criteria'=>array(
			    'condition'=>implode(' AND ',$conditions),
			    'params'=>$params,
			    'with'=>array("User"=>array('select'=>'id,user_login,permissions_type','condition'=>'','params'=>array(),'together'=>true)),
			),
			'pagination'=>array(
          'pageSize'=>'60',
          'params'=> $page_params,
      ),
      'sort'=>$sort,
		));
		
		
		$this->display('trave_image',array('model'=>$model,'image_title'=>$image_title,'image_category'=>$image_category,'active_dataprovider'=>$active_dataprovider));
 }
}
?>
