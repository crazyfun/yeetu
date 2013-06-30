<?php
class CommentdatasAction extends  BaseAction{
  
    public function beforeAction(){
      	Util::reset_vars();
       	return true;
    }
  
  protected function do_action(){
    $trave_id=$_POST['trave_id'];
		$trave_comment=new TraveComment();
		$comment_dataProvider = new CActiveDataProvider($trave_comment,array(
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
		$this->display_partial("comment_datas",array('comment_dataProvider'=>$comment_dataProvider),false);
		
  }
 
 
    
}
?>
