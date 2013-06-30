<?php
class ViewAction extends CAction {
    public function run(){
        $id = $_GET['id'];

        $answerModel = new AnswerForm();
        $answerModel->question_id = $id;
        $key= Yii::app()->user->getFlash('rc');
        $content = Util::get_return_content($key);
        if(!empty($content)){
            $answerModel->content = $content;
            Util::us($key);
        }

        $question = Question::model()->with(array('answer_count','category','user'=>array('select'=>'qu.id,qu.user_login,qu.head_img','alias'=>'qu'),'best_answer'
            ,'best_answer.user'=>array('select'=>'au.id,au.user_login,au.head_img','alias'=>'au')
        ))->findByPk($id);
        
        if(isset($_POST['AnswerForm'])){
            $this->_submit($answerModel,$question);
        }
       
        if($question == null){
            $this->controller->redirect(array("qa/index"));
        }


        //增加浏览次数
        $question->increase_views();

        $answers = Answer::model()->with(array('user'=>array('select'=>'user.id,user_login,head_img')))->findAll(array('condition'=>"question_id=".$id." and t.id!=".$question->best_id,'order'=>'t.id asc'));
        
        $this->controller->bc($this->id,array($question->category->name."问答"=>array('qa/category','id'=>$question->category->id), $question->subject));

        $this->controller->pt($this->id,array($question->category->name.'问答',$question->subject));
		$this->controller->desc("易途旅游问答_".$question->subject);
		$this->controller->kw("易途旅游问答_".$question->subject);

        $is_over = $question->is_over();
        if(!$is_over){
            $distance = $question->distance_to_over();
        }

        $datas = compact("question",'is_over','distance','answerModel','answers');
        $this->controller->render("view",$datas);
    }

    protected function _display(){
    }

    protected function _submit($an,$question){
        $an->attributes = $_POST['AnswerForm'];
        $result = array();
        if(Yii::app()->user->isGuest){
            $msg = '您必须先登录才能回答问题，点击确定跳转到登录页面.';
            $params = array('return'=>CV::RETURN_QA_ANSWER,'id'=>$an->question_id,'sp'=>'submit-answer');
            $key = Util::record_return_content($an->content);
            if(!empty($key)){
                $params['rc'] = $key;
            }
            $result = Util::ajax_msg(CV::AJAX_UNLOGIN_CODE,$msg,$params);
            echo $result;
            Yii::app()->end();
        }else if(Yii::app()->user->id == $question->user->id){
            $msg = "您不能回答自己提出的问题";
            $result = Util::ajax_msg(CV::AJAX_SUBMIT_ERROR_CODE,$msg);
            echo $result;
            Yii::app()->end();
        }else {
            $an->attributes = $_POST['AnswerForm'];
            $errors = CActiveForm::validate($an,'content');
            if(!empty($errors)){
                $e = json_decode($errors);
                $msg = $e->AnswerForm_content[0];
                if(!empty($msg)){
                $result = Util::ajax_msg(CV::AJAX_SUBMIT_ERROR_CODE,$msg);
                echo $result;
                Yii::app()->end();
                }
            }
            if($an->save()){
            	
            	  $question_id=$an->question_id;
            	  $questionModel = new Question();
            	  $question_datas=$questionModel->findByPk($question_id);
            	  $question_title=$question_datas->subject;
            	  $credit=new Credit();
								$user_id=Yii::app()->user->id;
			      		$credit_desc="会员在线回答:".$question_title.",赠送积分";
            		$credit->set_credit_vars($user_id,"answer_a_question",'1',$credit_desc);
            		
            		
                $msg = '您的回答已成功提交';
                $result = Util::ajax_msg(CV::AJAX_SUBMIT_SUCCESS_CODE,$msg,array('qid'=>$an->question_id));
                echo $result;
                Yii::app()->end();
            }
        }
    }
}
?>
