
<?php
class TravehotelsAction extends BaseAction{
  
  protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
    	$this->controller->bc(array("国内机+酒店"=>array('nianhui/index'),"增加国际机+酒店酒店"));
      return true;
    }
  protected function do_action(){	
  	$trave_id=$_GET['trave_id'];
  	$trave=new Trave();
  	$trave_datas=$trave->get_table_datas($trave_id);
  	$trave_hotels=$trave_datas->trave_hotels;
  	
  	$trave_name=$trave_datas->trave_name;
   
  	$model=new Hotels();
		$criteria=new CDbCriteria;
		$active_data_provider=new CActiveDataProvider($model, array(
			'criteria'=>array(
			    'condition'=>"FIND_IN_SET(id,:trave_hotels)>0",
			    'params'=>array(":trave_hotels"=>$trave_hotels),
			    'with'=>array(),
			    'order'=>'t.id ASC',
			),
			'pagination'=>array(
          'pageSize'=>'20',
          'params'=>array('trave_id'=>$trave_id),
      ),
		));
		$this->display('trave_hotels',array('model'=>$model,'active_data_provider'=>$active_data_provider,'trave_id'=>$trave_id,'trave_name'=>$trave_name));
		

  }  
}
?>
