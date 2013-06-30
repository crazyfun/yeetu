<?php
class AnswerForm extends CFormModel{
    public $id;
    public $question_id;
    public $content;

    public function rules(){
        return array(
            array("id,content","safe"),
            array("content,question_id","required",'message'=>'回答内容不能为空'),
            array("content","length",'encoding'=>'utf-8','max'=>1000,'tooLong'=>'最多只能输入1000个字'),
        );
    }



    public function save(){
        $answer = new Answer();
        if(empty($this->id)){
            $answer->content = CHtml::encode($this->content);
        }else {
            $answer = $answer->findByPk($this->id);
            if($answer != null){
                $answer->content = CHtml::encode($this->content);
            }else {
                return false;
            }
        }
        $answer->create_time = time();
        $answer->user_id = Yii::app()->user->id;
        $answer->question_id = $this->question_id;

        return $answer->save();
    }

}
?>
