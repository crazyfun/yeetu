<?php
class CategoryNav extends CWidget {
    public function run(){
        $qc = QuestionCategory::model();
        $categories = $qc->get_all_categories();
        $info = $qc->get_category_info();
        $this->render("category_nav",array('info'=>$info,'categories'=>$categories));
    }
}
?>
