<tr>
    <td></td>
    <td class="td_title"> <?php echo CHtml::link($data->subject,array("qa/view","id"=>$data->id));?> </td>
    <td><?php echo date("Y-m-d",$data->create_time);?></td>
    <td ><?php echo CHtml::link($data->user->user_login,array('qa/self','user_id'=>$data->user->id));?></td>
    <td><?php echo CHtml::link($data->category->name,array("qa/category","id"=>$data->category->id));?></td>
    <td><?php echo $data->get_status_image();?></td>
    <td><?php echo $data->answer_count;?></td>
</tr>

