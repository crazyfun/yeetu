<?php

/**
 * This is the model class for table "{{batch_message}}".
 *
 * The followings are the available columns in table '{{batch_message}}':
 * @property string $id
 * @property string $user_id
 * @property integer $batch_type
 * @property string $content
 * @property integer $status
 * @property string $custom_date
 * @property string $send_date
 */
class BatchMessage extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return BatchMessage the static model class
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
		return '{{batch_message}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('batch_type,content', 'required'),
			array('batch_type, status,is_all', 'numerical', 'integerOnly'=>true),
			array('custom_date, send_date,create_time', 'length', 'max'=>11),
			array('content,describe', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, batch_type,title,content,describe, status,is_all custom_date, send_date,create_time', 'safe', 'on'=>'search'),
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
			'User'=>array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'message' => '发送的对象',
			'batch_type' => '信息类型',
			'title'=>'主题',
			'content' => '信息内容',
			'describe'=>'发送描述',
			'status' => '状态',
			'is_all'=>'全部发送',
			'custom_date' => '定制日期',
			'send_date' => '发送时间',
			'create_time'=>'创建时间',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */

	
	
  public function insert_batch_message(){
		if(!$this->hasErrors()){
				$datas=$this->save();
				return $datas;
		}
	}
	
	
	protected function beforeSave(){
		if ($this->IsNewRecord) {
      $this->create_time=time();
		}
		return parent::beforeSave();
	}
	
	
	protected function get_message_operate(){
		 $controller_id=Yii::app()->getController()->getId();
		 $return_str="";
		 $return_str.=CHtml::link('查看',array("$controller_id/view","id"=>$this->id),array('class'=>'operate_button'));
		 $return_str.=CHtml::link("删除",array("$controller_id/deletem","id"=>$this->id),array('class'=>'operate_dbutton'));
		 return $return_str;
	}
	
	
	 function get_status(){
		if(empty($this->status))
		   return "未发送";
		else 
		   return "已发送";
	}	
	
	 function get_all(){
		if(empty($this->is_all)) 
		    return "不是"; 
		else
		    return "全部";
	}
	
}