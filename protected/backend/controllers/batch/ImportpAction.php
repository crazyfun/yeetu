<?php
class ImportpAction extends BaseAction
{
	protected function do_action()
	{   
		  $model=new ImportPhone();
		  $sort=new CSort();
  	  $sort->attributes=array();
  	  $sort->defaultOrder="t.create_time DESC";
  	  $condition=array();
  	  $params=array();
  	  $page_params=array();
  	  if(isset($_POST['search_submit'])){
  	  	
  	  	if(!empty($_POST['name'])){
  	  		$name=$_POST['name'];
  	  		array_push($condition,'name=:name');
  	  		$params[':name']=$name;
  	  		$page_params['name']=$name;
  	  	}
  	  	if(!empty($_POST['phone'])){
  	  		$phone=$_POST['phone'];
  	  		array_push($condition,'phone=:phone');
  	  		$params[':phone']=$phone;
  	  		$page_params['phone']=$phone;
  	  	}
  	  }
		  $criteria=new CDbCriteria;
		  $active_data_provider=new CActiveDataProvider($model, array(
			  'criteria'=>array(
			    'condition'=> implode(" AND ",$condition),
			    'params'=>$params,
			    'with'=>array('User'),
			  ),
			  'pagination'=>array(
          'pageSize'=>'20',
          'params'=>$page_params,
        ),
        'sort'=>$sort,
		  ));
		$this->display('import_phone',array('model'=>$model,'active_data_provider'=>$active_data_provider,'name'=>$name,'phone'=>$phone));
	}
}