<?php

/**
 * This is the model class for table "{{group_customize}}".
 *
 * The followings are the available columns in table '{{group_customize}}':
 * @property string $id
 * @property string $contact_name
 * @property string $contact_phone
 * @property string $contact_tel
 * @property string $contact_email
 * @property integer $reply_time
 * @property string $company_name
 * @property integer $start_region
 * @property integer $end_region
 * @property string $start_time
 * @property string $adults
 * @property string $childs
 * @property string $travel_nums
 * @property string $travel_budget
 * @property integer $transport
 * @property string $transport_tips
 * @property integer $stay
 * @property string $stay_tips
 * @property integer $dinning
 * @property string $dinning_tips
 * @property integer $guide
 * @property string $guide_tips
 * @property integer $shopping
 * @property string $shopping_tips
 * @property integer $meeting
 * @property string $meeting_tips
 * @property string $other_tips
 * @property string $create_id
 * @property string $create_time
 */
class GroupCustomize extends BaseActive
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
		return '{{group_customize}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('contact_name,contact_phone,contact_tel','required','message'=>'{attribute}为空'),
		  array('contact_phone',"user_phone_validate"),
		  array('contact_tel',"user_telephone_validate"),
		  array('contact_email',"user_email_validate"),
			array('reply_time, start_region, transport, stay, dinning, guide, shopping, meeting', 'numerical', 'integerOnly'=>true),
			array('contact_name, contact_phone, contact_tel, contact_email, start_time,end_region', 'length', 'max'=>30),
			array('company_name', 'length', 'max'=>100),
			array('status','length','max'=>1),
			array('adults, childs, travel_nums, travel_budget, create_id, create_time,operate_id,operate_time', 'length', 'max'=>11),
			array('transport_tips, stay_tips, dinning_tips, guide_tips, shopping_tips, meeting_tips, other_tips', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, contact_name, contact_phone, contact_tel, contact_email, reply_time, company_name, start_region, end_region, start_time, adults, childs, travel_nums, travel_budget, transport, transport_tips, stay, stay_tips, dinning, dinning_tips, guide, guide_tips, shopping, shopping_tips, meeting, meeting_tips, other_tips, create_id, create_time', 'safe', 'on'=>'search'),
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
		   'OUser'=>array(self::BELONGS_TO, 'User','operate_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'contact_name' => '联系人',
			'contact_phone' => '手机号码',
			'contact_tel' => '联系电话',
			'contact_email' => '联系Email',
			'reply_time' => '回复时间',
			'company_name' => '公司名称',
			'start_region' => '出发城市',
			'end_region' => '目的地',
			'start_time' => '出发日期',
			'adults' => '成人数',
			'childs' => '儿童数',
			'travel_nums' => '出游天数',
			'travel_budget' => '预算',
			'transport' => '交通工具',
			'transport_tips' => '交通工具说明',
			'stay' => '住宿标准',
			'stay_tips' => '住宿说明',
			'dinning' => '用餐标准',
			'dinning_tips' => '用餐说明',
			'guide' => '导游',
			'guide_tips' => '导游说明',
			'shopping' => '购物标准',
			'shopping_tips' => '购物说明',
			'meeting' => '会议安排',
			'meeting_tips' => '会议说明',
			'other_tips' => '其他说明',
			'status'=>'处理状态',
			'operate_id'=>'处理人',
			'operate_time'=>'处理时间',
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
		$criteria->compare('contact_name',$this->contact_name,true);
		$criteria->compare('contact_phone',$this->contact_phone,true);
		$criteria->compare('contact_tel',$this->contact_tel,true);
		$criteria->compare('contact_email',$this->contact_email,true);
		$criteria->compare('reply_time',$this->reply_time);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('start_region',$this->start_region);
		$criteria->compare('end_region',$this->end_region);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('adults',$this->adults,true);
		$criteria->compare('childs',$this->childs,true);
		$criteria->compare('travel_nums',$this->travel_nums,true);
		$criteria->compare('travel_budget',$this->travel_budget,true);
		$criteria->compare('transport',$this->transport);
		$criteria->compare('transport_tips',$this->transport_tips,true);
		$criteria->compare('stay',$this->stay);
		$criteria->compare('stay_tips',$this->stay_tips,true);
		$criteria->compare('dinning',$this->dinning);
		$criteria->compare('dinning_tips',$this->dinning_tips,true);
		$criteria->compare('guide',$this->guide);
		$criteria->compare('guide_tips',$this->guide_tips,true);
		$criteria->compare('shopping',$this->shopping);
		$criteria->compare('shopping_tips',$this->shopping_tips,true);
		$criteria->compare('meeting',$this->meeting);
		$criteria->compare('meeting_tips',$this->meeting_tips,true);
		$criteria->compare('other_tips',$this->other_tips,true);
		$criteria->compare('create_id',$this->create_id,true);
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
    $start_time=$_REQUEST['start_time'];
    $start_region=$_REQUEST['start_region'];
    $end_region=$_REQUEST['end_region'];
    $contact_name=$_REQUEST['contact_name'];
    $company_name=$_REQUEST['company_name'];
    $create_time=$_REQUEST['create_time'];
    $status=$_REQUEST['status'];
    if(!empty($start_time)){
			 array_push($conditions,"start_time = :start_time");
			 $params[':start_time']=$start_time;
			 $page_params['start_time']=$start_time;
		}
		
		if(!empty($start_region)){
			 array_push($conditions,"start_region = :start_region");
			 $params[':start_region']=$start_region;
			 $page_params['start_region']=$start_region;
		}
		
		if(!empty($end_region)){
			array_push($conditions,"end_region LIKE :end_region");
			 $params[':end_region']="%$end_region%";
			 $page_params['end_region']=$end_region;
		}
		
		if(!empty($contact_name)){
			 array_push($conditions,"(contact_name LIKE :contact_name OR contact_phone LIKE :contact_name)");
			 $params[':contact_name']="%$contact_name%";
			 $page_params['contact_name']=$contact_name;
		}
		
		if(!empty($company_name)){
			 array_push($conditions,"company_name LIKE :company_name");
			 $params[':company_name']="%$company_name%";
			 $page_params['company_name']=$company_name;
		}
		
			//结算时间
		if(!empty($create_time)){
			array_push($conditions,"FROM_UNIXTIME(t.create_time,'%Y-%m-%d')=:create_time");
			$params[':create_time']=$create_time;
			$page_params['create_time']=$create_time;
		}
		
		
		if(!empty($status)){
			 array_push($conditions,"status= :status");
			 $params[':status']=$status;
			 $page_params['status']=$status;
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
			    'with'=>array('OUser'),
			),
			'pagination'=>array(
          'pageSize'=>'20',
          'params'=> $page_params,
      ),
      'sort'=>$sort,
		));
	}
	
	
	
	
		//插入一笔旅游的数据
	public function insert_group(){
		if(!$this->hasErrors()){
				$datas=$this->save();
			  return $datas;
		}
	}
  function user_phone_validate(){
		if(!Util::is_phone($this->contact_phone,"cell")){
			$this->addError("contact_phone","格式不正确");
			return false;
		}else{
			return true;
		}
	}

	function user_telephone_validate(){
			if(!Util::is_phone($this->contact_tel,"tele")){
			 $this->addError("contact_tel","格式不正确");
			 return false;
		  }else{
			 return true;
		  }	
	}
	
	function user_email_validate(){
	 if(!empty($this->contact_email)){
		if(!Util::ie($this->contact_email)){
			 $this->addError("contact_email","格式不正确");
			 return false;
		  }else{
			 return true;
		  }	
		}else{
			return true;
		}
	}

	function beforeSave(){
	  if(parent::beforeSave()){
			if($this->isNewRecord){
				$this->create_id=Yii::app()->user->id;
				$this->create_time=Util::current_time('timestamp');
				$this->status='1';
			}else{
				//$this->create_id=Yii::app()->user->id;
				//$this->create_time=Util::current_time('timestamp');
			}
			return true;
		}else{
			return false;
		}

	}

	function get_customize_operate(){
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="";
		  $return_str.=CHtml::link('修改',array("$controller_id/add","id"=>$this->id),array('class'=>'operate_button'));
		  if($this->status=='1'){
		     $return_str.=CHtml::link('处理',array("$controller_id/process","id"=>$this->id),array('class'=>'operate_button'));
		  }
		  $return_str.=CHtml::link('删除',array("$controller_id/delete","id"=>$this->id),array('class'=>'operate_dbutton'));
		  return $return_str;
	}
	
	function get_reply_time(){
		$reply_time_array=CV::$GROUP_REPLY_TIME;
		return $reply_time_array[$this->reply_time];
	}
	
	function get_start_region(){
		$group_start_region=CV::$GROUP_START_REGION;
		if(!empty($this->start_region))
		    return $group_start_region[$this->start_region];
		else
		    return null;
	}
	
	function get_customize_status(){
		$customize_status=CV::$CUSTOMIZESTATUS;
		return $customize_status[$this->status];
	}
	
	
}