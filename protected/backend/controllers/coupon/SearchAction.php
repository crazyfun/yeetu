<?php
class SearchAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     $this->controller->bc(array("抵用劵管理"));
     return true;
  }
  protected function do_action(){	
		$model=new Coupon();
	  $coupon_numbe=$_REQUEST['coupon_numbe'];
		if(!empty($coupon_numbe)){
			 $com_condition['抵用劵号码:w%']=$coupon_numbe;
		}

		$com_condition_search=Util::com_search_condition($com_condition);

		$this->display('index',array('model'=>$model,'com_condition_search'=>$com_condition_search,'coupon_numbe'=>$coupon_numbe));
  } 
}
?>
