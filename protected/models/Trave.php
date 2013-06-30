<?php

/**
 * This is the model class for table "{{trave}}".
 *
 * The followings are the available columns in table '{{trave}}':
 * @property string $id
 * @property string $trave_number
 * @property integer $trave_category
 * @property string $trave_name
 * @property string $trave_suppliers
 * @property string $trave_region
 * @property string $trave_linetype
 * @property string $trave_receptionstandards
 * @property string $trave_recommended
 * @property string $trave_tour
 * @property string $trave_booknotice
 * @property string $trave_tips
 * @property string $trave_optimization
 * @property string $trave_title
 * @property string $create_id
 * @property string $create_time
 */
class Trave extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Trave the static model class
	 */
	public $adult_price;

  public static function model($className=__CLASS__)
	{
	
		return parent::model($className);
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{trave}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('trave_name,trave_region,trave_sregion,trave_transportation,trave_application,trave_linetype,trave_route_number','safe','on'=>'Clone'),
		 // array('trave_name,trave_region,trave_region,trave_linetype','required'),
			array('trave_name,trave_region,trave_sregion,trave_transportation,trave_application,trave_linetype,trave_route_number','required','message'=>'{attribute}不能为空'),
			array('trave_name','exist_trave_name'),
			array('trave_category,trave_route_number,is_package,free_category,coupon', 'numerical', 'integerOnly'=>true),
			array('trave_number,trave_suppliers_number', 'length', 'max'=>30),
			array('trave_application,trave_region, trave_linetype, trave_title,trave_hotels', 'length', 'max'=>100),
			array("trave_name","length",'encoding'=>'utf-8','max'=>100,'tooLong'=>'最多只能100个字'),
			array('trave_optimization','length','max'=>300),
			array('trave_transportation', 'length', 'max'=>50),
			array('create_id, create_time,default_hotel,coupon,trave_suppliers', 'length', 'max'=>11),
			array('trave_category,trave_recommend,trave_numbers,trave_bargain,trave_status,trave_ordain,system_indent,show_index,recycle,trave_shot_desc,trave_receptionstandards,trave_recommended,trave_tour,trave_booknotice,trave_tips,trave_budget', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, trave_number, trave_category, trave_name, trave_suppliers, trave_region, trave_linetype, trave_receptionstandards, trave_recommended, trave_tour, trave_booknotice, trave_tips, trave_optimization, trave_title, recycle, create_id, create_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		  'User'=>array(self::BELONGS_TO, 'User', 'create_id'),
		  'Traveroute'=>array(self::HAS_MANY,'Traveroute','trave_id','order'=>'Traveroute.route_day ASC'),
		  'Traveorder'=>array(self::HAS_MANY, 'Traveorder', 'trave_id'),
		  'Travedate'=>array(self::HAS_MANY,'Travedate','trave_id'),
		  'Travearea'=>array(self::HAS_MANY,'Travearea','trave_id'),
		  'Category'=>array(self::HAS_MANY,'Category',''),
		  'Sregion'=>array(self::BELONGS_TO,'District','trave_sregion'),
		  'Region'=>array(self::BELONGS_TO,'District','trave_region'),
		  'Agency'=>array(self::BELONGS_TO,'Agency','trave_suppliers'),

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '线路ID',
			'trave_number' => '线路编号',
			'trave_category' => '线路类型',
			'trave_name' => '线路名称',
			'trave_suppliers' => '旅行社',
			'trave_suppliers_number' => '旅行社编号',
			'trave_route_number'=>'出行天数',
			'trave_budget'=>'价格范围',
			'trave_sregion' => '线路始发地',
			'trave_region' => '线路目的地',
			'trave_linetype' => '线路类别',
			'trave_shot_desc'=>'简短描述',
			'trave_receptionstandards' => '接待标准',
			'trave_recommended' => '特色推荐',
			'trave_hotels'=>'自由线路的酒店',
			'default_hotel'=>'自由线路的默认酒店',
			'trave_tour' => '自费项目',
			'is_package'=>'套餐',
			'free_category'=>'自由行类型',
			'trave_booknotice' => '预订通知',
			'trave_tips' => '温馨提示',
			'trave_application'=>'提前报名',
			'trave_transportation'=>'往返交通',
			'trave_optimization' => '优化关键字',
			'trave_title' => '线路标题',
			'trave_recommend'=>'推荐',
			'coupon'=>'抵用劵',
			'trave_numbers'=>'购买数量',
			'trave_bargain'=>'特价',
			'trave_status'=>'发布状况',
			'trave_ordain'=>'立即预定',
			'system_indent'=>'系统订单数',
			'show_index'=>'首页显示',
			'create_id' => '创建者',
			'create_time' => '最近更新时间',
		);
	}
	
	
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{

	}

		/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	 //搜索数据
	public function searchdatas(){
	
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	}
	
	/**
	 * 随机按推荐和特价查询
	 * 
	 * @param int $limit
	 * @param string $type
	 * @return Trave
	 
	public function rand($limit=5, $type=null)
	{
		$condition = ' trave_status=2 '; //只显示公开的。
		
		if ('recommend' == $type) {
			$condition .= ' AND trave_recommend = 2 ';
		} elseif ('bargain' == $type) {
			$condition .= ' AND trave_bargain = 2';
		}
		
		$this->getDbCriteria()->mergeWith(array(
			'condition' => $condition,
			'limit' => $limit,
			'order' => 'RAND()'
		));
		
		return $this;
	}
	*/
	
	public function primaryKey()
{
    return 'id';
    // 对于复合主键，要返回一个类似如下的数组
    // return array('pk1', 'pk2');
}




	//删除一笔数据
	public function delete_table_datas($pk_id="",$condition=array()){
		if(!empty($pk_id)){
			$this->delete_trave_datas($pk_id);
			$delete_table_datas=$this->get_table_datas($pk_id,$condition);
			$datas=$this->deleteByPk($pk_id,"",array());        
		}else{
			 $delete_table_datas=$this->get_table_datas("",$condition);
			 foreach($delete_table_datas as $key => $value){
			 	  $this->delete_trave_datas($value->id);
		  	}
			 $com_condition=$this->com_condititions($condition);
       $datas=$this->deleteAll($com_condition['condition'],$com_condition['params']);
       
		}
		return $datas;
	}
	//删除跟线路相关的数据
	function delete_trave_datas($trave_id=""){
		$condition=array('trave_id'=>$trave_id);
		$trave_area=new Travearea();
		$trave_date=new Travedate();
		$trave_route=new Traveroute();
		$trave_area->delete_table_datas("",$condition);
		$trave_date->delete_table_datas("",$condition);
		$trave_route->delete_table_datas("",$condition);
		
		$consulting=new Consulting();
		$consulting->delete_table_datas("",$condition);
		
		$trave_order=new Traveorder();
		$trave_order->delete_table_datas("",$condition);
		
		$trave_comment=new TraveComment();
		$trave_comment->delete_table_datas("",$condition);
		
		$trave_history=new TraveHistory();
		$trave_history->delete_table_datas("",$condition);
		
	}
		//插入一笔旅游的数据
	public function insert_trave(){
		$id=$this->id;
		if(!$this->hasErrors()){
			if(!empty($id)){
			  $datas=$this->save();
			  return $datas;
			}else{
			 $this->trave_bargain='1';
			 $this->trave_status='1';
			 $this->trave_recommend='1';
			 $this->trave_hot='1';
				$datas=$this->save();
				return $datas;
			}
		}
	}
	
	

	function exist_trave_name(){
		$id=$this->id;
		if(!empty($id)){
			 $get_table_datas=$this->get_table_datas($id,array());
			 if($get_table_datas->trave_name!=$this->trave_name){
			 	 $find_datas=$this->find(array(
          'select'=>'trave_name',
          'condition'=>'trave_name=:trave_name',
          'params'=>array(':trave_name' => $this->trave_name),
         ));
			 }
		}else{
			$find_datas=$this->find(array(
         'select'=>'trave_name',
         'condition'=>'trave_name=:trave_name',
         'params'=>array(':trave_name' => $this->trave_name),
       ));
		}
     if(!empty($find_datas)){
     	 $this->addError("trave_name","线路名称已存在");
     }
	}
	
	function beforeSave(){
	 if(parent::beforeSave()){
			if($this->isNewRecord){
				  $serial=new Serial;
				  $search_serial_datas['serial_name']='Trave Number';
				  $serial_datas=$serial->get_table_datas("",$search_serial_datas);
				  $this->trave_number="STS".$serial_datas[0]->serial_value;
					$this->create_id=Yii::app()->user->id;
		      $this->create_time=Util::current_time('timestamp');
			}else{
				$this->create_time=Util::current_time('timestamp');
			}
			return true;
		}else{
			return false;
		}
	}
	function afterSave(){
					$serial=new Serial;
				  $search_serial_datas['serial_name']='Trave Number';
				  $serial_datas=$serial->get_table_datas("",$search_serial_datas);
				  $attributes['serial_value']=$serial_datas[0]->serial_value+1;
				  $serial->update_table_datas($serial_datas[0]->id,$attributes);
		      return true;
	}
	
	//行程
	function get_trave_route(){
		$controller_id=Yii::app()->getController()->getId();
		return CHtml::link("行程",array("$controller_id/traveroute","trave_id"=>$this->id));
	}
	
	//自由行航班
	function get_trave_flights(){
		$controller_id=Yii::app()->getController()->getId();
		return CHtml::link("航班",array("$controller_id/traveflight","trave_id"=>$this->id));
	}

	//时间
	function get_trave_date(){
		$controller_id=Yii::app()->getController()->getId();
		$travedate_model=new Travedate;
  	$condition['trave_id']=$this->id;
  	$condition['trave_status']='1';
    $travedate_datas=$travedate_model->get_table_datas("",$condition);
    $trave_date_name="";
    foreach((array)$travedate_datas as $key => $value){
      if(empty($trave_date_name)){
      	$trave_date_name.=Util::get_trave_start_date_name($value->trave_date,$value->date_type);
      }else{
      	$trave_date_name.="<br/>".Util::get_trave_start_date_name($value->trave_date,$value->date_type);
      }
    } 
    $trave_date_name.="&nbsp;&nbsp;".CHtml::link('增加',array("$controller_id/travedate","trave_id"=>$this->id),array('class'=>'operate_button'));
  	return $trave_date_name;
	}
	
		//时间
	function get_rtrave_date(){
		$controller_id=Yii::app()->getController()->getId();
		$travedate_model=new Travedate;
  	$condition['trave_id']=$this->id;
  	$condition['trave_status']='1';
    $travedate_datas=$travedate_model->get_table_datas("",$condition);
    $trave_date_name="";
    foreach((array)$travedate_datas as $key => $value){
      if(empty($trave_date_name)){
      	$trave_date_name.=Util::get_trave_start_date_name($value->trave_date,$value->date_type);
      }else{
      	$trave_date_name.="<br/>".Util::get_trave_start_date_name($value->trave_date,$value->date_type);
      }
    } 
  	return $trave_date_name;
	}
	//得到是否是套餐
	function get_trave_package(){
		  $package_data=CV::$PACKAGE;
		  return $package_data[$this->is_package];
	}
		//得到旅游线路详细信息的出发时间
	function get_trave_details_date(){
		$travedate_model=new Travedate;
  	$condition['trave_id']=$this->id;
  	$condition['trave_status']='1';
    $travedate_datas=$travedate_model->get_table_datas("",$condition);
    $trave_date_name="";
    $sort_array=array();
    foreach((array)$travedate_datas as $key => $value){
       $explode_array=explode(",",$value->trave_date);
       
      if(!empty($explode_array[1])&&!empty($explode_array[2])){
      	if($value->date_type=='1'){
				  $rules_dates=$this->get_rules_date($explode_array[0],$explode_array[1],$explode_array[2]);
				}else{
					$rules_dates=$this->get_period_date($explode_array[0],$explode_array[1],$explode_array[2]);
				}
          $sort_array=array_merge($sort_array,$rules_dates);
       }
       if(!in_array(strftime('%Y/%m/%d',strtotime($explode_array[0])),$sort_array)){
       	 $explode_date_str=strftime('%Y/%m/%d',strtotime($explode_array[0]));
       	 array_push($sort_array,$explode_date_str);
       	 
      }
    } 
  $sort_array=array_unique($sort_array);
  asort($sort_array);
  $slice_nums=0;
  foreach((array)$sort_array as $key1 => $value1){
       			if((strtotime($value1) > time())&&($slice_nums<=6)){
       				if(empty($trave_date_name)){
       	 	     	 $trave_date_name.=$value1;
      	    	}else{
       	     	   $trave_date_name.="、".$value1;
           		}
           	$slice_nums++;
       		}
   }
    
  	return $trave_date_name;
	}
	//获得时间段的日期
	function get_period_date($start_date="",$open_date,$close_date){
		 $open_date=strtotime($open_date);
		 $date=new Date($open_date);
		 $date_nums=$date->dateDiff($close_date,"d");
		 $date_nums=ceil($date_nums);
		 $return_array=array();
		 $diff_time=(24*60*60);
		for($ii=0;$ii <= $date_nums;$ii++){
			   $current_date=$open_date+($diff_time*$ii);
			   $final_day=date('Y/m/d', $current_date);
			   array_push($return_array,$final_day);
		}
		return $return_array;
	}
	//获取有规律的日期
	function get_rules_date($start_date="",$rule1,$rule2){
		$return_array=array();
	  
		switch($rule1){
			case '1':
			    switch($rule2){
			    	//月月天天
			    	case '1':
			          if(empty($start_date)){
			          	$start_date=date("Y/m/d");
			          }else{
			          	$old_start_date=$start_date;
			          }
			    	 
			    	$tem_start_date=strtotime($start_date);
			    	$day_m=date('n',$tem_start_date);
			    	$day_y=date('Y',$tem_start_date);
			    	$current_m=date('n',time());
			    	$current_y=date('Y',time());
			    	$pre_tem_return_array=array();
			    	if((($day_m <= $current_m)&&($day_y<=$current_y))||(($day_m >= $current_m)&&($day_y < $current_y))){
			    		 $current_return_array=$this->get_month_days(time());
			    	   foreach($current_return_array as $key => $value){
			    	   	if(!empty($old_start_date)){
			    	    	if(strtotime($value)>=$tem_start_date){
			    	    		if(!in_array($value,$return_array)){
			    	 	          array_push($return_array,$value);
			    	 	       }
			    	 	   }
			    	 	 }else{
			    	 	 	if(!in_array($value,$return_array)){
			    	 	 	   array_push($return_array,$value);
			    	 	  }
			    	 	}
			    	   }
             
			    		$next_moth_first=mktime(0,0,0,$current_m+1,1,$current_y);
			    		$pre_tem_return_array=$this->get_pre_month_days($tem_start_date);
			    		$next_tem_return_array=$this->get_month_days($next_moth_first);
			    	  $next_tem_return_array=array_merge($next_tem_return_array,$pre_tem_return_array);
			    	  foreach($next_tem_return_array as $key => $value){
			    	  	if(!empty($old_start_date)){
			    	  	if(strtotime($value)>=$tem_start_date){
			    	  		if(!in_array($value,$return_array)){
			    	 	      array_push($return_array,$value);
			    	 	    }
			    	 	  }
			    	 	}else{
			    	 		if(!in_array($value,$return_array)){
			    	 	      array_push($return_array,$value);
			    	 	    }
			    	 	}
			    	 	
			    	  }
			    	}else{
			    		$current_return_array=$this->get_month_days($tem_start_date);
			    	   foreach($current_return_array as $key => $value){
			    	   	if(!empty($old_start_date)){
			    	   	 if(strtotime($value)>=$tem_start_date){
			    	   	 	if(!in_array($value,$return_array)){
			    	 	     array_push($return_array,$value);
			    	 	    }
			    	 	   }
			    	 	 }else{
			    	 	 	if(!in_array($value,$return_array)){
			    	 	     array_push($return_array,$value);
			    	 	    }
			    	  	}
			    	   }
			    		$next_moth_first=mktime(0,0,0,$day_m+1,1,$day_y);
			    		$next_tem_return_array=$this->get_month_days($next_moth_first);
			    	  foreach($next_tem_return_array as $key => $value){
			    	  	if(!empty($old_start_date)){
			    	  	if(strtotime($value)>=$tem_start_date){
			    	  		if(!in_array($value,$return_array)){
			    	 	      array_push($return_array,$value);
			    	 	    }
			    	 	  }
			    	 	}else{
			    	 		if(!in_array($value,$return_array)){
			    	 	      array_push($return_array,$value);
			    	 	    }
			    	 	}
			    	  }
			    	}
	

			    	  //每月的星期几
			    	  break;
			    	default;
			    	  
			    	  if(empty($start_date)){
			          	$start_date=date("Y/m/d");
			          }else{
			          	$old_start_date=$start_date;
			          }
			          $str_start_date=strtotime($start_date); 

			    	$day_m=date('n',$str_start_date);
			    	$day_y=date('Y',$str_start_date);
			      $current_m=date('n',time());
			    	$current_y=date('Y',time());
			    	$pre_moth_weekly=array();
			    	if((($day_m <= $current_m)&&($day_y<=$current_y))||(($day_m >= $current_m)&&($day_y < $current_y))){
			    		
			    		$current_weekly=time();
			    	  $current_moth_weekly=$this->get_month_weekly($current_weekly,$rule2);
			    	  foreach($current_moth_weekly as $key => $value){
			    	  	if(!empty($old_start_date)){
			    	  	if(strtotime($value)>=$str_start_date){
			    	  		if(!in_array($value,$return_array)){
			    	 	         array_push($return_array,$value);
			    	 	     }
			    	 	  }
			    	 	}else{
			    	 		if(!in_array($value,$return_array)){
			    	 	         array_push($return_array,$value);
			    	 	     }
			    	 	 }
			    	  }
			    		$next_moth_first=mktime(0,0,0,$current_m+1,1,$current_y);
			    		$pre_moth_weekly=$this->get_pre_month_weekly($rule2);
			    		$next_moth_weekly=$this->get_month_weekly($next_moth_first,$rule2);
			    	  $next_moth_weekly=array_merge($next_moth_weekly,$pre_moth_weekly);
			    	  foreach($next_moth_weekly as $key => $value){
			    	   if(!empty($old_start_date)){
			    		  if(strtotime($value)>=$str_start_date){
			    		  	if(!in_array($value,$return_array)){
			    	 	     array_push($return_array,$value);
			    	 	    }
			    	   }
			    	 }else{
			    	 	if(!in_array($value,$return_array)){
			    	 	     array_push($return_array,$value);
			    	 	    }
			    	}
			    	 	
			    	  }

			    	}else{
			    	  $current_moth_weekly=$this->get_month_weekly($str_start_date,$rule2);
			    	  foreach($current_moth_weekly as $key => $value){
			    	   if(!empty($old_start_date)){
			    	  	if(strtotime($value)>=$str_start_date){
			    	  		if(!in_array($value,$return_array)){
			    	 	         array_push($return_array,$value);
			    	 	     }
			    	 	  }
			    	 	}else{
			    	 		if(!in_array($value,$return_array)){
			    	 	         array_push($return_array,$value);
			    	 	     }
			    	 	}
			    	  }
			    		$next_moth_first=mktime(0,0,0,$day_m+1,1,$day_y);
			    		$next_moth_weekly=$this->get_month_weekly($next_moth_first,$rule2);
			    		foreach($next_moth_weekly as $key => $value){
			    			if(!empty($old_start_date)){
			    		  if(strtotime($value)>=$str_start_date){
			    		  	if(!in_array($value,$return_array)){
			    	 	       array_push($return_array,$value);
			    	 	    }
			    	    }
			    	  }else{
			    	  	if(!in_array($value,$return_array)){
			    	 	       array_push($return_array,$value);
			    	 	    }
			    	  }
			    	  }
			    	}
			    	  break;
			    }
			  break;
			default:
			    switch($rule2){
			    	//月份的天天
			    	case '1':
               if(empty($start_date)){
			          	$start_date=date("Y/m/d");
			          }else{
			          	$old_start_date=$start_date;
			          }
			    	  $tem_start_date=mktime(0, 0, 0, $rule1-1, 1,date('Y',strtotime($start_date)));
			    	 
			    	  $tem_return_array=$this->get_month_days($tem_start_date);
			  
			    	   foreach($tem_return_array as $key => $value){
			    	   	
			    	   	if(!empty($old_start_date)){
			    	   	if(strtotime($value)>=strtotime($start_date)){
			    	   	 if(!in_array($value,$return_array)){
			    	   	  	array_push($return_array,$value);
			    	   	}
			    	   }
			    	 }else{
			    	 	if(!in_array($value,$return_array)){
			    	   	  	array_push($return_array,$value);
			    	   	}
			    	 }
			    	   }
			    	   return $return_array;
			    	    break; 
			    	  //月份的星期几
			    	 default:
                if(empty($start_date)){
			          	$start_date=date("Y/m/d");
			           }else{
			           	 $old_start_date=$start_date;
			           }
			    	    $tem_start_date=mktime(0, 0, 0, $rule1-1, 1,date('Y',strtotime($start_date)));
			    	   	$tem_return_array=$this->get_month_weekly($tem_start_date,$rule2);
			    	    foreach($tem_return_array as $key => $value){
			    	     if(!empty($old_start_date)){
			    	    	if(strtotime($value)>=strtotime($start_date)){
			    	   	   if(!in_array($value,$return_array)){
			    	   	 	   array_push($return_array,$value);
			    	   	   }
			    	   	  }
			    	     }else{
			    	     	if(!in_array($value,$return_array)){
			    	   	 	   array_push($return_array,$value);
			    	   	   }
			    	     }
			    	    }
			    	   return $return_array;
			    	    break;    
			    }
		}
		return $return_array;
	}
	//月份的天天
	function get_month_days($start_time,$select_month=false){
		          $return_array=array();
			    	  $day_m=date('n',$start_time);
			    	  $day_y=date('Y',$start_time);
			    	  $day_nums=date('t',$start_time);
			    	  $current_moth_first=mktime(0,0,0,$day_m,1,$day_y);
			    	  $diff_day=$day_nums;
			    	  $diff_time=(24*60*60);
			    	  for($ii=0;$ii < $diff_day;$ii++){
			    	  	$current_date=$current_moth_first+($diff_time*$ii);
			    	  	$final_day=date('Y/m/d', $current_date);
			    	  	array_push($return_array,$final_day);
			    	  }		
			    	  return $return_array;
		
	}
	
	
	
		//得到上个月份的天天
	function get_pre_month_days($start_time){
		          $current_time=time();
		          $return_array=array();
			    	  $current_m=date('n',$current_time);
			    	  $current_y=date('Y',$current_time);
			    	  $current_moth_first=mktime(0,0,0,$current_m-1,1,$current_y);
			    	  $day_nums=date('t',$current_moth_first);
			    	  $diff_day=$day_nums;
			    	  $diff_time=(24*60*60);
			    	  for($ii=0;$ii < $diff_day;$ii++){
			    	  	$current_date=$current_moth_first+($diff_time*$ii);
			    	  	 $final_day=date('Y/m/d', $current_date);
			    	  	 array_push($return_array,$final_day);
			    	  	
			    	  }		
			    	  
			    	  return $return_array;
	}
	
	
	//月份的星期几
	function get_month_weekly($start_time,$weekly){
		            $return_array=array();
			    	    $day_m=date('n',$start_time);
			    	    $day_y=date('Y',$start_time);
		            $day_nums=date('t',$start_time);
			    	    $current_moth_first=mktime(0,0,0,$day_m,1,$day_y);
                $diff_time=(24*60*60);
                for($ii=0;$ii < $day_nums;$ii++){
                	$tem_date=$current_moth_first+$diff_time*$ii;
                	$tem_day_w=date('w',$tem_date);
                	if($tem_day_w==(($weekly-1)%7)){
                		$final_day=date('Y/m/d', $tem_date);
                		array_push($return_array,$final_day);
                	}
                	
                }
    
                return $return_array;
              
	}
	
	
		//得到上一个月份的星期几
	function get_pre_month_weekly($weekly){
		            $current_time=time();
		            $return_array=array();
			    	    $current_m=date('n',$current_time);
			    	    $current_y=date('Y',$current_time);
			    	    $current_moth_first=mktime(0,0,0,$current_m-1,1,$current_y);
			    	    $day_nums=date('t',$current_moth_first);
			    	    $diff_time=(24*60*60);
                for($ii=0;$ii < $day_nums;$ii++){
                	$tem_date=$current_moth_first+$diff_time*$ii;
                	$tem_day_w=date('w',$tem_date);
                	if($tem_day_w==(($weekly-1)%7)){
                		$final_day=date('Y/m/d', $tem_date);
                		array_push($return_array,$final_day);
                	}
                }
                return $return_array;
	}
	    	  	
	
	//查找是否有时间相同的项
	  function is_unique_date($trave_date_datas,$trave_date){
	  	foreach((array)$trave_date_datas as $key => $value){
	  		$tem_trave_date=$value['trave_date'];
	  		if($tem_trave_date==$trave_date){
	  			return true;
	  		}
	  	}
	  	return false;
	  	
	  }
	//得到旅游线路详细信息的出发时间的选择项
		function get_trave_details_sdate($default_trave_sdate=""){
		$travedate_model=new Travedate;
  	$condition="trave_id=:trave_id AND trave_status=:trave_status ORDER BY trave_date ASC";
  	$params=array(":trave_id"=>$this->id,":trave_status"=>'1');
    $travedate_datas=$travedate_model->findAll($condition,$params);
    $date=new Date();
    $options="";
    foreach((array)$travedate_datas as $key => $value){
    	
    	$rules_dates=array();
       $explode_array=explode(",",$value->trave_date);
       if(!in_array($explode_array[0],$rules_dates)){
       	    $explode_date_str=strftime('%Y/%m/%d',strtotime($explode_array[0]));
       		 	array_push($rules_dates,$explode_date_str);
       }	
     	 if(!empty($explode_array[1])&&!empty($explode_array[2])){
     	 	
     	 	if($value->date_type=='1'){
				  $rules_dates_tem=$this->get_rules_date($explode_array[0],$explode_array[1],$explode_array[2]);
				}else{
					$rules_dates_tem=$this->get_period_date($explode_array[0],$explode_array[1],$explode_array[2]);
				}

       		  foreach($rules_dates_tem as $key2 => $value2){
       		  	if(!in_array($value2,$rules_dates)){
       		 	      array_push($rules_dates,$value2);
              }
       		  }
       } 
         $rules_dates=array_unique($rules_dates);
         asort($rules_dates);
       	 foreach((array)$rules_dates as $key1 => $value1){
       	 	
       		  $tem_date=strtotime($value1);
      			 if($tem_date > time()){
      			 $date->setDate($tem_date);
       			 $CDATE=$date->CDATE;
       			 $cWeekday=$date->cWeekday;
       			
       			 $tem_str=strftime('%Y/%m/%d',strtotime($CDATE));
       		
       			 $tem_str.=$cWeekday."出发,".$value->adult_price."元/成人";
       			 if($value->child_price){
       			 	$tem_str.=",".$value->child_price."元/儿童";
       			 }
       			 $options_value=$value1;
       			 $options.="<option value='".$options_value."'";
       	
       			 if($default_trave_sdate==$options_value)
       			   $options.=" selected ";
       			 $options.=" date_key='".$value->id."' adult_price='".$value->adult_price."' child_price='".$value->child_price."'>";
       			 $options.=$tem_str;
       			 $options.="</option>";
       			}
       		}
  }
    $return_select="<select name='select_trave_date' class='s_wj_datesel' id='select_trave_date'>";
    $return_select.=$options;
    $return_select.="</select>";  
    return $return_select;
	}
	//主要景区
	function get_trave_area(){
		$controller_id=Yii::app()->getController()->getId();
		$travearea_model=new Travearea;
  	$condition['trave_id']=$this->id;
  	$condition['trave_status']='1';
    $travearea_datas=$travearea_model->get_table_datas("",$condition);
    $trave_area_name="";
    foreach((array)$travearea_datas as $key => $value){
      if(empty($trave_area_name)){
      	$trave_area_name.=$value->trave_area;
      }else{
      	$trave_area_name.="&nbsp;&nbsp;".$value->trave_area;
      }
    } 
    $trave_area_name.="&nbsp;&nbsp;".CHtml::link('增加',array("$controller_id/travearea","trave_id"=>$this->id),array('class'=>'operate_button'));
  	return $trave_area_name;
	}
	
		//主要景区
	function get_rtrave_area(){
		$controller_id=Yii::app()->getController()->getId();
		$travearea_model=new Travearea;
  	$condition['trave_id']=$this->id;
  	$condition['trave_status']='1';
    $travearea_datas=$travearea_model->get_table_datas("",$condition);
    $trave_area_name="";
    foreach((array)$travearea_datas as $key => $value){
      if(empty($trave_area_name)){
      	$trave_area_name.=$value->trave_area;
      }else{
      	$trave_area_name.="&nbsp;&nbsp;".$value->trave_area;
      }
    } 
  	return $trave_area_name;
	}
	
	//获得酒店连接
	function get_trave_hotels(){
		$controller_id=Yii::app()->getController()->getId();
		return CHtml::link("酒店",array("$controller_id/travehotels","trave_id"=>$this->id));
	}

	//价钱
	function get_trave_price($id=""){
		$travedate_model=new Travedate;
		$id=empty($id) ? $this->id:$id;
    $trave_price=$travedate_model->get_trave_price($id);
  	return $trave_price;
	}

	//获取回收站的操作组
	function get_recycle_trave_operate(){
		$controller_id=Yii::app()->getController()->getId();
		$return_str="";
		$return_str.=CHtml::link('还原',array("$controller_id/restore","id"=>$this->id,'recycle'=>'0'),array('class'=>'operate_button'));
		$return_str.=CHtml::link('彻底删除',array("$controller_id/delet","id"=>$this->id),array('class'=>'operate_dbutton'));
		return $return_str;
	}
	
	//获取操作组
	function get_trave_operate(){
		 $controller_id=Yii::app()->getController()->getId();
		 $return_str="";
		 $return_str.=CHtml::link('修改',array("$controller_id/add","id"=>$this->id),array('class'=>'operate_button'));
		 
		 if($this->trave_recommend=='1')
		   $return_str.=CHtml::link("推荐",array("$controller_id/recommend","id"=>$this->id,'status'=>'2'),array('class'=>'operate_button'));
		 else
		   $return_str.=CHtml::link("取消推荐",array("$controller_id/recommend","id"=>$this->id,"status"=>'1'),array('class'=>'operate_button'));

		 if($this->trave_bargain=='1')
		   $return_str.=CHtml::link("特价",array("$controller_id/bargain","id"=>$this->id,'status'=>'2'),array('class'=>'operate_button'));
		 else
		   $return_str.=CHtml::link("取消特价",array("$controller_id/bargain","id"=>$this->id,'status'=>'1'),array('class'=>'operate_button'));
		   
		 if($this->trave_hot=='1')
		   $return_str.=CHtml::link("热卖",array("$controller_id/hot","id"=>$this->id,'status'=>'2'),array('class'=>'operate_button'));
		 else
		   $return_str.=CHtml::link("取消热卖",array("$controller_id/hot","id"=>$this->id,'status'=>'1'),array('class'=>'operate_button'));
		   
		 if($this->trave_status=='1')
		   $return_str.=CHtml::link("发布",array("$controller_id/publish","id"=>$this->id,'status'=>'2'),array('class'=>'operate_button'));
		 else
		   $return_str.=CHtml::link("不发布",array("$controller_id/publish","id"=>$this->id,'status'=>'1'),array('class'=>'operate_button'));
		   
		 $return_str.=CHtml::link("删除",array("$controller_id/recycle","id"=>$this->id,'recycle'=>'1'),array('class'=>'operate_dbutton'));
		 return $return_str;
	}

	function cout_images(){
		  $trave_image=new Traveimage();
		  $images_couts=$trave_image->count("trave_id=:trave_id",array(':trave_id'=>$this->id));
		  return $images_couts;
	}
	
	
	function converse_date(){
		 $date=new Date(intval($this->create_time));
		 return $date->format();
	}
	
	
	function get_belong_user_name(){
		$get_datas=$this->with("User")->findByPk($this->id,"",array());
		
		$user_login=$get_datas->User->user_login;
		return $user_login;
	}
	
	//过去线路的行程
	function get_trave_route_datas(){
		$trave_route_datas=$this->Traveroute();
		return $trave_route_datas;
	}
	
	
		//获得旅游线路的特价线路
  function get_bargain_travel($trave_category,$trave_sregion=""){
    $condition=" trave_bargain=:trave_bargain AND trave_status=:trave_status AND trave_sregion=:trave_sregion AND trave_category=:trave_category AND recycle=0 ORDER BY create_time DESC LIMIT 4";
    $params=array(':trave_bargain'=>'2',':trave_status'=>'2',':trave_category'=> $trave_category,':trave_sregion'=>$trave_sregion);
		$trave_bargain=$this->findAll(array('select'=>'id,trave_number,trave_name,trave_category,trave_shot_desc,trave_numbers,trave_title,system_indent','condition'=>$condition,'params'=>$params));
		return $trave_bargain;
	}
	//获得线路的第一张图片
	function get_trave_first_image($trave_id){
		  $trave_image=new Traveimage();
  	  $condition="t.trave_id=:trave_id AND Trave_area.trave_status=:trave_status";
  	  $params=array("trave_id"=>$trave_id,':trave_status'=>'1');
  	  
  	  $trave_images_datas=$trave_image->with("Images",'Trave_area')->find(array('condition'=>$condition,'params'=>$params,'order'=>'t.id ASC','together'=>true));
  	  if(!empty($trave_images_datas)){
  			$image_path=$trave_images_datas->Images->get_image_path();
  			$image_src=$trave_images_datas->Images->image_src;
  			$image_name=$trave_images_datas->Images->image_title;
  			$image_path="/".$image_path;
  			$return_str.="<span class='trave_b_image'><div class='b_img_cut'><img width='60' height='30' src='".Util::rename_thumb_file(60,30,$image_path,$image_src)."' alt='".$image_name."' title='".$image_name."'/></div></span>";
  	 }
  	  return $return_str;
  }
  
  
  	//获得线路的第一张图片
	function get_trave_hover_image($trave_id){
  	  $trave_image=new Traveimage();
  	  $condition="t.trave_id=:trave_id AND Trave_area.trave_status=:trave_status";
  	  $params=array("trave_id"=>$trave_id,':trave_status'=>'1');
  	  $trave_images_datas=$trave_image->with("Images",'Trave_area')->find(array('condition'=>$condition,'params'=>$params,'order'=>'t.id ASC','together'=>true));
  	  if(!empty($trave_images_datas)){
  			$image_path=$trave_images_datas->Images->get_image_path();
  			$image_src=$trave_images_datas->Images->image_src;
  			$image_name=$trave_images_datas->Images->image_title;
  			$image_path="/".$image_path;
  			$return_str.="<div class='trave_hover_image'><img src='".Util::rename_thumb_file(75,75,$image_path,$image_src)."' alt='".$image_name."' title='".$image_name."'/></div>";
  	 }
  	  return $return_str;
  }
  
  	//获得线路的第一张搜索图片图片
	function get_trave_search_first_image($trave_id){
		
		$trave_image=new Traveimage();
  	 $condition="t.trave_id=:trave_id AND Trave_area.trave_status=:trave_status";
  	  $params=array("trave_id"=>$trave_id,':trave_status'=>'1');
  	  $trave_images_datas=$trave_image->with("Images",'Trave_area')->find(array('condition'=>$condition,'params'=>$params,'order'=>'t.id ASC','together'=>true));
  	  if(!empty($trave_images_datas)){
  		 $image_path=$trave_images_datas->Images->get_image_path();
  		 $image_src=$trave_images_datas->Images->image_src;
  		 $image_name=$trave_images_datas->Images->image_title;
  		 $image_path="/".$image_path;
  		 $return_str.="<img width='145' height='80' src='".Util::rename_thumb_file(145,80,$image_path,$image_src)."' alt='".$image_name."' title='".$image_name."'/>";
  		}
  	  return $return_str;
  	  
  	  
  }
  
  
  
  //得到一周的前10热卖线路
  function get_trave_week_hot($trave_category,$trave_sregion=""){
  	$sql="SELECT t.id,t.trave_category,t.trave_number,t.trave_name,t.trave_numbers,t.trave_title,t.system_indent,t.trave_shot_desc,t.trave_category FROM {{trave}} as t,{{traveorder}} as o WHERE (TO_DAYS(NOW()) - TO_DAYS(FROM_UNIXTIME(o.create_time,'%Y-%m-%d %H:%i:%s')) <= 7) AND t.trave_sregion=:trave_sregion AND  o.trave_id=t.id AND o.pay_status=:pay_status AND t.trave_status=:trave_status AND t.trave_category=:trave_category AND t.recycle=0 AND (o.order_status='6' OR o.order_status='7') GROUP BY o.trave_id ORDER BY t.trave_numbers DESC LIMIT 10 ";
   //查找一周的订单
    $trave_datas=$this->findAllBySql($sql,array(':pay_status'=>'2',':trave_status'=>'2',':trave_sregion'=>$trave_sregion,':trave_category'=>$trave_category));

    return $trave_datas;
  }
  
  //得到首页周前10热卖线路
  function get_weekly_top10($trave_sregion){
  	$sql="SELECT t.id,t.trave_category,t.trave_number,t.trave_name,t.trave_numbers,t.trave_title,t.system_indent,(SELECT MIN(td.adult_price) FROM yt_travedate as td WHERE td.trave_id=t.id GROUP BY adult_price LIMIT 1) as adult_price FROM {{trave}} as t,{{traveorder}} as o WHERE (TO_DAYS(NOW()) - TO_DAYS(FROM_UNIXTIME(o.create_time,'%Y-%m-%d %H:%i:%s')) <= 7) AND t.trave_sregion=:trave_sregion AND  o.trave_id=t.id AND o.pay_status=:pay_status AND t.trave_status=:trave_status  AND t.recycle=0 AND (o.order_status='6' OR o.order_status='7') GROUP BY o.trave_id ORDER BY t.trave_numbers DESC LIMIT 10 ";
   //查找一周的订单
    $trave_datas=$this->findAllBySql($sql,array(':pay_status'=>'2',':trave_status'=>'2',':trave_sregion'=>$trave_sregion));
    return $trave_datas;
  }
  
  //得到首页前10月热卖线路
  function get_month_top10($trave_sregion){
  	$sql="SELECT t.id,t.trave_number,t.trave_category,t.trave_name,t.trave_numbers,t.trave_title,t.system_indent,(SELECT MIN(td.adult_price) FROM yt_travedate as td WHERE td.trave_id=t.id GROUP BY adult_price LIMIT 1) as adult_price FROM {{trave}} as t,{{traveorder}} as o WHERE (TO_DAYS(NOW()) - TO_DAYS(FROM_UNIXTIME(o.create_time,'%Y-%m-%d %H:%i:%s')) <= 31) AND t.trave_sregion=:trave_sregion AND  o.trave_id=t.id AND o.pay_status=:pay_status AND t.trave_status=:trave_status  AND t.recycle=0 AND (o.order_status='6' OR o.order_status='7') GROUP BY o.trave_id ORDER BY t.trave_numbers DESC LIMIT 10 ";
   //查找一月的订单
    $trave_datas=$this->findAllBySql($sql,array(':pay_status'=>'2',':trave_status'=>'2',':trave_sregion'=>$trave_sregion));
    return $trave_datas;
  }
  
  
  //得到各个特价线路的详细信息
  function get_trave_bargin_detail($trave_category,$trave_sregion=""){
  	
  	 $condition="trave_status=:trave_status AND trave_category=:trave_category  AND trave_bargain=:trave_bargain  AND trave_sregion=:trave_sregion AND recycle=0 ORDER BY create_time DESC";
     $params=array(':trave_status'=>'2',':trave_category'=>$trave_category,':trave_bargain'=>'2',':trave_sregion'=>$trave_sregion);
     $trave_bargin_datas=$this->findAll(array('select'=>'t.id,t.trave_number,t.trave_name,t.trave_numbers,t.trave_title,t.system_indent,t.trave_shot_desc,t.trave_category','condition'=>$condition,'params'=>$params));
    return $trave_bargin_datas;
  }
  
  
  
    //得到推荐的10条自由行线路
  function get_trave_free($trave_sregion=""){
     $condition="trave_status=:trave_status AND trave_category=:trave_category  AND trave_recommend=:trave_recommend  AND trave_sregion=:trave_sregion AND recycle=0 ORDER BY create_time DESC LIMIT 10";
     $params=array(':trave_status'=>'2',':trave_category'=>'5',':trave_recommend'=>'2',':trave_sregion'=>$trave_sregion);
     $trave_free_datas=$this->findAll($condition,$params);
    return $trave_free_datas;
  }
  
  
  function get_trave_recommend($trave_category,$trave_sregion=""){
  	//查找目的地
  	$sql="SELECT DISTINCT(trave_region) as trave_region FROM {{trave}} WHERE trave_status=:trave_status AND trave_category=:trave_category AND trave_recommend=:trave_recommend AND trave_sregion=:trave_sregion AND recycle=0 ORDER BY trave_region ASC";
  	$trave_datas=$this->findAllBySql($sql,array(':trave_status'=>'2',':trave_category'=>$trave_category,':trave_recommend'=>'2',':trave_sregion'=>$trave_sregion));
  	$return_array=array();
  	$district=new District();
  	
  	foreach($trave_datas as $key => $value){
  		//查找目的地的父类
  		 $temp=array();
  		 $sql="SELECT id, district_name FROM {{district}} WHERE id IN (SELECT parent_id FROM {{district}} WHERE id=:trave_region )";
  		 $district_names=$district->findBySql($sql,array(':trave_region'=>$value->trave_region));
  		 $temp['district_name']=$district_names->district_name;
  		 $temp['district_id']=$district_names->id;
  		 //查找目的地的线路
  		 $region_condition="trave_status=:trave_status AND trave_category=:trave_category AND trave_recommend=:trave_recommend AND trave_region=:trave_region AND trave_sregion=:trave_sregion AND recycle=0";
  
  		 $region_params=array(':trave_status'=>'2',':trave_category'=>$trave_category,':trave_recommend'=>'2',':trave_region'=>$value->trave_region,':trave_sregion'=>$trave_sregion);
  	
  		 $trave_region_datas=$this->findAll(array('select'=>'t.id,t.trave_number,t.trave_name,t.trave_numbers,t.trave_title,t.system_indent,t.trave_shot_desc,t.trave_category','condition'=>$region_condition,'params'=>$region_params,'order'=>'t.create_time DESC','limit'=>'10'));
  		 $temp['district_value']=$trave_region_datas;
  		 
  		 array_push($return_array,$temp);
  		 
  	}
  	$tem_key=array();
   
  	foreach($return_array as $key => $value){
  		$value_key=array_keys($tem_key,$value['district_name']);
  		if(empty($value_key)){
  			$tem_key[$key]=$value['district_name'];
  		}else{
  			$count=count($return_array[$value_key[0]]['district_value']);
  			if($count<10){
  				$return_array[$value_key[0]]['district_value']=array_merge($return_array[$value_key[0]]['district_value'],$value['district_value']);
  				unset($return_array[$key]);
  			}else{
  				unset($return_array[$key]);
  			}
  		}
  	}
  	
  	
  	return $return_array;
  }
  
  
  //得到旅游线路更多的页面
  function get_trave_more($trave_category,$trave_sregion,$province_id){
  	   $return_array=array();
  	   $district=new District();
  	   $sql="SELECT id, district_name FROM {{district}} WHERE parent_id=:province_id";
  		 $district_datas=$district->findAllBySql($sql,array(':province_id'=>$province_id));
  		 foreach($district_datas as $key => $value){
       $temp=array();

  		  //查找目的地的线路
  		 $region_condition="trave_status=:trave_status AND trave_category=:trave_category  AND trave_region=:trave_region AND trave_sregion=:trave_sregion AND recycle=0 ORDER BY create_time DESC";
  		 $region_params=array(':trave_status'=>'2',':trave_category'=>$trave_category,':trave_region'=>$value->id,':trave_sregion'=>$trave_sregion);
  		 $trave_region_datas=$this->findAll($region_condition,$region_params);
  		 if(!empty($trave_region_datas)){
  		 	 $temp['district_name']=$value->district_name;
  		   $temp['district_id']=$value->id;
  			 $temp['district_value']=$trave_region_datas;
  		 	 array_push($return_array,$temp);
  		 }
  		 	
  		}	
  	$tem_key=array();
  	foreach($return_array as $key => $value){
  		$value_key=array_keys($tem_key,$value['district_name']);
  		if(empty($value_key)){
  			$tem_key[$key]=$value['district_name'];
  		}else{
  			$return_array[$value_key[0]]['district_value']=array_merge($return_array[$value_key[0]]['district_value'],$value['district_value']);
  			unset($return_array[$key]);
  		}
  	}
  	return $return_array;
  }
  
  

  //判断自由行中入住酒店是否为空
  function is_empty_trave_hotels(){
  	if(empty($this->trave_hotels)){
				$this->addError('trave_hotels','入住酒店不能为空');
			}
  }
  
  //获取周边游的搜索资料
  function get_trave_category($trave_category=""){
  	if(!empty($trave_category)){
     $sql="SELECT DISTINCT(trave_linetype) as trave_linetype FROM {{trave}} WHERE trave_status=:trave_status AND trave_category=:trave_category AND recycle=0 ORDER BY trave_linetype ASC";
  	 $trave_datas=$this->findAllBySql($sql,array(':trave_status'=>'2',':trave_category'=>$trave_category));
  	}else{
  		$sql="SELECT DISTINCT(trave_linetype) as trave_linetype FROM {{trave}} WHERE trave_status=:trave_status AND recycle=0 ORDER BY trave_linetype ASC";
  	  $trave_datas=$this->findAllBySql($sql,array(':trave_status'=>'2'));
  	}
  	
  	$category_datas=array();
  	foreach($trave_datas as $key => $value){
  		$tem_array=explode(',',$value->trave_linetype);
  		$category_datas=array_merge($category_datas,$tem_array);
  	}
  	$category_datas=array_unique($category_datas);
  	$category=new Category();
  	$return_array=array();
 
  	foreach($category_datas as $key => $value){
       $temp=array();
  		 $sql="SELECT id,category_name FROM {{category}} WHERE id IN (SELECT parent_id FROM {{category}} WHERE id=:trave_linetype)";
  		 $category_names=$category->findBySql($sql,array(':trave_linetype'=>$value));
  		 if(!empty($category_names)){
  		 $temp['district_name']=$category_names->category_name;
  		 $temp['district_id']=$category_names->id;
  		 $category_values=$category->find(array('select'=>'id,category_name,sort_id','condition'=>'id=:id','params'=>array(':id'=>$value)));
  		 $category_value=array();
  		 $tem_category_value['id']=$category_values->id;
  		 $tem_category_value['name']=$category_values->category_name;
		   $tem_category_value['sort_id']=$category_values->sort_id;
  		 array_push($category_value,$tem_category_value);
  		 $temp['district_value']=$category_value;
  		 array_push($return_array,$temp);
  		}
  	}
  	$tem_key=array();
  	foreach($return_array as $key => $value){
  		$value_key=array_keys($tem_key,$value['district_name']);
  		if(empty($value_key)){
  			$tem_key[$key]=$value['district_name'];
  		}else{
  				$return_array[$value_key[0]]['district_value']=array_merge($return_array[$value_key[0]]['district_value'],$value['district_value']);
  				unset($return_array[$key]);
  		}
  	}
	//根据sort_id对数组进行排序
	foreach($return_array as $key => $value){
		$district_value=$value['district_value'];
		    usort($district_value,"category_cmp");
        $return_array[$key]['district_value']=$district_value;
	}
  	return $return_array;
  }

  
  //根据条件获得线路分类
  function get_condition_trave_category($trave_condition=""){
  	$category=new Category();
  	$return_array=array();
    $temp=array(); 	
  	$sql="SELECT id,category_name FROM {{category}} WHERE id=:trave_linetype";
  	$category_names=$category->findBySql($sql,array(':trave_linetype'=>$trave_condition));
    if(!empty($category_names)){
  		 $temp['district_name']=$category_names->category_name;
  		 $temp['district_id']=$category_names->id;
  		 $category_values=$category->findAll(array('select'=>'id,category_name,sort_id','condition'=>'parent_id=:parent_id','params'=>array(':parent_id'=>$category_names->id)));
  		 $category_value=array();
  		 foreach($category_values as $key => $value){
  		 	$tem_category_value['id']=$value->id;
  		  $tem_category_value['name']=$value->category_name;
		    $tem_category_value['sort_id']=$value->sort_id;
		     array_push($category_value,$tem_category_value);
  		 }
  		 $temp['district_value']=$category_value;
  		 array_push($return_array,$temp);
  		}
  	  return $return_array;
  	
  }

 
  //获得首页搜索时的线路分类
  function get_search_trave_category($trave_category=""){
  	if(!empty($trave_category)){
     $sql="SELECT DISTINCT(trave_linetype) as trave_linetype FROM {{trave}} WHERE trave_status=:trave_status AND trave_category=:trave_category ORDER BY trave_linetype ASC";
  	 $trave_datas=$this->findAllBySql($sql,array(':trave_status'=>'2',':trave_category'=>$trave_category));
  	}else{
  		$sql="SELECT DISTINCT(trave_linetype) as trave_linetype FROM {{trave}} WHERE trave_status=:trave_status ORDER BY trave_linetype ASC";
  	  $trave_datas=$this->findAllBySql($sql,array(':trave_status'=>'2'));
  	}
  	$category_datas=array();
  	foreach($trave_datas as $key => $value){
  		$tem_array=explode(',',$value->trave_linetype);
  		$category_datas=array_merge($category_datas,$tem_array);
  	}
  	$category_datas=array_unique($category_datas);
  	$category=new Category();
  	$return_array=array();
  	$search_line_type=CV::$FILTER_SEARCH_LINE_TYPE;
  	$implode_search_line_type=implode(',',$search_line_type);
  	foreach($category_datas as $key => $value){
       $temp=array();
  		 $sql="SELECT id,category_name FROM {{category}} WHERE FIND_IN_SET(id,'$implode_search_line_type')>0 AND id IN (SELECT parent_id FROM {{category}} WHERE id=:trave_linetype)";
  		 $category_names=$category->findBySql($sql,array(':trave_linetype'=>$value));
  		 if(!empty($category_names)){
  		 $temp['id']=$category_names->id;
  		 $temp['name']=$category_names->category_name;
  		 array_push($return_array,$temp);
  		}
  	} 
  	$json_array=array();
  	$unique_array=array(); 	
  	foreach($return_array as $key => $value){
  		if(!in_array($value['id'],$unique_array)){
  			array_push($unique_array,$value['id']);
  			array_push($json_array,$value);
  		}
  	}
  	return $json_array;
  }
  
  
  function get_trave_characteristic(){
  	$category_id='337';
		$conditions['parent_id']=$category_id;
		$category=new Category();
		$category_datas=$category->get_table_datas("",$conditions);
		$return_array=array();
		foreach($category_datas as $key => $value){
			array_push($return_array,$value->id);
		}
		$trave_linetype=$this->trave_linetype;
		$trave_linetype_array=explode(',',$trave_linetype);
		$intersect_array=array_intersect($return_array,$trave_linetype_array);
		$return_characteristic=array();
		if(!empty($intersect_array)){
			  
			  foreach($intersect_array as $key => $value){
			  	 $characteristic_datas=$category->get_table_datas($value);
			  	 $return_characteristic[$characteristic_datas->id]=$characteristic_datas->category_name; 
			  }
		}
		return $return_characteristic;
		

  }
  
    //获取周边游的搜索资料
  function get_free_trave_distrinct($free_category){
   //查找目的地
  	$sql="SELECT DISTINCT(trave_region) as trave_region FROM {{trave}} WHERE trave_status=:trave_status AND trave_category=:trave_category AND free_category=:free_category AND recycle=0 ORDER BY trave_region ASC";
  	$trave_datas=$this->findAllBySql($sql,array(':trave_status'=>'2',':trave_category'=>'5',':free_category'=>$free_category));
  	$return_array=array();
  	$district=new District();
  	foreach($trave_datas as $key => $value){
  		//查找目的地的父类
  		 $temp=array();
  		 $sql="SELECT id,district_name FROM {{district}} WHERE id IN (SELECT parent_id FROM {{district}} WHERE id=:trave_region )";
  		 $district_names=$district->findBySql($sql,array(':trave_region'=>$value->trave_region));
  		 if(!empty($district_names)){
  		 	$temp['district_name']=$district_names->district_name;
  		 	$temp['district_id']=$district_names->id;
  		 	$district_values=$district->get_table_datas($value->trave_region,array());
  		 	$district_value=array();
  		 	$tem_district_value['id']=$district_values->id;
  		 	$tem_district_value['name']=$district_values->district_name;
  		 	array_push($district_value,$tem_district_value);
  		 	$temp['district_value']=$district_value;
  		 	array_push($return_array,$temp);
  		 } 		 
   } 
    $tem_key=array();
  	foreach($return_array as $key => $value){
  		$value_key=array_keys($tem_key,$value['district_name']);
  		if(empty($value_key)){
  			$tem_key[$key]=$value['district_name'];
  		}else{
  				$return_array[$value_key[0]]['district_value']=array_merge($return_array[$value_key[0]]['district_value'],$value['district_value']);
  				unset($return_array[$key]);
  		}
  	}
    return $return_array;
  }
  
  
  //获取国内的搜索资料
  function get_travel_region($trave_category=""){
  	
  	if(empty($trave_category)){
  		  	//查找目的地
  	  $sql="SELECT DISTINCT(trave_region) as trave_region FROM {{trave}} WHERE trave_status=:trave_status AND recycle=0  ORDER BY trave_region ASC";
  	  $trave_datas=$this->findAllBySql($sql,array(':trave_status'=>'2'));
  	}else{
  		  	//查找目的地
  	  $sql="SELECT DISTINCT(trave_region) as trave_region FROM {{trave}} WHERE trave_status=:trave_status AND trave_category=:trave_category AND recycle=0 ORDER BY trave_region ASC";
  	  $trave_datas=$this->findAllBySql($sql,array(':trave_status'=>'2',':trave_category'=>$trave_category));
  	}

  	$return_array=array();
  	$district=new District();
  	foreach($trave_datas as $key => $value){
  		//查找目的地的父类
  		 $temp=array();
  	
  		 $sql="SELECT id,district_name FROM {{district}} WHERE id IN (SELECT parent_id FROM {{district}} WHERE id=:trave_region )";
  		 $district_names=$district->findBySql($sql,array(':trave_region'=>$value->trave_region));
  		 
  		 if(!empty($district_names)){
  		 	$temp['district_name']=$district_names->district_name;
  		 	$temp['district_id']=$district_names->id;
  		 	$district_values=$district->find(array('select'=>'id,district_name','condition'=>'id=:id','params'=>array(':id'=>$value->trave_region)));
  		 	$district_value=array();
  		 	$tem_district_value['id']=$district_values->id;
  		 	$tem_district_value['name']=$district_values->district_name;
  		 	array_push($district_value,$tem_district_value);
  		 	$temp['district_value']=$district_value;
  		 	array_push($return_array,$temp);
  		 }
  		 		 
   } 
   
  
    $tem_key=array();
  	foreach($return_array as $key => $value){
  		$value_key=array_keys($tem_key,$value['district_name']);
  		if(empty($value_key)){
  			$tem_key[$key]=$value['district_name'];
  		}else{
  				$return_array[$value_key[0]]['district_value']=array_merge($return_array[$value_key[0]]['district_value'],$value['district_value']);
  				unset($return_array[$key]);
  		}
  	}
    return $return_array;
  }
  
  
    //获取国庆周边游的搜索资料
  function get_guoqing_trave_category($trave_category=""){
  	if(!empty($trave_category)){
     $sql="SELECT DISTINCT(trave_linetype) as trave_linetype FROM {{trave}} WHERE trave_status=:trave_status AND trave_category=:trave_category AND (trave_name LIKE '%国庆%' OR trave_name LIKE '%十一%') AND recycle=0 ORDER BY trave_linetype ASC";
  	 $trave_datas=$this->findAllBySql($sql,array(':trave_status'=>'2',':trave_category'=>$trave_category));
  	}else{
  		$sql="SELECT DISTINCT(trave_linetype) as trave_linetype FROM {{trave}} WHERE trave_status=:trave_status AND (trave_name LIKE '%国庆%' OR trave_name LIKE '%十一%') AND recycle=0 ORDER BY trave_linetype ASC";
  	  $trave_datas=$this->findAllBySql($sql,array(':trave_status'=>'2'));
  	}
  	
  	$category_datas=array();
  	foreach($trave_datas as $key => $value){
  		$tem_array=explode(',',$value->trave_linetype);
  		$category_datas=array_merge($category_datas,$tem_array);
  	}
  	$category_datas=array_unique($category_datas);
  	$category=new Category();
  	$return_array=array();
 
  	foreach($category_datas as $key => $value){
       $temp=array();
  		 $sql="SELECT id,category_name FROM {{category}} WHERE id IN (SELECT parent_id FROM {{category}} WHERE id=:trave_linetype)";
  		 $category_names=$category->findBySql($sql,array(':trave_linetype'=>$value));
  		 if(!empty($category_names)){
  		 $temp['district_name']=$category_names->category_name;
  		 $temp['district_id']=$category_names->id;
  		 $category_values=$category->find(array('select'=>'id,category_name,sort_id','condition'=>'id=:id','params'=>array(':id'=>$value)));
  		 $category_value=array();
  		 $tem_category_value['id']=$category_values->id;
  		 $tem_category_value['name']=$category_values->category_name;
		   $tem_category_value['sort_id']=$category_values->sort_id;
  		 array_push($category_value,$tem_category_value);
  		 $temp['district_value']=$category_value;
  		 array_push($return_array,$temp);
  		}
  	}
  	$tem_key=array();
  	foreach($return_array as $key => $value){
  		$value_key=array_keys($tem_key,$value['district_name']);
  		if(empty($value_key)){
  			$tem_key[$key]=$value['district_name'];
  		}else{
  				$return_array[$value_key[0]]['district_value']=array_merge($return_array[$value_key[0]]['district_value'],$value['district_value']);
  				unset($return_array[$key]);
  		}
  	}
	//根据sort_id对数组进行排序
	foreach($return_array as $key => $value){
		$district_value=$value['district_value'];
		    usort($district_value,"category_cmp");
        $return_array[$key]['district_value']=$district_value;
	}
  	return $return_array;
  }
  
    
  //获取国庆的搜索资料
  function get_guoqing_travel_region($trave_category=""){
  	
  	if(empty($trave_category)){
  		  	//查找目的地
  	  $sql="SELECT DISTINCT(trave_region) as trave_region FROM {{trave}} WHERE trave_status=:trave_status AND (trave_name LIKE '%国庆%' OR trave_name LIKE '%十一%') AND recycle=0  ORDER BY trave_region ASC";
  	  $trave_datas=$this->findAllBySql($sql,array(':trave_status'=>'2'));
  	}else{
  		  	//查找目的地
  	  $sql="SELECT DISTINCT(trave_region) as trave_region FROM {{trave}} WHERE trave_status=:trave_status AND trave_category=:trave_category AND (trave_name LIKE '%国庆%' OR trave_name LIKE '%十一%') AND recycle=0 ORDER BY trave_region ASC";
  	  $trave_datas=$this->findAllBySql($sql,array(':trave_status'=>'2',':trave_category'=>$trave_category));
  	}

  	$return_array=array();
  	$district=new District();
  	foreach($trave_datas as $key => $value){
  		//查找目的地的父类
  		 $temp=array();
  	
  		 $sql="SELECT id,district_name FROM {{district}} WHERE id IN (SELECT parent_id FROM {{district}} WHERE id=:trave_region )";
  		 $district_names=$district->findBySql($sql,array(':trave_region'=>$value->trave_region));
  		 
  		 if(!empty($district_names)){
  		 	$temp['district_name']=$district_names->district_name;
  		 	$temp['district_id']=$district_names->id;
  		 	$district_values=$district->find(array('select'=>'id,district_name','condition'=>'id=:id','params'=>array(':id'=>$value->trave_region)));
  		 	$district_value=array();
  		 	$tem_district_value['id']=$district_values->id;
  		 	$tem_district_value['name']=$district_values->district_name;
  		 	array_push($district_value,$tem_district_value);
  		 	$temp['district_value']=$district_value;
  		 	array_push($return_array,$temp);
  		 }
  		 		 
   } 
   
  
    $tem_key=array();
  	foreach($return_array as $key => $value){
  		$value_key=array_keys($tem_key,$value['district_name']);
  		if(empty($value_key)){
  			$tem_key[$key]=$value['district_name'];
  		}else{
  				$return_array[$value_key[0]]['district_value']=array_merge($return_array[$value_key[0]]['district_value'],$value['district_value']);
  				unset($return_array[$key]);
  		}
  	}
    return $return_array;
  }
  
  //根据条件获得线路目的地
  function get_condition_trave_region($trave_condition=""){
  		$return_array=array();
  		$district=new District();
  		//查找目的地的父类
  		 $temp=array();
  		 $sql="SELECT id,district_name FROM {{district}} WHERE id=:trave_region";
  		 $district_names=$district->findBySql($sql,array(':trave_region'=>$trave_condition));
  		 if(!empty($district_names)){
  		 	$temp['district_name']=$district_names->district_name;
  		 	$temp['district_id']=$district_names->id;
  		 	$district_values=$district->findAll(array('select'=>'id,district_name,parent_id','condition'=>'parent_id=:parent_id','params'=>array(':parent_id'=>$district_names->id)));
  		 	$district_value=array();
  		 	foreach($district_values as $key => $value){
  		 		$tem_district_value['id']=$value->id;
  		 		$tem_district_value['name']=$value->district_name;
  		 		array_push($district_value,$tem_district_value);
  			}
  			 $temp['district_value']=$district_value;
  		 		array_push($return_array,$temp);
  		 }
       return $return_array;
  }
  
  
  
  function get_search_travel_region($trave_category){
  	if(empty($trave_category)){
  		  	//查找目的地
  	  $sql="SELECT DISTINCT(trave_region) as trave_region FROM {{trave}} WHERE trave_status=:trave_status  ORDER BY trave_region ASC";
  	  $trave_datas=$this->findAllBySql($sql,array(':trave_status'=>'2'));
  	}else{
  		  	//查找目的地
  	  $sql="SELECT DISTINCT(trave_region) as trave_region FROM {{trave}} WHERE trave_status=:trave_status AND trave_category=:trave_category ORDER BY trave_region ASC";
  	  $trave_datas=$this->findAllBySql($sql,array(':trave_status'=>'2',':trave_category'=>$trave_category));
  	}
  	$return_array=array();
  	$district=new District();
  	foreach($trave_datas as $key => $value){
  		//查找目的地的父类
  		 $temp=array();
  		 $sql="SELECT id,district_name FROM {{district}} WHERE id IN (SELECT parent_id FROM {{district}} WHERE id=:trave_region )";
  		 $district_names=$district->findBySql($sql,array(':trave_region'=>$value->trave_region));
  		 if(!empty($district_names)){
  		 	$temp['id']=$district_names->id;
  		 	$temp['name']=$district_names->district_name;
  		 	array_push($return_array,$temp);
  		 }	 
   } 
   $json_array=array();
  	$unique_array=array(); 	
  	foreach($return_array as $key => $value){
  		if(!in_array($value['id'],$unique_array)){
  			array_push($unique_array,$value['id']);
  			array_push($json_array,$value);
  		}
  		
  	}
  	return $json_array;
  }
  
  //获得搜索的出发城市
  function get_trave_sregion(){
		$sql="SELECT DISTINCT(trave_sregion) as trave_sregion FROM {{trave}} WHERE trave_status=:trave_status ORDER BY trave_sregion ASC";
  	$trave_datas=$this->findAllBySql($sql,array(':trave_status'=>'2'));
  	$district=new District();
  	$sregion_datas=array();
  	foreach($trave_datas as $key => $value){
  		$district_datas=$district->find(array('select'=>'id,district_name','condition'=>'id=:id','params'=>array(':id'=>$value->trave_sregion)));
  		if(!empty($district_datas))
  		  $sregion_datas[$district_datas->id]=$district_datas->district_name;
  	}
  	return $sregion_datas;
  }
  

  //获得首页的最新最热线路
  function get_trave_latest($show_type,$trave_sregion){
  	switch($show_type){
  		case '1':
  		   $conditions="trave_sregion=:trave_sregion AND trave_recommend=:trave_recommend AND (trave_category <> '5') AND t.trave_status=:trave_status AND recycle=0";
  	     $params=array(':trave_sregion'=>$trave_sregion,':trave_recommend'=>'2',':trave_status'=>'2');
  		   break;
  		case '2':
  		   $conditions="trave_sregion=:trave_sregion AND trave_category=:trave_category AND t.trave_status=:trave_status AND recycle=0";
  	     $params=array(':trave_sregion'=>$trave_sregion,':trave_category'=>'5',':trave_status'=>'2');
  		   break;
  		case '3':
  		   $conditions="trave_sregion=:trave_sregion AND trave_category <> '5' AND trave_recommend <> '2' AND t.trave_status=:trave_status AND recycle=0";
  	     $params=array(':trave_sregion'=>$trave_sregion,':trave_status'=>'2');
  		   break;
  	}
  	$conditions.=" AND show_index=:show_index";
  	$params[':show_index']='1';
    $criteria=new CDbCriteria;
    $criteria->select="id,trave_title,trave_category,trave_bargain,trave_ordain,trave_name,trave_shot_desc,(SELECT MIN(td.adult_price) FROM yt_travedate as td WHERE td.trave_id=t.id GROUP BY adult_price LIMIT 1) as adult_price";
		$criteria->condition=$conditions;
		$criteria->params=$params;
		//$criteria->with=array('Travedate'=>array("select"=>'MIN(adult_price) as adult_price','condition'=>'','params'=>array(),'group'=>'Travedate.adult_price','together'=>true));
		$criteria->order="t.create_time DESC,t.trave_numbers DESC,adult_price DESC";
		$criteria->limit="10";
  	$trave_datas=$this->findAll($criteria);
  	return $trave_datas;
  }
  
  
  //获得首页的热门评论
  function get_comment_latest($trave_sregion){
  	$conditions="trave_sregion=:trave_sregion  AND t.trave_status=:trave_status AND recycle=0";
  	$params=array(':trave_sregion'=>$trave_sregion,':trave_status'=>'2');
   
		$criteria=new CDbCriteria;
    $criteria->select="id,trave_title,trave_category,system_indent,trave_name,trave_shot_desc,(SELECT MIN(td.adult_price) FROM yt_travedate as td WHERE td.trave_id=t.id GROUP BY adult_price LIMIT 1) as adult_price,(SELECT COUNT(td.id) FROM yt_trave_comment as td WHERE td.trave_id=t.id  LIMIT 1) as count_ids";
		$criteria->condition=$conditions;
		$criteria->params=$params;
		//$criteria->with=array('Travedate'=>array("select"=>'MIN(adult_price) as adult_price','condition'=>'','params'=>array(),'group'=>'Travedate.adult_price','together'=>true));
		$criteria->order="count_ids DESC,t.trave_numbers DESC,t.create_time DESC";
		$criteria->limit="8";
  	$trave_datas=$this->findAll($criteria);
  	return $trave_datas;
	
}
  
  //获取首页的热门推荐
  
  function get_trave_hot_recommend($trave_category,$trave_sregion){
  	$conditions="show_index=:show_index AND trave_sregion=:trave_sregion AND trave_category=:trave_category AND trave_recommend=:trave_recommend AND t.trave_status=:trave_status AND recycle=0";
  	$params=array('show_index'=>'1',':trave_sregion'=>$trave_sregion,':trave_category'=>$trave_category,':trave_recommend'=>'2',':trave_status'=>'2');
  	
  	$criteria=new CDbCriteria;
    $criteria->select="id,trave_shot_desc,system_indent,trave_numbers,trave_title,trave_category,trave_bargain,trave_ordain,trave_name,trave_category,(SELECT MIN(td.adult_price) FROM yt_travedate as td WHERE td.trave_id=t.id GROUP BY adult_price LIMIT 1) as adult_price";
		$criteria->condition=$conditions;
		$criteria->params=$params;
		//$criteria->with=array('Travedate'=>array("select"=>'MIN(adult_price) as adult_price','condition'=>'','params'=>array(),'group'=>'Travedate.adult_price','together'=>true));
		$criteria->order="t.create_time DESC,t.trave_numbers DESC,adult_price DESC";
		if($trave_category=='2'||$trave_category=='3'){
		   $criteria->limit="10";
		}else{
		   $criteria->limit="8";
		}
  	$trave_datas=$this->findAll($criteria);
  	return $trave_datas;
  }

  function get_trave_keywords_recommend($trave_category,$trave_sregion){
  	$trave_area=new Travearea();
  	$sql="SELECT t.trave_area FROM {{travearea}} AS t,{{trave}} as tr WHERE t.id >= (SELECT floor(RAND() * (SELECT MAX(id) FROM {{travearea}} ))) AND t.trave_id=tr.id AND tr.trave_sregion=:trave_sregion AND tr.trave_category=:trave_category AND tr.trave_status=:trave_status AND tr.recycle=:recycle ORDER BY t.id LIMIT 10";
  	$trave_area_datas=$trave_area->findAllBySql($sql,array(':trave_sregion'=>$trave_sregion,':trave_category'=>$trave_category,':trave_status'=>'2',':recycle'=>'0'));
  	$trave_area_name="";
  	foreach($trave_area_datas as $key => $value){
  		if(empty($trave_area_name))
  		   $trave_area_name.=$value->trave_area;
  		else
  		   $trave_area_name.=",".$value->trave_area;
  	}
  	return $trave_area_name;
  }
  
  //得到首页的显示特价
  function get_limited_special($trave_category,$trave_sregion){
  	$condition="show_index=:show_index AND trave_sregion=:trave_sregion AND trave_category=:trave_category AND trave_bargain=:trave_bargain AND t.trave_status=:trave_status AND recycle=0";
  	$params=array('show_index'=>'1',':trave_sregion'=>$trave_sregion,':trave_category'=>$trave_category,':trave_bargain'=>'2',':trave_status'=>'2');
  	$criteria=new CDbCriteria;
  	$criteria->select="id,trave_category,trave_title,trave_shot_desc,trave_name,system_indent,trave_numbers,coupon,(SELECT MIN(td.adult_price) FROM yt_travedate as td WHERE td.trave_id=t.id GROUP BY adult_price LIMIT 1) as adult_price";
		$criteria->condition=$condition;
		$criteria->params=$params;
		//$criteria->with=array('Travedate'=>array("select"=>'MIN(adult_price) as adult_price','condition'=>'','params'=>array(),'group'=>'Travedate.adult_price','together'=>true));
		$criteria->order="t.trave_numbers DESC,adult_price DESC,t.create_time DESC";
		$criteria->limit="10";
  	$trave_datas=$this->findAll($criteria);
  	return $trave_datas;
  }

  function get_limited_special_keywords($trave_sregion){
  	$condition="trave_sregion=:trave_sregion AND trave_bargain=:trave_bargain AND trave_status=:trave_status AND recycle=0 ORDER BY create_time DESC LIMIT 5";
  	$params=array(':trave_sregion'=>$trave_sregion,':trave_bargain'=>'2',':trave_status'=>'2');
  	$trave_datas=$this->findAll($condition,$params);
  	return $trave_datas;
  }
  
  
  function get_coupon_describe(){
  	$system=new System();
  	$golden_system=$system->get_system_value("golden_coupon");
  	$diamond_system=$system->get_system_value("diamond_coupon");
  	$return_str="（可优惠".$this->coupon."元/人,黄金会员可以再优惠".$golden_system."元,钻石会员可以再优惠".$diamond_system."元）";
  	return $return_str;
  }
  
  
    //后台预览线路
  function preview_trave(){
     $preview_link=CHtml::link($this->trave_name,Yii::app()->homeUrl."/travel/travelpreview/id/".$this->id."/user_id/".Yii::app()->user->id.".html",array('target'=>'_blank'));
     return $preview_link;

  }
  
  //后台预览线路
  function preview_dtrave(){
  	 $trave_name=Util::cs($this->trave_name,20);
     $preview_link=CHtml::link($trave_name,Yii::app()->homeUrl."/travel/travelpreview/id/".$this->id."/user_id/".Yii::app()->user->id.".html",array('target'=>'_blank'));
     return $preview_link;
  }
  
  //克隆线路
  function clone_trave($trave_id,$trave_category,$trave_package,$free_category){
     $trave_datas=$this->get_table_datas($trave_id);
     $trave_datas->id=null;
      $trave_datas->setIsNewRecord(true);
     $trave_number=$trave_datas->trave_number;
     $trave_datas->trave_category=$trave_category;
     $trave_datas->is_package=$trave_package;
     $trave_datas->free_category=$free_category;
     $trave_datas->trave_status='1';
     $trave_datas->trave_numbers='0';
     if($trave_category!=5){
     	$trave_datas->trave_hotels="";
     	$trave_datas->default_hotel="0";
     }
     $trave_datas->insert();
     $trave_area=Travearea::model();
     $condition['trave_id']=$trave_id;
     $trave_area_datas=$trave_area->get_table_datas("",$condition);
     $replace_trave_areas=array();
     foreach($trave_area_datas as $key => $value){
     	 $value->id=null;
     	 $value->setIsNewRecord(true);
     	 $trave_area_id=$value->id;
     	 $value->trave_id=$trave_datas->id;
     	 $value->insert();
     	 $replace_trave_areas[$trave_area_id]=$value->id;
     	 $trave_image=Traveimage::model();
     	 $image_condition['trave_id']=$trave_id;
     	 $image_condition['trave_area_id']=$trave_area_id;
     	 $trave_image_datas=$trave_image->get_table_datas("",$image_condition);
     	 foreach($trave_image_datas as $key1 => $value1){
     	 	   $value1->id=null;
     	 	   $value1->setIsNewRecord(true);
     	 	   $value1->trave_id=$trave_datas->id;
     	 	   $value1->trave_area_id=$value->id;
     	 	   $value1->insert();	 
     	 }
     }
     
    
     $trave_date=Travedate::model();
     $trave_date_datas=$trave_date->get_table_datas("",$condition);
     foreach($trave_date_datas as $key => $value){
     	$value->id=null;
     	$value->setIsNewRecord(true);
       $value->trave_id=$trave_datas->id;
       if($trave_category!=5){
         $value->flight_id="0";
         $value->back_flight_id="0";
         $value->flight_price="0";
       }
       $value->insert();	
    }
    $trave_route=Traveroute::model();
    $trave_route_datas=$trave_route->get_table_datas("",$condition);
    foreach($trave_route_datas as $key => $value){
    	$value->id=null;
    	$value->setIsNewRecord(true);
    	$value->trave_id=$trave_datas->id;
    	$trave_route_value=$value->trave_route;
    	 $return_trave_route=array();
    	if(!empty($trave_route_value)){
    	  $trave_route_value_arr=explode(",",$trave_route_value);
    	  $replace_trave_areas_keys=array_keys($replace_trave_areas);
    	  foreach($trave_route_value_arr as $key1 => $value1){
    		  if(in_array($value1,$replace_trave_areas_keys)){
    			  array_push($return_trave_route,$replace_trave_areas[$value1]);
    		  }
    	  }
    	  $value->trave_route=implode(",",$return_trave_route);
      }
    	
    	
    	$value->insert();
    }  
    return true;
  }
  
  //获得古镇专题的线路
function get_guzhen_travel($trave_sregion){
	$trave_name="古镇";
	$guzhen_datas=$this->findAll(array('select'=>'*,(SELECT MIN(td.adult_price) FROM yt_travedate as td WHERE td.trave_id=t.id GROUP BY adult_price LIMIT 1) as adult_price','condition'=>'trave_name LIKE "%'.$trave_name.'%" AND trave_sregion=:trave_sregion AND trave_status=:trave_status AND recycle=0','params'=>array(':trave_sregion'=>$trave_sregion,':trave_status'=>'2'),'limit'=>'10','order'=>'adult_price DESC'));
	return $guzhen_datas;
}

//获得三亚专题的线路
function get_sanya_travel($trave_sregion){
	$trave_name="三亚";
	$guzhen_datas=$this->findAll(array('select'=>'*,(SELECT MIN(td.adult_price) FROM yt_travedate as td WHERE td.trave_id=t.id GROUP BY adult_price LIMIT 1) as adult_price','condition'=>'trave_name LIKE "%'.$trave_name.'%" AND trave_sregion=:trave_sregion AND trave_status=:trave_status AND recycle=0','params'=>array(':trave_sregion'=>$trave_sregion,':trave_status'=>'2'),'limit'=>'10','order'=>'adult_price DESC'));
	return $guzhen_datas;
	
}
//获得线路的游记和攻略
function get_trave_threads(){
	$trave_id=$this->id;
	$trave_threads=new TraveThreads();
	$trave_threads_datas=$trave_threads->findAll(array('select'=>'*','condition'=>'trave_id=:trave_id','params'=>array(':trave_id'=>$trave_id),'order'=>'sort ASC','limit'=>'3'));
	return $trave_threads_datas;
}


//根据线路的id获得线路的信息
function get_travel_data_by_ids($ids=array()){
	$return_datas=array();
	foreach($ids as $key => $value){
		$travel_data=$this->findByPk($value['id']);
		$attributes=$travel_data->attributes;
		if(!empty($value['image'])){
				$attributes['image']=$value['image'];
		}else{
			  $attributes['image']=$this->get_first_image($value['id']);
		}
		$return_datas[]=$attributes;
	}
	return $return_datas;
}
	
	
//获得线路的第一张图片
	function get_first_image($trave_id){
		  $trave_image=new Traveimage();
  	  $condition="t.trave_id=:trave_id AND Trave_area.trave_status=:trave_status";
  	  $params=array("trave_id"=>$trave_id,':trave_status'=>'1');
  	  $trave_images_datas=$trave_image->with("Images",'Trave_area')->find(array('condition'=>$condition,'params'=>$params,'order'=>'t.id ASC','together'=>true));
  	  $return_str="";
  	  if(!empty($trave_images_datas)){
  			$image_path=$trave_images_datas->Images->get_image_path();
  			$image_src=$trave_images_datas->Images->image_src;
  			$return_str="/".$image_path."/".$image_src;
  	 }
  	 return $return_str;
  }
}

function category_cmp($a, $b){
    if ($a['sort_id'] == $b['sort_id']){
        return 0;
    }
    return ($a['sort_id'] < $b['sort_id']) ? -1 : 1;
}
?>
