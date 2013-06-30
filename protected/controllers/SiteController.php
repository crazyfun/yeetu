<?php

class SiteController extends Controller
{
		//出发城市的名字
	public $trave_sregion_name="";

	//出发城市的ID号
	public $trave_sregion="";
	
	//出发城市的英文名字
	public $trave_sregion_en_name="";
	//用户发送短信的次数
	public $_send_phone_time=0;
	
	 public function filters() {
		return array(
			'accessControl', // perform access control for CRUD operations
			//'SynchronousFilter',
			'SregionFilter + sregion,index,login,logout,forgotpassword,sendemail,repeatactive,sendphone,phoneverification,imagecode,compeletetrave,survey,searchregion,searchcondition',
			'LoginFilter + forgotpassword,login',
		);
	}
  public function actions()
	{
	
		return array(
			'page'=>array(
				'class'=>'CViewAction',
		  ),
		  'index'=>'application.controllers.site.IndexAction',
		  'login'=>'application.controllers.site.LoginAction',
		  'logout'=>'application.controllers.site.LogoutAction',
		  'forgotpassword'=>'application.controllers.site.ForgotpasswordAction',
		  'sendemail'=>'application.controllers.site.SendemailAction',
		  'repeatactive'=>'application.controllers.site.RepeatactiveAction',
		  'sendphone'=>'application.controllers.site.SendphoneAction',
		  'phoneverification'=>'application.controllers.site.PhoneverificationAction',
		  'registeverification'=>'application.controllers.site.RegisteverificationAction',
		  'imagecode'=>'application.controllers.site.ImagecodeAction',
		  'sregion'=>'application.controllers.site.SregionAction',
		  'compeletetrave'=>'application.controllers.site.CompeletetraveAction',
		  'survey'=>'application.controllers.site.SurveyAction',
		  'searchregion'=>'application.controllers.site.SearchregionAction',
		  'searchcondition'=>'application.controllers.site.SearchconditionAction',
		  'validatemail'=>'application.controllers.site.ValidatemailAction',
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
	 public function FilterLoginFilter($filterChain) {
		if(!Yii::app()->user->isGuest){
			$this->redirect($this->createUrl("site/index"));
		}
	$filterChain->run();
	}
	
	
	public function FilterSregionFilter($filterChain){
		Util::get_sregion();
		$sregion_session=Yii::app()->session->get('sregion_datas');
		$this->trave_sregion=$sregion_session['id'];
		$this->trave_sregion_name=$sregion_session['name'];
		$this->trave_sregion_en_name=$sregion_session['en_name'];
		$filterChain->run();
	}
	
	//跳转到相应的邮件的登录页面
	function redirect_email($email){
		    $tem_link_email=explode("@",$email);
		    $link_email_name="mail.".$tem_link_email[1];
			  $link_email="http://mail.".$tem_link_email[1];
			  $return_str="前往".CHtml::link($link_email_name,$link_email,array('target'=>"_blank"))."收取邮件";
			  return $return_str;
	}

    public function f($msg_code){ 
    	
    	
     if($msg_code == CV::UNLOGIN_USER){
      $this->ff("您还未登录,登录后自动跳转到会员中心。");
     }
     if($msg_code==CV::UNLOGIN_ORDER){
    	$this->ff("您还未登录，只有已登录会员才能预订，您也可以拨打021-56880166直接咨询客服。");
      }
      if($msg_code==CV::SEND_PHONE_FAILED){
     	  $this->ff("发送验证码失败，请检查您的手机号码。");
      }
    }
    
	function init_login_page(){
		$this->layout="site/main1";
		Util::reset_vars();
	}
	function init_page(){
		$this->layout="site/main";
		Util::reset_vars();
	}
}
