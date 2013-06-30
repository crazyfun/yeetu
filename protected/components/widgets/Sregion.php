<?php

class Sregion extends CWidget
{
	public function run(){
		
		/*
		$trave=new Trave();
     	//查找目的地
  	$sql="SELECT DISTINCT(trave_sregion) as trave_sregion FROM {{trave}} WHERE trave_status=:trave_status ORDER BY trave_sregion ASC";
  	$trave_datas=$trave->findAllBySql($sql,array(':trave_status'=>'2'));
  	
  	$return_array=array();
  	$district=new District();
  	foreach($trave_datas as $key => $value){
  		//查找目的地的父类
  		 $temp=array();
  		 $sql="SELECT district_name FROM {{district}} WHERE id IN (SELECT parent_id FROM {{district}} WHERE id=:trave_sregion )";
  		 $district_names=$district->findBySql($sql,array(':trave_sregion'=>$value->trave_sregion));
  		 $temp['district_name']=$district_names->district_name;
  		 $district_values=$district->find(array('select'=>'id,district_name','condition'=>'id=:id','params'=>array(':id'=>$value->trave_sregion)));
  		 $district_value=array();
  		 $tem_district_value['id']=$district_values->id;
  		 $tem_district_value['name']=$district_values->district_name;
  		 array_push($district_value,$tem_district_value);
  		 $temp['district_value']=$district_value;
  		 array_push($return_array,$temp);
   } 
    $tem_key=array();
  	foreach($return_array as $key => $value){
  	
  		$value_key=array_keys($tem_key,$value['district_name']);
  		if(empty($value_key)){
  			$tem_key[$key]=$value['district_name'];
  		}else{
  				$return_array[$value_key[0]]['district_value']=array_merge($return_array[$value_key[0]]['district_value'],$value['district_value']);
  				unset($return_array[$key]);
  		}
  	}
  	*/
  	$return_array=Cfenzhan::model()->get_sfenzhan_select();
    $this->render("sregion",array('district_values'=>$return_array));
	}							 												 					
	
	

}