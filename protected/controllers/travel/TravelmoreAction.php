<?php
class TravelmoreAction extends  BaseAction{
  
    protected function beforeAction(){
    	$trave_category=$_GET['trave_category'];
    	$this->controller->init_page();
    	$this->controller->trave_category=$trave_category;
    	$this->controller->set_trave_category($this->controller->trave_category);
    	
    	$this->_set_trave_breadcrumbs($this->controller->menu_tag);
    	return true;
    }

  protected function do_action(){
  	$province_id=$_GET['province_id'];
		 $trave=new Trave();
		 $this->display('travel_more',array("trave_model"=>$trave,'province_id'=>$province_id));
  }
 
   private function  _set_trave_breadcrumbs($menu_tag){
  	switch($menu_tag){
		 	case 'n_travel':
    	   $this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
    	     array($this->controller->trave_sregion_name.'出发出境旅游'=>array("travel/nation"))
        	);

		 	   break;
		 	case 'p_travel':
		 	
		 	   $this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
    	     array($this->controller->trave_sregion_name.'出发周边旅游'=>array("travel/peripheral"))
        	);
        	
		 	  
		 	   break;
		 	case 'd_travel':
		 	  
		 	  $this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
    	     array($this->controller->trave_sregion_name.'出发国内旅游'=>array("travel/domestic"))
        	);
        	
		 	   break;
		 	case 'g_travel':
		 	   $this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
    	     array($this->controller->trave_sregion_name.'出发公司旅游'=>array("travel/group"))
        	);
        	
        	
      case 's_travel':
		 	   $this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
    	     array($this->controller->trave_sregion_name.'出发自助游'=>array("travel/free"))
        	);

		 	   break;
		 	default:
		 	   break;
		  }
		  
		  
  }
 
    
}
?>
