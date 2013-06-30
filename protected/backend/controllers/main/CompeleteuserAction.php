<?php
class CompeleteuserAction extends BaseAction{
  
    public function beforeAction(){
    	if(Yii::app()->request->isAjaxRequest){
      	Util::reset_vars();
       	return true;
      }
    }
  
  protected function do_action(){
   $query=$_REQUEST['query'];
   $user=new User();
   $user_datas=$user->findAll("user_login LIKE '%$query%' AND user_active=:user_active",array(':user_active'=>'2'));
   $suggestions=array();
   $datas=array();
   foreach($user_datas as $key => $value){
   	array_push($suggestions,$value->user_login);
   	$tem_array=array();
   	$tem_array['user_id']=$value->id;
   	array_push($datas,$tem_array);
   }
   $ajax_array=array('query'=>$query,'suggestions'=>$suggestions,'data'=>$datas);
   echo json_encode($ajax_array);
  }
 
 
    
}
?>
