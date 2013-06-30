<?php
class SubtravehotelAction extends BaseAction{
  
    protected function beforeAction(){
    	if(Yii::app()->request->isAjaxRequest){
    		Util::reset_vars();
        return true;
      }
    }
  protected function do_action(){	
		    $hotel_city=$_REQUEST['address_id'];
				$model=new Hotels();
		    $conditions=array('hotel_city'=>$hotel_city);
		    $hotel_datas=$model->get_table_datas("",$conditions);
        $json_array=array('self_address'=>array(),'parent_address'=>array());
		    foreach($hotel_datas as $key => $value){
		    	$tem_district_data['id']=$value->id;
			    $tem_district_data['name']=$value->hotel_name;
			    array_push($json_array['self_address'],$tem_district_data); 
		    }
		    echo json_encode($json_array);
		      
  } 
}
?>
