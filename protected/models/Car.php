<?php

/**
 * This is the model class for table "{{syestem}}".
 *
 * The followings are the available columns in table '{{syestem}}':
 * @property string $id
 * @property string $config_name
 * @property string $config_value
 * @property string $config_desc
 * @property string $create_id
 * @property string $create_time
 */
class Car extends BaseActive
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
		return '{{car}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		//  array('footlink_name,footlink_order,footlink_desc','required','message'=>'{attribute}不能为空'),
		//  array('footlink_name',"exist_footlink_name"),
			array('car_driver', 'length', 'max'=>30),
			array('create_time', 'length', 'max'=>11),
			array('motorcade_id,car_driver,car_num,car_type,driver_phone,trave,price,status,car_desc,use_date,create_id', 'safe'),
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, motorcade_id, car_driver, car_num, driver_phone, trave, price, status, car_desc', 'safe', 'on'=>'search'),
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
			'Motorcade'=>array(self::BELONGS_TO,'Motorcade','motorcade_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'car_driver' => '司机',
			'motorcade_id' => '车队名称',
			'car_num' => '车牌',
			'car_type' => '车型',
			'driver_phone' => '司机电话',
			'trave'=>'线路',
			'price'=>'价格',
			'status'=>'结算状态',
			'car_desc'=>'车辆描述',

			'use_date'=>'车辆使用日期',

			'create_id'=>'创建人',

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
		$criteria->compare('car_driver',$this->car_driver,true);
		$criteria->compare('motorcade_id',$this->motorcade_id,true);
		$criteria->compare('car_num',$this->car_num,true);
		$criteria->compare('car_type',$this->car_type,true);
		$criteria->compare('driver_phone',$this->driver_phone,true);
		$criteria->compare('trave',$this->trave,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('car_desc',$this->car_desc,true);
		$criteria->compare('use_date',$this->use_date,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	

	
		/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function searchdatas()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$conditions=array();
		$params=array();
		$page_params=array();
		$car_num=$_REQUEST['car_num'];
		$driver_phone = $_REQUEST['driver_phone'];
		$trave = $_REQUEST['trave'];
		$motorcade_id=$_REQUEST['motorcade_id'];
		if(!empty($car_num)){
			array_push($conditions,"car_num LIKE :car_num");
			$params[':car_num']="%$car_num%";
			$page_params['car_num']=$car_num;			
		}
		if(!empty($driver_phone)){
			array_push($conditions,"driver_phone LIKE :driver_phone");
			$params[':driver_phone'] = "%$driver_phone%";
			$page_params['driver_phone'] = $driver_phone;
		}
		if(!empty($trave)){
			array_push($conditions,"trave LIKE :trave");
			$params[':trave'] = "%$trave%";
			$page_params['trave'] = $trave;
		}
		array_push($conditions,"motorcade_id = :motorcade_id");
		$params[':motorcade_id']=$motorcade_id;
		$page_params['motorcade_id']=$motorcade_id;
		$criteria=new CDbCriteria;
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>array(
			    'condition'=>implode(' AND ',$conditions),
			    'params'=>$params,
			    'order'=>'t.id DESC',
			),
			'pagination'=>array(
            'pageSize'=>'20',
            'params'=> $page_params,
          ),
	   ));
	}
	
	
		//插入新的数据
	public function insert_car(){
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
        //$this->create_id=Yii::app()->user->id;
			  $this->create_time=Util::current_time('timestamp');
			}
			return true;
		}else{
			return false;
		}

	}

	function get_car_operate(){
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="";
		  
		  $return_str.=CHtml::link('修改',array("$controller_id/addcar","id"=>$this->id,"motorcade_id"=>$this->motorcade_id),array('class'=>'operate_button'));
		  if($this->status!='1')
		     $return_str.=CHtml::link('结算',array("$controller_id/settle","id"=>$this->id,"motorcade_id"=>$this->motorcade_id),array('class'=>'operate_button'));
		  
		  $return_str.=CHtml::link('删除',array("$controller_id/deletecar","id"=>$this->id,'motorcade_id'=>$this->motorcade_id),array('class'=>'operate_dbutton'));
		  return $return_str;
	}
	
  function get_motorcade_name($motorcade_id=""){
  	$motorcade_id=empty($motorcade_id)?$this->motorcade_id:$motorcade_id;
  	$motor_cade=new Motorcade();
  	$motor_cade_datas=$motor_cade->get_table_datas($motorcade_id);
  	return $motor_cade_datas->motorcade_name;
  }
  
  function get_settle_status(){
  	if($this->status=='1'){
  		return '已结算';
  	}else{
  		return '未结算';
  	}
  }
	

}