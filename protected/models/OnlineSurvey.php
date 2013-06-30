<?php

/**
 * This is the model class for table "{{online_survey}}".
 *
 * The followings are the available columns in table '{{online_survey}}':
 * @property string $id
 * @property integer $survey_type
 * @property string $remote_ip
 * @property string $create_time
 */
class OnlineSurvey extends BaseActive
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
		return '{{online_survey}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('survey_type', 'numerical', 'integerOnly'=>true),
			array('remote_ip','safe'),
			array('create_time', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, survey_type, remote_ip, create_time', 'safe', 'on'=>'search'),
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
			'id' => '在线调查ID',
			'survey_type' => '在线调查内容',
			'remote_ip' => '在线调查IP',
			'create_time' => '在线调查时间',
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
		$criteria->compare('survey_type',$this->survey_type);
		$criteria->compare('remote_ip',$this->remote_ip,true);
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
    $survey_type=$_REQUEST['survey_type'];
    $remote_ip=$_REQUEST['remote_ip'];
    if(!empty($survey_type)){
			 array_push($conditions,"survey_type = :survey_type");
			 $params[':survey_type']=$survey_type;
			 $page_params['survey_type']=$survey_type;
		}
		if(!empty($remote_ip)){
			 array_push($conditions,"remote_ip LIKE :remote_ip");
			 $params[':remote_ip']="%$remote_ip%";
			 $page_params['remote_ip']=$remote_ip;
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
			   
			),
			'pagination'=>array(
          'pageSize'=>'20',
          'params'=> $page_params,
      ),
      'sort'=>$sort,
		));
	}
	
		//插入一笔旅游的数据
	public function insert_online_survey(){
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