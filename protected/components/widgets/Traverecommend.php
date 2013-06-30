<?php
class Traverecommend extends CWidget
{
	public $trave_category;
	public $trave_sregion;
	public function run(){
		$trave=new Trave();
		$trave_recommend=$trave->get_trave_recommend($this->trave_category,$this->trave_sregion);
		if(!empty($trave_recommend)){
			if(($this->trave_category=='4')||($this->trave_category=='5')){
				 $this->render("trave_recommend_img",array('trave_recommend'=>$trave_recommend,'trave'=>$trave));	
			}else{
			   $this->render("trave_recommend",array('trave_recommend'=>$trave_recommend,'trave'=>$trave));	
			}
		}
    
	}							 												 					

}