<?php
class QuestionForm extends CFormModel{
    public $id;
    public $subject;
    public $content;
    public $catid;

    public function rules(){
        return array(
            array("id","safe"),
            array("subject,content,catid","required"),
            array("subject","length",'encoding'=>'utf-8','max'=>100,'tooLong'=>'最多只能输入50个字'),
            array("content","length",'encoding'=>'utf-8','max'=>3000,'tooLong'=>'最多只能输入3000个字'),
        );
    }

    public function attributeLabels(){
        return array(
            'subject'=>'问题标题',
            'content'=>'问题内容',
        
        );
    }


    public function save(){
        $question = new Question();
        $question->id = $this->id;
        $question->subject = CHtml::encode($this->subject);
        $question->content = CHtml::encode($this->content);
        $question->category_id= CHtml::encode($this->catid);
        $question->user_id = Yii::app()->user->id;

        if(empty($this->id)){
            $question->create_time= time();
            $question->modify_time = 0;
            $question->status = Question::UNSOLVED;
            $question->views = 0;
            $question->best_id = 0;
        }else {
            $question->modify_time = time();
        }

        if($question->save()){
            return $question->id;
        }else{
            return false;
        }
    }
}
?>
