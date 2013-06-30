<?php
class IndexAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->init_page();
		  $this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
		  array('线路搜索'=>array('search/index'))
		  );
		  if(empty($_REQUEST['trave_sregion'])){
		     $_REQUEST['trave_sregion']=$this->controller->trave_sregion;
		   }
		  

    	return true;
    }
  protected function do_action(){	
  	$recommend_line=$_REQUEST['recommend_line'];
  	//目的地
    $did=$_REQUEST['did'];
  	//线路出发地
    $trave_sregion=$_REQUEST['trave_sregion'];
    //线路名称
    $trave_name=$_REQUEST['trave_name'];
    //预算
    $budget=$_REQUEST['budget'];
    //出行天数
    $trave_route_number=$_REQUEST['trave_route_number'];
    //分类
    //$trave_linetype=$_REQUEST['trave_linetype'];
    
    //特色
    $trave_characteristic=$_REQUEST['trave_characteristic'];

    //线路的类别
    $tcid=$_REQUEST['tcid'];
    $pdid=$_REQUEST['pdid'];
    $select_sort=$_REQUEST['select_sort'];
    //排序
    $time_sort=$_REQUEST['time_sort'];
    $order_sort=$_REQUEST['order_sort'];
    $pub_sort=$_REQUEST['pub_sort'];
    if(!isset($_REQUEST['time_sort'])){
      $time_sort="DESC"; 	
    }
    if(!isset($_REQUEST['order_sort'])){
      $order_sort="DESC";	
    }
    if(!isset($_REQUEST['pub_sort'])){
    	$pub_sort="DESC";
    }
   $ismore=$_REQUEST['ismore'];

  if(empty($select_sort)){
   if(isset($_REQUEST['time_sort'])){
   	 $select_sort="adult_price $time_sort";
   	
   }else if(isset($_REQUEST['order_sort'])){
   	$select_sort="t.trave_numbers $order_sort";
   }else if(isset($_REQUEST['pub_sort'])){
   	$select_sort="t.create_time $pub_sort";
   }else{
  	$select_sort="t.create_time DESC";
   }
  }
   $advance_flag=$_REQUEST['advance_flag'];
		$trave=new Trave();
	if(empty($recommend_line)){
		$search_conditions=$this->combo_search_conditions();
		//$search_conditions['with']=array_merge((array)$order_with,$search_conditions['with']);
		$search_conditions['page_params']['advance_flag']=$advance_flag;
		$search_conditions['page_params']['select_sort']=$select_sort;
		$trave_dataProvider = new CActiveDataProvider($trave,array(
		  'criteria'=>array(
		      'select'=>'t.system_indent,t.trave_recommend,t.trave_bargain,t.trave_hot,t.trave_name,t.id,t.trave_sregion,t.trave_region,t.trave_numbers,t.trave_shot_desc,t.trave_category,t.trave_linetype,t.trave_title,(SELECT MIN(td.adult_price) FROM yt_travedate as td WHERE td.trave_id=t.id GROUP BY adult_price LIMIT 1) as adult_price ',
			    'condition'=>implode(" AND ",$search_conditions['conditions']),
			    'params'=>$search_conditions['params'],
			    'with'=>$search_conditions['with'],
			    'order'=>$select_sort,
			),
			'pagination'=>array(
          'pageSize'=>'20',
          'params'=>$search_conditions['page_params'],
      ),
		));
	}
		if(empty($trave_dataProvider->itemCount)){
			$page_params=array('trave_recommend'=>'2','trave_status'=>'2','trave_sregion'=>$trave_sregion,'recycle'=>0,'select_sort'=>$select_sort,'recommend_line'=>'1');
			$trave_sregion=empty($trave_sregion)?$this->controller->trave_sregion:$trave_sregion;
			$page_params['recommend_line']='1';
			$trave_recomment_dataProvider = new CActiveDataProvider($trave,array(
		  'criteria'=>array(
		      'select'=>'t.system_indent,t.trave_recommend,t.trave_bargain,t.trave_hot,t.trave_name,t.id,t.trave_sregion,t.trave_region,t.trave_numbers,t.trave_shot_desc,t.trave_category,t.trave_linetype,t.trave_title,(SELECT MIN(td.adult_price) FROM yt_travedate as td WHERE td.trave_id=t.id GROUP BY adult_price LIMIT 1) as adult_price',
			    'condition'=>'t.trave_recommend=:trave_recommend AND t.trave_status=:trave_status AND t.trave_sregion=:trave_sregion AND t.recycle=:recycle',
			    'with'=>array(),
			    'params'=>array(':trave_recommend'=>'2',':trave_status'=>'2',':trave_sregion'=>$trave_sregion,':recycle'=>0),
			    'order'=>$select_sort,
			),
			'pagination'=>array(
          'pageSize'=>'20',
          'params'=>$page_params,
      ),
		 ));
		}
	  $trave_region=$_REQUEST['trave_region'];
	  if(empty($trave_region)){
	  
	  //目的地
    if(!empty($did)){
      if($tcid=='2'){
       if(!empty($ismore)){
       	 $district=new District();
       	 $district_datas=$district->find(array('select'=>'district_name','condition'=>'id=:id','params'=>array(':id'=>$did)));
       	 $trave_region=$district_datas->district_name;
       }else{
       	   $category=new Category();
       	   $category_datas=$category->find(array('select'=>'category_name','condition'=>'id=:id','params'=>array(':id'=>$did)));
       	   $trave_region=$category_datas->category_name;
       }
      }else{
      	 $district=new District();
       	 $district_datas=$district->find(array('select'=>'district_name','condition'=>'id=:id','params'=>array(':id'=>$did)));
       	 $trave_region=$district_datas->district_name;
      }
    } 
   
   }
		$sregion_datas=$return_array=Cfenzhan::model()->get_sfenzhan_select();
		$trave_name=html_entity_decode($trave_name);
		$this->display('index',array('trave'=>$trave,'trave_dataProvider'=>$trave_dataProvider,'trave_recomment_dataProvider'=>$trave_recomment_dataProvider,'sregion_datas'=>$sregion_datas,'trave_sregion'=>$trave_sregion,'budget'=>$budget,'trave_name'=>$trave_name,'trave_route_number'=>$trave_route_number,'time_sort'=>$time_sort,'order_sort'=>$order_sort,'pub_sort'=>$pub_sort,'tcid'=>$tcid,'advance_flag'=>$advance_flag,'did'=>$did,'pdid'=>$pdid,'trave_characteristic'=>$trave_characteristic,'trave_region'=>$trave_region,'ismore'=>$ismore,'recommend_line'=>$recommend_line));
  }
  function combo_search_conditions(){
  	$titles=array();
  	$keywords=array();
  	//目的地
    $did=$_REQUEST['did'];
    //线路出发地
    $trave_sregion=$_REQUEST['trave_sregion'];
    //预算
    $budget=$_REQUEST['budget'];

    //线路名称
    $trave_name=$_REQUEST['trave_name'];
    //出行天数
    $trave_route_number=$_REQUEST['trave_route_number'];
    //线路分类
   // $trave_linetype=$_REQUEST['trave_linetype'];
    //特色
    $trave_characteristic=$_REQUEST['trave_characteristic'];
    //线路类别
    $tcid=$_REQUEST['tcid'];
    $pdid=$_REQUEST['pdid'];
    $trave_status=$_REQUEST['trave_status'];
    $ismore=$_REQUEST['ismore'];
    $conditions=array();
    $params=array();
    $page_params=array();
    $with=array();
    $result_array=array();

    //线路名称
     if(!empty($trave_name)){
       array_push($conditions,"(t.trave_name LIKE '%$trave_name%' OR t.trave_optimization LIKE '%$trave_name%' OR t.trave_title LIKE '%$trave_name%' OR t.trave_number LIKE '%$trave_name%')");
       $page_params['trave_name']=$trave_name;
       $search_keywords=new SearchKeywords();
       $search_keywords->insert_search_keywords($trave_name); 
       array_push($titles,$trave_name);
    }
    /*
    //分类
    if(!empty($trave_linetype)){
          array_push($conditions,"FIND_IN_SET(:trave_linetype,t.trave_linetype)>0");
    	    $params[':trave_linetype']=$trave_linetype;
    	    $page_params['trave_linetype']=$trave_linetype;

    }
    */
    
         //特色
    if(!empty($trave_characteristic)){
    	    $trave_characteristic_arr=explode(',',$trave_characteristic);
    	    $characteristic_condition=array();
    	    foreach($trave_characteristic_arr as $key => $value){
    	    	$tem_characteristic="FIND_IN_SET('".$value."',t.trave_linetype)>0";
    	    	array_push($characteristic_condition,$tem_characteristic);
    	    }
          array_push($conditions,"(".implode(" OR ",$characteristic_condition).")");
    	    $page_params['trave_characteristic']=$trave_characteristic;

    	    $category=new Category();
          $category_datas=$category->findAll(array('select'=>'category_name','condition'=>'FIND_IN_SET(id,"'.$trave_characteristic.'")>0','params'=>array()));
          foreach($category_datas as $key => $value){
          	array_push($titles,$value->category_name);
          }
          
    	    
    }
    
        //出行天数
     if(!empty($trave_route_number)){
    	$trave_route_number=html_entity_decode($trave_route_number);
    	$trave_route_number_array=explode('-',$trave_route_number);
    	if(count($trave_route_number_array)>=2){
    		$r_first_value=$trave_route_number_array[0];
    		$r_last_value=$trave_route_number_array[1];
    		if(empty($r_last_value)){
    			array_push($conditions,"t.trave_route_number>:r_first_value");
    		  $params[':r_first_value']=$r_first_value;
    		}else{
    			array_push($conditions,":r_first_value<=t.trave_route_number AND t.trave_route_number<=:r_last_value");
    			$params[':r_first_value']=$r_first_value;
    			$params[':r_last_value']=$r_last_value;
    		}
    	}else{
    	 	array_push($conditions,"t.trave_route_number=:r_first_value");
    		$params[':r_first_value']=$trave_route_number;
    	}
    	$page_params['trave_route_number']=$trave_route_number;
    	$trave_route_number_datas=CV::$TRAVE_ROUTE_NUMBER;
    	array_push($titles,$trave_route_number_datas[$trave_route_number]);
    }
    
    
        //预算 
    if(!empty($budget)){
    	array_push($conditions,"t.trave_budget=:trave_budget");
    	$params[':trave_budget']=$budget;
    	$page_params['trave_budget']=$budget;
    	
    	$budget_datas=CV::$BUDGET_DATAS;
    	array_push($titles,$budget_datas[$budget]);
    }
    
    
        //目的地
    if(!empty($did)){
    	
      if($tcid=='2'){
      	
       if(!empty($ismore)){
      	 if(!empty($pdid)){
      	 	
      		array_push($conditions,"t.trave_region IN (SELECT dis.id FROM {{district}} as dis WHERE dis.parent_id=:did)");
          $params[':did']=$did;
          $page_params['pdid']=$pdid;
          
          $district=new District();
          $district_datas=$district->find(array('select'=>'district_name','condition'=>'id=:id','params'=>array(':id'=>$did)));
          array_push($titles,$district_datas->district_name);
      	 }else{
       		array_push($conditions,"t.trave_region=:did");
       		$params[':did']=$did;
       		
       		$district=new District();
          $district_datas=$district->find(array('select'=>'district_name,parent_id','condition'=>'id=:id','params'=>array(':id'=>$did)));
          $district_parent_datas=$district->find(array('select'=>'district_name','condition'=>'id=:id','params'=>array(':id'=>$district_datas->parent_id)));
          array_push($titles,$district_datas->district_name);
          array_push($titles,$district_parent_datas->district_name);
          
          
         }
       }else{
       	 if(!empty($pdid)){
      		 $with['Category']=array("select"=>'Category.id','on'=>'FIND_IN_SET(Category.id,t.trave_linetype)>0','condition'=>'Category.parent_id=:did','params'=>array(':did'=>$did),'together'=>true);  
      		 $page_params['pdid']=$pdid;
      		 
      		$category=new Category();
          $category_datas=$category->find(array('select'=>'category_name','condition'=>'id=:id AND id <> :n_id','params'=>array(':id'=>$did,':n_id'=>'97')));
          if(!empty($category_datas->category_name)){
            array_push($titles,$category_datas->category_name);
          }

      	}else{
          array_push($conditions,"FIND_IN_SET(:did,t.trave_linetype)>0");
          $params[':did']=$did;
          
          $category=new Category();
          $category_datas= $category->find(array('select'=>'category_name,parent_id','condition'=>'id=:id','params'=>array(':id'=>$did)));
          $category_parent_datas= $category->find(array('select'=>'category_name','condition'=>'id=:id AND id <> :n_id','params'=>array(':id'=>$category_datas->parent_id,':n_id'=>'97')));
          array_push($titles,$category_datas->category_name);
          if(!empty($category_parent_datas->category_name)){
            array_push($titles,$category_parent_datas->category_name);
          }

        }
       }
      }else{
      	if(!empty($pdid)){
      		array_push($conditions,"t.trave_region IN (SELECT dis.id FROM {{district}} as dis WHERE dis.parent_id=:did)");
          $params[':did']=$did;
          $page_params['pdid']=$pdid;
          $district=new District();
          $district_datas=$district->find(array('select'=>'district_name','condition'=>'id=:id','params'=>array(':id'=>$did)));
          array_push($titles,$district_datas->district_name);
      	}else{
       		array_push($conditions,"t.trave_region=:did");
       		$params[':did']=$did;$district=new District();
          $district_datas=$district->find(array('select'=>'district_name,parent_id','condition'=>'id=:id','params'=>array(':id'=>$did)));
          $district_parent_datas=$district->find(array('select'=>'district_name','condition'=>'id=:id','params'=>array(':id'=>$district_datas->parent_id)));
          array_push($titles,$district_datas->district_name);
          array_push($titles,$district_parent_datas->district_name);
        }
      }
      $page_params['ismore']=$ismore;
      $page_params['did']=$did;
    } 
    
       //线路类型
    if(!empty($tcid)){
    	array_push($conditions,"t.trave_category=:trave_category");
    	$params[':trave_category']=$tcid;
    	$page_params['tcid']=$tcid;
    	$search_trave_category=CV::$SEARCH_TRAVE_CATEGORY;
    	array_push($titles,$search_trave_category[$tcid]);
    }
        //出发地
    if(!empty($trave_sregion)){
    	array_push($conditions,"t.trave_sregion=:trave_sregion");
    	$params[':trave_sregion']=$trave_sregion;
    	$page_params['trave_sregion']=$trave_sregion;
    	 $district=new District();
       $district_datas=$district->find(array('select'=>'id,district_name,district_en_name','condition'=>'id=:id','params'=>array(':id'=>$trave_sregion)));
       $this->controller->trave_esregion=$district_datas->id;
       array_push($titles,$district_datas->district_name."出发");
	     //出发城市的英文名字
	     $this->controller->trave_esregion_en_name=$district_datas->district_en_name;
	     $this->controller->trave_esregion_name=$district_datas->district_name;
	
    }else{
    	$trave_sregion=$this->controller->trave_sregion;
    	array_push($conditions,"t.trave_sregion=:trave_sregion");
    	$params[':trave_sregion']=$trave_sregion;
    	$page_params['trave_sregion']=$trave_sregion;
    	$this->controller->trave_esregion_en_name=$this->controller->trave_sregion_en_name;
    	$this->controller->trave_esregion=$trave_sregion;
    	$this->controller->trave_esregion_name=$this->controller->$trave_sregion_name;
    	array_push($titles,$this->controller->trave_sregion_name."出发");

    }
    
    
    
    
    if(empty($trave_status)){
    	$trave_status=2;
    }
    array_push($conditions,'t.trave_status=:t_trave_status');
    $params[':t_trave_status']=$trave_status;
    $page_params['trave_status']=$trave_status;
    
    array_push($conditions,'t.recycle=:recycle');
    $params[':recycle']=0;
    $page_params['recycle']=0;
    
    $result_array['conditions']=$conditions;
    $result_array['params']=$params;
    $result_array['page_params']=$page_params;
    $result_array['with']=$with;
    array_push($titles,"旅游线路搜索-易途旅游网");
    $this->controller->pt($this->id,$titles);
       switch($tcid){
          case '2':
            $this->controller->desc("易途旅游网(41ly.cn)——最新的".$this->controller->trave_esregion_name."周边旅游线路报价及价格目录,详细介绍".$this->controller->trave_esregion_name."周边旅游线路报价,".$this->controller->trave_esregion_name."周边旅游线路价格,详细行程,发团日期,报价以及提供在线咨询服务,为您提供一站式服务");
	          $this->controller->kw("周边旅游,".$this->controller->trave_esregion_name."周边旅游,周边旅游线路报价,".CV::$SEARCH_KEYWORDS['2']);
            break;
          case '3':
            $this->controller->desc("易途旅游网(41ly.cn)——最新的".$this->controller->trave_esregion_name."出发国内旅游线路报价及价格目录,详细介绍".$this->controller->trave_esregion_name."出发国内旅游线路报价,".$this->controller->trave_esregion_name."出发国内旅游线路价格,详细行程,发团日期,报价以及提供在线咨询服务,为您提供一站式服务");
	          $this->controller->kw("国内旅游,".$this->controller->trave_esregion_name."出发国内旅游,国内旅游线路报价,".CV::$SEARCH_KEYWORDS['3']);
            break;
          case '1':
            $this->controller->desc("易途旅游网(41ly.cn)——最新的".$this->controller->trave_esregion_name."出发出境旅游线路报价及价格目录,详细介绍".$this->controller->trave_esregion_name."出发出境旅游线路报价,".$this->controller->trave_esregion_name."出发出境旅游线路价格,详细行程,发团日期,报价以及提供在线咨询服务,为您提供一站式服务");
	          $this->controller->kw("出境旅游,".$this->controller->trave_esregion_name."出发出境旅游,出境旅游线路报价,".CV::$SEARCH_KEYWORDS['1']);
            break;
          case '5':
            $this->controller->desc("易途旅游网(41ly.cn)——最新的".$this->controller->trave_esregion_name."出发自助游线路报价及价格目录,详细介绍".$this->controller->trave_esregion_name."出发自助游线路报价,".$this->controller->trave_esregion_name."出发自助游线路价格,详细行程,发团日期,报价以及提供在线咨询服务,为您提供一站式服务");
            $trave=Trave::model();
            $kw_datas1=$trave->get_free_trave_distrinct("1");
            $kw_datas2=$trave->get_free_trave_distrinct("2");
            $kw_datas=array_merge($kw_datas1,$kw_datas2);
            $kw_names="";
            foreach($kw_datas as $key => $value){
    	         $district_value=$value['district_value'];
               foreach($district_value as $key1 => $value1){
       	         if(empty($kw_names)){
       	           $kw_names.=	$value1['name'];
       	         }else{
       	 	         $kw_names.=	",".$value1['name'];
       	         }
       	
              }
           }  
		       $this->controller->kw("自助游,".$this->controller->trave_esregion_name."出发自助游,自助游线路报价,".$kw_names);
            break;
          case '4':
             $this->controller->desc("易途旅游网(41ly.cn)提供在线公司企业团队旅游咨询,为您提供专业的公司旅游策划方案,".$this->controller->trave_esregion_name."出发专业的企业团队旅游线路,为您制定个性化的团队旅游需求.专业,个性,一站式的公司团队旅游服务就在易途旅游网.");
		         $this->controller->kw("公司旅游,".$this->controller->trave_esregion_name."出发公司旅游,".$this->controller->trave_esregion_name."出发公司旅游线路报价,消夏游,年会游,度假游,拓展游,奖励游,公关游,会议游");
            break;
          default:
            $this->controller->desc("易途旅游网(41ly.cn)——最简单易用方便实惠的旅游线路在线预订平台,一站式个性化旅游服务提供商;跟团游＋自助游＋公司旅游专家;周边游,国内游,出境游,公司旅游;出发地:".$this->controller->trave_esregion_name);
	          $this->controller->kw("旅游线路搜索,搜索,旅游,旅游网,旅游网站,自助游,跟团游,公司旅游");
            break;	
       	
       }
   
	  
    return $result_array;
  } 
}

function adult_price_cmp_d($a,$b){
	
	if ($a->adult_price == $b->adult_price) {
        return 0;
  }
  return ($a->adult_price < $b->adult_price) ? -1 : 1;
}

function adult_price_cmp_a($a,$b){

	if ($a->adult_price == $b->adult_price) {
        return 0;
  }
  return ($a->adult_price > $b->adult_price) ? -1 : 1;
}


?>
