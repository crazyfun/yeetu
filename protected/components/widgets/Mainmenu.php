<?php

class Mainmenu extends CWidget
{
	public $menu=array();
	public function run(){
		$this->renderMenu();
	}
	
	private function renderMenu(){
		  $return_str="";
		  $return_str.=$this->renderBigmenu();
		  $return_str.=$this->renderSmallmenu();
		  echo $return_str;
	}
	
	
	//显示大的menu
	private function renderBigmenu(){
		 $bigmenu_str="";
		 
		 $big_menu=$this->menu['big'];
		
		 $bigmenu_str.=CHtml::openTag("div",array('class'=>'nav_M1'));
		 $bigmenu_implode=array();
		 $controller=Yii::app()->getController();
		 foreach((array)$big_menu as $key => $value){
		 	  $isVisible=!$value['isVisible']?false:true;
		 	  
		 	  if($controller->menu_tag==$value['tag']){
		 	  	$select_class="menu_select";
		 	  }else{
		 	  	$select_class="";
		 	  }
		 	  
		 	  
		 	  if(!$isVisible){
		 	  	if(!Yii::app()->user->isGuest){
		 	  		$menu_a=CHtml::openTag("span",array('id'=>'bigmenu_'.$key,'class' => $select_class)).CHtml::link($value['label'],$value['url'],$value['htmloptions']);
		 	  		if(!empty($value['subitem'])){
		 	  			 $menu_a.=$this->rend_big_subitem($value['subitem'],$key);
		 	  		}
		 	  		$menu_a.=CHtml::closeTag("span");	
		 	  		array_push($bigmenu_implode,$menu_a);
		 	  	}
		 	  }else{
		 	  	  $menu_a=CHtml::openTag("span",array('id'=>'bigmenu_'.$key,'class' => $select_class)).CHtml::link($value['label'],$value['url'],$value['htmloptions']);
		 	  	  if(!empty($value['subitem'])){
		 	  			 $menu_a.=$this->rend_big_subitem($value['subitem'],$key);
		 	  		}
		 	  	  $menu_a.=CHtml::closeTag("span");	
		 	  		array_push($bigmenu_implode,$menu_a);
		 	  }
		 }
		 $span_str=CHtml::openTag("span",array('class'=>'span_line'));
	
		 $span_str.=CHtml::closeTag("span");
		 
		 $tem_bigmenu=implode($span_str,$bigmenu_implode);
		 $bigmenu_str.=$tem_bigmenu;
		 $bigmenu_str.=CHtml::closeTag("div");
		 return $bigmenu_str;
		 
	}

        
        
        
        
	//显示小的menu
	private function renderSmallmenu(){
		 $smallmenu_str="";
		 $small_menu=$this->menu['small'];
		 
		 $smallmenu_str.=CHtml::openTag("div",array('class'=>'nav_right_link'));
		 $smallmenu_implode=array();
		 $controller=Yii::app()->getController();
		 foreach((array)$small_menu as $key => $value){
		 	  $isVisible=!$value['isVisible']?false:true;
		 	  if($controller->menu_tag==$value['tag']){
		 	  	$select_class="menu_select";
		 	  }else{
		 	  	$select_class="";
		 	  }
		 	  if(!$isVisible){
		 	  	if(!Yii::app()->user->isGuest){
		 	  		$menu_a=CHtml::link($value['label'],$value['url'],$value['htmloptions']);
		 	  		if(!empty($value['subitem'])){
		 	  			 $menu_a.=$this->rend_small_subitem($value['subitem'],$key);
		 	  		}
		 	  		
		 	  		array_push($smallmenu_implode,$menu_a);
		 	  	}
		 	  }else{
		 	  	  $menu_a=CHtml::link($value['label'],$value['url'],$value['htmloptions']);
		 	  	  if(!empty($value['subitem'])){
		 	  			 $menu_a.=$this->rend_small_subitem($value['subitem'],$key);
		 	  		}
		 	  	
		 	  		array_push($smallmenu_implode,$menu_a);
		 	  }
		 }
		 $span_str=CHtml::openTag("span");
		 $span_str.="|";
		 $span_str.=CHtml::closeTag("span");
		 $tem_smallmenu=implode($span_str,$smallmenu_implode);
		 $smallmenu_str.=$tem_smallmenu;
		 $smallmenu_str.=CHtml::closeTag("div");
		 return $smallmenu_str;
	}
	
	//显示大的菜单的子菜单
	function rend_big_subitem($subitem,$key){
		
		
	}

//显示大的菜单的子菜单
	function rend_small_subitem($subitem,$key){
		
		
	}
}