<?php
class SeparateAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
    	$this->controller->bc(array('订单管理'=>array('order/index'),"拆单"));
      return true;
    }
  protected function do_action(){	
  	$model=new Traveorder();
  	$id=$_REQUEST['id'];
  	if(isset($_POST['Traveorder'])){
  		if(!empty($_POST['Traveorder']['id'])){
				$model=$model->get_table_datas($_POST['Traveorder']['id']);
			}
			//if($model->separate_nums!=$_POST['Traveorder']['separate_nums']){
			$model->id=$_POST['Traveorder']['id'];
			$model->attributes=$_POST['Traveorder'];
			if($model->save()){
				$separate_nums=$_POST['Traveorder']['separate_nums'];
			  $total_price=$model->total_price;
			  $separate_price=$model->get_separate_nums($total_price,$separate_nums);
			 
			  $order_separate=new OrderSeparate();
			  $order_separate->delete_table_datas("",array('order_id'=>$model->id));
			  foreach($separate_price as $key => $value){
			  	$order_separate=new OrderSeparate();
			  	$order_separate->order_id=$id;
			  	$order_separate->separate_price=$value;
			  	$order_separate->insert_order_separate();
			  }
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
			}else{
				$this->controller->f(CV::FAILED_ADMIN_OPERATE);
			}
		 //}
  	}else{
  	  $model=$model->get_table_datas($id);
  	}
    $this->display("separate",array('model'=>$model));
  }
 

    
}
?>
