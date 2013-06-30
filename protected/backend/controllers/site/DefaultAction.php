<?php
class DefaultAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->bc(array("首页"));
    	$this->controller->init_none();
      return true;
    }

  protected function do_action(){	
		$model=new Traveorder();
		$validate_sregion=$this->controller->validate_sregion();
	  if($validate_sregion){
	    $validate_sregion=" AND ".$validate_sregion;
	  }
		$criteria=new CDbCriteria();
		$criteria=array(
			    'select'=>'*',
			    'condition'=>'t.pay_status=:pay_status AND t.order_status <> :order_status',
			    'params'=>array(':pay_status'=>'1',':order_status'=>'8'),
			    'with'=>array('trave'=>array('select'=>'trave.trave_name,trave.trave_category,trave.trave_sregion,trave.trave_region','condition'=>'(1=1)'.$validate_sregion,'params'=>array(),'together'=>true),'user'=>array('select'=>"user.user_login")),
			    'order'=>'t.create_time DESC',
			    'limit'=>'8',
			);
		$trave_order_datas=$model->findAll($criteria);
			
	  $model=new Consulting();
	  $criteria=new CDbCriteria();
	  $trave_with=array('select'=>'trave.trave_name','condition'=>'(1=1)'.$validate_sregion,'params'=>array(),'together'=>true);
		$criteria=array(
			    'condition'=>'t.reply_id=:reply_id',
			    'params'=>array(':reply_id'=>''),
			    'with'=>array('Trave'=>$trave_with),
			    'order'=>'t.id DESC',
			    'limit'=>'8',
		);
		$consulting_datas=$model->findAll($criteria);
		$this->display('default',array('trave_order_datas'=>$trave_order_datas,'consulting_datas'=>$consulting_datas));
   	
  }
 
 
    
}
?>
