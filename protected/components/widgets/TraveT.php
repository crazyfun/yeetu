<?php

class TraveT extends CWidget
{
	public $datas;
	public function run()
	{
		$this->render('trave_t', array('datas'=>$this->datas));
	} 
	

}
