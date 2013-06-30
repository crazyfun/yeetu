<?php

class GongLue extends CWidget
{
	public function run()
	{

    $bbs_threads=new BbsThreads();
    $gonglue_datas=$bbs_threads->get_threads_by_type('1');
		$this->render('gong_lue', array('gonglue_datas'=>$gonglue_datas));
	} 
	

}
