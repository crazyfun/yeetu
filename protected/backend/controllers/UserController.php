<?php
class UserController extends AController
{
	
	public function filters() {
		return array(
		  'accessControl', // perform access control for CRUD operations
		);
	}
	
	
	public function actions()
	{
		return array(
			'index'=>'application.backend.controllers.user.IndexAction',
			'add'=>'application.backend.controllers.user.AddAction',
			'search'=>'application.backend.controllers.user.SearchAction',
			'delete'=>'application.backend.controllers.user.DeleteAction',
			'credit'=>'application.backend.controllers.user.CreditAction',
			'cconsume'=>'application.backend.controllers.user.CconsumeAction',
			'editcredit'=>'application.backend.controllers.user.EditcreditAction',
			'editcoupon'=>'application.backend.controllers.user.EditcouponAction',
			'setadmin'=>'application.backend.controllers.user.SetadminAction',
			'active'=>'application.backend.controllers.user.ActiveAction',
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
