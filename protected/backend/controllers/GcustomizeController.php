<?php
class GcustomizeController extends AController
{
	
	public function filters() {
		return array(
		  'accessControl', // perform access control for CRUD operations
		);
	}
	public function actions()
	{
		return array(
		  'index'=>'application.backend.controllers.gcustomize.IndexAction',
		  'add'=>'application.backend.controllers.gcustomize.AddAction',
		  'search'=>'application.backend.controllers.gcustomize.SearchAction',
		  'delete'=>'application.backend.controllers.gcustomize.DeleteAction',
		  'process'=>'application.backend.controllers.gcustomize.ProcessAction',

		);
	}
	 public function f($msg_code){ 
     if($msg_code == CV::SUCCESS_ADMIN_OPERATE){
       $this->sf("操作成功");
     }
     if($msg_code == CV::FAILED_ADMIN_OPERATE){
     	$this->ff("操作失败");
     }
     if($msg_code == CV::ERROR_ADMIN_DATABASE){
     	 $this->ff("操作数据库错误");
     }
    }
}
