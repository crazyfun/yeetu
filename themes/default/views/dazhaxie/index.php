<div class="main-content">
	<div class="part3">
    	<div class="title_bar"><div>旅游路线</div></div>
        <div class="line-tab-con">
        	<table cellpadding="0" cellspacing="0" width="100%">
            	<colgroup>
                	<col width="85"/>
                    <col width="565"/>
                    <col width="220"/>
                    <col />
                </colgroup>
            	<tr><th></th><th>路线</th><th>价格</th><th>预订</th></tr>
            <?php
               $trave=Trave::model();
               $trave_datas=$trave->get_travel_data_by_ids(array(array('id'=>'266','image'=>''),array('id'=>'268','image'=>'')));
               foreach($trave_datas as $key => $value){
            ?>	
               <tr><td><div><?php echo $trave->get_trave_first_image($value['id']);?></div></td><td class="algin-left"><a href="<?php echo $this->createUrl("travel/detail",array('id'=>$value['id'],'n'=>$value['trave_title'])); ?>"><?php echo $value['trave_name'];?></a></td><td><span style="color:#ff6600;"><?php if($value['trave_category']=='4') echo "一团一议"; else echo Util::enlarge_first($trave->get_trave_price($value['id']))."元";?></span></td><td><a href="<?php echo $this->createUrl("travel/detail",array('id'=>$value['id'],'n'=>$value['trave_title'])); ?>"><img src="/css/images/dazhaxie_theme/bt.gif" /></a></td></tr>
             <?php } ?>
            </table>
        </div>
    </div>

	<div class="part1">
    	<div class="title_bar"><div>大闸蟹名字的由来</div></div>
        <div class="part-txt">
        	 阳澄湖蟹为什么又普遍称为"大闸蟹"呢?包笑天曾对这个名称写过一篇《大闸蟹史考》，
说到"大闸蟹三字来源于苏州卖蟹人之口。""人家吃蟹总喜欢在吃夜饭之前，或者是临时
发起的。所以这些卖蟹人，总是在下午挑了担子，沿街喊道：'闸蟹来大闸蟹'。"这个
"闸"字，音同"SA"，（SA在吴方言中就是水煮的意思）蟹以水蒸煮而食，谓"SA蟹"。
这样的解释，尚不能尽意。他"有一日，在吴讷士家作蟹宴(讷士乃湖帆之文)，座有张惟
一先生，是昆山人，家近阳澄湖畔，始悉其原委。"
        </div>
    </div>
    
    <div class="part2">
    	<div class="title_bar"><div>什么是大闸蟹？</div></div>
        <div class="part-txt">
        	 阳闸蟹是河蟹的一种，河蟹学名中华绒螯蟹。在我国北起辽河南至珠江，漫长的海岸线上广泛分布，其中以长江水系产量
最大，口感最鲜美。一般来说，大闸蟹特指长江系的中华绒螯蟹。过去大闸蟹在长江口近海产苗，长成幼蟹后，逆长江洄游，
生长在长江下游一带的湖河港汊中。
        </div>
    </div>