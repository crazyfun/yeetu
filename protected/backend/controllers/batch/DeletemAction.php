<?php
class DeletemAction extends BaseAction
{
	protected function do_action()
	{
	
		$ids = isset($_REQUEST['id']) ?$_REQUEST['id'] : 0;
		
		$model=new BatchMessage();
    if(is_array($ids)){
    	foreach($ids as $key => $value){
    		
    		$model->delete_table_datas($value);
    	}
    }else{
    	$model->delete_table_datas($ids);
    	
    }
		$this->controller->redirect(array('batch/message'));
 }
}