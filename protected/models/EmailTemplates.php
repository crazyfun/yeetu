<?php

/**
 * This is the model class for table "{{email_templates}}".
 *
 * The followings are the available columns in table '{{email_templates}}':
 * @property string $id
 * @property string $email_templates_name
 * @property string $email_templates_content
 * @property string $create_id
 * @property string $create_time
 */
class EmailTemplates extends BaseActive
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
		return '{{email_templates}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email_templates_name, email_templates_content', 'required', 'message' => '{attribute}不能为空'),
			array('email_templates_name', 'length', 'max'=>30),
			array('create_id, create_time', 'length', 'max'=>11),
			array('email_templates_content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, email_templates_name, email_templates_content, create_id, create_time', 'safe', 'on'=>'search'),
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
			'id' => '模板ID',
			'email_templates_name' => '模板名称',
			'email_templates_content' => '模板内容',
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


    $sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.create_time DESC";
  	$sort->params=$page_params;
  	
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
			'pagination'=>array(
                'pageSize'=>'20',
                'params'=>$page_params,
      ),
      'sort'=>$sort,
		));
		
	}
	
	protected function beforeSave()
	{
		if ($this->IsNewRecord) {
			$this->create_time = Util::current_time('timestamp');
			$this->create_id = Yii::app()->user->id;
		}
		
		return parent::beforeSave();
	}

	protected function beforeDelete()
	{
		//系统自带的模板不能被删除
		if ($this->create_id == 0) {
			return false;
		}

		return parent::beforeDelete();
	}

	private function get_attributes(){
		  return array(
			'id',
			'email_templates_name',
			'email_templates_content',
			'create_id',
			'create_time',
		);
	}


		/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	 //�������
	public function searchdatas(){
	
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.


	}
	public function primaryKey()
{
    return 'id';

}



		//����һ�����ε����
	public function insert_emailtemplates(){
		if(!$this->hasErrors()){
				$datas=$this->save();
				return $datas;
		}
	}
	

}