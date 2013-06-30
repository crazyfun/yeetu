<?php
class SearchAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
    	$this->controller->bc(array("回收站"));
      return true;
    }

  protected function do_action(){	
	   $model=new Trave;
		//搜索
		$trave_name=$_REQUEST['trave_name'];
		$trave_status=$_REQUEST['trave_status'];
		$trave_recommend=$_REQUEST['trave_recommend'];
		$trave_bargain=$_REQUEST['trave_bargain'];
		$trave_ordain=$_REQUEST['trave_ordain'];
		$condition=array();
		$params=array();
		$page_params=array();
		if(!empty($trave_name)){
			array_push($condition,"(t.trave_name LIKE :trave_name OR t.trave_suppliers LIKE  :trave_name OR t.trave_number LIKE :trave_name)");
			$params[':trave_name']="%$trave_name%";
			$page_params['trave_name']=$trave_name;
		}
		if(!empty($trave_status)){
			array_push($condition,"t.trave_status=:trave_status");
			$params[':trave_status']=$trave_status;
			$page_params['trave_status']=$trave_status;
		}
		
		
		if(!empty($trave_recommend)){
			array_push($condition,"t.trave_recommend=:trave_recommend");
			$params[':trave_recommend']=$trave_recommend;
			$page_params['trave_recommend']=$trave_recommend;
		}
		
		if(!empty($trave_bargain)){
			array_push($condition,"t.trave_bargain=:trave_bargain");
			$params[':trave_bargain']=$trave_bargain;
			$page_params['trave_bargain']=$trave_bargain;
		}
		
		
		if(!empty($trave_ordain)){
			array_push($condition,"t.trave_ordain=:trave_ordain");
			$params[':trave_ordain']=$trave_ordain;
			$page_params['trave_ordain']=$trave_ordain;
		}
		
		array_push($condition,"recycle=1");

    $validate_sregion=$this->controller->validate_sregion();
	  if($validate_sregion){
	    array_push($condition,$validate_sregion);
	  }
		$criteria=new CDbCriteria;
		
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.id DESC";
  	$sort->params=$page_params;
  	
  	
		$active_data_provider=new CActiveDataProvider($model, array(
			'criteria'=>array(
			    'condition'=>implode(" AND ",$condition),
			    'params'=>$params,
			    'with'=>array(),
			),
			'pagination'=>array(
          'pageSize'=>'20',
          'params'=>$page_params,
          
      ),
      'sort'=>$sort,
		));
		$com_condition['模糊查询:w%']=$trave_name;
		if(!empty($trave_status)){
			$trave_status_name=($trave_status=='1')?"未发布":"已发布";
			$model->trave_status=$trave_status;
		}else{
			$model->trave_status="";
		}
		
		if(!empty($trave_recommend)){
			$trave_recommend_name=($trave_recommend=='1')?"未推荐":"已推荐";
			$model->trave_recommend=$trave_recommend;
		}
		
		if(!empty($trave_bargain)){
			$trave_bargain_name=($trave_bargain=='1')?"不是特价":"是特价";
			$model->trave_bargain=$trave_bargain;
		}
		
		if(!empty($trave_ordain)){
			$trave_ordain_name="立即预定";
			$model->trave_ordain=$trave_ordain;
		}
		
		
		
		$com_condition['显示类型:w%']=$trave_status_name;
		$com_condition['推荐:w%']=$trave_recommend_name;
		$com_condition['特价:w%']=$trave_bargain_name;
		$com_condition['预定类型:w%']=$trave_ordain_name;
		$com_condition_search=Util::com_search_condition($com_condition);
		$this->display('index',array('model'=>$model,'active_data_provider'=>$active_data_provider,'com_condition_search'=>$com_condition_search,'trave_name'=>$trave_name));
  }
 
 
    
}
?>
