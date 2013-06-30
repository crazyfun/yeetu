<?php

/**
 * This is the model class for table "{{traveorder}}".
 *
 * The followings are the available columns in table '{{traveorder}}':
 * @property string $id
 * @property string $trave_id
 * @property string $adult_nums
 * @property string $adult_price
 * @property string $child_nums
 * @property integer $child_price
 * @property string $start_date
 * @property integer $total_price
 * @property string $insurance_ids
 * @property integer $pay_status
 * @property string $order_remark
 * @property string $create_id
 * @property string $create_time
 */
class Traveorder extends BaseActive
{
  public static function model($className=__CLASS__)
	{
	
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{traveorder}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('child_price,pay_status,start_date_id,suppliers_settle', 'numerical', 'integerOnly'=>true),
			array('trave_id,room_id,adult_nums, adult_price, child_nums, create_id,operate_id,relation_id, create_time,operate_time,total_price', 'length', 'max'=>11),
			array('start_date', 'length', 'max'=>20),
			array('is_invoice,order_status,pay_style,order_style,order_source,order_level,suppliers_settle','length','max'=>1),
			array('room_nums,trave_route_number','length','max'=>2),
			array('insurance_ids', 'length', 'max'=>30),
			array('order_remark,separate_nums,coupon_value', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, trave_id, adult_nums, adult_price, child_nums, child_price, start_date, total_price, insurance_ids, pay_status, order_remark, create_id, create_time', 'safe', 'on'=>'search'),
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
			'trave' => array(self::BELONGS_TO, 'Trave', 'trave_id'),
			'user' => array(self::BELONGS_TO,'User','create_id'),
			'relation'=>array(self::BELONGS_TO,'User','relation_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '订单ID',
			'trave_id' => '线路名称',
			'start_date_id'=>'出发时间ID',
			'adult_nums' => '成人数',
			'adult_price' => '成人价钱',
			'child_nums' => '儿童数',
			'child_price' => '儿童价钱',
			'start_date' => '出发时间',
			'total_price' => '总价钱',
			'coupon_value'=>'优惠劵',
			'separate_nums'=>'拆单数',
			'insurance_ids' => '保险ID',
			'pay_status' => '付款状态',
			'pay_style'=> '支付方式',
			'order_style'=>'下单方式',
			'order_source'=>'来源地',
			'order_level'=>'订单等级',
			'order_status' => '订单状态',
			'suppliers_settle'=>'供应商结算',
			'order_remark' => '订单备注',
			'room_id'=>'房间ID',
			'room_nums'=>'房间数',
			'trave_route_number'=>'入住晚数',
			'is_invoice'=>'发票',
			'create_id' => '订单者',
			'operate_id'=>'最后操作者',
			'relation_id'=>'关联者',
			'operate_time'=>'处理时间',
			'create_time' => '下单时间',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('trave_id',$this->trave_id,true);
		$criteria->compare('adult_nums',$this->adult_nums,true);
		$criteria->compare('adult_price',$this->adult_price,true);
		$criteria->compare('child_nums',$this->child_nums,true);
		$criteria->compare('child_price',$this->child_price);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('total_price',$this->total_price);
		$criteria->compare('insurance_ids',$this->insurance_ids,true);
		$criteria->compare('pay_status',$this->pay_status);
		$criteria->compare('order_remark',$this->order_remark,true);
		$criteria->compare('create_id',$this->create_id,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	
	
		//删除一笔数据
	public function delete_table_datas($pk_id="",$condition=array()){
		if(!empty($pk_id)){
			$datas=$this->deleteByPk($pk_id,"",array());
			if($datas){
			 $this->delete_relation_table($pk_id);
		  }
		}else{
			 $com_condition=$this->com_condititions($condition);
			 $search_datas=$this->findAll(array('select'=>'id','condition'=>$com_condition['condition'],'params'=>$com_condition['params']));
			 foreach($search_datas as $key => $value){
			 	$datas=$this->deleteByPk($value->id,"",array());
			 	if($datas){
			    $this->delete_relation_table($value->id);
		     }
			}
		}
		return $datas;
	}
	
	
	//删除与订单相关联的表
	public function delete_relation_table($order_id){
		$order_separate=new OrderSeparate();
		$condition['order_id']=$order_id;
		$order_separate->delete_table_datas("",$condition);
		$order_serial=new OrderSerial();
		$order_serial->delete_table_datas("",$condition);
		$order_contact=new Ordercontact();
		$contact_condition['trave_order_id']=$order_id;
		$order_contact->delete_table_datas("",$contact_condition);
		$order_pay=new Orderpay();
		$order_pay->delete_table_datas("",$condition);
		$agency_finan=new AgencyFinan();
		$agency_finan->delete_table_datas("",$condition);
	}
	
	
	
	/**
	 * 
	 * 最近的订单记录
	 * @param int $limit
	 */
	public function recently($limit=5)
	{
		$this->getDbCriteria()->mergeWith(array(
			'order' => 'create_time DESC',
			'limit' => $limit,
		));
		
		return $this;
	}
	

	
	
			//插入一笔旅游的数据
	public function insert_traveorder(){
		if(!$this->hasErrors()){
			  $datas=$this->save();
			  return $datas;
		}
	}

 function beforeSave(){
	 if(parent::beforeSave()){
			if($this->isNewRecord){
				  $serial=new Serial;
				  $search_serial_datas['serial_name']='Trave Order';
				  $serial_datas=$serial->get_table_datas("",$search_serial_datas);
				  $this->id=$serial_datas[0]->serial_value;
				  if(empty($this->create_id)){
					  $this->create_id=Yii::app()->user->id;
					 }
		      $this->create_time=Util::current_time('timestamp');
			}
			return true;
		}else{
			return false;
		}
	}
	
	function afterSave(){
		if($this->isNewRecord){
					$serial=new Serial;
				  $search_serial_datas['serial_name']='Trave Order';
				  $serial_datas=$serial->get_table_datas("",$search_serial_datas);
				  $attributes['serial_value']=$serial_datas[0]->serial_value+1;
				  $serial->update_table_datas($serial_datas[0]->id,$attributes);
		}
		      return true;
	}
	
	//获得订单的线路名字
	function get_trave_name($trave_id=""){
		$trave_id=empty($trave_id)?$this->trave_id:$trave_id;
		$trave=new Trave();
		$trave_datas=$trave->get_table_datas($trave_id);
		return $trave_datas->trave_name;

	}
	
	//获得订单状态
	function get_order_status($order_status=""){
		$order_status=empty($order_status)?$this->order_status:$order_status;
		$order_status_str="";
		if(($order_status=='1')||($order_status=='2')||($order_status=='3')||($order_status=='4')||($order_status=='5')){
			$order_status_str="正在处理";
		}else if(($order_status=='6')||($order_status=='7')){
			$order_status_str="预定成功";
		}else if(($order_status=='8')){
			$order_status_str="已取消";
		}else{
			$order_status_str="正在处理";
		}
		return $order_status_str;
	}
	//获得用户操作连接
  function get_order_operate($pay_status="",$order_status=""){
  	$controller=Yii::app()->getController();
  	$pay_status=empty($pay_status)?$this->pay_status:$pay_status;
  	$tem_order_status=$this->order_status;
  	$trave=new Trave();
  	$trave_id=$this->trave_id;
    $trave_datas=$trave->get_table_datas($trave_id);
    $result_str="";
    
    $trave_ordain=$trave_datas->trave_ordain;
    switch($trave_ordain){
    	case '1':
    	 if(($tem_order_status=='1')||($tem_order_status=='2')||($tem_order_status=='3')||($tem_order_status=='4')||($tem_order_status=='5')){
    	   if($pay_status=='1'||$pay_status=='3'){
  		   	 $order_param=array();
  		   	 if(!empty($order_status)){
  		   	 	 $order_param=array('id'=>$this->id,'order_status'=>$order_status);
  		   	 }else{
  		   	 	  $order_param=array('id'=>$this->id);
  		   	 }
  		 
  		   	 $order_separate=new OrderSeparate();
  		   	 $remain_separate_datas=$order_separate->get_remain_separate($this->id);
  		   	 if(!empty($remain_separate_datas)){
  		   	 	foreach($remain_separate_datas as $key => $value){
  		   	 	 $result_str.=CHtml::link("付款(".$value->separate_price.")",$controller->createUrl("travel/userorder",array('id'=>$this->trave_id,'order_id'=>$this->id,'separate_id'=>$value->id,'pay_price'=>$value->separate_price)),array('rel'=>"nofollow"))."|";
  		   	  }
  		   	 }else{
  		   	  $result_str.=CHtml::link("付款(".$this->total_price.")",$controller->createUrl("travel/userorder",array('id'=>$this->trave_id,'order_id'=>$this->id,'pay_price'=>$this->total_price)),array('rel'=>"nofollow"))."|";
  		     }
  		     
  		   	 $result_str.=CHtml::link("取消",$controller->createUrl("user/cancelorder",$order_param))."|";
  		   }
  		 }
    	   break;
    	default:
    	 if(($tem_order_status=='2')||($tem_order_status=='3')||($tem_order_status=='4')||($tem_order_status=='5')){
    	   if($pay_status=='1'||$pay_status=='3'){
  		   	 $order_param=array();
  		   	 if(!empty($order_status)){
  		   	 	 $order_param=array('id'=>$this->id,'order_status'=>$order_status);
  		   	 }else{
  		   	 	  $order_param=array('id'=>$this->id);
  		   	 }

  		   	 
  		   	 $order_separate=new OrderSeparate();
  		   	 
  		   	 $remain_separate_datas=$order_separate->get_remain_separate($this->id);
  		   	 if(!empty($remain_separate_datas)){
  		   	 	
  		   	 	foreach($remain_separate_datas as $key => $value){
  		   	 	 $result_str.=CHtml::link("付款(".$value->separate_price.")",$controller->createUrl("travel/userorder",array('id'=>$this->trave_id,'order_id'=>$this->id,'separate_id'=>$value->id,'pay_price'=>$value->separate_price)),array('rel'=>"nofollow"))."|";
  		   	  }
  		   	 }else{
  		   	  $result_str.=CHtml::link("付款(".$this->total_price.")",$controller->createUrl("travel/userorder",array('id'=>$this->trave_id,'order_id'=>$this->id,'pay_price'=>$this->total_price)),array('rel'=>"nofollow"))."|";
  		     }
  		   	 
  		   	 $result_str.=CHtml::link("取消",$controller->createUrl("user/cancelorder",$order_param))."|";
  		   }
  		 }
    	   break;
    }
  	$result_str.=CHtml::link("查看",$controller->createUrl("user/orderview",array('id'=>$this->id)),array('rel'=>"nofollow"));
  	return $result_str;
  }

  function get_admin_order_operate(){
  	$controller=Yii::app()->getController();
  	$pay_status=$this->pay_status;
  	$tem_order_status=$this->order_status;
    $result_str="";
    $order_param=array('id'=>$this->id);
    if($pay_status=='1'&&$tem_order_status!='7'&&$tem_order_status!='6'&&$tem_order_status!='8'){
    	$remain_pay=$this->get_remain_pay();
    	if($remain_pay>0){
    	  $result_str.=CHtml::link("付款",$controller->createUrl("order/adminpay",array('order_id'=>$this->id)),array('class'=>'operate_button'));
    	 }
    	$result_str.=CHtml::link("拆单",$controller->createUrl("order/separate",array('id'=>$this->id)),array('class'=>'operate_button'));
    }
    if($pay_status=='3'&&$tem_order_status!='7'&&$tem_order_status!='6'&&$tem_order_status!='8'){
    	$remain_pay=$this->get_remain_pay();
    	if($remain_pay>0){
    	  $result_str.=CHtml::link("付款",$controller->createUrl("order/adminpay",array('order_id'=>$this->id)),array('class'=>'operate_button'));
    	}
    }
  	switch($tem_order_status){
  		case '1':
  		   $result_str.=CHtml::link("计调确认",$controller->createUrl("order/status",array('id'=>$this->id,'order_status'=>'2')),array('class'=>'operate_button'));
  		   $result_str.=CHtml::link("取消",$controller->createUrl("order/status",array('id'=>$this->id,'order_status'=>'8')),array('class'=>'operate_dbutton'));
  		   break;
  		case '2':
  		   $result_str.=CHtml::link("客服联系",$controller->createUrl("order/status",array('id'=>$this->id,'order_status'=>'3')),array('class'=>'operate_button'));
  		   $result_str.=CHtml::link("取消",$controller->createUrl("order/status",array('id'=>$this->id,'order_status'=>'8')),array('class'=>'operate_dbutton'));
  		   break;
  		case '3':
  		   $result_str.=CHtml::link("客户答复",$controller->createUrl("order/status",array('id'=>$this->id,'order_status'=>'4')),array('class'=>'operate_button'));
  		   $result_str.=CHtml::link("取消",$controller->createUrl("order/status",array('id'=>$this->id,'order_status'=>'8')),array('class'=>'operate_dbutton'));
  		   break;
  		case '4':
  		   $result_str.=CHtml::link("已发确认书",$controller->createUrl("order/status",array('id'=>$this->id,'order_status'=>'5')),array('class'=>'operate_button'));
  		   $result_str.=CHtml::link("取消",$controller->createUrl("order/status",array('id'=>$this->id,'order_status'=>'8')),array('class'=>'operate_dbutton'));
  		   break;
  		case '5':
  		   if($pay_status=='2'){
  		     $result_str.=CHtml::link("转成正式订单",$controller->createUrl("order/status",array('id'=>$this->id,'order_status'=>'6')),array('class'=>'operate_button'));
  		   }
  		   $result_str.=CHtml::link("取消",$controller->createUrl("order/status",array('id'=>$this->id,'order_status'=>'8')),array('class'=>'operate_dbutton'));
  		   break;
  		case '6':
  		  if($pay_status=='2'){
  		    $result_str.=CHtml::link("已发团通知书",$controller->createUrl("order/status",array('id'=>$this->id,'order_status'=>'7')),array('class'=>'operate_button'));
  		  }
  		   $result_str.=CHtml::link("取消",$controller->createUrl("order/status",array('id'=>$this->id,'order_status'=>'8')),array('class'=>'operate_dbutton'));
  		   break;
      case '7':
  		   $result_str.=CHtml::link("取消",$controller->createUrl("order/status",array('id'=>$this->id,'order_status'=>'8')),array('class'=>'operate_dbutton'));
  		   break;
  		case '8':
  		   $result_str.=CHtml::link("启用",$controller->createUrl("order/status",array('id'=>$this->id,'order_status'=>'1')),array('class'=>'operate_button')); 
  		   break;
  		default:
  		   break;
  	}
  	$result_str.=CHtml::link("修改/查看",$controller->createUrl("order/add",$order_param),array('class'=>'operate_button'));
  	return $result_str;
  	
  }
  
  
  //获得首页默认的订单
  function get_default_order_operate(){
  	$controller=Yii::app()->getController();
  	$pay_status=$this->pay_status;
  	$tem_order_status=$this->order_status;
    $result_str="";
    $order_param=array('id'=>$this->id);
    
  	switch($tem_order_status){
  		case '1':
  		   $result_str.=CHtml::link("计调确认",$controller->createUrl("order/status",array('id'=>$this->id,'order_status'=>'2')),array())."|";
  		   break;
  		case '2':
  		   $result_str.=CHtml::link("客服联系",$controller->createUrl("order/status",array('id'=>$this->id,'order_status'=>'3')),array())."|";
  		   break;
  		case '3':
  		   $result_str.=CHtml::link("客户答复",$controller->createUrl("order/status",array('id'=>$this->id,'order_status'=>'4')),array())."|";
  		   break;
  		case '4':
  		   $result_str.=CHtml::link("已发确认书",$controller->createUrl("order/status",array('id'=>$this->id,'order_status'=>'5')),array())."|";
  		   break;
  		case '5':
  		   if($pay_status=='2'){
  		     $result_str.=CHtml::link("转成正式订单",$controller->createUrl("order/status",array('id'=>$this->id,'order_status'=>'6')),array())."|";
  		   }
  		   break;
  		case '6':
  		  if($pay_status=='2'){
  		    $result_str.=CHtml::link("已发团通知书",$controller->createUrl("order/status",array('id'=>$this->id,'order_status'=>'7')),array())."|";
  		  }
  		   break;
  		default:
  		   break;
  	}
  	
  	if($pay_status=='1'&&$tem_order_status!='7'&&$tem_order_status!='6'&&$tem_order_status!='8'){
    	$result_str.=CHtml::link("拆单",$controller->createUrl("order/separate",array('id'=>$this->id)),array());
    }
  	return $result_str;
  }
  
  
  
  //获得订单各个状态的数量
  function get_order_nums($user_id=""){
  	$return_array=array();
  	$user_id=empty($user_id)?Yii::app()->user->id:$user_id;
  	$all_condition="create_id=:user_id";
  	$all_params=array(':user_id'=>$user_id);
  	$order_datas=$this->findAll($all_condition,$all_params);
  	$all_nums=0;
  	$ordering_nums=0;
  	$success_nums=0;
  	$failed_nums=0;
  	foreach($order_datas as $key => $value){
  		$order_status=$value->order_status;
  		if(($order_status=='1')||($order_status=='2')||($order_status=='3')||($order_status=='4')||($order_status=='5')){
  			$ordering_nums+=1;
  		}
  		if(($order_status=='6')||($order_status=='7')){
  			$success_nums+=1;
  		}
  		if(($order_status=='8')){
  			$failed_nums+=1;
  		}
  		$all_nums+=1;
  	}
  	$return_array['all_nums']=$all_nums;
  	$return_array['ordering_nums']=$ordering_nums;
  	$return_array['success_nums']=$success_nums;
  	$return_array['failed_nums']=$failed_nums;
  	return $return_array;
  }
  //显示出发城市
  function get_trave_sregion(){
  	
  	 $trave_district=new District(); 
  	 $trave_sregion_data=$trave_district->get_table_datas($this->trave->trave_sregion);
  	return $trave_sregion_data['district_name'];
  }
  
  
  //显示目的地
  function get_trave_region(){
  	  $trave_district=new District();
  	  $trave_region_data=$trave_district->get_table_datas($this->trave->trave_region);
  	  return $trave_region_data['district_name'];
  }
  //获得线路类别
  function get_trave_category(){
    $trave_category=CV::$TRAVE_CATEGORY;
  	return $trave_category[$this->trave->trave_category];
  }
  
  //获得处理状态
  function get_trave_order_status(){
  	$order_status=CV::$ORDER_STATUS;
  	return $order_status[$this->order_status];
  }
  //获得支付状态
   function get_trave_pay_status(){
   	$pay_status=CV::$PAY_STATUS;
  	return $pay_status[$this->pay_status];
  }
  
  //获得订单发票
  function get_invoince_datas(){
     $invoice_array=array("0"=>"不需要","1"=>"需要");
     return $invoice_array[$this->is_invoice];
  }
  
  
  //获得线路订单的总人数
  
  function get_trave_date_peoples($trave_id,$start_time){
	  	 $conditions="t.start_date=:start_date AND t.trave_id=:trave_id AND (t.order_status='6' OR t.order_status='7') AND t.pay_status=:pay_status ";
	  	 $params=array(':start_date'=>$start_time,':trave_id'=>$trave_id,':pay_status'=>'2');
	  	 $trave_order_datas=$this->findAll(array('select'=>'adult_nums,child_nums','condition'=>$conditions,'params'=>$params));
	  	 $total_nums=0;
	  	 foreach($trave_order_datas as $key1 => $value1){
         $total_nums+=intval($value1->adult_nums)+intval($value1->child_nums);
	  	 }
	  	 return $total_nums;
  	
  }
  
  //获得拆单后的价钱数组
  function get_separate_nums($total_price,$separate_nums){
 	 if($separate_nums&&$total_price){
 	   $separate_price=$total_price/$separate_nums;
 	   $remainder_price=$total_price%$separate_nums;
 	   $return_array=array();
 	   if(!empty($separate_price)){
 	    for($ii=1;$ii<=$separate_nums;$ii++){
 	   	 array_push($return_array, $separate_price);
 	    }
  	}
  	if(!empty($remainder_price)){
  		array_push($return_array,$remainder_price);
  	}
  }
  return $return_array;
 }
 
 //获得某个订单已经支付的总价钱
   function get_aleady_pay($order_id=""){
   	  if(empty($order_id)){
   	  	 $order_id=$this->id;
   	  }
   	  $order_pay=new Orderpay();
   	  $order_pay_datas=$order_pay->find(array(
   	    'select'=>'SUM(total_fee) as total_fee',
   	    'condition'=>'order_id=:order_id',
   	    'params'=>array(':order_id'=>$order_id),
   	  ));
   	  return  $order_pay_datas->total_fee;
   }
   
   
   //获得可支付金额
   
   function get_remain_pay($order_id=""){
   	if(empty($order_id)){
   		$order_id=$this->id;
   	}
    $aleady_pay_nums=$this->get_aleady_pay($order_id);
    $trave_order_datas=$this->get_table_datas($order_id);
		$total_nums=$trave_order_datas->total_price;
		$remain_pay=$total_nums-$aleady_pay_nums;
		return $remain_pay;
	}
	
	
	    //获得订单的各种统计信息
     function get_order_statist($trave_order_datas){
    	$total_price=0;
    	$aleady_pay=0;
    	$remain_pay=0;
    	$total_order=0;
    	$return_array=array();
    	foreach($trave_order_datas as $key => $value){
    		$total_order++;
    		$total_price+=floatval($value->total_price);
    		$aleady_pay+=floatval($value->get_aleady_pay());
    		$remain_pay+=floatval($value->get_remain_pay());
    	}
     $return_array['total_price']=$total_price;
     $return_array['aleady_pay']=$aleady_pay;
     $return_array['remain_pay']=$remain_pay;
     $return_array['total_order']=$total_order;
    	return $return_array;
    }
    
    
	//获得订单的统计信息
	function get_order_static_information($condition,$params,$trave_condition,$trave_params,$trave_with){
		$validate_sregion=Yii::app()->getController()->validate_sregion();
	  if($validate_sregion){
	    $validate_sregion=" AND ".$validate_sregion;
	  }
	  
		$trave_order_datas=$this->findAll(array(
		   'select'=>'*',
		    'condition'=>implode(' AND ',$condition),
			  'params'=>$params,
			  'with'=>array('trave'=>array('select'=>'trave.id,trave.trave_name','condition'=>'(1=1)'.$validate_sregion.$trave_condition,'params'=>$trave_params,'with'=>$trave_with,'together'=>true)),
		 ));
		  $total_price=0;
    	$aleady_pay=0;
    	$remain_pay=0;
    	$total_order=0;
    	$return_array=array();
    	foreach($trave_order_datas as $key => $value){
    		$total_order++;
    		$total_price+=floatval($value->total_price);
    		$aleady_pay+=floatval($value->get_aleady_pay());
    		$remain_pay+=floatval($value->get_remain_pay());
    	}
     $return_array['total_price']=$total_price;
     $return_array['aleady_pay']=$aleady_pay;
     $return_array['remain_pay']=$remain_pay;
     $return_array['total_order']=$total_order;
    	return $return_array;
		
	}
	
	//获得与供应商结算资料
	function get_suppliers_settle(){
		$suppliers_settle=CV::$SUPPLIERS_SETTLE;
		return $suppliers_settle[$this->suppliers_settle];
	}
	
	//获得财务的操作按钮
	function get_financial_operate(){
		$pay_status=$this->pay_status;
		$suppliers_settle=$this->suppliers_settle;
		if(($pay_status=='2')&&($suppliers_settle!='3')){
			 $result_str=CHtml::link("结算",Yii::app()->getController()->createUrl("financial/adminfinan",array('order_id'=>$this->id)),array('class'=>'operate_button'));
		}
		return $result_str;
	}
	
	function get_order_profit(){
		$start_date_id=$this->start_date_id;
		$adult_nums=intval($this->adult_nums);
		$child_nums=intval($this->child_nums);
		$coupon_value=intval($this->coupon_value);
		$trave_date=new Travedate();
		$trave_date_datas=$trave_date->get_table_datas($start_date_id,array());
		$fa_price=intval($trave_date_datas->fa_price);
    $fc_price=intval($trave_date_datas->fc_price);
		$child_price=intval($this->child_price);
    $adult_price=intval($this->adult_price);
    $return_price=(($adult_price-$fa_price)*$adult_nums)+(($child_price-$fc_price)*$child_nums)-intval($coupon_value);
    return $return_price;
		
	}
	
	function get_start_date_flight(){
		$start_date_id=$this->start_date_id;
		$trave_date=new Travedate();
		$trave_date_datas=$trave_date->get_table_datas($start_date_id);
		$flight_id=$trave_date_datas->flight_id;
		$trave_flight=new TraveFlight();
		$trave_flight_datas=$trave_flight->get_table_datas($flight_id);
		if(!empty($flight_id)){
		
		  $suggestions_data=CHtml::link($trave_flight_datas->go_flight."(".$trave_flight_datas->departure."->".$trave_flight_datas->destinations.",".$trave_date_datas->flight_price.",".$trave_flight_datas->go_flight_type.",".$trave_flight_datas->go_flight_time.")",Yii::app()->getController()->createUrl("flights/traveflight",array('flight_id'=>$trave_flight_datas->id)),array());
		}
		return $suggestions_data;

	}
	
		function get_back_start_date_flight(){
		$start_date_id=$this->start_date_id;
		$trave_date=new Travedate();
		$trave_date_datas=$trave_date->get_table_datas($start_date_id);
		$flight_id=$trave_date_datas->back_flight_id;
		$trave_flight=new TraveFlight();
		$trave_flight_datas=$trave_flight->get_table_datas($flight_id);
		if(!empty($flight_id)){
		  $suggestions_data=CHtml::link($trave_flight_datas->go_flight."(".$trave_flight_datas->departure."->".$trave_flight_datas->destinations.",".$trave_flight_datas->go_flight_type.",".$trave_flight_datas->go_flight_time.")",Yii::app()->getController()->createUrl("flights/traveflight",array('flight_id'=>$trave_flight_datas->id)),array());
		}
		return $suggestions_data;

		
	}
	
	
	function get_order_hotel_name(){
		$room_id=$this->room_id;
		$hotel_room=new HotelRoom();
		$hotel_room_datas=$hotel_room->get_table_datas($room_id);
		$hotel_name=$hotel_room_datas->Hotels->hotel_name;
		if(!empty($room_id))
		   $return_str=CHtml::link($hotel_name,Yii::app()->getController()->createUrl("hotels/search",array('hotel_name'=>$hotel_room_datas->Hotels->id)),array());
		return $return_str;
	}
	
	function get_order_room_name(){
		
		$room_id=$this->room_id;
		$hotel_room=new HotelRoom();
		$hotel_room_datas=$hotel_room->get_table_datas($room_id);
		$room_name=$hotel_room_datas->RoomStyle->room_style;
		if(!empty($room_id))
		   $return_str=$room_name."(".$hotel_room_datas->room_people.",".$hotel_room_datas->room_yprice.")";
		return $return_str;
	}
	
	function get_pay_contacter(){
		$order_id=$this->id;
    $ordercontact=new Ordercontact();
    $condition="trave_order_id=:trave_order_id AND main_contact=:main_contact";
    $params=array(':trave_order_id'=>$order_id,':main_contact'=>'1');
    $ordercontact_datas=$ordercontact->find(array('condition'=>$condition,'params'=>$params));
    return $ordercontact_datas->contact_name;
	}
	
	function get_pay_contacter_phone(){
		$order_id=$this->id;
    $ordercontact=new Ordercontact();
    $condition="trave_order_id=:trave_order_id AND main_contact=:main_contact";
    $params=array(':trave_order_id'=>$order_id,':main_contact'=>'1');
    $ordercontact_datas=$ordercontact->find(array('condition'=>$condition,'params'=>$params));
    return $ordercontact_datas->contact_phone;
	}
	
}