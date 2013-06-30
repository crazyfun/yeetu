<?php
class ConsultingAction extends BaseAction{
  
    protected function beforeAction(){
      if(Yii::app()->request->isAjaxRequest){
      	Util::reset_vars();
       	return true;
      }else{
      	return false;
      }
    }
  protected function do_action(){
	if(Util::check_ip()){

		$trave_id=$_REQUEST['trave_id'];
		$consulting_content=$_REQUEST['consulting_content'];
		//$verification_code=$_REQUEST['verification_code'];
		$consulting_email=$_REQUEST['consulting_email'];
		//$img_code=Yii::app()->session->get("consult__img_code__");
		//if($img_code==md5(strtoupper($verification_code))){
			$comment_content_lenth=Util::strLength($consulting_content);
			if($comment_content_lenth<=3000){
				$consulting=new Consulting();
				$consulting->consulting_email=$consulting_email;
				$consulting->trave_id=$trave_id;
				$consulting->consulting_content=nl2br($consulting_content);
				$result=$consulting->insert_consulting();
				if($result){
					$trave=new Trave();
					$trave_datas=$trave->find(array('select'=>'trave_name','condition'=>'id=:id','params'=>array(':id'=>$trave_id)));
					//$send_mail=new SendMail("Submit Consult");
					//$send_mail->send_consulting("",$consulting_email,$trave_datas->trave_name,$consulting_content);
					$return_array['result']="success";
				}else
					$return_array['result']="数据库操作错误";
			}else{
				$return_array['result']="点评内容不能大于3000个字符";
			}
		//}else{
		//	$return_array['result']="验证码不正确";
	//	}
	}else{
		$return_array['result'] = "您的IP已被限制,如有疑问请与客服联系";
	}
	echo json_encode($return_array);
  }
}
?>
