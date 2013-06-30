<div class="r_two">
<h2 class="title"><?php echo CHtml::link($title,$url);?></h2>
     <table class="ask_table" >
           <tr class="ask_tr_b">
                <th width="3"></th>
                <th class="lb"  width="378">问题</th>
                <th class="lb1" width="70">提问时间</th>
                <th class="lb1" width="76">提问者</th>
                <th class="lb1" width="53">分类</th>
                <th class="lb1" width="44">状态</th>
                <th class="lb1" width="44">回答数</th>
           </tr>
           <tbody>
           <?php foreach($questions as $question){ ?>
           <tr>
               <td></td>
               <td class="td_title"> <?php echo CHtml::link($question->subject,array("qa/view","id"=>$question->id));?> </td>
               <td><?php echo date("Y-m-d",$question->create_time); ?></td>
               <td ><?php echo CHtml::link($question->user->user_login,array('qa/self','user_id'=>$question->user->id));?></td>
    
              <td><?php echo CHtml::link($question->category->name,array("qa/category","id"=>$question->category->id));?></td>
               <td> <?php echo $question->get_status_image();?> </td>
               <td><?php echo $question->answer_count;?></td>
            </tr>
            <?php } ?>
            </tbody>
      </table>
</div>
 
