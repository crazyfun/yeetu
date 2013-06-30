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
class FriendLink extends CActiveRecord
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
		return '{{friend_link}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, link', 'required'),
			array('display', 'numerical', 'integerOnly'=>true),
			array('name', "length",'encoding'=>'utf-8','max'=>20,'tooLong'=>'最多只能20个字'),
			array('link', 'length', 'max'=>200),
			array('create_time', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, link, create_time, display', 'safe', 'on'=>'search'),
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
			'name' => '名称',
			'link' => '链接',
			'create_time' => '添加时间',
			'display' => '显示次序',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('display',$this->display);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public function get_friend_operate(){
		 $controller_id=Yii::app()->getController()->getId();
		 $return_str="";
		 $return_str.=CHtml::link('修改',array("$controller_id/add","id"=>$this->id),array('class'=>'operate_button'));
		 $return_str.=CHtml::link("删除",array("$controller_id/delete","id"=>$this->id),array('class'=>'operate_dbutton'));
		 return $return_str;
	}

	function beforeSave(){
		if(parent::beforeSave()){
			if($this->isNewRecord){
				$this->create_time=Util::current_time('timestamp');
			}
		}
		return true;
	}
}
