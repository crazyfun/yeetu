<?php
class FriendLinks extends CWidget
{
	public function run()
	{
		$links = FriendLink::model()->findAll("display!=0",array('order'=>'display asc,id desc','select'=>'name,link'));

		$this->render('friend_links', array('links'=>$links));
	}
}
