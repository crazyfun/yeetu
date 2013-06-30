<?php
class HelpmanualController extends AController
{
	public function filters() {
	}
	public function actions(){
		return array(
			'index'=>'application.backend.controllers.helpmanual.IndexAction',
			'help'=>array(
				'class'=>'CViewAction',
        'basePath'=>'', //指定目录名
        'defaultView'=>'',
        'viewParam'=>'help', //get参数
        'layout'=>false,
			),
		);
		
	}
	
	function init_page(){
		$this->layout="helpm";
	}

}
