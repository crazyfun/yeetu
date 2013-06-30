<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
  	 $this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
     $this->controller->init_page();
     $this->controller->bc(array("公司旅游"));
     return true;
  }
  protected function do_action(){	
  	$model=new GroupCustomize();
    if(isset($_REQUEST['search_submit'])){
    	
    	$start_time=$_REQUEST['start_time'];
      $start_region=$_REQUEST['start_region'];
      $end_region=$_REQUEST['end_region'];
      $contact_name=$_REQUEST['contact_name'];
      $company_name=$_REQUEST['company_name'];
      $create_time=$_REQUEST['create_time'];
      $status=$_REQUEST['status'];
      if(!empty($start_time)){
      	$com_condition['出发时间:w%']=$start_time;
      }
      if(!empty($start_region)){
      	$com_condition['出发城市:w%']=$start_region;
      }
      if(!empty($end_region)){
      	$com_condition['目的地:w%']=$end_region;
      }
      if(!empty($contact_name)){
      	$com_condition['联系人/联系手机:w%']=$contact_name;
      }
      if(!empty($company_name)){
      	$com_condition['公司名称:w%']=$company_name;
      }
      
      if(!empty($create_time)){
      	$com_condition['提交时间:w%']=$create_time;
      }
      if(!empty($status)){
      	$com_condition['处理状态:w%']=$status;
      }
      $com_condition_search=Util::com_search_condition($com_condition);
    }
		$this->display('index',array('model'=>$model,'com_condition_search'=>$com_condition_search,'start_time'=>$start_time,'start_region'=>$start_region,'end_region'=>$end_region,'contact_name'=>$contact_name,'company_name'=>$company_name,'create_time'=>$create_time,'status'=>$status));
  } 
}
?>
