<?php
class UserController extends Controller
{
 public $head_img="";
 public $user_id="";
 public $user_login="";
 
 	//出发城市的名字
	public $trave_sregion_name="";
	
	//出发城市的英文名字
	public $trave_sregion_en_name="";
	
	//出发城市的ID号
	public $trave_sregion="";

 public function filters() {
		return array(
			'accessControl', // perform access control for CRUD operations
			//'SynchronousFilter',
			'HeadFilter + profile,index,order,orderview,addcoupon,coupon,credit,reviews,head,password,distribution,visitors,email,editemail,useractive,repeatactive,editin,headiframe,cancelorder,editdis,deletedis,editvis,deletevis,history,edituserphone',
			'SregionFilter +profile,index,order,orderview,addcoupon,coupon,credit,reviews,head,password,distribution,visitors,email,editemail,useractive,repeatactive,editin,headiframe,cancelorder,editdis,deletedis,editvis,deletevis,history,edituserphone',

		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
   
		);
	}
	public function actions()
	{
		return array(
		  'profile'=> 'application.controllers.user.ProfileAction',
		  'index' => 'application.controllers.user.IndexAction',
		  'editin'=>'application.controllers.user.EditinAction',
		  'editemail'=>'application.controllers.user.EditemailAction',
		  'repeatactive'=>'application.controllers.user.RepeatactiveAction',
		  'useractive'=>'application.controllers.user.UseractiveAction',
		  'order'=>'application.controllers.user.OrderAction',
		  'message'=>'application.controllers.user.MessageAction',
		  'orderview'=>'application.controllers.user.OrderviewAction',
		  'cancelorder'=>'application.controllers.user.CancelorderAction',
		  'coupon'=>'application.controllers.user.CouponAction',
		  'addcoupon'=>'application.controllers.user.AddcouponAction',
		  'credit'=>'application.controllers.user.CreditAction',
		  'reviews'=>'application.controllers.user.ReviewsAction',
		  'head'=>'application.controllers.user.HeadAction',
		  'headiframe'=>'application.controllers.user.HeadiframeAction',
		  'password'=>'application.controllers.user.PasswordAction',
		  'distribution'=>'application.controllers.user.DistributionAction',
		  'editdis'=>'application.controllers.user.EditdisAction',
		  'deletedis'=>'application.controllers.user.DeletedisAction',
		  'visitors'=>'application.controllers.user.VisitorsAction',
		  'editvis'=>'application.controllers.user.EditvisAction',
		  'deletevis'=>'application.controllers.user.DeletevisAction',
		  'email'=>'application.controllers.user.EmailAction',
		  'subscribe'=>'application.controllers.user.SubscribeAction',
		  'history'=>'application.controllers.user.HistoryAction',
		  'edituserphone'=>'application.controllers.user.EdituserphoneAction',

		);
	}
public function FilterSynchronousFilter($filterChain){
    require_once('config.inc.php');
  	require_once('uc_client/client.php');
  	$user_id=Yii::app()->user->id;
  	if(!empty($user_id)){
  	 $user_datas=User::model()->find(array('select'=>'user_login,credit','condition'=>'id=:user_id','params'=>array(':user_id'=>$user_id)));
  	 $user_login=$user_datas->user_login;
  	 $user_credit=$user_datas->credit;
  	 
  	 list($dz_uid,$dz_user_login,$dz_user_email) = uc_get_user($user_login);
		 $dz_credit=uc_user_getcredit(1,$dz_uid,1);
		 if($user_credit!=$dz_credit){
			 $update_credit_datas['credit']=$dz_credit;
			 $credit_result=User::model()->update_table_datas($user_id,$update_credit_datas,array());
		 }
		}
	
		$filterChain->run();
	}
	public function FilterHeadFilter($filterChain) {
		//获得用户的头像和ID
		$user_id=$_GET['user_id'];
		$user_id=empty($user_id)?(Yii::app()->user->id):$user_id;
		if(!empty($user_id)){
			$user= User::model()->findByPk($user_id);
			$this->head_img=$user->get_user_head(70,70);
			$this->user_id=$user_id;
			$this->user_login = $user->user_login;
		}
		$filterChain->run();
	}
	
	
	public function FilterSregionFilter($filterChain) {
		Util::get_sregion();
		$sregion_session=Yii::app()->session->get('sregion_datas');
		$this->trave_sregion=$sregion_session['id'];
		$this->trave_sregion_name=$sregion_session['name'];
		$this->trave_sregion_en_name=$sregion_session['en_name'];
		$filterChain->run();
	
	}
	
	
	
  //获取航班信息
	function travel_flight($params){
	  $start_date_id=$params['start_date_id'];
	  $trave_id=$params['trave_id'];
		$trave_date=strftime("%Y-%m-%d", strtotime($params['start_date']));
		$trave_date_class=new Travedate();
    $trave_date_datas=$trave_date_class->get_table_datas($start_date_id,array());
    $flight_id=$trave_date_datas->flight_id;
    $back_flight_id=$trave_date_datas->back_flight_id;
		$trave_flight=new TraveFlight();
		$trave_flight_datas=$trave_flight->get_table_datas($flight_id,array());
		$back_trave_flight_datas=$trave_flight->get_table_datas($back_flight_id,array());
		$flight_package=$this->renderPartial("trave_flight",array('trave_flight'=>$trave_flight,'trave_flight_datas'=>$trave_flight_datas,'back_trave_flight_datas'=>$back_trave_flight_datas,'trave_date'=>$trave_date,'trave_id'=>$trave_id),true);
		return $flight_package;
	}
	
	
	//获取酒店信息
	function travel_hotels($params){

		$room_id=$params['room_id'];
		$trave_date=strftime("%Y-%m-%d", strtotime($params['start_date']));
		$trave_route_number=$params['trave_route_number'];
		$room_nums=$params['room_nums'];
		$hotel_room=new HotelRoom();
	  $conditions="id=:room_id";
	  $params=array(':room_id'=>$room_id);
		$hotel_room_datas=$hotel_room->findAll($conditions,$params);
		$hotel_package=$this->renderPartial("trave_hotels",array('hotel_room_datas'=>$hotel_room_datas,'trave_date'=>$trave_date,'trave_route_number'=>$trave_route_number,'room_nums'=>$room_nums),true);
		return $hotel_package;
	
	}
	
	
	
		//获取保险信息
	function travel_insurance($params){
   $insurance_ids=$params['insurance_ids'];
   $adult_nums=$params['adult_nums'];
   $child_nums=$params['child_nums'];
	 $insurance=new Insurance();
	 $conditions=" FIND_IN_SET(id,'$insurance_ids')>0 ORDER BY id ASC";
	 $insurance_datas=$insurance->findAll($conditions,array());
	 $insurance_content=$this->renderPartial("trave_insurance",array('insurance_datas'=>$insurance_datas,'adult_nums'=>$adult_nums,'child_nums'=>$child_nums),true);
		return $insurance_content;
	}
	
	
			//获取联系人信息
	function travel_contacts($params){
		$order_id=$params['order_id'];
    $ordercontact=new Ordercontact();
    $condition="trave_order_id=:trave_order_id ORDER BY main_contact DESC";
    $params=array(':trave_order_id'=>$order_id);
    $ordercontact_datas=$ordercontact->findAll($condition,$params);
	  $contacts_content=$this->renderPartial("trave_contacts",array('travel_people'=>$ordercontact_datas),true);
		return $contacts_content;
	}
	
	
	
	
	
	
	 public function f($msg_code){ 
     if($msg_code == CV::UNLOGIN_USER){
       $this->ff("您还未登录,登录后自动跳转到会员中心");
     }
     if($msg_code == CV::SUCCESS_OPERATE){
     	 $this->sf("操作成功");
     }
     if($msg_code == CV::SUCCESS_EDITIN){
     	 $this->sf("个人信息修改成功");
     }
     if($msg_code == CV::SUCCESS_PASSWORD){
     	 $this->sf("密码修改成功");
     }
     if($msg_code == CV::ERROR_DATABASE){
     	 $this->ff("数据库操作错误");
     }
     if($msg_code == CV::ERROR_CODE){
     	 $this->ff("验证码不正确,请重新验证");
     }
     if($msg_code == CV::ERROR_USER_PHONE){
     	 $this->ff("手机号码相同");
     }
    }

	function redirect_email($email){
		    $tem_link_email=explode("@",$email);
		    $link_email_name="mail.".$tem_link_email[1];
			  $link_email="http://mail.".$tem_link_email[1];
			  $return_str="前往".CHtml::link($link_email_name,$link_email,array('target'=>"_blank"))."收取邮件";
			  return $return_str;
	}
	function init_page(){
		$this->layout="user/main";
		Util::reset_vars();
	}
}
