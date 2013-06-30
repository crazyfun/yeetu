<?php
class SubdistrictAction extends BaseAction{
  
    protected function beforeAction(){
    	if(Yii::app()->request->isAjaxRequest){
    		Util::reset_vars();
        return true;
      }
    }
  protected function do_action(){	
		$model=new District();
		$parent_id=$_REQUEST['address_id'];
		$condition['parent_id']=$parent_id;
		$district_datas=$model->get_table_datas("",$condition);
		$json_array=array('self_address'=>array(),'parent_address'=>array());
		foreach((array)$district_datas as $key => $value){
			 $tem_district_data['id']=$value['id'];
			 $tem_district_data['name']=$value['district_name'];
			 array_push($json_array['self_address'],$tem_district_data); 	
		}
		echo json_encode($json_array);	  
  } 
}
?>
