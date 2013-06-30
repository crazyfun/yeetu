<?php
class EmailAction extends BaseAction
{
	protected function do_action()
	{   
		  $this->controller->bc(array("邮件管理"));
		  $model=new Batch();
		  $sort=new CSort();
  	  $sort->attributes=array();
  	  $sort->defaultOrder="t.create_time DESC";
		  $criteria=new CDbCriteria;
		  $active_data_provider=new CActiveDataProvider($model, array(
			  'criteria'=>array(
			    'condition'=>'batch_type=:batch_type',
			    'params'=>array(':batch_type'=>'1'),
			    'with'=>array(),
			  ),
			  'pagination'=>array(
          'pageSize'=>'20',
        ),
        'sort'=>$sort,
		  ));
		$this->display('batch', array('model'=>$model,'active_data_provider'=>$active_data_provider));
	}
}