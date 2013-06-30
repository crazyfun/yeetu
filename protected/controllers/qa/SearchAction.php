<?php
class SearchAction extends CAction {
    public function run(){
        $this->controller->bc($this->id,array('搜索答案')); 
        $this->controller->pt($this->id,array("搜索答案".($_GET['s']?"_".$_GET['s']:"")."-易途旅游网")); 
        $this->controller->desc("易途旅游网(41ly.cn)——最简单易用方便实惠的旅游线路在线预订平台,一站式个性化旅游服务提供商;跟团游＋自助游＋公司旅游专家;周边游,国内游,出境游,公司旅游;问答中心——解答国内旅游疑问,出境旅游疑问,周边旅游疑问,自助旅游疑问,旅途纠纷,旅游服务,在线提问,在线回复,在线咨询,提出问题,分享知道的东西,评价和体验");
		    $this->controller->kw("问答中心,旅游,旅游网,旅游网站,自助游,跟团游,公司旅游,国内旅游问答,出境旅游问答,周边旅游问答,自助旅游问答");
		if(!empty($_GET['s'])){
			$condition = 't.content like '.Util::q("%".$_GET['s']."%");
			$condition .= ' or subject like '.Util::q("%".$_GET['s']."%");
		}else{
			$condition = '';
		}
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

        $this->controller->render('search',array('dataProvider'=>$dataProvider));
    }
}
?>
