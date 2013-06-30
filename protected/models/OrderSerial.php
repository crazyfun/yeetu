<?php

/**
 * This is the model class for table "{{order_serial}}".
 *
 * The followings are the available columns in table '{{order_serial}}':
 * @property string $id
 * @property string $order_id
 * @property string $serial_value
 * @property string $create_time
 */
class OrderSerial extends BaseActive
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
		return '{{order_serial}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id, create_time', 'length', 'max'=>11),
			array('serial_value', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, order_id, serial_value, create_time', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'order_id' => 'Order',
			'serial_value' => 'Serial Value',
			'create_time' => 'Create Time',
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
		$criteria->compare('serial_value',$this->serial_value,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	
	
	//插入一笔旅游的数据
	public function insert_order_serial(){
		if(!$this->hasErrors()){
			  $datas=$this->save();
			  return $datas;
		}
	}
 function beforeSave(){
	 if(parent::beforeSave()){
			if($this->isNewRecord){
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
	
	
	//获得serial_value值
	function get_serial_value($order_id){
	   if(empty($order_id)){
	      $order_id=$this->order_id;
	   }	
	   $order_serial_datas=$this->get_table_datas("",array('order_id'=>$order_id));
	   $order_serial_data=$order_serial_datas[0];
	   $serial_value=$order_serial_data->serial_value;
	   if(!empty($serial_value)){
	   	   return unserialize($serial_value);
	   }
	}
	

}