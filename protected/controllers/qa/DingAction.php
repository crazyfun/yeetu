<?php
class DingAction extends CAction {
    public function run(){
        $id=$_GET['id'];
        $answer = Answer::model()->findByPk($id);
        if($answer != null && $answer->user_id !=Yii::app()->user->id){
            $answer->ding++;
            if($answer->save()){
                echo $answer->ding;
                Yii::app()->end();
            }
        }
        echo 0;
        Yii::app()->end();

    }
}
?>
