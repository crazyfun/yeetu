<?php
class FinancialController extends AController
{
	
	public function filters() {
		return array(
		  'accessControl', // perform access control for CRUD operations
		);
	}
	public function actions()
	{
		return array(
		 'order'=>'application.backend.controllers.financial.OrderAction',
		 'adminfinan'=>'application.backend.controllers.financial.AdminfinanAction',
		 'finan'=>'application.backend.controllers.financial.FinanAction',
		 'searchf'=>'application.backend.controllers.financial.SearchfAction',
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
     if($msg_code == CV::FAILED_ADMIN_OPERATE_USER_EMAIL){
     	$this->ff("注册会员数据错误");
     }
    }
}
