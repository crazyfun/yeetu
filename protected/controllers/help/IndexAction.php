<?php
class IndexAction extends BaseAction{

	public $is_home = true;
	
	protected function beforeAction(){
		$this->controller->init_page();
		$this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,array('帮助'=>array('help/index'))
		);
		
		return true;
	}
	
	protected function do_action(){
		$condition = '';
		
		if ($type_id = $_GET['cid']) {
			$type_id = abs(intval($type_id));
			$condition = 'type_id = ' . $type_id; 
			$this->is_home=false;
			
			$rows = Help::model()->findAll(array(
				'select' => 'title, content',
				'condition' => $condition,
				'order' => 'id ASC'
			));
		} else {
			
			$type_list = Help::model()->get_type_list();
		}
		$help_type_data=HelpType::model()->find(array('select'=>'name','condition'=>'id=:type_id','params'=>array(':type_id'=>$type_id)));
		$this->controller->pt($this->id,array((empty($help_type_data->name)?"帮助中心":$help_type_data->name)."-易途旅游网"));
		$this->controller->desc("易途旅游网(41ly.cn)——最简单易用方便实惠的旅游线路在线预订平台,一站式个性化旅游服务提供商;跟团游＋自助游＋公司旅游专家;周边游,国内游,出境游,公司旅游;");
		$this->controller->kw("旅游,旅游网,旅游网站,自助游,跟团游,公司旅游");

		$this->display('index',array(
			'rows' => $this->is_home ? null : $rows, 
			'type_list' => $this->is_home ? $type_list : null,
		));
	}
}
?>
