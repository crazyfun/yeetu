<?php

/**
 * This is the model class for table "{{insurance}}".
 *
 * The followings are the available columns in table '{{insurance}}':
 * @property string $id
 * @property string $insurance_name
 * @property string $insurance_period
 * @property string $insurance_pice
 * @property string $insurance_explain
 * @property string $insurance_describe
 * @property string $create_id
 * @property string $create_time
 */
class Insurance extends BaseActive
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
		return '{{insurance}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('insurance_name, insurance_period, insurance_pice', 'required', 'message'=>'{attribute}不能为空'),
			array('insurance_pice', 'numerical', 'message'=>'保险价格必须为数字'),
			array('insurance_name, insurance_explain', 'length', 'max'=>100),
			array('insurance_period', 'length', 'max'=>30),
			array('insurance_pice, create_id, create_time', 'length', 'max'=>11),
			array('insurance_describe', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, insurance_name, insurance_period, insurance_pice, insurance_explain, insurance_describe, create_id, create_time', 'safe', 'on'=>'search'),
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
			'id' => '保险ID',
			'insurance_name' => '保险名称',
			'insurance_period' => '保险期限',
			'insurance_pice' => '保险价格',
			'insurance_explain' => '保险说明',
			'insurance_describe' => '保险描述',
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
                'params'=>array(),
      ),
      'sort'=>$sort,
		));
	}
	
	protected function beforeSave()
	{
		if ($this->IsNewRecord) {
			$this->create_time = Util::current_time('timestamp');
			$this->create_id = Yii::app()->user->id;
		}else{
			  $this->create_id=Yii::app()->user->id;
				$this->create_time=Util::current_time('timestamp');
		}
		
		return parent::beforeSave();
	}
	
public function primaryKey()
{
    return 'id';
    // ���ڸ�������Ҫ����һ���������µ�����
    // return array('pk1', 'pk2');
}


	
	public function delete_table_datas($pk_id="",$condition=array()){
		if(!empty($pk_id)){
			  $this->deleteByPk($pk_id,array(),array());
			  $parent_condition['parent_id']=$pk_id;
				$this->delete_table_datas("",$parent_condition);
		}else{
			  $get_condition_datas=$this->get_table_datas("",$condition);
			  foreach($get_condition_datas as $key => $value){
			  	$this->deleteByPk($value->id,array(),array());
			  	
					 $parent_condition['parent_id']=$value->id;
					 $this->delete_table_datas("",$parent_condition);
			  }
			  
		}
	}
	

	
	
		//����һ�����ε����
	public function insert_insurance(){
		if(!$this->hasErrors()){
        $datas=$this->save();
			  return $datas;
		}
	}
	
	
	//获得保险信息的搜索项
	public function get_insurance_datas(){
		$insurance_datas=$this->findAll(array('select'=>'id,insurance_name','condition'=>'','params'=>array()));
		$return_insurance=array();
		$return_insurance['']='请选择保险名称';
		foreach($insurance_datas as $key => $value){
			$return_insurance[$value->id]=$value->insurance_name;
		}
		return $return_insurance;
	}
	
}