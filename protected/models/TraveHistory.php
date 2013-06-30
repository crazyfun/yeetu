<?php

/**
 * This is the model class for table "{{trave_history}}".
 *
 * The followings are the available columns in table '{{trave_history}}':
 * @property string $id
 * @property string $trave_id
 * @property integer $is_favorites
 * @property string $create_id
 * @property string $create_time
 */
class TraveHistory extends BaseActive
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
		return '{{trave_history}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('is_favorites', 'safe'),
			array('is_favorites', 'numerical', 'integerOnly'=>true),
			array('trave_id, create_id, create_time', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, trave_id, is_favorites, create_id, create_time', 'safe', 'on'=>'search'),
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
		   'Trave'=>array(self::BELONGS_TO,'Trave','trave_id', 'select'=>'trave_name, trave_number,trave_title'),
		);
	}
	
	/**
	 * 
	 * 最近的历史记录
	 * @param int $limit
	 */
	public function recently($limit=5)
	{
		$this->getDbCriteria()->mergeWith(array(
			'order' => 't.create_time DESC',
			'limit' => $limit,
		));
		
		return $this;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '历史记录ID',
			'trave_id' => '路线·ID',
			'is_favorites' => '是否收藏',
			'create_id' => '创建者ID',
			'create_time' => '创建时间',
		);
	}
	
	
	private function get_attributes(){
		  return array(
			'id',
			'trave_id',
			'is_favorites',
			'create_id',
			'create_time',
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
		$criteria->compare('trave_id',$this->trave_id,true);
		$criteria->compare('is_favorites',$this->is_favorites);
		$criteria->compare('create_id',$this->create_id,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
		 //�������
	public function searchdatas(){
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	}
	public function primaryKey()
{
    return 'id';
    // ���ڸ�������Ҫ����һ���������µ�����
    // return array('pk1', 'pk2');
}




		//����һ�����ε����
	public function insert_trave_history(){
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
			}
			return true;

		}else{
			return false;
		}
	}
	function afterSave(){

		      return true;
	}
	
	
	function get_recent_history(){
		$trave_history_datas=$this->with("Trave")->findAll(array('select'=>'trave_id,create_id,create_time','condition'=>'t.create_id=:create_id',"params"=>array(":create_id"=>Yii::app()->user->id),"order"=>"t.create_time DESC","limit"=>'5'));
    return $trave_history_datas;
		
	}
}