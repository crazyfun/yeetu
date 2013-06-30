<?php

class SearchController extends Controller
{
	public $trave_sregion_name="";
	public $trave_esregion_name="";
	public $trave_sregion="";
	
	public $trave_esregion="";
	//出发城市的英文名字
	public $trave_sregion_en_name="";
	public $trave_esregion_en_name="";
	 public function filters(){
		return array(
			'accessControl', // perform access control for CRUD operations
			//'SynchronousFilter',
			'SregionFilter + index',
		);
	}
  public function actions()
	{
		return array(
		  'index'=>'application.controllers.search.IndexAction',
		  'compeleteregion'=>'application.controllers.search.CompeleteregionAction',
		  'compeletetrave'=>'application.controllers.search.CompeletetraveAction',
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
	public function FilterSregionFilter($filterChain) {
		Util::get_sregion();
		$sregion_session=Yii::app()->session->get('sregion_datas');
		$this->trave_sregion=$sregion_session['id'];
		$this->trave_sregion_name=$sregion_session['name'];
		$this->trave_sregion_en_name=$sregion_session['en_name'];
		$filterChain->run();
	
	}
	
  public function f($msg_code){ 

  }
	function init_page(){
		$this->layout="search/main";
		Util::reset_vars();
	}
}
