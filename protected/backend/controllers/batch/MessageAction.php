<?php
class MessageAction extends BaseAction
{
	protected function do_action()
	{   
		  $this->controller->bc(array("信息管理"));
		  $model=new BatchMessage();
		  $sort=new CSort();
  	  $sort->attributes=array();
  	  $sort->defaultOrder="t.create_time DESC";
  	  $condition=array();
  	  $params=array();
  	  $page_params=array();
  	  if(isset($_POST['search_submit'])){
  	  	
  	  	if(!empty($_POST['title'])){
  	  		$title=$_POST['title'];
  	  		array_push($condition,'title=:title');
  	  		$params[':title']=$title;
  	  		$page_params['title']=$title;
  	  	}
  	  	if(!empty($_POST['custom_date'])){
  	  		$custom_date=$_POST['custom_date'];
  	  		array_push($condition,'custom_date=:custom_date');
  	  		$params[':custom_date']=$custom_date;
  	  		$page_params['custom_date']=$custom_date;
  	  	}
  	  	if(!empty($_POST['message'])){
  	  		$message=$_POST['message'];
  	  		array_push($condition,"message=:message");
  	  		$params[':message']=$message;
  	  		$page_params['message']=$message;
  	  	}
  	  	if(!empty($_POST['batch_type'])){
  	  		$batch_type=$_POST['batch_type'];
  	  		array_push($condition,"batch_type=:batch_type");
  	  		$params['batch_type']=$batch_type;
  	  		$page_params['batch_type']=$batch_type;
  	  		
  	  	}
  	  	if(!empty($_POST['status'])){
  	  		$status=$_POST['status'];
  	  		array_push($condition,"status=:status");
  	  		$params['status']=$status-1;
  	  		$page_params['status']=$status;
  	  		
  	  	}
  	  	if(!empty($_POST['is_all'])){
  	  		$is_all=$_POST['is_all'];
  	  		array_push($condition,"is_all=:is_all");
  	  		$params['is_all']=$is_all-1;
  	  		$page_params['is_all']=$is_all;
  	  	}
  	  }
		  $criteria=new CDbCriteria;
		  $active_data_provider=new CActiveDataProvider($model, array(
			  'criteria'=>array(
			    'condition'=> implode(" AND ",$condition),
			    'params'=>$params,
			    'with'=>array(),
			  ),
			  'pagination'=>array(
          'pageSize'=>'20',
          'params'=>$page_params,
        ),
        'sort'=>$sort,
		  ));
		$this->display('message',array('model'=>$model,'active_data_provider'=>$active_data_provider,'title'=>$title,'custom_date'=>$custom_date,'message'=>$message,'batch_type'=>$batch_type,'status'=>$status,'is_all'=>$is_all));
	}
}