<?php
class SearchAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     $this->controller->bc(array("用户评论"));
     return true;
  }
  protected function do_action(){	
  	
		$model=new TraveComment();
	  $trave_name=$_REQUEST['trave_name'];
    $shit_comment=$_REQUEST['shit_comment'];
    $comment_total=$_REQUEST['comment_total'];
    $comment_scape=$_REQUEST['comment_scape'];
    $comment_shop=$_REQUEST['comment_shop'];
    $comment_stay=$_REQUEST['comment_stay'];
    $comment_dining=$_REQUEST['comment_dining'];
    $comment_cat=$_REQUEST['comment_cat'];
    $comment_guide=$_REQUEST['comment_guide'];
    $comment_server=$_REQUEST['comment_server'];
    $create_time=$_REQUEST['create_time'];
    $search_rating_values=CV::$SEARCH_RATING_VALUES;
    
		if(!empty($trave_name)){
			 $com_condition['线路名称:w%']=$trave_name;
		}
		if(!empty($shit_comment)){
			 $com_condition['乱评论:w%']="是";
		}
		if(!empty($create_time)){
			$com_condition['评论时间:w%']=$create_time;
		}
		
		if(!empty($comment_total)){
			 $com_condition['总体评分:w%']=$search_rating_values[$comment_total];
		}
		
		if(!empty($comment_scape)){
			 $com_condition['景点评分:w%']=$search_rating_values[$comment_scape];
		}
		if(!empty($comment_shop)){
			 $com_condition['购物评分:w%']=$search_rating_values[$comment_shop];
		}
		if(!empty($comment_stay)){
			 $com_condition['住宿评分:w%']=$search_rating_values[$comment_stay];
		}
		
		if(!empty($comment_dining)){
			 $com_condition['用餐评分:w%']=$search_rating_values[$comment_dining];
		}
		if(!empty($comment_cat)){
			 $com_condition['车辆评分:w%']=$search_rating_values[$comment_cat];
		}
		if(!empty($comment_guide)){
			 $com_condition['导游评分:w%']=$search_rating_values[$comment_guide];
		}
		
		if(!empty($comment_server)){
			 $com_condition['客服评分:w%']=$search_rating_values[$comment_server];
		}

		$com_condition_search=Util::com_search_condition($com_condition);
		$this->display('index',array('model'=>$model,'com_condition_search'=>$com_condition_search,'trave_name'=>$trave_name,'shit_comment'=>$shit_comment,'comment_total'=>$comment_total,'comment_scape'=>$comment_scape,'comment_shop'=>$comment_shop,'comment_stay'=>$comment_stay,'comment_dining'=>$comment_dining,'comment_cat'=>$comment_cat,'comment_guide'=>$comment_guide,'comment_server'=>$comment_server,'create_time'=>$create_time));
  } 
}
?>
