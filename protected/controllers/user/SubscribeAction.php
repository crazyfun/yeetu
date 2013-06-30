<?php
class SubscribeAction extends  BaseAction{
  
    protected function beforeAction(){
    	if(Yii::app()->request->isAjaxRequest){
    	  return true;
    	}
    }
  
  protected function do_action(){
		  $s_type=$_REQUEST['s_type'];
			$user_id=Yii::app()->user->id;
			$user=new User();
			$update_datas['agreement_free']=$s_type;
			$result=$user->update_table_datas($user_id,$update_datas);
			$json_array=array();
			if($result){
				if($s_type){
					$json_array['result']='success';
					$json_array['content']="订阅成功";
				}else{
					$json_array['result']='success';
					$json_array['content']="退订成功";
				}				
			}else{
				if($s_type){	
					$json_array['result']='failed';
					$json_array['content']="订阅失败，请重试";				

				}else{
					$json_array['result']='failed';
					$json_array['content']="退订失败，请重试";
				}
			}
			echo json_encode($json_array);
  }
 
 
    
}
?>
