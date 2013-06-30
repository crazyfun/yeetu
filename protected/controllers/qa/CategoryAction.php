<?php
class CategoryAction extends CAction {
    public function run(){
        $type = $_GET['t'];
        $id = $_GET['id'];

        if(!empty($id)){
            $category = QuestionCategory::model()->findByPk($id);
            if($category == null){
                $id = QuestionCategory::ALL;
            }else {
                $condition = " and t.category_id=".$id;
            }
        }

        //待解决
        if($type == CV::CAT_Q_UNSOLVED){
            $condition .= " and t.status=".Question::UNSOLVED;
            $s = "待解决问题";
        }else if($type == CV::CAT_Q_SOLVED){
            $condition .= " and t.status=".Question::SOLVED;
            $s = "已解决问题";
        }else if($type == CV::CAT_Q_HOT){
            $condition .= " and t.views>".CV::HOT_VIEW_NUM;
            $s = "热门问题";
        }else{
            $type = CV::CAT_Q_LATEST;
            $s = "最新问题";
        }

        $tabOn = array($type=>'wj_tab_d1');

        $dataProvider = $this->_get_question_provider($condition,$type);
        $categories = QuestionCategory::model()->get_categories_for_select();

        $data = compact("dataProvider","categories",'tabOn','category');

        if($category == null){
            $this->controller->bc($this->id);
            $this->controller->pt($this->id,array($s."-易途旅游网"));
        }else {
            $this->controller->bc($this->id,$category->name.'问答');
            $this->controller->pt($this->id,array($category->name.'问答',$s."-易途旅游网"));
        }
        
        $this->controller->desc("易途旅游网(41ly.cn)——最简单易用方便实惠的旅游线路在线预订平台,一站式个性化旅游服务提供商;跟团游＋自助游＋公司旅游专家;周边游,国内游,出境游,公司旅游;问答中心——解答国内旅游疑问,出境旅游疑问,周边旅游疑问,自助旅游疑问,旅途纠纷,旅游服务,在线提问,在线回复,在线咨询,提出问题,分享知道的东西,评价和体验");
		    $this->controller->kw($category->name.'问答,'.$s.",问答中心,旅游,旅游网,旅游网站,自助游,跟团游,公司旅游,国内旅游问答,出境旅游问答,周边旅游问答,自助旅游问答");
		
		
        $this->controller->render("category",$data);
    }

    private function _display(){
        $condition = "";
        return $this->_get_question_provider($condition);
    }

    private function _get_question_provider($condition){
        $criteria=new CDbCriteria(array(
			'condition'=>"1".$condition,
			'order'=>'t.id desc',
            'with'=>array('user'=>array('select'=>'user_login'),'category'),
		));

		$dataProvider=new CActiveDataProvider('Question', array(
			'pagination'=>array(
               'pageSize'=>30,
            ),
			'criteria'=>$criteria,
		));

        return $dataProvider;
    }

}
?>
