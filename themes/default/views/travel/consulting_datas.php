             <?php 
                
                  $this->widget('zii.widgets.CListView',array(
												'dataProvider'=>$consulting_dataProvider,
												'itemView'=>'consulting_item',
												'ajaxUpdate'=>true,
										));
               ?>
              