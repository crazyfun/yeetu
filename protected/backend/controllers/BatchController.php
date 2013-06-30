<?php
class BatchController extends AController
{
	public function filters() {
		return array(
		  'accessControl', // perform access control for CRUD operations
		);
	}
	public function actions()
	{
		$path = 'application.backend.controllers.batch.';
		return array(
			'phone' => $path.'PhoneAction',
			'email' => $path.'EmailAction',
			'edite' => $path.'EditeAction',
			'message' => $path.'MessageAction',
			'deletee'=> $path.'DeleteeAction',
			'editp' => $path.'EditpAction',
			'deletep'=> $path.'DeletepAction',
			'deletem'=> $path.'DeletemAction',
			'view'=> $path.'ViewAction',
			'importp'=>$path.'ImportpAction',
			'importpdelete'=>$path.'ImportpDeleteAction',
			'importpedit'=>$path.'ImportpEditAction',
			
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
    
    
	public function init(){
		parent::init_page();
	}
	
	public function beforeAction($action)
	{
		$this->check_login("",CV::RETURN_ADMIN_INDEX);
		return parent::beforeAction($action);
	}
}
