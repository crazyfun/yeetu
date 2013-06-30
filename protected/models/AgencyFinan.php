<?php

/**
 * This is the model class for table "{{agency_finan}}".
 *
 * The followings are the available columns in table '{{agency_finan}}':
 * @property string $id
 * @property string $order_id
 * @property string $trave_id
 * @property string $agency_id
 * @property string $finan_price
 * @property string $create_id
 * @property string $create_time
 */
class AgencyFinan extends BaseActive
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
		return '{{agency_finan}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id,trave_id,agency_id,finan_price','required','message'=>'{attribute}不能为空'),
			array('finan_price','validate_finan_price'),
			array('order_id, trave_id, agency_id, finan_price, create_id, create_time', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, order_id, trave_id, agency_id, finan_price, create_id, create_time', 'safe', 'on'=>'search'),
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
		  'Trave'=>array(self::BELONGS_TO, 'Trave', 'trave_id'),
		  'Agency'=>array(self::BELONGS_TO, 'Agency', 'agency_id'),
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
			'trave_id' => '线路名称',
			'agency_id' => '供应商名称',
			'finan_price' => '结算价格',
			'create_id' => '结算人',
			'create_time' => '结算时间',
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
		$criteria->compare('trave_id',$this->trave_id,true);
		$criteria->compare('agency_id',$this->agency_id,true);
		$criteria->compare('finan_price',$this->finan_price,true);
		$criteria->compare('create_id',$this->create_id,true);
		$criteria->compare('create_time',$this->create_time,true);
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	
		//插入一笔旅游的数据
	public function insert_finan(){
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
			}else{
				$this->create_id=Yii::app()->user->id;
				$this->create_time=Util::current_time('timestamp');
			}
			return true;
		}else{
			return false;
		}

	}
	
	
	
	function afterSave(){	
		  $remain_pay=$this->get_remain_pay();
		  $trave_order=new Traveorder();
		  $order_id=$this->order_id;
		  if($remain_pay<=0){
		  	 $update_datas['suppliers_settle']='3';
		  	 $trave_order->update_table_datas($order_id,$update_datas);
		  }else{
		  	 $update_datas['suppliers_settle']='2';
		  	 $trave_order->update_table_datas($order_id,$update_datas);
		  }
		  return true;
	}
	
	
	
	
	function validate_finan_price(){
		$remain_pay=$this->get_remain_pay();
		if($this->finan_price>$remain_pay){
			$this->addError("finan_price","结算价钱大于可结算价钱");
		}
	}
	
	
	function get_total_pay($order_id=""){
		if(empty($order_id)){
			$order_id=$this->order_id;
		}
		
		$trave_order=new Traveorder();
		$trave_order_datas=$trave_order->get_table_datas($order_id,array());
		$start_date_id=$trave_order_datas->start_date_id;
		$adult_nums=intval($trave_order_datas->adult_nums);
		$child_nums=intval($trave_order_datas->child_nums);

		$trave_date=new Travedate();
		$trave_date_datas=$trave_date->get_table_datas($start_date_id,array());
		$fa_price=intval($trave_date_datas->fa_price);
    $fc_price=intval($trave_date_datas->fc_price);
    $return_price=($fa_price*$adult_nums)+($fc_price*$child_nums);
    return $return_price;
	}
	
	function get_already_pay($order_id=""){
		if(empty($order_id)){
			$order_id=$this->order_id;
		}
		$already_pay_datas=$this->findAll(array('select'=>'finan_price','condition'=>'order_id=:order_id','params'=>array(':order_id'=>$order_id)));
		$total_already_price=0;
		foreach($already_pay_datas as $key => $value){
			$total_already_price+=$value->finan_price;
		}
		return $total_already_price;
	}
	
	function get_remain_pay($order_id=""){
		if(empty($order_id)){
			$order_id=$this->order_id;
		}
		$total_pay=$this->get_total_pay($order_id);
		$already_pay=$this->get_already_pay($order_id);
		$remain_pay=$total_pay-$already_pay;
		return $remain_pay;
	}
}