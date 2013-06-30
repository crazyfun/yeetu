<?php

   class AdminSearch{
  	  var $per_records="";
  	  function __Construct(){
  	  }
  	  public function search(&$model,$search_value=array(),$com_search_value=array()){
  	  	    $return_search_value=array();
  	  	    $paged=$_REQUEST['paged'];
					//翻页
	 					$per_records=!empty($this->per_records)?$this->per_records:20;
    				$Yii_Page = new YII_Page ();
    				$index=$Yii_Page->get_index($paged,$per_records);   			
    				$search_value['extern_condition']=$search_value['extern_condition']." LIMIT $index,$per_records ";
						$model_data=$model->get_table_datas("",$search_value,true);
						$return_search_value['search_datas']=$model_data['datas'];
						//显示翻页的连接
    				$optons = array ("found_recodes" => $model_data['total_nums'], "current_page" => $paged, "per_records" => $per_records, "pagefunc" => "page_search", "show_total" => true, "show_first" => true, "show_last" => true, "pagetype" => 1, "selectpage" => false );
   				 	$Yii_Page->Inite( $optons );
    				$pagestr = $Yii_Page->get_pagestr(array ('prev' => "前一页", 'prevr' => '', 'next' => "后一页", 'nextr' => '' ) );
    				$return_search_value['pagestr']=$pagestr;
    				$com_search_condition=$this->com_search_condition($com_search_value);
    				$return_search_value['com_search_datas']=$com_search_condition;
    				foreach($search_value as $key => $value){
  	  	   	   $return_search_value[$key]=$value;
  	  	    }
    				return $return_search_value;
  	  }
  	  
  	  private function com_search_condition($com_search_value=array()){
  	  	 	$return_search_condition="";
  
	        foreach((array)$com_search_value as $key => $value){
		        if(!empty($value)){
		     	    $search_value=$key;
			        $return_search_condition.=str_replace("w%",$value,$search_value)."&nbsp;&nbsp;";
		        }
	        }
	        return $return_search_condition;
  	  }
  	  
  	 
  	
  }
?>