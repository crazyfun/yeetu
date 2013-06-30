<?php
class ImportpAction extends  BaseAction{
  
    public function beforeAction(){
    	  $this->controller->layout="iframe";
      	Util::reset_vars();
       	return true;
    }
  
    protected function do_action(){
      $message_id=$_REQUEST['message_id'];
      $custom_date=$_REQUEST['custom_date'];
      if(isset($_POST['message_ok'])){
      	  $message_select=$_REQUEST['message_select'];
      	  $is_all=$_REQUEST['is_all'];
      	  $message_select=explode(",",$message_select);
      	  $import_phone=new ImportPhone();
      	  $batch=new Batch();
      	  $batch_datas=$batch->get_table_datas($message_id);
      	  $title=$batch_datas->title;
      	  $content=$batch_datas->content;
      	  $send_mail=new SendMail();
      	  	if(empty($is_all)){
      	  	   $batch_phone=array();
      	  	   foreach($message_select as $key => $value){
      	  	   	  $import_phone_data=$import_phone->get_table_datas($value);
      	  	   	  if(!empty($import_phone_data->phone)){
      	  	   	  	array_push($batch_phone,$import_phone_data->phone);
      	  	   	  }
      	  	    }
      	  	    foreach($batch_phone as $key => $value){
      	  	       if(empty($custom_date)){
      	  	       	  $result=$send_mail->send_batch_phone($value,$content);
      	  	       	 //if($result){
      	  	       	    $batch_message=new BatchMessage();
      	  	       	    $batch_message->title=$title;
      	  	       	    $batch_message->message=$value;
      	  	       	    $batch_message->batch_type='2';
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
      	  	       	    $batch_message->batch_type='2';
      	  	       	    $batch_message->content=$content;
      	  	            $batch_message->custom_date=$custom_date;
      	  	       	    if($batch_message->validate()){
	  		                   $batch_message->save();
	  		                }
      	  	       }	
      	  	  }
      	  	}else{
      	  		if(empty($custom_date)){
      	  			$import_phone_datas=$import_phone->findAll(array('select'=>'phone','condition'=>'','params'=>array()));
      	  			foreach($import_phone_datas as $key => $value){
      	  				   $result=$send_mail->send_batch_phone($value->phone,$title,$content);
      	  			}
      	  			$batch_message=new BatchMessage();
      	  	    $batch_message->message='';
      	  	    $batch_message->batch_type='2';
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
      	  	    $batch_message->batch_type='2';
      	  	    $batch_message->title=$title;
      	  	    $batch_message->content=$content;
      	  	    $batch_message->is_all='1';
                $batch_message->custom_date=$custom_date;
      	  	    if($batch_message->validate()){
	  		            $batch_message->save();
	  		        }
      	  		}
      	  	}
            $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
      }else{
      	$name=$_REQUEST['name'];
	      $phone=$_REQUEST['phone'];
        $conditions=array();
        $params=array();
        $page_params=array();
        if(!empty($name)){
          array_push($conditions,"(name =:name)");
          $params[':name']=$name;
          $page_params[':name']=$name;
        }
        if(!empty($phone)){
    	    array_push($conditions,"phone =:phone");
			    $params[':phone']=$phone;
			    $page_params['phone']=$phone; 
        }
      	$page_params['message_id']=$message_id;
        $model=new ImportPhone();
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
    	$this->display('importp',array('message_id'=>$message_id,'active_dataprovider'=>$active_dataprovider,'name'=>$name,'phone'=>$phone));
    } 
}
?>
