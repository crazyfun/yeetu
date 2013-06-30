<?php
class TravedateAction extends  BaseAction{
  
    public function beforeAction(){
      	Util::reset_vars();
       	return true;
    }
  
  protected function do_action(){
  	$trave=new Trave();
    $trave_id=$_REQUEST['trave_id'];
    $start_date=$_REQUEST['start_date'];
    $trave->id=$trave_id;
    $trave_details_sdate=$trave->get_trave_details_sdate($start_date);
    echo $trave_details_sdate;
  }
 
 
    
}
?>
