<?php
class HotList extends CWidget
{
	public function run()
	{
		$model = HotView::model();
		$topices = $model->topices;
		$hotViews = $model->hotViews;
		$this->render('hot_list', array('topices'=>$topices,'hotViews'=>$hotViews));
	}
}
