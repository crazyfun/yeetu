
<?php
class DingForm extends CFormModel{
    public $answer_id;

    public function rules(){
        return array(
            array("answer_id","safe"),
        );
    }


    public function save(){
    }
}
?>
