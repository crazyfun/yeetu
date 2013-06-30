<?php

/*
   根据传过来的参数显示分页的导航条
参数：$found_recodes：查找的笔数
      $paged: 页号
      $per_records:每页显示的笔数
      $pagefunc:发送页号的javascript函数
		  $pagetext:显示上页和下页的字符串
		  $pagetype：显示上页和下页的字符串的类型1为字符串 2为图片
		  $selectpage：是否显示下拉的分页框
回传：     $javascriptstr：分页显示的字符串 （LXF 20090805)
*/
class YII_Page{
   var $found_recodes=0;//总的笔数
	 var $per_records=0;//每页显示的笔数
	 var $pagefunc="";//javascript的函数
	 var $pageprev="";//前页显示的内容
	 var $pagenext="";//后页显示的内容
	 var $pagenums=0;//页数
	 var $current_page=1;//当前显示的页数
	 var $selectpage=false;//是否有下拉框进行选择
	 var $pagetype=1;
	 var $show_total=false;//是否显示总笔数
	 var $show_first=false;
	 var $show_last=false;
	 function CI_Page(){
	 	  $this->per_records=20;
	 }
	  //构造函数
   function Inite($options){
		 foreach((array)$options as $key => $value){
		 	   $this->$key=$value;
		 }
		 if(empty($this->current_page)){
		 	  $this->current_page=1;
		 }
	 }
	 //得到翻页的字符串
	 function get_pagestr($pagetext){
     $this->pageprev=$pagetext['prev'];//前页
		 $this->pagenext=$pagetext['next'];//后页
		 //字符串显示
		 if($this->pagetype==1)
		 {
		 	  if($this->per_records>$this->found_recodes){
		 	     return;
		 	  }else{
		     return $this->get_textstr();
		    }
		 }
		 //图片显示
		 if($this->pagetype==2)
		 {
		 	  if($this->per_records>$this->found_recodes){
		 	     return;
		 	  }else{
		     return $this->get_picstr();
		    }
		 }
	 }
	 //字符串显示
	 function get_textstr(){
	    $tempagenum=$this->pagenums=ceil($this->found_recodes/$this->per_records);
		  $temcurrent_page=$this->current_page;
		  $pagestr="<span class='pagebarstr'>";
		  if($this->show_first)
		     $pagestr.="<span class='itemspan'><a class='Qtxt_336699_12' href='".$this->get_pagefunc(1)."'>首页</a></span>";
		  //前一页导航
		  if($temcurrent_page==1)
		      $pagestr.="<span class='itemspan Qtxt_336699_12'>".$this->pageprev."</span>";
		  else
		       $pagestr.="<span class='itemspan'><a class='Qtxt_336699_12' href='".$this->get_pagefunc($temcurrent_page-1)."'>".$this->pageprev."</a></span>";
		 
		  if ( $temcurrent_page >= 4){
		     $pagestr .="<span class='itemspan'><a class='Qtxt_336699_12' href='".$this->get_pagefunc(1)."'>1</a>...</span>";
		  }
		  //导航
		  for($i=$temcurrent_page-2;$i<=$temcurrent_page+2;$i++){ 
		    if ($i >= 1 && $i <= $tempagenum) {
		      if($temcurrent_page==$i)
			  {
			      $pagestr.="<span class='itemspan txt_333333_13'>".$i."</span>";
			  }
			  else
			  {
			     
		          $pagestr.="<span class='itemspan'><a class='Qtxt_336699_12' href='".$this->get_pagefunc($i)."'>".$i."</a></span>";
				  
			  }
			 }
			  
		  }
		  
		  if (($temcurrent_page+2) < ($tempagenum)){
		      $pagestr.="<span class='itemspan'>...<a class='Qtxt_336699_12' href='".$this->get_pagefunc($tempagenum)."'>".$tempagenum."</a></span>";
		  }
		  //后一页导航
		  if($temcurrent_page==$tempagenum)
		     $pagestr.="<span class='itemspan Qtxt_336699_12'>".$this->pagenext."</span>";
		  else
		  
		    $pagestr.="<span class='itemspan'><a class='Qtxt_336699_12' href='".$this->get_pagefunc($temcurrent_page+1)."'>".$this->pagenext."</a></span>";
		 if($this->show_last)
		     $pagestr.="<span class='itemspan'><a class='Qtxt_336699_12' href='".$this->get_pagefunc($tempagenum)."'>末页</a></span>";
		 if($this->show_total){
		    	$pagestr.="<span class='itemspan Qtxt_336699_12'>总笔数:".$this->found_recodes."</span>";
		  }
			//选择下拉表框
			if($this->selectpage){
		      $pagestr.="<span class='itemspan Qtxt_336699_12'>转到<select name='paged' onchange='javascript:".$this->pagefunc."(this.value);'>";
			  for($i=1;$i<=$tempagenum;$i++){
			      $pagestr.="<option value='".$i."'";
				  if($temcurrent_page==$i)
				      $pagestr.="selected='selected'";
				  
				  $pagestr.=">".$i."</option>";
			  }
			  $pagestr.="</select>页</span>";
		  }
		  $pagestr.="</span>";
		  return $pagestr;
	     
	 }
	 
	 function get_picstr(){
	      $tempagenum=$this->pagenums=ceil($this->found_recodes/$this->per_records);
		  $temcurrent_page=$this->current_page;
		  $pagestr="<span class='pagebarstr'>";
		  if($this->show_first)
		     $pagestr.="<span class='itemspan'><a class='Qtxt_336699_12' href='".$this->get_pagefunc(1)."'>首页</a></span>";
		  //前一页
		  if($temcurrent_page==1)
		      $pagestr.="<span class='itemspan'><img src='".$this->pageprev."'/></span>";
		  else
		       $pagestr.="<span class='itemspan'><a href='".$this->get_pagefunc($temcurrent_page-1)."'><img src='".$this->pageprev."'/></a></span>";
		 
		  if ( $temcurrent_page >= 4){
		     $pagestr .="<span class='itemspan'><a class='Qtxt_336699_12' href='".$this->get_pagefunc(1)."'>1</a>...</span>";
		  }
		  //导航
		  for($i=$temcurrent_page-2;$i<=$temcurrent_page+2;$i++){ 
		    if ($i >= 1 && $i <= $tempagenum) {
		      if($temcurrent_page==$i)
			  {
			      $pagestr.="<span class='itemspan txt_333333_13'>".$i."</span>";
			  }
			  else
			  {
		          $pagestr.="<span class='itemspan'><a class='Qtxt_336699_12' href='".$this->get_pagefunc($i)."'>".$i."</a></span>";
			  }
			 }
			  
		  }
		  
		  if (($temcurrent_page+2) < ($tempagenum)){
		      $pagestr.="<span class='itemspan'>...<a class='Qtxt_336699_12' href='".$this->get_pagefunc($tempagenum)."'>".$tempagenum."</a></span>";
		  }
		  //后一页
		  if($temcurrent_page==$tempagenum)
		     $pagestr.="<span class='itemspan'><img src='".$this->pagenext."'/></span>";
		  else
		    $pagestr.="<span class='itemspan'><a href='".$this->get_pagefunc($temcurrent_page+1)."'><img src='".$this->pagenext."'/></a></span>";
		 if($this->show_last)
		     $pagestr.="<span class='itemspan'><a class='Qtxt_336699_12' href='".$this->get_pagefunc($tempagenum)."'>末页</a></span>";
		 if($this->show_total){
		 	$pagestr.="<span class='itemspan Qtxt_336699_12'>总笔数:".$this->found_recodes."</span>";
		}
			//选择下拉表框
		 if($this->selectpage){
		    $pagestr.="<span class='itemspan Qtxt_336699_12'>转到<select name='paged' onchange=\"";
		    if(!empty($this->pagefunc)){
		    	$pagestr.=$this->pagefunc."(this.value);\">";
		    }else{
		    	$pagestr.="javascript:self.location=self.location.pathname+'?paged='+this.value\">";
		    }  
			  for($i=1;$i<=$tempagenum;$i++){
			      $pagestr.="<option value='".$i."'";
				  if($temcurrent_page==$i)
				      $pagestr.="selected='selected'";
				  
				  $pagestr.=">".$i."</option>";
			  }
			  
			  $pagestr.="</select>页</span>";
		  }
		  $pagestr.="</span>";
		  
		  
		  return $pagestr;
	 }
	 //发送页数的参数到页面上
	 function get_pagefunc($paged){
	     if(empty($this->pagefunc)){
	     	
	   
     if($this->found_recodes){
		     $pageurl = parse_url( $_SERVER['REQUEST_URI'] );
		     $pagepath = $pageurl['path'];

		     $pagepath = ltrim($pagepath, '/');
		     $javascriptstr =   '/' . $pagepath . '?paged=' . $paged;
		   }else{
		   	  $javascriptstr="javascript:void(0);";
		   }
		 }
		 else{
         if($this->found_recodes)
		      $javascriptstr="javascript:".$this->pagefunc."(".$paged.")";
		     else
		      $javascriptstr="javascript:void(0);";
		 }
		 
		 return $javascriptstr;
	     
	 }
	 
	 function get_index($paged=1,$per_records=20){
	     
       if( empty($paged) ){ $paged = 1; $index = 0; }
       else { $index = ( $paged-1 ) * $per_records;} 
       return $index;
	}
	
	function get_limit($paged=1,$per_records=20){
       $index=$this->get_index($paged,$per_records);
       $limit=" LIMIT $index,$per_records ";
       return $limit;
	}

}

/* End of file User_agent.php */
/* Location: ./system/libraries/User_agent.php */

?>