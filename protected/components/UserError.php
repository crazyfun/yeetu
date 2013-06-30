<?php

   class UserError{
  	  private $error_flag=false;
  	  function __Construct(){
  	  
  	  }
  	  function get_error($key){
  	  	if(!empty($this->$key)){
  	  		$error_return="<div class='user_error'>".$this->$key."</div>";
  	  	}
  	  	return $error_return;
  	  }
  	  function set_error($key,$value){
  	  	if(!empty($key)&&!empty($value)){
  	  	  $this->$key=$value;
  	  	  $this->error_flag=true;
  	  	}
  	  }
  	  function set_attribute_errors($attribute_errors){
  	  	foreach((array)$attribute_errors as $key => $value){
  	  		 $this->set_error($key,$value);
  	  	}
  	  }
  	  
  	  public function is_error(){
  	  	return $this->error_flag;
  	  }
  	  
  	
  }
?>