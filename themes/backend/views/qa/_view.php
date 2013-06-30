<div style="border:1px solid #ccc;  padding: 10px; margin: 10px 0">
	<table width="100%" border="0" cellpadding="5" cellspacing="0">
		<tr>
			<th valign="top" align="right" width="10%" class="bgcolor_even">
				<?php echo $data->user->user_login; ?>：
			</th>
			<td valign="top" class="bgcolor">
				<div style="margin-bottom:10px"><?php echo CHtml::encode($data->content); ?></div>
				<div style="margin-bottom:5px; color: #aaa; text-align:right"> <?php echo date("Y-m-d H:i:s", $data->create_time); ?></div>
				<div style="text-align: right">
					<?php echo CHtml::link('设置最佳', $this->createUrl('qa/set_best', array('id' => $data->id, 'page' => $page)),array('class'=>'operate_button'))?>
					<?php
					   if($data->shit_status==''){
					       echo CHtml::link('设置为乱回答', $this->createUrl('qa/setshit', array('id' => $data->id,'shit_status'=>'1','page' => $page)),array('class'=>'operate_button'));
					   }
					 ?>
					<?php echo CHtml::link('编辑', $this->createUrl('qa/edit_answer', array('id' => $data->id, 'page' => $page)),array('class'=>'operate_button')) ?>
					<?php echo CHtml::link('删除', $this->createUrl('qa/delete_answer', array('id' => $data->id, 'q_id' => $data->question_id)), array('class'=>'operate_dbutton','onclick' => 'return confirm("确定要删除这个回答吗？")')) ?>
				</div>
			</td>
		</tr>
	</table>
</div>