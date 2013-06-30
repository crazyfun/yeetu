<?php
class LineAction extends BaseAction{
  
    protected function beforeAction(){
    	if(Yii::app()->request->isAjaxRequest){
    		Util::reset_vars();
        return true;
      }
    }
  protected function do_action(){	
		    $model=new Category();
		    $id=$_REQUEST['id'];
		    if(!empty($id)){
		    	 $condition['id']=$id;
		    }
		    $condition['parent_id']="'0'";
			  $category_datas=$model->get_table_datas("",$condition);
			  $json_array=array('self_address'=>array(),'parent_address'=>array());
			  foreach((array)$category_datas as $key => $value){
			  	$tem_category_data['id']=$value['id'];
			  	$tem_category_data['name']=$value['category_name'];
			  	array_push($json_array['parent_address'],$tem_category_data);
			  	
			  }
			  echo json_encode($json_array); 
  } 
}
?>
