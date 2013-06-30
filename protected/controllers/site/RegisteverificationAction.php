<?php
class RegisteverificationAction extends  BaseAction{
  
   protected function beforeAction(){
    if(Yii::app()->request->isAjaxRequest){
    	return true;
     }else{
     	return false;
     }
    }
  protected function do_action(){	
		  $valide_type=$_REQUEST['valide_type'];
		  $input_value=$_REQUEST['input_value'];
		  $user=new User();
		  $json_html=array();
		  switch($valide_type){
		  	case 'User_user_phone':
		  	    $user->user_phone=$input_value;
		  	    if($user->user_phone_validate()){
		  	    	/*
		  	    	if(!$user->exist_user_phone()){
		  	    		$json_html['json_type']="F";
		  	    		$json_html['json_content']=$user->getError("user_phone");
		  	    	}else{
		  	    		$json_html['json_type']="Y";
		  	    	}
		  	    	*/
		  	    	$json_html['json_type']="Y";
		  	    }else{
		  	    	  $json_html['json_type']="F";
		  	    		$json_html['json_content']=$user->getError("user_phone");
		  	    }
		  	  break;
		  	case 'User_user_login':
		  	  $user->user_login=$input_value;
		  	    if($user->exist_user_login()){
		  	    	$json_html['json_type']="Y";
		  	    }else{
		  	    	  $json_html['json_type']="F";
		  	    		$json_html['json_content']=$user->getError("user_login");
		  	    }
		  	    
		  	  break;
		  	case 'User_email':
		  	   $user->email=$input_value;
		  	    if($user->exist_email()){
		  	    	$json_html['json_type']="Y";
		  	    }else{
		  	    	  $json_html['json_type']="F";
		  	    		$json_html['json_content']=$user->getError("email");
		  	    }
		  	  break;
		  	default:
		  	  break;
		  }
		  echo json_encode($json_html);
  }
}
?>
