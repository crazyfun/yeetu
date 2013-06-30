<div id="page_content">
	<div class="show_right_content">
	<div class="user_operate"><div class="user_operate_content"><span><a href='<?php echo $this->createUrl("qa/index",array());?>'>返回到问答列表</a></span></div></div>

		<div class="show_search_content">
			<div class="show_search_text">
				<div class="operate_result">
					<?php $this->widget("FlashInfo");?>
				</div>
				<div>
					<table width="100%" border="0" cellpadding="5" cellspacing="0">
						<tr>
							<th valign="top" align="right" width="10%" class="bgcolor_even">
								主题：
							</th>
							<td valign="top" class="bgcolor">
								<?php echo CHtml::encode($question->subject); ?>
								<?php echo $question->get_status_image();?>
							</td>
						</tr>
						<tr>
							<th valign="top" align="right" width="10%" class="bgcolor_even">
								内容：
							</th>
							<td valign="top" class="bgcolor">
								<?php echo CHtml::encode($question->content); ?>
							</td>
						</tr>
						<tr>
							<th valign="top" align="right" width="10%" class="bgcolor_even">
								类别：
							</th>
							<td valign="top" class="bgcolor">
								<?php echo CHtml::encode($question->category->name); ?>
							</td>
						</tr>
						<tr>
							<th valign="top" align="right" width="10%" class="bgcolor_even">
								用户：
							</th>
							<td valign="top" class="bgcolor">
								<?php echo $question->user->user_login; ?>
							</td>
						</tr>
						<tr>
							<th valign="top" align="right" width="10%" class="bgcolor_even">
								创建时间：
							</th>
							<td valign="top" class="bgcolor">
								<?php echo date("Y-m-d H:i:s", $question->create_time); ?>
							</td>
						</tr>
						<tr>
							<td colspan="2" class="bgcolor_even">
								<div style="text-align: right">
									<?php if (Question::CLOSED == $question->status):?>
									<?php echo CHtml::link('开启问题', $this->createUrl('qa/open', array('id'=>$question->id)),array('class'=>'operate_button'))?> 
									<?php else: ?>
									<?php echo CHtml::link('关闭问题', $this->createUrl('qa/close', array('id'=>$question->id)),array('class'=>'operate_button'))?>
									<?php endif; ?>
									<?php echo CHtml::link('编辑', $question->get_admin_edit_url(),array('class'=>'operate_button'))?> 
									<?php echo CHtml::link('删除', $question->get_admin_delete_url(), array('class'=>'operate_dbutton',
    		'onclick' => 'return confirm("确定要删除这个问题吗？\n删除后，该问题的所有答案也将会被删除！")'
    	))?>
    	</div>
							</td>
						</tr>
					</table>
				</div>
				<?php if ($question->best_answer->id):?>
				<p><strong>最佳回答：</strong></p>
				<div>
					<table width="100%" border="0" cellpadding="5" cellspacing="0">
						<tr>
							<th valign="top" align="right" width="10%" class="bgcolor_even">
								<?php echo $question->best_answer->user->user_login; ?>：
							</th>
							<td valign="top" class="bgcolor">
								<div style="margin-bottom:10px"><?php echo CHtml::encode($question->best_answer->content); ?></div>
								<div style="margin-bottom:5px; color: #aaa; text-align: right"> <?php echo date("Y-m-d H:i:s", $question->best_answer->create_time); ?></div>
								<div style="text-align: right">
									<?php echo CHtml::link('取消最佳', $this->createUrl('qa/cancel_best', array('id' => $question->best_answer->id, 'page' => $page)),array('class'=>'operate_button')) ?> 
									<?php echo CHtml::link('编辑', $this->createUrl('qa/edit_answer', array('id' => $question->best_answer->id, 'page' => $page)),array('class'=>'operate_button')) ?>
									<?php echo CHtml::link('删除', $this->createUrl('qa/delete_answer', array('id' => $question->best_answer->id, 'q_id' => $question->id)), array('class'=>'operate_dbutton','onclick' => 'return confirm("确定要删除这个回答吗？")')) ?>
								</div>
							</td>
						</tr>
					</table>
				</div>
				<?php endif;?>
				<p><strong><?php if($question->best_answer->id): ?>其他回答：<?php else: ?>回答<?php endif; ?></strong></p>
				<?php 
					$this->widget('zii.widgets.CListView',array(
						'dataProvider'=>$answer_data_provider,
						'itemView'=>'_view',
						'summaryText' => '',
						'viewData' => array('page' => $page),
						'sortableAttributes'=>array(
							'id',
							'user_id' => '用户',
							'create_time' => '创建时间'
						),
					));
				?>
			</div><!-- /.show_search_text -->
		</div><!-- /.show_search_content -->
	</div><!-- /.show_right_content -->
</div><!-- /#page_content -->