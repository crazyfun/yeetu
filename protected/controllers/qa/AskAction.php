<?php
class AskAction extends CAction {
    const ASK_VIEW = "ask";
    public function run(){
        //$this->controller->f(CV::UNLOGIN_ASK);

        $this->controller->bc($this->id,array("我要提问")); 
        $this->controller->pt($this->id);
        $this->controller->desc("易途旅游网(41ly.cn)——最简单易用方便实惠的旅游线路在线预订平台,一站式个性化旅游服务提供商;跟团游＋自助游＋公司旅游专家;周边游,国内游,出境游,公司旅游;问答中心——解答国内旅游疑问,出境旅游疑问,周边旅游疑问,自助旅游疑问,旅途纠纷,旅游服务,在线提问,在线回复,在线咨询,提出问题,分享知道的东西,评价和体验");
		    $this->controller->kw("问答中心,旅游,旅游网,旅游网站,自助游,跟团游,公司旅游,国内旅游问答,出境旅游问答,周边旅游问答,自助旅游问答");
        $this->controller->check_login(CV::UNLOGIN_ASK,CV::RETURN_QA_ASK);
        $questionModel = new QuestionForm();
        $questionModel->catid = QuestionCategory::DEFAULT_ID;
        if($_POST['QuestionForm']){
            $this->_submit($questionModel);
        }
        
        //获取分类的id
        $this->_display(self::ASK_VIEW,array("model"=>$questionModel));
    }

    protected function _display($view,$params){
        $categories = QuestionCategory::model()->get_all_categories();
        $params['categories']=$categories;
        $this->controller->render($view,$params);
    }

    protected function _submit($qm){
        $qm->attributes = $_POST['QuestionForm'];
        if($qm->validate()){
            $qid = $qm->save();
            
            //$this->controller->f(CV::SUBMIT_QUESTION_SUCCESS);
            if(!empty($qid)){
            	  $credit=new Credit();
								$user_id=Yii::app()->user->id;
			      		$credit_desc="会员在线提问:".$_POST['QuestionForm']['subject'].",赠送积分";
            		$credit->set_credit_vars($user_id,"ask_a_question",'1',$credit_desc);
                $this->controller->redirect(array('qa/view','id'=>$qid));
            }
            
            
        }
    }
}
?>
