<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     $this->controller->bc(array("在线咨询"=>array('consulting/index'),'在线咨询回复'));
     return true;
  }
  protected function do_action(){	
  	$model=new Consulting();
  	if(isset($_POST['Consulting'])){
  		if(!empty($_POST['Consulting']['id'])){
  			$model=$model->get_table_datas($_POST['Consulting']['id']);
  		}
  		$create_name=$_POST['create_name'];
  		$trave_name=$_POST['trave_name'];
  		$consulting_email=$_POST['consulting_email'];
  		$create_time=$_POST['create_time'];
			$model->id=$_POST['Consulting']['id'];
			$model->attributes=$_POST['Consulting'];
			$model->consulting_email=$consulting_email;
			if($model->validate()){
			  $result=$model->insert_consulting();
			  if($result){
			  	 $create_time=Util::current_time('timestamp');
			  	 $this->send_reply_email($consulting_email,$trave_name,$_POST['Consulting']['consulting_content'],$_POST['Consulting']['reply_content'],$create_time);
			     $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
			  }
		  }else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
		}else{
			$id=$_REQUEST['id'];
			if(!empty($id)){
			 	$model=$model->get_table_datas($id,array());
			}
		}
		$this->display('add_consulting',array('model'=>$model,'create_name'=>$create_name,'trave_name'=>$trave_name,'create_time'=>$create_time));
  } 
  
  protected function send_reply_email($consulting_email,$trave_name,$consulting_content,$reply_content,$create_time){
  	    $send_mail=new SendMail("Consulting Reply");
			  $result=$send_mail->send_consulting_reply("",$consulting_email,$trave_name,$consulting_content,$reply_content,$create_time);
			  return $result;
  }
}
?>
