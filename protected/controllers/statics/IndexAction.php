<?php
class IndexAction extends BaseAction{

	public $is_home = true;
	
	protected function beforeAction(){
		$this->controller->init_page();
		$this->controller->desc("易途旅游网(41ly.cn)——最简单易用方便实惠的旅游线路在线预订平台,一站式个性化旅游服务提供商;跟团游＋自助游＋公司旅游专家;周边游,国内游,出境游,公司旅游;");
		$this->controller->kw("旅游,旅游网,旅游网站,自助游,跟团游,公司旅游");
		return true;
	}
	
	protected function do_action(){
		$condition = '';
		$this->is_home=true;
		if ($type_id = $_GET['cid']) {
			$id = abs(intval($type_id));
			$this->is_home=false;
			
			$model = Footlink::model()->findByPk($id);
			$footlink_name=$model->footlink_name;
			$this->controller->pt($this->id,array($footlink_name."-易途旅游网"));
		} else {
			$this->controller->redirect(Yii::app()->homeUrl);
		}

		$this->display('index',array('model' =>$this->is_home?null:$model));
	}
}
?>
