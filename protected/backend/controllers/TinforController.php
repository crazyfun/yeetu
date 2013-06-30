<?php
class TinforController extends AController
{
	
	public function filters() {
		return array(
		  'accessControl', // perform access control for CRUD operations
		);
	}
	
	public function actions()
	{
		return array(
		  'index'=>'application.backend.controllers.tinfor.IndexAction',
		  'add'=>'application.backend.controllers.tinfor.AddAction',
		  'search'=>'application.backend.controllers.tinfor.SearchAction',
		  'delete'=>'application.backend.controllers.tinfor.DeleteAction',
		  'theme'=>'application.backend.controllers.tinfor.ThemeAction',
		  'addtheme'=>'application.backend.controllers.tinfor.AddthemeAction',
		  'deletetheme'=>'application.backend.controllers.tinfor.DeletethemeAction',
		  'publish'=>'application.backend.controllers.tinfor.PublishAction',
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
