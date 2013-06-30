<?php

/**
 * This is the model class for table "{{orderpay}}".
 *
 * The followings are the available columns in table '{{orderpay}}':
 * @property string $id
 * @property string $order_id
 * @property string $notify_id
 * @property string $total_fee
 * @property string $receive_name
 * @property string $receive_address
 * @property string $receive_zip
 * @property string $receive_phone
 * @property string $receive_mobile
 * @property string $create_time
 */
class Orderpay extends BaseActive
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
		return '{{orderpay}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('total_fee,order_id','required','message'=>'{attribute}不能为空'),
		  array('total_fee','validate_total_free'),
			array('order_id, total_fee, create_time,operate_id,create_id', 'length', 'max'=>11),
			array('receive_name, receive_phone, receive_mobile', 'length', 'max'=>30),
			array('receive_address,notify_id', 'length', 'max'=>100),
			array('receive_zip', 'length', 'max'=>10),
			array('trade_type','length','max'=>'1'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, order_id, notify_id, total_fee, receive_name, receive_address, receive_zip, receive_phone, receive_mobile, create_time', 'safe', 'on'=>'search'),
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
		  'OUser'=>array(self::BELONGS_TO, 'User', 'operate_id'),
		  'Order'=>array(self::BELONGS_TO,'Traveorder','order_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'order_id' => '订单号',
			'web_notify_id'=>'内部流水号',
			'notify_id' => '外部流水号',
			'total_fee' => '交易总数',
			'trade_type' => '交易接口类型',
			'receive_name' => '付款人名称',
			'receive_address' => '付款人地址',
			'receive_zip' => '付款人邮编',
			'receive_phone' => '付款人电话号码',
			'receive_mobile' => '付款人手机号码',
			'operate_id'=>'操作用户',
			'create_id'=>'付款用户',
			'create_time' => '创建时间',
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
		$criteria->compare('order_id',$this->order_id,true);
		$criteria->compare('notify_id',$this->notify_id,true);
		$criteria->compare('total_fee',$this->total_fee,true);
		$criteria->compare('receive_name',$this->receive_name,true);
		$criteria->compare('receive_address',$this->receive_address,true);
		$criteria->compare('receive_zip',$this->receive_zip,true);
		$criteria->compare('receive_phone',$this->receive_phone,true);
		$criteria->compare('receive_mobile',$this->receive_mobile,true);
		$criteria->compare('create_time',$this->create_time,true);
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	



			//插入一笔旅游的数据
	public function insert_orderpay(){
		if(!$this->hasErrors()){
				$datas=$this->save();
			  return $datas;
		}
	}
 function beforeSave(){
	 if(parent::beforeSave()){
			if($this->isNewRecord){
          $web_notify_id=date('YmdHis');
          $this->web_notify_id=$web_notify_id;
				  $this->create_id=Yii::app()->user->id;
		      $this->create_time=Util::current_time('timestamp');
			}
			return true;

		}else{
			return false;
		}
	}
	function afterSave(){
		
		    $trave_order=new Traveorder();
				$remain_pay=$trave_order->get_remain_pay($this->order_id);
        
				if($remain_pay<=0){
					$update_datas['pay_status']='2';
					$trave_order->update_table_datas($this->order_id,$update_datas);
				}else{
					$update_datas['pay_status']='3';
					$trave_order->update_table_datas($this->order_id,$update_datas);
				}
		    return true;
	}
	
	
	function validate_total_free(){
		 $trave_order=new Traveorder();
		 $order_id=$this->order_id;
		 $trave_order_datas=$trave_order->get_table_datas($order_id);
		 $aleady_pay_nums=$trave_order->get_aleady_pay($order_id);
		 $total_nums=$trave_order_datas->total_price;
		 $tem_total_nums=$aleady_pay_nums+$this->total_fee;
		 if($tem_total_nums > $total_nums){
		 	  $this->addError("total_fee","支付金额大于总支付金额");
		 }

	}
	
	function get_trade_type(){
		$pay_style_select=CV::$PAY_STYLE;
		return $pay_style_select[$this->trade_type];
	}
	
	function get_operate_user(){
		$user=new User();
		$user_datas=$user->get_table_datas($this->operate_id);
		return $user_datas->user_login;
	}
}