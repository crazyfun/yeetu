<?php
class TravehotelAction extends BaseAction{
  
    protected function beforeAction(){
    	if(Yii::app()->request->isAjaxRequest){
    		Util::reset_vars();
        return true;
      }
    }
  protected function do_action(){	
		    $model=new Hotels();
		    $sql="SELECT DISTINCT(hotel_city) FROM {{hotels}}";
		    $hotel_city=$model->findAllBySql($sql,array());
		    $district=new District();
		    $json_array=array('self_address'=>array(),'parent_address'=>array());
		    foreach($hotel_city as $key => $value){
		    	
		    	$district_datas=$district->get_table_datas($value->hotel_city);
		    	$tem_district_data['id']=$district_datas->id;
			  	$tem_district_data['name']=$district_datas->district_name;
			  	array_push($json_array['parent_address'],$tem_district_data);
		    }
		    echo json_encode($json_array);

  } 
}
?>
