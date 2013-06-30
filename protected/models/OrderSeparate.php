<?php

/**
 * This is the model class for table "{{order_separate}}".
 *
 * The followings are the available columns in table '{{order_separate}}':
 * @property string $id
 * @property string $order_id
 * @property double $separate_price
 * @property integer $status
 * @property string $create_id
 * @property string $create_time
 */
class OrderSeparate extends BaseActive
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
		return '{{order_separate}}';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id,separate_price','required','message'=>'{attribute}不能为空'),
			array('status', 'length', 'max'=>1),
			array('separate_price', 'numerical'),
			array('order_id, create_id, create_time', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, order_id, separate_price, status, create_id, create_time', 'safe', 'on'=>'search'),
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
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '拆单ID',
			'order_id' => '订单ID',
			'separate_price' => '拆单价钱',
			'status' => '付款状态',
			'create_id' => '拆单人',
			'create_time' => '拆单时间',
		);
	}
	
	
	
		private function get_attributes(){
		  return array(
			'id',
			'order_id',
			'separate_price',
			'status',
			'create_id',
			'create_time',
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
		$criteria->compare('separate_price',$this->separate_price);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_id',$this->create_id,true);
		$criteria->compare('create_time',$this->create_time,true);
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}




	
	
			//插入一笔旅游的数据
	public function insert_order_separate(){
		if(!$this->hasErrors()){
			  $datas=$this->save();
			  return $datas;
	
		}
	}

 function beforeSave(){
	 if(parent::beforeSave()){
			if($this->isNewRecord){
			  $this->create_id=Yii::app()->user->id;
		      $this->create_time=Util::current_time('timestamp');
			}
			return true;
		}else{
			return false;
		}
	}
	
	function afterSave(){
		      return true;
	}
	
	//获得未付款的拆单项
	
	function get_remain_separate($order_id){
		if(empty($order_id)){
			  $order_id=$this->order_id;
		}
		$remain_separate_datas=$this->findAll("order_id=:order_id AND status=:status",array('order_id'=>$order_id,'status'=>''));
		return $remain_separate_datas;
		
	}
	

}