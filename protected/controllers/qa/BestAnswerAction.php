<?php
class BestAnswerAction extends CAction {
    public function run(){
        $id=$_GET['id'];
        $answer = Answer::model()->with('question')->findByPk($id);
        if($answer != null){
            $answer->question->best_id=$id;
            $answer->question->status = Question::SOLVED;
            if($answer->question->save()){
                echo 1;
                Yii::app()->end();
            }
        }
        echo 0;
        Yii::app()->end();
    }
}
?>
