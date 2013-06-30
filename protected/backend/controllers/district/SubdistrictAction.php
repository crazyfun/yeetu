<?php
class SubdistrictAction extends BaseAction{
  
    protected function beforeAction(){
    	if(Yii::app()->request->isAjaxRequest){
    		$this->controller->init_page();
        return true;
      }
    }

  protected function do_action(){	
      $model=new District;
      $condition['parent_id']=$_REQUEST['parent_district_id'];
			$result_datas=$model->get_table_datas($id,$condition,false);
			$json_result=array();
			foreach($result_datas as $key => $value){
				$tem_json_result=array();
				$tem_json_result['id']=$value->id;
				$tem_json_result['district_name']=$value->district_name;
				$tem_json_result['edit_flag']=$value->is_permissions_edit();
				array_push($json_result,$tem_json_result);
			}
			echo json_encode($json_result);
  }
 
 
    
}
?>
