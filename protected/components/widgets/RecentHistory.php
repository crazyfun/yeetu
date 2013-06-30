<?php
class RecentHistory extends CWidget
{

	public function run(){
		$trave_history=new TraveHistory();
		$trave_history_datas=$trave_history->get_recent_history();
		$this->render('recent_history',array('trave_history'=>$trave_history_datas));
	}

}