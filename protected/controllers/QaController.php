<?php
class QaController extends Controller
{
  public $layout = "/layouts/qa/index";
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
			'SregionFilter + index,ask,view,category,self,answer,ding,bestAnswer,search',
		);
	}
	
	
	public function actionIndex()
	{
    $this->breadcrumbs = BC::_($this->id,'index');
    $this->pt($this->getAction()->id,array("问答中心-易途旅游网"));
    $this->desc("易途旅游网(41ly.cn)——最简单易用方便实惠的旅游线路在线预订平台,一站式个性化旅游服务提供商;跟团游＋自助游＋公司旅游专家;周边游,国内游,出境游,公司旅游;问答中心——解答国内旅游疑问,出境旅游疑问,周边旅游疑问,自助旅游疑问,旅途纠纷,旅游服务,在线提问,在线回复,在线咨询,提出问题,分享知道的东西,评价和体验");		
    $this->kw("问答中心,旅游,旅游网,旅游网站,自助游,跟团游,公司旅游,国内旅游问答,出境旅游问答,周边旅游问答,自助旅游问答");
		$this->render('index');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'ask'=>'application.controllers.qa.AskAction',
			'view'=>'application.controllers.qa.ViewAction',
			'category'=>'application.controllers.qa.CategoryAction',
			'self'=>'application.controllers.qa.SelfAction',
			'answer'=>'application.controllers.qa.AnswerAction',
			'ding'=>'application.controllers.qa.DingAction',
			'bestAnswer'=>'application.controllers.qa.BestAnswerAction',
			'search'=>'application.controllers.qa.SearchAction',
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
    public function actionLoadAnswers(){
        $id=$_GET['id'];
        $answers = Answer::model()->with(array('user'=>array('select'=>'user.id,user_login,head_img')))->findAll(array('condition'=>"question_id=".$id,'order'=>'t.id asc'));
        $this->renderPartial("_answers",array('answers'=>$answers));
    }
    
public function FilterSregionFilter($filterChain){
		Util::get_sregion();
		$sregion_session=Yii::app()->session->get('sregion_datas');
		$this->trave_sregion=$sregion_session['id'];
		$this->trave_sregion_name=$sregion_session['name'];
		$this->trave_sregion_en_name=$sregion_session['en_name'];
		$filterChain->run();
	}

    public function f($msg_code){
        if($msg_code == CV::SUBMIT_QUESTION_SUCCESS){
            $this->sf("问题提交成功");
        }else if($msg_code == CV::SUBMIT_QUESTION_FAILED){
            $this->ff("");
        }else if($msg_code == CV::UNLOGIN_ASK){
            $this->tf("您必须先登录才能提问");
        }else if($msg_code == CV::UNLOGIN_ANSWER){
            $this->tf("您必须先登录才能回答");
        }else if($msg_code == CV::UNLOGIN_SELF_QUESTION){
            $this->tf("您必须先登录才能查看您的提问");
        }else if($msg_code == CV::UNLOGIN_SELF_ANSWER){
            $this->tf("您必须先登录才能查看您的回答");
        }else if($msg_code == CV::QA_SUBMIT_ANSWER_SUCCESS){
            $this->sf("回答提交成功");
        }
    }
}
