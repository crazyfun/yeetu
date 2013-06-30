<?php
class Helpindex extends CWidget
{
	public function run()
	{
		$type_list = Help::model()->get_type_list(CV::$HELP_INDEX_IDS);
		$this->render('help_index', array('type_list'=>$type_list));
	} 
}
