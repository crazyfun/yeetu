<?php

class RegisterController extends Controller
{
	//出发城市的名字
	public $trave_sregion_name="";
	//出发城市的英文名字
	public $trave_sregion_en_name="";
	//出发城市的ID号
	public $trave_sregion="";
	 public function filters() {
		return array(
			'accessControl',
			'LoginFilter + index,registe,useractive,repeatactive',
			//'SynchronousFilter',
			'SregionFilter + index,useractive,repeatactive',
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
	
	
	
  public function actions()
	{
		 return array(
		  'registe'=>'application.controllers.register.RegisteAction',
		  'useractive'=>'application.controllers.register.UseractiveAction',
		  'repeatactive'=>'application.controllers.register.RepeatactiveAction'
		);
	}
	//首页
	public function actionIndex(){
		$this->init_page();
		$this->pt($this->getAction()->id,array("会员注册-易途旅游网"));
		$model=new User;
		$this->render('index',array('model'=>$model));
	}

	function redirect_email($email){
		    $tem_link_email=explode("@",$email);
		    $link_email_name="mail.".$tem_link_email[1];
			  $link_email="http://mail.".$tem_link_email[1];
			  $return_str="前往".CHtml::link($link_email_name,$link_email,array('target'=>"_blank"))."收取邮件";
			  return $return_str;
	}
		public function f($msg_code){ 
     if($msg_code==CV::REGISTE_ACTIVECODE){
    	$this->ff("激活码不正确,请重新激活");
      }
     if($msg_code==CV::SEND_PHONE_FAILED){
     	$this->ff("发送验证码失败，请检查你的手机号码或重新注册。");
     }

    }
	function init_page(){
		$this->layout="register/main";
		Util::reset_vars();
	}
}
