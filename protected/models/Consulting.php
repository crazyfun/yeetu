<?php

/**
 * This is the model class for table "{{consulting}}".
 *
 * The followings are the available columns in table '{{consulting}}':
 * @property string $id
 * @property string $trave_id
 * @property string $consulting_email
 * @property string $consulting_content
 * @property string $create_id
 * @property string $create_time
 */
class Consulting extends BaseActive
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
		return '{{consulting}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('consulting_content,consulting_email','required','message'=>'{attribute}不能为空'),
			array('trave_id, create_id, create_time,reply_id,reply_time', 'length', 'max'=>11),
			array('consulting_email', 'length', 'max'=>30),
			array('consulting_content,reply_content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, trave_id, consulting_email, consulting_content, create_id, create_time', 'safe', 'on'=>'search'),
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
		  'User'=>array(self::BELONGS_TO,'User','create_id'),
		  'RUser'=>array(self::BELONGS_TO,'User','reply_id'),
		  'Trave'=>array(self::BELONGS_TO,'Trave','trave_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'trave_id' => '线路名字',
			'consulting_email' => '咨询email',
			'consulting_content' => '咨询内容',
			'reply_content'=>'回复内容',
			'reply_id'=>'回复人',
			'create_id' => '创建ID',
			'reply_time'=>'回复时间',
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
		$criteria->compare('trave_id',$this->trave_id,true);
		$criteria->compare('consulting_email',$this->consulting_email,true);
		$criteria->compare('consulting_content',$this->consulting_content,true);
		$criteria->compare('create_id',$this->create_id,true);
		$criteria->compare('create_time',$this->create_time,true);
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function searchdatas()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	  $page_params=array();
	  $consulting_title=$_REQUEST['consulting_title'];
	  $trave_name=$_REQUEST['trave_name'];
	  $create_name=$_REQUEST['create_name'];
    $reply_name=$_REQUEST['reply_name'];
    $validate_sregion=Yii::app()->getController()->validate_sregion();
	  if($validate_sregion){
	    $validate_sregion=" AND ".$validate_sregion;
	  }
	  $with=array();
	  $trave_with=array();
	  if(!empty($consulting_title))
	     $page_params['consulting_title']=$_REQUEST['consulting_title'];
	  if(!empty($trave_name)){
	  	 $trave_with=array('select'=>'Trave.trave_name','condition'=>'Trave.trave_name LIKE :trave_name'.$validate_sregion,'params'=>array(':trave_name'=>"%$trave_name%"));
	     $page_params['trave_name']=$trave_name;
	  }else{
	  	$trave_with=array('select'=>'trave.trave_name','condition'=>'(1=1)'.$validate_sregion,'params'=>array(),'together'=>true);
	  }
	  $with['Trave']=$trave_with;
	  if(!empty($create_name)){
	  	 $with['User']=array('select'=>'User.user_login','condition'=>'User.user_login LIKE :create_name','params'=>array(':create_name'=>"%$create_name%"));
	     $page_params['create_name']=$create_name;
	  }
	  if(!empty($reply_name)){
	  	 $with['RUser']=array('select'=>'RUser.user_login','condition'=>'RUser.user_login LIKE :reply_name','params'=>array(':reply_name'=>"%$reply_name%"));

	     $page_params['reply_name']=$reply_name;
	  }
	  
		$criteria=new CDbCriteria;
		
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.id DESC";
  	$sort->params=$page_params;
  	
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>array(
			    'condition'=>'(t.consulting_content LIKE :consulting_title) OR (t.reply_content LIKE :consulting_title)',
			    'params'=>array(':consulting_title'=>"%$consulting_title%"),
			    'with'=>$with,
			),
			'pagination'=>array(
            'pageSize'=>'20',
            'params'=>$page_params,
      ),
      'sort'=>$sort,
		));
	}



	
	//插入一笔旅游的数据
	public function insert_consulting(){
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
			}else{
				$this->reply_id=Yii::app()->user->id;
				$this->reply_time=Util::current_time('timestamp');
			}
			return true;
		}else{
			return false;
		}
	}
	
	function get_reply_name($reply_id=""){
		$reply_id=empty($reply_id)?$this->reply_id:$reply_id;
		$user=new User();
		$user_datas=$user->get_table_datas($reply_id);
		return $user_datas->user_login;
	}
	
	function get_create_name($create_id=""){
		$create_id=empty($create_id)?$this->create_id:$create_id;
		if(!empty($create_id)){
			$user=new User();
			$user_datas=$user->get_table_datas($create_id);
			return $user_datas->user_login;
		}else{
			return "游客";
		}
	}
	
	
  function converse_date(){
		 $date=new Date(intval($this->create_time));
		 return $date->format();
	}
	function converse_reply_date(){
		if(!empty($this->reply_time)){
		 
		  $date=Date("Y-m-d H:i:s",$this->reply_time);
		  return $date;
		}else{
			return "未回复";
		}
	}
	function get_consulting_operate(){
		 $controller_id=Yii::app()->getController()->getId();
		 $return_str="";
		 $return_str.=CHtml::link('回复',array("$controller_id/add","id"=>$this->id),array('class'=>'operate_button'));
		 $return_str.=CHtml::link("删除",array("$controller_id/delete","id"=>$this->id),array('class'=>'operate_dbutton'));
		 return $return_str;
	}
	
	function get_default_operate(){
		$controller_id=Yii::app()->getController()->getId();
		 $return_str="";
		 $return_str.=CHtml::link('回复',array("consulting/add","id"=>$this->id),array());
		 return $return_str;
	}

}