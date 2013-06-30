<?php
class Usermenu extends CWidget
{
	public $menu=array();
	public function run(){
		$this->renderMenu();
	}
	private function renderMenu(){
		  $return_str="";
      $menu=$this->menu;
      $controller=Yii::app()->getController();
      
      foreach($menu as $key => $value){
      	$isVisible=!$value['isVisible']?false:true;
      	$menu_a="";
      	 if(!$isVisible){
      	 	  if(!Yii::app()->user->isGuest){
      	 	  	 $menu_a.=CHtml::openTag("h3",array('id'=>'menu_'.$key,'class' => "wj_viph3"));
      	 	  	 $menu_a.=$value['label'];
      	 	  	 $menu_a.=CHtml::closeTag("h3");
      	 	  	 if(!empty($value['subitem']))	
      	 	  	   $menu_a.=$this->renderSubmenu($value['subitem']);
      	 	  }
      	 }else{
      	 	$menu_a.=CHtml::openTag("h3",array('id'=>'menu_'.$key,'class' => "wj_viph3"));
      	 	$menu_a.=$value['label'];	 
      	 	$menu_a.=CHtml::closeTag("h3");
      	 	if(!empty($value['subitem']))
      	    	$menu_a.=$this->renderSubmenu($value['subitem']);
      	 }
      	 $return_str.=$menu_a;
      }
		  echo $return_str;
	}
	
	private function renderSubmenu($subitem){
		  $return_str="";
      $menu=$subitem;
      $controller=Yii::app()->getController();
      $return_str.=CHtml::openTag("ul",array('class' => "wj_vipul"));
      foreach($menu as $key => $value){
      	 $isVisible=!$value['isVisible']?false:true;
      	if($controller->user_tag==$value['user_tag']){
		 	  	$select_class="wjdoing";
		 	  }else{
		 	  	$select_class="";
		 	  }
      	 $menu_a="";
      	 if(!$isVisible){
      	 	  if(!Yii::app()->user->isGuest){
      	 	  	 $menu_a.=CHtml::openTag("li",array());
      	 	  	 $menu_a.=CHtml::link($value['label'],$value['url'],array_merge($value['htmloptions'],array('class'=>$select_class,'rel'=>'nofollow')));
      	 	  	 $menu_a.=$value['li'];
      	 	  }
      	 }else{
      	 	$menu_a.=CHtml::openTag("li",array());
      	 	$menu_a.=CHtml::link($value['label'],$value['url'],array_merge($value['htmloptions'],array('class'=>$select_class,'rel'=>'nofollow')));
      	 	$menu_a.=$value['li'];
      	 }
      	 $return_str.=$menu_a;
      }
      $return_str.=CHtml::closeTag("ul");	
		  return $return_str;
	}
}