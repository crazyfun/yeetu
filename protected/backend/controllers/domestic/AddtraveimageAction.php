<?php
class AddtraveimageAction extends BaseAction{
  protected function beforeAction(){
  	
     $this->controller->init_page();
     return true;
   
  }
  protected function do_action(){	
		$id=$_REQUEST['id'];
		$trave_id=$_REQUEST['trave_id'];
		$trave_area_id=$_REQUEST['trave_area_id'];
		$model=new Traveimage();
		$trave_area_images=array();
		$trave_area_images=$model->get_trave_area_images($trave_id,$trave_area_id);
		$this->controller->bc(array("国内游"=>array('domestic/index'),"增加/修改国内游景区图片"));
		$model->trave_id=$trave_id;
		$model->trave_area_id=$trave_area_id;
		$this->display('add_trave_image',array('model'=>$model,'str_image_id'=>implode(',',$trave_area_images)));
 }
}
?>
