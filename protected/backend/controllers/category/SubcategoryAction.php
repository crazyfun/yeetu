<?php
class SubcategoryAction extends BaseAction{
  
    protected function beforeAction(){
    	if(Yii::app()->request->isAjaxRequest){
    	  $this->controller->init_page();
        return true;
      }
    }
  protected function do_action(){	
		  $model=new Category;
      $condition['parent_id']=$_REQUEST['parent_category_id'];
			$result_datas=$model->get_table_datas($id,$condition);
			$json_result=array();
			foreach($result_datas as $key => $value){
				$tem_json_result=array();
				$tem_json_result['id']=$value->id;
				$tem_json_result['category_name']=$value->category_name;
				array_push($json_result,$tem_json_result);
			}
			echo json_encode($json_result);
  }
 
 
    
}
?>
