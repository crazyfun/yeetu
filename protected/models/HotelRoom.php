<?php

/**
 * This is the model class for table "{{hotel_room}}".
 *
 * The followings are the available columns in table '{{hotel_room}}':
 * @property string $id
 * @property string $hotel_id
 * @property string $room_name
 * @property string $room_bed
 * @property integer $room_broadband
 * @property integer $room_people
 * @property string $room_dinning
 * @property string $room_price
 * @property string $create_id
 * @property string $create_time
 */
class HotelRoom extends BaseActive
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
		return '{{hotel_room}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('room_broadband,hotel_id,room_price,room_people,room_bed,room_name,room_dinning', 'required'),
			array('room_broadband, room_people,room_name,room_bed,room_dinning', 'numerical', 'integerOnly'=>true),
			array('hotel_id, room_price,room_yprice, create_id, create_time', 'length', 'max'=>11),
			array('is_default','length','max'=>'1'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, hotel_id, room_name, room_bed, room_broadband, room_people, room_dinning, room_price, create_id, create_time', 'safe', 'on'=>'search'),
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
		  'Hotels'=>array(self::BELONGS_TO,'Hotels','hotel_id'),
		  'RoomStyle'=>array(self::BELONGS_TO,'RoomStyle','room_name'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '房型ID',
			'hotel_id' => '酒店名称',
			'room_name' => '房型',
			'room_bed' => '床型',
			'room_broadband' => '宽带',
			'room_people' => '人数',
			'room_dinning' => '早餐',
			'room_price' => '挂牌价',
			'room_yprice'=>'易途价',
			'is_default'=>'默认户型',
			'room_desc'=>'房型描述',
			'create_id' => '创建者ID',
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
		$criteria->compare('hotel_id',$this->hotel_id,true);
		$criteria->compare('room_name',$this->room_name,true);
		$criteria->compare('room_bed',$this->room_bed,true);
		$criteria->compare('room_broadband',$this->room_broadband);
		$criteria->compare('room_people',$this->room_people);
		$criteria->compare('room_dinning',$this->room_dinning,true);
		$criteria->compare('room_price',$this->room_price,true);
		$criteria->compare('create_id',$this->create_id,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	


		//插入一笔旅游的数据
	public function insert_hotel_room(){
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
	
	function get_room_operate(){
		 $controller_id=Yii::app()->getController()->getId();
		 $return_str="";
		 $return_str.=CHtml::link('修改',array("$controller_id/addroom","id"=>$this->id,'hotel_id'=>$this->hotel_id),array('class'=>'operate_button'));
		if(empty($this->is_default)){
		   $return_str.=CHtml::link('设为默认',array("$controller_id/defaultroom","room_id"=>$this->id,'is_default'=>'1','hotel_id'=>$this->hotel_id),array('class'=>'operate_button'));
		 }else{
		 	 $return_str.=CHtml::link('取消默认',array("$controller_id/defaultroom","room_id"=>$this->id,'is_default'=>'','hotel_id'=>$this->hotel_id),array('class'=>'operate_button'));
		  }
		 $return_str.=CHtml::link("删除",array("$controller_id/deleteroom","id"=>$this->id,'hotel_id'=>$this->hotel_id),array('class'=>'operate_dbutton'))."  ";
		 return $return_str;
	}

	function get_belong_user_name(){
		$get_datas=$this->with("User")->findByPk($this->id,"",array());
		$user_login=$get_datas->User->user_login;
		return $user_login;
	}
	
	
 function converse_date(){
		 $date=new Date(intval($this->create_time));
		 return $date->format();
	}
	
	
	function get_hotel_name(){
    $get_datas=$this->with("Hotels")->findByPk($this->id,"",array());
		$hotel_name=$get_datas->Hotels->hotel_name;
		return $hotel_name;
	}
	
	//获得房型
	function get_room_name(){
		$room_style=new RoomStyle();
		$room_style_select=$room_style->get_room_style_select();
		return $room_style_select[$this->room_name];
	}
	
	
	//获得床型
	function get_room_bed(){
		$room_bed=CV::$ROOM_BED;
		return $room_bed[$this->room_bed];
	}
	
	
 //获得居住人数
	function get_room_people(){
		$room_people=CV::$ROOM_PEOPLE;
		return $room_people[$this->room_people];
	}
	
	//获得早餐
	function get_room_dinning(){
		$room_dinning=CV::$ROOM_DINNING;
		return $room_dinning[$this->room_dinning];
	}
	
	//获得宽带
	function get_room_broadband(){
		$broadband=CV::$ROOM_BROADBAND;
		return $broadband[$this->room_broadband];
	}
	
	
	
}