<?php

class TravelPractical extends CWidget
{
	public $type_id;
	public function run(){
		$help=new Help();
		$help_datas=$help->get_type_list(array($this->type_id));
    $this->render("travel_practical",array('help_datas'=>$help_datas));
 
	}							 												 					
	
	

}