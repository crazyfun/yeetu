<?php

   class UserHmtl{
  	    function __Construct(){
  	    	
  	    }
  	    public function get_select_value($name,$options,$selected,$default_select,$class_name=""){
  	    	$result="<SELECT  class='".$class_name."' name=\"".$name."\" id=\"".$name."\">";
	       	if(!empty($default_select)){
          	$result.="<OPTION value=\"\" SELECTED=\"SELECTED\">".$default_select."</OPTION>";
     			 }
    			 foreach((array)$options as $key => $value){
    	 		 		if($selected == $key)
    	     				$result.="<OPTION value=\"".$key."\" SELECTED=\"SELECTED\">".$value."</OPTION>";
    	 		 		else
    	     				$result.="<OPTION value=\"".$key."\">".$value."</OPTION>";
    			}
    			$result.="</SELECT>";
    			return $result;
  	    }
  	    function get_select_multiple_value($name,$options,$selected,$default_select="",$class_name="",$size=""){
					$result="<SELECT multiple multi='1'  class='".$class_name."' name=\"".$name."[]\" id=\"".$name."\" size=\"".$size."\" >";
					if(!empty($default_select)&&empty($selected)){
        
          		$result.="<OPTION value=\"\" SELECTED=\"SELECTED\">".$default_select."</OPTION>";
      		}
    			foreach((array)$options as $key => $value){
    	  		if(in_array($key,(array)$selected))
    	     			$result.="<OPTION value=\"".$key."\" SELECTED=\"SELECTED\">".$value."</OPTION>";
    	  		else
    	     			$result.="<OPTION value=\"".$key."\">".$value."</OPTION>";
    			}
    			$result.="</SELECT>";
    			return $result;
				}
				function set_date_option_list( $tag_name = '' , $select = "", $start = '',$default_select='',$class_name=""){
					$data = array( 
						'month' => array( "01"=>'01',"02"=>'02',"03"=>'03',"04"=>'04',"05"=>'05',"06"=>'06',"07"=>'07',"08"=>'08',"09"=>'09',"10"=>'10',"11"=>'11',"12"=>'12'),
						'day' => array( "01" => '01',"02" =>'02',"03" =>'03',"04" =>'04',"05" =>'05',"06" =>'06',"07" =>'07',"08" =>'08',"09" =>'09',"10" =>'10',"11" =>'11',"12" =>'12',"13" =>'13',"14" =>'14',"15" =>'15',"16" =>'16',"17" =>'17',"18" =>'18',"19" =>'19',"20" =>'20',"21" =>'21',"22" =>'22',"23" =>'23',"24" =>'24',"25" =>'25',"26" =>'26',"27" =>'27',"28" =>'28',"29" =>'29',"30" =>'30',"31" =>'31'),
					);
					$year_start = 2015;
					$year_end =  2011; 
					$str = '';
					if( $tag_name == 'year' ){
						$str.="<SELECT name='".$tag_name."' class='".$class_name."' id='".$tag_name."'>";

						if(!empty($default_select)){
							$str.="<option value='' SELECTED>".$default_select."</option>";
						}

					//处理年度内容
						for( $i = $year_start; $i >= $year_end; $i--){
							$str .= '<option value="'.$i.'" ';
	 						if( $select == $i ) $str .= 'SELECTED ';			
								$str .= '>'.$i.'</option>';
							}	
						$str.="</SELECT>";
					}else{
					//处理月份及日期内容
						$str.="<SELECT name='".$tag_name."' class='".$class_name."' id='".$tag_name."'>";
	  				if(!empty($default_select)){
			 				 $str.="<option value='' SELECTED>".$default_select."</option>";
		  			}
						foreach ($data[$tag_name] as $index => $value ){

							if( empty($start) || $index >= $start ){
								$str .= '<option value="'.$index.'" ';
	 							if( $select == $value ) $str .= 'SELECTED ';
								$str .= '>'.$value.'</option>';
							}
						}
					$str.="</SELECT>";
				 }
				 return $str;
			 } 

  	    public function get_check_value($tag_name,$check_options,$default_select,$check_class="",$is_br=true){
  	    	$checked="";
					$str="";
					foreach((array)$check_options as $key => $value){
						$str.="<input type='checkbox' class='".$check_class."' name='".$tag_name."' value='".$key."'";
						if($default_select == $key ){
							$str.=" checked='CHECKED' ";
						}
						$str.="/>&nbsp;&nbsp;".$value;
						if($is_br)
		       		$str.="<br/>";
		    		else
		       		$str.="&nbsp;&nbsp;&nbsp;&nbsp;";
					}
					return $str;
  	    }
  	    
  	    public function get_radio_value($tag_name,$radio_options,$default_select,$radio_class="",$is_br=true){
  	    	$checked="";
					$str="";
					foreach((array)$radio_options as $key => $value){
						$str.="<input type='radio' class='".$radio_class."' name='".$tag_name."' value='".$key."'";
						if($default_select == $key ){
							$str.=" checked='CHECKED' ";
						}
						$str.="/>&nbsp;&nbsp;".$value;
						if($is_br)
		       		$str.="<br/>";
		    		else
		       		$str.="&nbsp;&nbsp;";
					}
					return $str;
  	    }
  	
  }
?>