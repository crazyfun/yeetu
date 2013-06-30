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
class Hotel extends BaseActive
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
		return '{{hotel}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('hotel_name','required','message'=>'{attribute}不能为空'),
		array('id, hotel_name, hotel_address, hotel_phone, hotel_fax, hotel_link, mark_price, resale_price, group_price, hotel_desc, hotel_comment, create_id, create_time', 'safe'),
			array('hotel_name', 'length', 'max'=>30),
			array('hotel_level','length','max'=>'1'),
			array('pingri_price,zhoumo_price,create_id, create_time', 'length', 'max'=>11),
		//	array('hotel_desc,hotel_comment', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pingri_price,zhoumo_price,hotel_level,id, hotel_name, hotel_address, hotel_phone, hotel_fax, hotel_link, mark_price, resale_price, group_price, hotel_desc, hotel_comment, create_id, create_time', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'hotel_name' => '酒店名称',
			'hotel_address' => '酒店地址',
			'hotel_phone' => '酒店电话',
			'hotel_fax' => '传真',
			'hotel_link' => '联系人',
			'mark_price' => '挂牌价格',
			'resale_price' => '散客价格',
			'group_price' => '团队价格',
			'pingri_price'=>'团队平日价格',
			'zhoumo_price'=>'团队周末价格',
			'hotel_level'=>'酒店星级',
			'hotel_desc' => '酒店简介',
			'hotel_comment' => '备注',
			'create_id' => '创建用户',
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
		$criteria->compare('hotel_name',$this->hotel_name,true);
		$criteria->compare('hotel_address',$this->hotel_address,true);
		$criteria->compare('hotel_phone',$this->hotel_phone,true);
		$criteria->compare('hotel_fax',$this->hotel_fax,true);
		$criteria->compare('hotel_link',$this->hotel_link,true);
		$criteria->compare('mark_price',$this->mark_price,true);
		$criteria->compare('resale_price',$this->resale_price,true);
		$criteria->compare('group_price',$this->group_price,true);
		$criteria->compare('hotel_desc',$this->hotel_desc,true);
		$criteria->compare('hotel_comment',$this->hotel_comment,true);
		$criteria->compare('create_id',$this->create_id,true);
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
		$hotel_name=$_REQUEST['hotel_name'];
    	if(!empty($hotel_name)){
			 array_push($conditions,"hotel_name LIKE :hotel_name");
			 $params[':hotel_name']="%$hotel_name%";
			 $page_params['hotel_name']=$hotel_name;
		}
		$user_permissions_type=Yii::app()->getController()->validate_user_permissions_type();
		if($user_permissions_type){
			$user_permissions_type=" AND ".$user_permissions_type;
		}
		$criteria=new CDbCriteria;
		
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.create_time DESC";
  	$sort->params=$page_params;
  	
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>array(
			    'condition'=>implode(' AND ',$conditions),
			    'params'=>$params,
			    'with'=>array("User"=>array('select'=>'id,user_login,permissions_type','condition'=>'(1=1)'.$user_permissions_type,'params'=>array(),'together'=>true)),
			),
			'pagination'=>array(
          'pageSize'=>'20',
          'params'=> $page_params,
      ),
      'sort'=>$sort,
		));
	}
	

	
		//插入新景区的数据
	public function insert_hotel(){
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

	
	
	function get_hotel_operate(){
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="";
		  $return_str.=CHtml::link('修改/详情',array("$controller_id/add","id"=>$this->id),array('class'=>'operate_button'));
		  $return_str.=CHtml::link('删除',array("$controller_id/delete","id"=>$this->id),array('class'=>'operate_dbutton'));
		  return $return_str;
	}
	
	//获得系统变量的值
	function get_footlink_value($hotel_name){
		$conditions['hotel_name']=$hotel_name;
		$system_values=$this->get_table_datas("",$conditions);
		return $system_values[0]['id'];
		
	}	
	
	function get_hotel_level(){
		$hotel_level=array('1'=>'一星','2'=>'二星','3'=>'三星','4'=>'四星','5'=>'五星','6'=>'六星','7'=>'七星');
		return $hotel_level[$this->hotel_level];
	}
}