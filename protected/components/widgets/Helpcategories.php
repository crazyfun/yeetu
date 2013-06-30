<?php
class Helpcategories extends CWidget
{
	public function run(){
		$rows = Help::model()->get_type_list();
		$this->render("help_category",array('rows' => $rows));
	}
}