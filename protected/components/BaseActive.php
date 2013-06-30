<?php
class BaseActive extends CActiveRecord {
   			//得到表的数据
	public function get_table_datas($pk_id="",$condition=array()){
    $com_condition=$this->com_condititions($condition);
		if(!empty($pk_id)){
			$datas=$this->findByPk($pk_id,$com_condition['condition'],$com_condition['params']);
      return $datas;
		}else{
        $datas=$this->findAll($com_condition['condition'],$com_condition['params']);
         return $datas;
		}
	}
	
	
 //组合查询的条件 $is_total_num 是否需要返回中数量用于分页
	public function com_condititions($condition=array()){
    $return_array=array();
    $tem_params=array();
    $tem_condition=" (1=1) ";
		foreach((array)$condition as $key => $value){
			if(!empty($value)){
				 $tem_condition.=" AND ".$key."=:".$key;
			   $tem_params[":".$key]=$value;
		 }
		}
		$return_array['condition']=$tem_condition;
		$return_array['params']=$tem_params;
		return $return_array;
	}
	
	//删除一笔数据
	public function delete_table_datas($pk_id="",$condition=array()){
		if(!empty($pk_id)){
			$datas=$this->deleteByPk($pk_id,"",array());
		}else{
			 $com_condition=$this->com_condititions($condition);
       $datas=$this->deleteAll($com_condition['condition'],$com_condition['params']);
		}
		return $datas;
	}
	
		//跟新一笔数据
	public function update_table_datas($pk_id="",$attributes,$condition=array()){
		 $com_condition=$this->com_condititions($condition);
		 if(!empty($pk_id)){
		   $update_datas=$this->updateByPk($pk_id,$attributes,$com_condition['condition'],$com_condition['params']);
		 }else{
		 	 $update_datas=$this->updateAll($attributes,$com_condition['condition'],$com_condition['params']);
		 }
     return $update_datas;
	}
	
public function getSortArray($sortItems, $label = null) {
  $sort = array ();
  if ($label != null) {
    $sort ['label'] = $label;
  }
  $asc = "";
  $desc = "";
  foreach ( $sortItems as $i => $s ) {
  if ($i == 0) {
    $asc = $s;
    $desc = $s . " desc";
  } else {
    $asc .= "," . $s;
    $desc .= "," . $s . " desc";
  }
 }
  $sort ['asc'] = $asc;
  $sort ['desc'] = $desc;
  return $sort;
}


    
}
?>
