<?php

/**
 * This is the model class for table "{{friend_link}}".
 *
 * The followings are the available columns in table '{{friend_link}}':
 * @property string $id
 * @property string $name
 * @property string $link
 * @property string $create_time
 * @property integer $display
 */
class IpFilter extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return FriendLink the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ip_filter}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ip_address,status', 'required'),
			array('ip_address','match','pattern'=>'/^(\d{1,2}|1\d\d|2[0-4]\d|25[0-5]|[1,2,\*]?[\d,\*]?[\d,\*]?)\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5]|[1,2,\*]?[\d,\*]?[\d,\*]?)\.((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])|[1,2,\*]?[\d,\*]?[\d,\*]?)\.((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])|[1,2,\*]?[\d,\*]?[\d,\*]?)$/','message'=>'请输入有效的IP地址'),
			array('ip_address','unique','message'=>'您输入的IP地址已存在，请重新输入'),
	//		array('status', 'integerOnly'=>true),
			array('ip_address', "length",'encoding'=>'utf-8','max'=>20,'tooLong'=>'最多只能15个字'),
			array('expire_time', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ip_address, status, create_time, expire_time, create_id', 'safe', 'on'=>'search'),
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
			'ip_address' => '限制IP',
			'status' => '限制状态',
			'create_time' => '创建时间',
			'expire_time' => '过期时间',
			'create_id' => '创建用户',
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
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('expire_time',$this->expire_time,true);
		$criteria->compare('create_id',$this->create_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public function get_ip_operate(){
		 $controller_id=Yii::app()->getController()->getId();
		 $return_str="";
		 $return_str.=CHtml::link('修改',array("$controller_id/add","id"=>$this->id),array('class'=>'operate_button'));
		 $return_str.=CHtml::link("删除",array("$controller_id/delete","id"=>$this->id),array('class'=>'operate_dbutton'));
		 return $return_str;
	}

	function beforeSave(){
		if(parent::beforeSave()){
			if($this->isNewRecord){
				$this->create_id = Yii::app()->user->id;
				$this->create_time=Util::current_time('timestamp');
			}
		}
		return true;
	}

	function get_format_expire_time($expire_time){

		return $expire_time == 0?"":date("Y-m-d H:i:s",$expire_time);
	}
/*
	function check_repeat_ip($ip_address,$id){
		$model = IpFilter::model();
		$ip_data = $model->findByAttributes(array('ip_address'=>$ip_address));
		if($ip_data && $ip_data->id != $id){
     		return false;
		}
		return true;
	}*/
}
