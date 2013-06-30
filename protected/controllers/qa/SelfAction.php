<?php
class SelfAction extends CAction {
    public function run(){
        $t = $_GET['t'];

        $user_id = $_GET['user_id'];

        if(empty($user_id)){
            $user_id = Yii::app()->user->id;
        }


        if($t == CV::SELF_ANSWER){
            $this->_display_answer($user_id);
        }else {
            $this->_display_question($user_id);
        }
    }

    private function _display_question($user_id){
        //$this->controller->check_login(CV::UNLOGIN_SELF_QUESTION,);
        $type = CV::SELF_QUESTION;

        if(empty($user_id)){
            $this->controller->check_login(CV::UNLOGIN_SELF_QUESTION,CV::RETURN_QA_SELF,array('t'=>CV::SELF_QUESTION));
        }

        $user = User::model()->findByPk($user_id,array('select'=>'id,user_login'));
        $params = $user->id == Yii::app()->user->id ? array('我的提问') : array($user->user_login."的提问");
        $this->controller->bc($this->id,$params); 
        array_push($params,"易途旅游网");
        $this->controller->pt($this->id,$params); 
        $this->controller->desc("易途旅游网(41ly.cn)——最简单易用方便实惠的旅游线路在线预订平台,一站式个性化旅游服务提供商;跟团游＋自助游＋公司旅游专家;周边游,国内游,出境游,公司旅游;问答中心——解答国内旅游疑问,出境旅游疑问,周边旅游疑问,自助旅游疑问,旅途纠纷,旅游服务,在线提问,在线回复,在线咨询,提出问题,分享知道的东西,评价和体验");
		    $this->controller->kw("问答中心,旅游,旅游网,旅游网站,自助游,跟团游,公司旅游,国内旅游问答,出境旅游问答,周边旅游问答,自助旅游问答");

        $condition = "t.user_id=".intVal($user_id);
        $criteria=new CDbCriteria(array(
			'condition'=>$condition,
			'order'=>'t.id desc',
            'with'=>array('user'=>array('select'=>'user_login'),'category'),
		));

		$dataProvider=new CActiveDataProvider('Question', array(
			'pagination'=>array(
			'pageSize'=>25,
            ),
			'criteria'=>$criteria,
		));

        $this->controller->render("self",array('dataProvider'=>$dataProvider,'t'=>$type,'user'=>$user));
    }

    private function _display_answer($user_id){
        $type = CV::SELF_ANSWER;
        if(empty($user_id)){
            $user_id = Yii::app()->user->id;
        }

        if(empty($user_id)){
            $this->controller->check_login(CV::UNLOGIN_SELF_ANSWER,CV::RETURN_QA_SELF,array('t'=>CV::SELF_ANSWER));
        }

        $user = User::model()->findByPk($user_id,array('select'=>'id,user_login'));
        $params = $user->id == Yii::app()->user->id ? array('我的回答') : array($user->user_login."的回答");
        $this->controller->bc($this->id,$params);
         array_push($params,"易途旅游网");
        $this->controller->pt($this->id,$params);
        $this->controller->desc("易途旅游网(41ly.cn)——最简单易用方便实惠的旅游线路在线预订平台,一站式个性化旅游服务提供商;跟团游＋自助游＋公司旅游专家;周边游,国内游,出境游,公司旅游;问答中心——解答国内旅游疑问,出境旅游疑问,周边旅游疑问,自助旅游疑问,旅途纠纷,旅游服务,在线提问,在线回复,在线咨询,提出问题,分享知道的东西,评价和体验");
		    $this->controller->kw("问答中心,旅游,旅游网,旅游网站,自助游,跟团游,公司旅游,国内旅游问答,出境旅游问答,周边旅游问答,自助旅游问答"); 
        /*
        //$condition = "yt_answer.user_id=".$user_id;
        $criteria=new CDbCriteria(array(
			//'condition'=>$condition,
			'order'=>'t.id desc',
            'with'=>array('answers'=>array('joinType'=>'right join','condition'=>'answers.user_id='.$user_id)),
		));
         */


        $condition = 't.user_id ='.intVal($user_id);
        //$condition = '1';

        $criteria=new CDbCriteria(array(
			'condition'=>$condition,
			'order'=>'t.id desc',
            'with'=>array('question','question.user'=>array('select'=>'id,user_login'),'question.category'),
		));

		$dataProvider=new CActiveDataProvider('Answer', array(
			'pagination'=>array(
                'pageSize'=>10,
            ),
			'criteria'=>$criteria,
		));

        $this->controller->render("self",array('t'=>$type,'user'=>$user,'dataProvider'=>$dataProvider));
    }
}
?>
