<?php
class MainController extends Controller
{
	
	public function filters() {
		return array(
		  'accessControl', // perform access control for CRUD operations
		);
	}
	
	public function actions()
	{
		return array(
		 'addistrict' => 'application.backend.controllers.main.AddistrictAction', //后台广告搜寻起始出发地
		 'district'=>'application.backend.controllers.main.DistrictAction',
		 'subdistrict'=>'application.backend.controllers.main.SubdistrictAction',
		 'line'=>'application.backend.controllers.main.LineAction',
		 'subline'=>'application.backend.controllers.main.SubLineAction',
		 'ajaxtarea'=>'application.backend.controllers.main.AjaxtareaAction',
		 'ajaxorder'=>'application.backend.controllers.main.AjaxorderAction',
		 'travehotel'=>'application.backend.controllers.main.TravehotelAction',
		 'subtravehotel'=>'application.backend.controllers.main.SubtravehotelAction',
		 'traveflight'=>'application.backend.controllers.main.TraveflightAction',
		 'travehotels'=>'application.backend.controllers.main.TravehotelsAction',
		 'compeletetrave'=>'application.backend.controllers.main.CompeletetraveAction',
		 'travedate'=>'application.backend.controllers.main.TravedateAction',
		 'compeletesuppliers'=>'application.backend.controllers.main.CompeletesuppliersAction',
		 'compeleteflight'=>'application.backend.controllers.main.CompeleteflightAction',
		 'compeleteuser'=>'application.backend.controllers.main.CompeleteuserAction',
		 'clone'=>'application.backend.controllers.main.CloneAction',
		 'message'=>'application.backend.controllers.main.MessageAction',
		 'importp'=>'application.backend.controllers.main.ImportpAction',
		 'import'=>'application.backend.controllers.main.ImportAction',
		 'export'=>'application.backend.controllers.main.ExportAction',
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
