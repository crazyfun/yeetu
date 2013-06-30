<?php
class AddistrictAction extends BaseAction
{
	protected function do_action()
	{
		$parent_ids = Yii::app()->getDb()->createCommand()
			->select('parent_id')
			->from('{{district}}')
			->join('{{trave}}', '{{trave}}.trave_sregion={{district}}.id')
			->where('{{trave}}.trave_status=2') //只显示已发布的
			->group('parent_id')
			->queryColumn();

		$parent_district = Yii::app()->getDb()->createCommand()
			->select('id, district_name as name')
			->from('{{district}}')
			->where(array('in', 'id', $parent_ids))
			->queryAll();

		echo json_encode(array(
			'self_address'=>array(),
			'parent_address'=>$parent_district
		));
	}
}