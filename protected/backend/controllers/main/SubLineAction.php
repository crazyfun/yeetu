<?php
class SublineAction extends BaseAction{
  
    protected function beforeAction(){
    	if(Yii::app()->request->isAjaxRequest){
    		Util::reset_vars();
        return true;
      }
    }
  protected function do_action(){	
		$model=new Category();
		$parent_id=$_REQUEST['address_id'];
		$condition['parent_id']=$parent_id;
		$category_datas=$model->get_table_datas("",$condition);
		$json_array=array('self_address'=>array(),'parent_address'=>array());
		foreach((array)$category_datas as $key => $value){
			 $tem_category_data['id']=$value['id'];
			 $tem_category_data['name']=$value['category_name'];
			 array_push($json_array['self_address'],$tem_category_data);
			  	
		}
		echo json_encode($json_array);
  } 
}
?>
