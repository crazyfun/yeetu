<?php

class TravelSearch extends CWidget
{
	public function run(){
	
		$sregion_datas=$return_array=Cfenzhan::model()->get_sfenzhan_select();
    $this->render("travel_search",array('sregion_datas'=>$sregion_datas));
	}							 												
}