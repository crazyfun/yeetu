<?php

/**
 * This is the model class for table "{{serial}}".
 *
 * The followings are the available columns in table '{{serial}}':
 * @property integer $id
 * @property string $serial_name
 * @property string $serial_value
 * @property integer $create_time
 */
class Serial extends BaseActive
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
		return '{{serial}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('create_time', 'numerical', 'integerOnly'=>true),
			array('serial_name', 'length', 'max'=>30),
			array('serial_value', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, serial_name, serial_value, create_time', 'safe', 'on'=>'search'),
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
			'id' => '序号ID',
			'serial_name' => '序号名字',
			'serial_value' => '序号值',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('serial_name',$this->serial_name,true);
		$criteria->compare('serial_value',$this->serial_value,true);
		$criteria->compare('create_time',$this->create_time);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	
		//插入一笔旅游的数据
	public function insert_serial(){
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
}