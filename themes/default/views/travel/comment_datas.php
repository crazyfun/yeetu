             <?php 
                
                  $this->widget('zii.widgets.CListView',array(
												'dataProvider'=>$comment_dataProvider,
												'itemView'=>'comment_item',
												'ajaxUpdate'=>true,
										));
               ?>
              