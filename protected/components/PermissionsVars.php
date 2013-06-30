<?php
class PermissionsVars extends CWidget
{
	var $menu=array();
	var $permissions_value="";
	var $permissions_array=array();
	public function run(){
		$this->rend_permissions();
	}
	function rend_permissions(){
		$menu=$this->menu;
		$this->permissions_array=explode(",",$this->permissions_value);
			$return_str="<div class='permission_wrapp'>";
			foreach((array)$menu as $key => $value){
				$return_str.="<div class='permission_parent'>";
				$return_str.="<div class='permission_item'><div><input type='checkbox' id='permission_item_check_".$key."'";
				if(!empty($value['subitem'])){
					$subitem_keys=$this->get_subitem_keys($value['subitem']);
					$tem_subitem_keys=array_diff($subitem_keys,$this->permissions_array);
					if(empty($tem_subitem_keys)){
						$return_str.=" CHECKED ";
					}
				}
				$return_str.=" onclick=\"javascipt:managepermission.select_permission_all('".$key."');\" name='permission_item_check' value='".$key."'/></div><div class='permission_name'><label for='permission_item_check_".$key."'>".Yii::t('default',$value['name'])."</label></div><div><a id='show_sub_menu_".$key."' class='permissions_operate_sub' href=\"javascript:managepermission.show_sub_menu('".$key."')\"></a></div></div><div class='clear_both'></div>";
				$return_str.="<div class='permission_subitem' id='permission_subitem_".$key."'>";
				 if(!empty($value['subitem'])){
					 $return_str.=$this->rend_subitem($key,$value['subitem']);
				 }
				$return_str.="</div>";
				$return_str.="</div>";
			
		}
			$return_str.="</div>";
		echo $return_str;
	}
	function rend_subitem($parent_key,$menu){
		$return_str="";
		foreach((array)$menu as $key => $value){
			$return_str.="<div class='permission_subitem_menu' style='display:block;'><span><input type='checkbox'";
			if(in_array($key,$this->permissions_array))
			   $return_str.=" CHECKED ";
			$return_str.=" name='permission_value[]' id='permission_subitem_check_".$key."' value='".$key."'  class='permission_subitem_check_".$parent_key."'/></span><span><lable for='permission_subitem_check_".$key."'>".Yii::t('default',$value['name'])."</lable></span></div>";
		}
		return $return_str;
	}
	
	function get_subitem_keys($subitem){
		return array_keys($subitem);
	}

	
}