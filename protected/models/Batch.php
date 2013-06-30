<?php

/**
 * This is the model class for table "{{batch}}".
 *
 * The followings are the available columns in table '{{batch}}':
 * @property string $id
 * @property string $title
 * @property integer $batch_type
 * @property string $content
 * @property string $create_id
 * @property string $create_time
 */
class Batch extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Batch the static model class
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
		return '{{batch}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('title,batch_type,content','required','message'=>'{attribute}不能为空'),
			array('batch_type', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
			array('create_id, create_time', 'length', 'max'=>11),
			array('content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, batch_type, content, create_id, create_time', 'safe', 'on'=>'search'),
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
			'title' => '标题',
			'batch_type' => '类型',
			'content' => '内容',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('batch_type',$this->batch_type);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('create_id',$this->create_id,true);
		$criteria->compare('create_time',$this->create_time,true);
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function insert_batch(){
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
		 if($action_id=="email"){
		 	 $return_str.=CHtml::link('修改',array("$controller_id/edite","id"=>$this->id),array('class'=>'operate_button'));
		 	 $return_str.=CHtml::link("发送用户邮件",'javascript:send_message('.$this->id.',1);',array('class'=>'operate_button'));
		   $return_str.=CHtml::link("删除",array("$controller_id/deletee","id"=>$this->id),array('class'=>'operate_dbutton'));
		    
		}else{
		 $return_str.=CHtml::link('修改',array("$controller_id/editp","id"=>$this->id),array('class'=>'operate_button'));
		 $return_str.=CHtml::link("发送用户短信","javascript:send_message(".$this->id.",2);",array('class'=>'operate_button'));
		 $return_str.=CHtml::link("发送导入短信","javascript:show_importpdialog(".$this->id.");",array('class'=>'operate_button'));
		 $return_str.=CHtml::link("删除",array("$controller_id/deletep","id"=>$this->id),array('class'=>'operate_dbutton'));
		 
		} 
		 return $return_str;
		
	}
	
	
}