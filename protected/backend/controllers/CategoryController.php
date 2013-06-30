<?php
class CategoryController extends AController
{
	
	public function filters() {
		return array(
		  'accessControl', // perform access control for CRUD operations
		);
	}
	
	
	public function actions()
	{
		return array(
		  'index'=>'application.backend.controllers.category.IndexAction',
		  'add'=>'application.backend.controllers.category.AddAction',
		  'search'=>'application.backend.controllers.category.SearchAction',
		  'addcategory'=>'application.backend.controllers.category.AddcategoryAction',
		  'delete'=>'application.backend.controllers.category.DeleteAction',
		  'subcategory'=>'application.backend.controllers.category.SubcategoryAction',
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
