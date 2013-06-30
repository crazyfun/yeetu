<?php
class DeletepAction extends BaseAction
{
	protected function do_action()
	{
		$ids = isset($_REQUEST['id']) ?$_REQUEST['id'] : 0;

		$model=new Batch();
    if(is_array($ids)){
    	foreach($ids as $key => $value){
    		$model->delete_table_datas($value);
    	}
    }else{
    	$model->delete_table_datas($ids);
    	
    }
		$this->controller->redirect(array('batch/phone'));
 }
}