<?php
class ConsultingdatasAction extends  BaseAction{
  
    public function beforeAction(){
      	Util::reset_vars();
       	return true;
    }
  
  protected function do_action(){
    $trave_id=$_POST['trave_id'];
		$trave_consulting=new Consulting();
		$consulting_dataProvider = new CActiveDataProvider($trave_consulting,array(
		  'criteria'=>array(
			    'condition'=>'trave_id=:trave_id',
			    'params'=>array(':trave_id'=>$trave_id),
			    'order'=>'create_time DESC',
			),
			'pagination'=>array(
          'pageSize'=>'20',
          'params'=>array('id'=>$trave_id)
          
      ),
		));
		$this->display_partial("consulting_datas",array('consulting_dataProvider'=>$consulting_dataProvider),false);
		
  }
 
 
    
}
?>
