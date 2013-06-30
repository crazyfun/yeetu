<?php
class NewComment extends CWidget
{
	public function run()
	{
		$trave_comment=new TraveComment();
		$trave_sregion=Yii::app()->getController()->trave_sregion;
		$trave_comment_datas=$trave_comment->get_new_comment($trave_sregion);
		$this->render('new_comment', array('trave_comment_datas'=>$trave_comment_datas));
	} 
}
