<?php

class YouJi extends CWidget
{
	public function run()
	{
    $bbs_threads=new BbsThreads();
    $youji_datas=$bbs_threads->get_threads_by_type('2');
		$this->render('you_ji', array('youji_datas'=>$youji_datas));
	} 
	

}
