<?php
class TravelcommentsAction extends BaseAction{
  
    protected function beforeAction(){
      if(Yii::app()->request->isAjaxRequest){
      	$trave_id=$_REQUEST['trave_id'];
      	$this->controller->check_login(CV::UNLOGIN_COMMENT,CV::RETURN_TRAVE_COMMENT,array('trave_id'=>$trave_id));
      	Util::reset_vars();
       	return true;
      }else{
      	return false;
      }
    }
  protected function do_action(){
	  if(Util::check_ip()){
        $trave_id=$_REQUEST['trave_id'];
			  $comment_content=$_REQUEST['comment_content'];
			  $comment_scape=$_REQUEST['comment_scape'];
			  $comment_stay=$_REQUEST['comment_stay'];
			  $comment_dining=$_REQUEST['comment_dining'];
			  $comment_cat=$_REQUEST['comment_cat'];
			  $comment_guide=$_REQUEST['comment_guide'];
			  $comment_server=$_REQUEST['comment_server'];
			  $comment_shop=$_REQUEST['comment_shop'];
			  $total_rating=$_REQUEST['total_rating'];
			  //$verification_code=$_REQUEST['verification_code'];
			 // $img_code=Yii::app()->session->get("comment__img_code__");
			 // if($img_code==md5(strtoupper($verification_code))){
			  
			  $comment_content_lenth=Util::strLength($comment_content);
		if($comment_content_lenth<=100){
			  $trave_comment=new TraveComment();
			  $trave_comment->trave_id=$trave_id;
			  $trave_comment->comment_scape=$comment_scape;
			  $trave_comment->comment_shop=$comment_shop;
			  $trave_comment->comment_stay=$comment_stay;
			  $trave_comment->comment_dining=$comment_dining;
			  $trave_comment->comment_cat=$comment_cat;
			  $trave_comment->comment_guide=$comment_guide;
			  $trave_comment->comment_server=$comment_server;
			  $trave_comment->comment_content=nl2br($comment_content);
			  
			  if(!empty($total_rating))
			     $trave_comment->comment_total=$total_rating;
			  $result=$trave_comment->insert_trave_comment();
			  
			  if($result){
			  	
			  	 $trave=new Trave();
			  	 $trave_datas=$trave->get_table_datas($trave_id);
           $trave_name=$trave_datas->trave_name;
			  	 $credit=new Credit();
					 $user_id=Yii::app()->user->id;
			     $credit_desc="会员在线评论线路:".$trave_name.",赠送积分";
           $credit->set_credit_vars($user_id,"comment",'1',$credit_desc);
                
                
                
		       $return_array['result']="success";
			  }else
			     $return_array['result']="数据库操作错误";
			
		}else{
			 $return_array['result']="点评内容不能大于100个字符";
		}
	//}else{
	//	$return_array['result']="验证码不正确";
	//}
	}else{
		$return_array['result'] = "您的IP已被限制,如有疑问请与客服联系";
	}
		
		echo json_encode($return_array);
  }
 
 
    
}
?>
