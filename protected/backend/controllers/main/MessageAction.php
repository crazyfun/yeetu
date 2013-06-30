<?php
class MessageAction extends  BaseAction{
  
    public function beforeAction(){
    	  $this->controller->layout="iframe";
      	Util::reset_vars();
       	return true;
    }
  
    protected function do_action(){
      $message_id=$_REQUEST['message_id'];
      $message_type=$_REQUEST['message_type'];
      $custom_date=$_REQUEST['custom_date'];
      if(isset($_POST['message_ok'])){
      	  $message_select=$_REQUEST['message_select'];
      	  $is_all=$_REQUEST['is_all'];
      	  $message_select=explode(",",$message_select);
      	  $user=new User();
      	  $batch=new Batch();
      	  $batch_datas=$batch->get_table_datas($message_id);
      	  $title=$batch_datas->title;
      	  $content=$batch_datas->content;
      	  $send_mail=new SendMail();
      	  switch($message_type){
      	  	case '1':
      	  	 if(empty($is_all)){
      	  	   $batch_mail=array();
      	  	   foreach($message_select as $key => $value){
      	  	   	  $user_data=$user->get_table_datas($value);
      	  	   	  if($user_data->email_validate=='2'){
      	  	   	  	array_push($batch_mail,$user_data->email);
      	  	   	  }
      	  	   }
      	  	   foreach($batch_mail as $key => $value){
      	  	       if(empty($custom_date)){
      	  	       	 $result=$send_mail->send_batch_email($value,$title,$content);
      	  	       	 if($result){
      	  	       	    $batch_message=new BatchMessage();
      	  	       	    $batch_message->message=$value;
      	  	       	    $batch_message->batch_type=$message_type;
      	  	       	    $batch_message->title=$title;
      	  	       	    $batch_message->content=$content;
      	  	       	    $batch_message->status='1';
      	  	       	    $batch_message->send_date=time();	
      	  	       	    if($batch_message->validate()){
	  		                   $batch_message->save();
	  		                }
      	  	       	 }
      	  	       }else{
      	  	       	    $batch_message=new BatchMessage();
      	  	       	    $batch_message->message=$value;
      	  	       	    $batch_message->batch_type=$message_type;
      	  	       	    $batch_message->title=$title;
      	  	       	    $batch_message->content=$content;
      	  	            $batch_message->custom_date=$custom_date;
      	  	       	    if($batch_message->validate()){
	  		                   $batch_message->save();
	  		                }
      	  	       }	
      	  	   	
      	  	  }
      	  	}else{
      	  		if(empty($custom_date)){
      	  			$user_datas=$user->findAll(array('select'=>'email','condition'=>'email_validate=2 AND user_active=2','params'=>array()));
      	  			foreach($user_datas as $key => $value){
      	  				   $result=$send_mail->send_batch_email($value->email,$title,$content);
      	  			}
      	  			
      	  			$batch_message=new BatchMessage();
      	  	    $batch_message->message='';
      	  	    $batch_message->batch_type=$message_type;
      	  	    $batch_message->title=$title;
      	  	    $batch_message->content=$content;
      	  	    $batch_message->is_all='1';
      	  	    $batch_message->status='1';
      	  	    $batch_message->send_date=time();	
      	  	    if($batch_message->validate()){
	  		            $batch_message->save();
	  		        }
      	  			
      	  		}else{
      	  			$batch_message=new BatchMessage();
      	  	    $batch_message->message='';
      	  	    $batch_message->batch_type=$message_type;
      	  	    $batch_message->title=$title;
      	  	    $batch_message->content=$content;
      	  	    $batch_message->is_all='1';
                $batch_message->custom_date=$custom_date;
      	  	    if($batch_message->validate()){
	  		            $batch_message->save();
	  		        }
      	  		}
      	  		
      	  	}
      	  	   
			         
      	  	   break;
      	  	case '2':
      	  	  if(empty($is_all)){
      	  	   $batch_phone=array();
      	  	   foreach($message_select as $key => $value){
      	  	   	  $user_data=$user->get_table_datas($value);
      	  	   	  if(!empty($user_data->user_phone)){
      	  	   	  	array_push($batch_phone,$user_data->user_phone);
      	  	   	  }
      	  	    }
      	  	    
      	  	    foreach($batch_phone as $key => $value){
      	  	       if(empty($custom_date)){
      	  	       	  $result=$send_mail->send_batch_phone($value,$content);
      	  	       	 //if($result){
      	  	       	    $batch_message=new BatchMessage();
      	  	       	    $batch_message->title=$title;
      	  	       	    $batch_message->message=$value;
      	  	       	    $batch_message->batch_type=$message_type;
      	  	       	    $batch_message->content=$content;
      	  	       	    $batch_message->status='1';
      	  	       	    $batch_message->send_date=time();	
      	  	       	    if($batch_message->validate()){
	  		                   $batch_message->save();
	  		                }
      	  	       	 //}
      	  	       }else{
      	  	       	    $batch_message=new BatchMessage();
      	  	       	    $batch_message->title=$title;
      	  	       	    $batch_message->message=$value;
      	  	       	    $batch_message->batch_type=$message_type;
      	  	       	    $batch_message->content=$content;
      	  	            $batch_message->custom_date=$custom_date;
      	  	       	    if($batch_message->validate()){
	  		                   $batch_message->save();
	  		                }
      	  	       }	
      	  	  }
      	  	}else{
      	  		if(empty($custom_date)){
      	  			$user_datas=$user->findAll(array('select'=>'user_phone','condition'=>'user_active=2','params'=>array()));
      	  			foreach($user_datas as $key => $value){
      	  				   $result=$send_mail->send_batch_phone($value->user_phone,$title,$content);
      	  			}
      	  			$batch_message=new BatchMessage();
      	  	    $batch_message->message='';
      	  	    $batch_message->batch_type=$message_type;
      	  	    $batch_message->title=$title;
      	  	    $batch_message->content=$content;
      	  	    $batch_message->is_all='1';
      	  	    $batch_message->status='1';
      	  	    $batch_message->send_date=time();	
      	  	    if($batch_message->validate()){
	  		            $batch_message->save();
	  		        }
     
      	  			
      	  		}else{
      	  			$batch_message=new BatchMessage();
      	  	    $batch_message->message='';
      	  	    $batch_message->batch_type=$message_type;
      	  	    $batch_message->title=$title;
      	  	    $batch_message->content=$content;
      	  	    $batch_message->is_all='1';
                $batch_message->custom_date=$custom_date;
      	  	    if($batch_message->validate()){
	  		            $batch_message->save();
	  		        }

      	  		}
      	  		
      	  		
      	  	}
      	  	   break;
      	  	default:
      	  	
      	  	   break;
      	  }
          $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
      }else{
      	$user_login=$_REQUEST['user_login'];
	  $level=$_REQUEST['level'];
	  $user_active=$_REQUEST['user_active'];
	  $status=$_REQUEST['status'];
	  $create_time=$_REQUEST['create_time'];
	  $user_phone=$_REQUEST['user_phone'];
	  $email=$_REQUEST['email'];
	  
    $conditions=array();
    $params=array();
    $page_params=array();
        
    if(!empty($user_login)){
      array_push($conditions,"(user_login LIKE '%".$user_login."%' OR id=:user_login)");
      $params[':user_login']=$user_login;
      $page_params[':user_login']=$user_login;
    }
    
    if(!empty($email)){
    	 array_push($conditions,"email =:email");
			 $params[':email']=$email;
			 $page_params['email']=$email; 
    }
      	
		if(!empty($level)){
			array_push($conditions,"level =:level");
			 $params[':level']=$level;
			 $page_params['level']=$level; 
		}
		if(!empty($user_active)){
			 array_push($conditions,"user_active =:user_active");
			 $params[':user_active']=$user_active;
			 $page_params['user_active']=$user_active;
		}
		if(!empty($status)){
			 array_push($conditions,"status =:status");
			 $params[':status']=$status;
			 $page_params['status']=$status;
		}
		if(!empty($create_time)){
			array_push($conditions,"FROM_UNIXTIME(create_time,'%Y-%m-%d')=:create_time");
			$params[':create_time']=$create_time;
			$page_params['create_time']=$create_time;
		}
		if(!empty($user_phone)){
			 array_push($conditions,"user_phone LIKE :user_phone");
			 $params[':user_phone']="%$user_phone%";
			 $page_params['user_phone']=$user_phone;
		}
		
      	$page_params['message_id']=$message_id;
      	$page_params['message_type']=$message_type;
        $model=new User();
        $active_dataprovider= new CActiveDataProvider($model, array(
			   'criteria'=>array(
			      'condition'=>implode(' AND ',$conditions),
			      'params'=>$params,
			   ),
			   'pagination'=>array(
            'pageSize'=>'60',
            'params'=> $page_params,
         ),	
        ));
        
      }
    	$this->display('message',array('message_id'=>$message_id,'message_type'=>$message_type,'active_dataprovider'=>$active_dataprovider,'email'=>$email,'user_login'=>$user_login,'level'=>$level,'user_active'=>$user_active,'status'=>$status,'create_time'=>$create_time));
    } 
}
?>
