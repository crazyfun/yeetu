<?php
class DeleteAction extends BaseAction
{
	protected function do_action()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];
		
		if (!is_array($id)) {
			if ($this->single_delete($id))
				$this->controller->sf('删除保险成功');
			else
				$this->controller->ff('删除保险失败');
		} else {
			if ($count = $this->batch_delete($id))
				$this->controller->sf('删除' . $count . '个保险成功');
		}
		
		$this->controller->redirect(array('index'));
	}
	
	/**
	 * 删除单个
	 * @param int $id
	 */
	protected function single_delete($id)
	{
		$id = (int) $id;
		
		if (empty($id) || (!$model = Insurance::model()->findByPk($id)))
			return false;
		
		return $model->delete();
	}
	
	/**
	 * 删除多个
	 * @param array $ids
	 */
	protected function batch_delete($ids)
	{
		$count = 0;
		
		if (!empty($ids)) {
			$models = Insurance::model()->findAllByPk($ids);
			
			foreach ($models as $model) {
				if ($model->delete())
					$count++;
			}
		}
		
		return $count;
	}
}