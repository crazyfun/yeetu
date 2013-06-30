<?php
class QuestionListPanel extends CWidget
{
    public $type;
    public function run(){
        if($this->type == CV::UNSOLVED_QUESTION){
            $this->_render_unsolved_question();
        }else if($this->type == CV::SOLVED_QUESTION){
            $this->_render_solved_question();
        }else if($this->type == CV::LATEST_ZHOUBIAN){
            $this->_render_latest_zhoubian();
        }else if($this->type == CV::LATEST_GUONEI){
            $this->_render_latest_guonei();
        }else if($this->type == CV::LATEST_CHUJING){
            $this->_render_latest_chujing();
        }else if($this->type == CV::LATEST_ZIYOU){
            $this->_render_latest_ziyou();
        }
    }

    private function _render_unsolved_question(){
        $questions = Question::model()->get_unsolved_question(10);
        $title = "待解决问题";
        $url = array("qa/category/t/unsolved/id");
        $this->render("question_list",array("title"=>$title,"questions"=>$questions,"url"=>$url));
    }

    private function _render_solved_question(){
        $questions = Question::model()->get_solved_question(10);
        $title = "已解决问题";
        $url = array("qa/category/t/solved/id");
        $this->render("question_list",array("title"=>$title,"questions"=>$questions,"url"=>$url));
    }

    private function _render_latest_zhoubian(){
        $questions = Question::model()->get_latest_zhoubian(10);
        $title = "周边旅游最新问题";
        $url = array("qa/category/t/latest/id/3");
        $this->render("question_list",array("title"=>$title,"questions"=>$questions,"url"=>$url));
    }

    private function _render_latest_guonei(){
        $questions = Question::model()->get_latest_guonei(10);
        $title = "国内旅游最新问题";
        $url = array("qa/category/t/latest/id/1");
        $this->render("question_list",array("title"=>$title,"questions"=>$questions,"url"=>$url));
    }

    private function _render_latest_chujing(){
        $questions = Question::model()->get_latest_chujing(10);
        $title = "出境旅游最新问题";
        $url = array("qa/category/t/latest/id/2");
        $this->render("question_list",array("title"=>$title,"questions"=>$questions,"url"=>$url));
    }

    private function _render_latest_ziyou(){
        $questions = Question::model()->get_latest_ziyou(10);
        $title = "自助旅游最新问题";
        $url = array("qa/category/t/latest/id/4");
        $this->render("question_list",array("title"=>$title,"questions"=>$questions,"url"=>$url));
    }
}
?>
