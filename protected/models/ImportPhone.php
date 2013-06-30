<?php

/**
 * This is the model class for table "{{import_phone}}".
 *
 * The followings are the available columns in table '{{import_phone}}':
 * @property string $id
 * @property string $name
 * @property string $phone
 * @property string $create_id
 * @property string $create_time
 */
class ImportPhone extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ImportPhone the static model class
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
		return '{{import_phone}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,phone','required','message'=>'{attribute}不能为空'),
			array('phone','exist_phone'),
			array('name, phone', 'length', 'max'=>30),
			array('create_id, create_time', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, phone, create_id, create_time', 'safe', 'on'=>'search'),
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
			'name' => '客户名字',
			'phone' => '联系方式',
			'create_id' => '创建人',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('create_id',$this->create_id,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
		public function insert_import_phone(){
		if(!$this->hasErrors()){
				$datas=$this->save();
				return $datas;
		}
	}
	
	
	protected function beforeSave()
	{
		if ($this->IsNewRecord) {
			$this->create_id = Yii::app()->user->id;
			$this->create_time = Util::current_time('timestamp');
		}
		return parent::beforeSave();
	}
	
		public function get_operate(){
		 $controller_id=Yii::app()->getController()->getId();
		 $action_id=Yii::app()->getController()->getAction()->id;
		 $return_str="";
		 $return_str.=CHtml::link('修改',array("$controller_id/importpedit","id"=>$this->id),array('class'=>'operate_button'));
		 $return_str.=CHtml::link("删除",array("$controller_id/importpdelete","id"=>$this->id),array('class'=>'operate_dbutton'));
		 return $return_str;
		
	}
	
	
		//检测用户名
	function exist_phone(){
		$id=$this->id;
		if(!empty($id)){
			 $get_table_datas=$this->get_table_datas($id,array());
			 if($get_table_datas->phone!=$this->phone){
			 	 $find_datas=$this->find(array(
          'select'=>'phone',
          'condition'=>'phone=:phone',
          'params'=>array(':phone' => $this->phone),
         ));
			 }
		}else{
			$find_datas=$this->find(array(
         'select'=>'phone',
         'condition'=>'phone=:phone',
         'params'=>array(':phone' => $this->phone),
       ));
		}
     if(!empty($find_datas)){
     	 $this->addError("phone","联系方式已存在");
     	 return false;
     }
     return true;
    
	}
}