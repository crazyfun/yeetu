<div class="r_two_box">
  <ul>
  <li><?php $user=new User(); echo CHtml::link(CHtml::image($user->get_user_head(60,60,$user->id)),array("qa/self","user_id"=>$user->id));?></li>
    <li><?php echo CHtml::link($user->user_login,array("qa/self","user_id"=>$user->id));?></li>
  </ul>
</div>

