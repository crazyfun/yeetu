<?php
class TravelinfoAction extends  BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login(CV::UNLOGIN_ORDER,'',array());
    	$this->controller->init_order_page();
    	$this->controller->desc("易途旅游网(41ly.cn)——最简单易用方便实惠的旅游线路在线预订平台,一站式个性化旅游服务提供商;跟团游＋自助游＋公司旅游专家;周边游,国内游,出境游,公司旅游;");
		  $this->controller->kw("旅游,旅游网,旅游网站,自助游,跟团游,公司旅游");
    	return true;
    }
  protected function do_action(){
		  $trave_id=$_POST['trave_id'];
		  $adult_nums=$_POST['hidden_adult_nums'];
		  $child_nums=$_POST['hidden_child_nums'];
		  $adult_price=$_POST['hidden_adult_price'];
		  $child_price=$_POST['hidden_child_price'];
		  $start_time=$_POST['hidden_start_date'];
		  $total_price=$_POST['hidden_total_price'];
		  $insurance_ids=$_POST['hidden_insurance_ids'];
		  $start_date_id=$_POST['start_date_id'];
		  $trave=new Trave();
		  $trave_datas=$trave->get_table_datas($trave_id);
		  
		  $this->controller->pt($this->id,array($trave_datas->trave_name.'旅游线路在线预定_游客信息-易途旅游网'));
		  
		  $this->controller->set_trave_category($trave_datas->trave_category);
		
      	$user_datas=$this->get_contact_datas($user_id);
		  	$ordercontact=new Ordercontact("OrderContact");
		  	$ordercontact->contact_name=$user_datas['real_name'];
		  	$ordercontact->contact_phone=$user_datas['user_phone'];
		  	$ordercontact->contact_email=$user_datas['email'];
		  	$ordercontact->contact_address=$user_datas['user_address'];
		  	$ordercontact->area_code=$user_datas['user_code'];
		  	$ordercontact->user_telephone=$user_datas['user_telephone'];
		  	$ordercontact->order_agree=true;
		  	
		  	$visitor_number=$adult_nums+$child_nums;
        $visitor_datas=$this->get_visitor_datas($user_id,$visitor_number);
        $ii=1;
        $travel_people=array();
        foreach($visitor_datas as $key => $value){
        	$travel_people[$ii]['real_name']=$value['contact_name'];
      		$travel_people[$ii]['user_phone']=$value['contact_phone'];
      		$ii++;
		
        }
		  	$this->get_contact_datas($user_id);
		  	$this->display('travel_info',array('model'=>$ordercontact,'trave_id'=>$trave_id,'start_time'=>$start_time,'total_price'=>$total_price,'insurance_ids'=>$insurance_ids,'adult_nums'=>$adult_nums,'child_nums'=>$child_nums,'adult_price'=>$adult_price,'child_price'=>$child_price,'travel_people'=>$travel_people,'start_date_id'=>$start_date_id));
		  	
		 
  }
  
  public function get_contact_datas($user_id=""){
  	$user_id=empty($user_id)?Yii::app()->user->id:$user_id;
		$user_contact=new Usercontact();
		$conditions="create_id=:user_id AND contact_type=:contact_type ORDER BY create_time DESC LIMIT 1";
		$params=array(':user_id'=>$user_id,':contact_type'=>'1');
		$user_contact_datas=$user_contact->findAll($conditions,$params);
		$contact_datas=$user_contact_datas[0];
		$return_datas=array();
		if(empty($contact_datas)){
		   $user=new User();
		   $user_datas=$user->get_table_datas($user_id);
		   $return_datas['real_name']=$user_datas->real_name;
		   $return_datas['user_phone']=$user_datas->user_phone;
		   $user_telephone=$user_datas->user_telephone;
		   $tem_user_telephone=explode('-',$user_telephone);
		   if(count($tem_user_telephone)>=2){
		   	$return_datas['user_code']=$tem_user_telephone[0];
		    $return_datas['user_telephone']=$tem_user_telephone[1];
		   }else{
		   	$return_datas['user_telephone']=$user_datas->user_telephone;
		   }
		   $return_datas['email']=$user_datas->email;
		   $return_datas['user_address']=$user_datas->user_address;
		}else{
		   $return_datas['real_name']=$contact_datas->contact_name;
		   $return_datas['user_phone']=$contact_datas->contact_phone;
		   $user_telephone=$contact_datas->contact_telephone;
		   $tem_user_telephone=explode('-',$user_telephone);
		   if(count($tem_user_telephone)>=2){
		   	$return_datas['user_code']=$tem_user_telephone[0];
		    $return_datas['user_telephone']=$tem_user_telephone[1];
		   }else{
		   	$return_datas['user_telephone']=$contact_datas->contact_telephone;
		   }
		   $return_datas['email']=$contact_datas->contact_email;
		   $return_datas['user_address']=$contact_datas->contact_address;	
		}
		return $return_datas;
 
  }
  
  
  function get_visitor_datas($user_id,$visitor_number){
  	$user_id=empty($user_id)?Yii::app()->user->id:$user_id;
		$user_contact=new Usercontact();
		$conditions="create_id=:user_id AND contact_type=:contact_type ORDER BY create_time DESC LIMIT $visitor_number";
		$params=array(':user_id'=>$user_id,':contact_type'=>'2');
		$user_contact_datas=$user_contact->findAll($conditions,$params);
		return $user_contact_datas;
  	
  }
 
 
    
}
?>
