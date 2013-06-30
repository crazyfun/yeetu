<?php

/**
 * This is the model class for table "{{coupon_consume}}".
 *
 * The followings are the available columns in table '{{coupon_consume}}':
 * @property string $id
 * @property string $user_id
 * @property integer $coupon_style
 * @property string $coupon_desc
 * @property string $create_id
 * @property string $create_time
 */
class CouponConsume extends BaseActive
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
		return '{{coupon_consume}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  
		  array('coupon_type,user_id,coupon_value,coupon_desc','required','message'=>'{attribute}不能为空'),
			array('coupon_type,coupon_value', 'numerical', 'integerOnly'=>true),
			array('user_id, create_id, create_time,coupon_value', 'length', 'max'=>11),
			array('coupon_desc,coupon_before,coupon_after,coupon_value,coupon_category', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id,coupon_type, coupon_desc, create_id, create_time', 'safe', 'on'=>'search'),
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
		  'Coupon'=>array(self::BELONGS_TO, 'Coupon', 'coupon_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => '会员名称',
			'coupon_before'=>'操作前值',
			'coupon_value'=>'抵用值',
			'coupon_after'=>'操作后值',
			'coupon_type' => '操作动作',
			'coupon_desc' => '操作描述',
			'coupon_category'=>'消费类型',
			'create_id' => '操作用户',
			'create_time' => '操作时间',
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
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('coupon_type',$this->coupon_style);
		$criteria->compare('coupon_desc',$this->coupon_desc,true);
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
  	$user_login=$_REQUEST['user_login'];
		$coupon_type=$_REQUEST['coupon_type'];
		$coupon_desc=$_REQUEST['coupon_desc'];
		$coupon_category=$_REQUEST['coupon_category'];
		$coupon_number=$_REQUEST['coupon_number'];
		$create_time=$_REQUEST['create_time'];
		
		$conditions=array();
		$params=array();
		$page_params=array();
    if(!empty($user_login)){
			 array_push($conditions,"User.user_login LIKE :user_login");
			 $params[':user_login']="%$user_login%";
			 $page_params['user_login']=$user_login;
		}
		if(!empty($coupon_type)){
			array_push($conditions,"t.coupon_type=:coupon_type");
			$params[':coupon_type']=$coupon_type;
			$page_params['coupon_type']=$coupon_type;
		}
		
		
		if(!empty($coupon_category)){
			array_push($conditions,"t.coupon_category=:coupon_category");
			$params[':coupon_category']=$coupon_category;
			$page_params['coupon_category']=$coupon_category;
		}
		
		if(!empty($coupon_desc)){
			 array_push($conditions,"t.coupon_desc LIKE :coupon_desc");
			 $params[':coupon_desc']="%$coupon_desc%";
			 $page_params['coupon_desc']=$coupon_desc;
		}
		if(!empty($coupon_number)){
			 array_push($conditions,"Coupon.coupon_number LIKE :coupon_number");
			 $params[':coupon_number']="%$coupon_number%";
			 $page_params['coupon_number']=$coupon_number;
		}
		
		if(!empty($create_time)){
			 array_push($conditions,"FROM_UNIXTIME(t.create_time,'%Y-%m-%d')=:create_time");
			 $params[':create_time']=$create_time;
			 $page_params['create_time']=$create_time;
		}
		$criteria=new CDbCriteria;
		
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.create_time DESC";
  	$sort->params=$page_params;
  	
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>array(
			    'condition'=>implode(" AND ",$conditions),
			    'params'=>$params,
			    'with'=>array("User",'Coupon'),
			),
			'pagination'=>array(
          'pageSize'=>'20',
          'params'=>$page_params,
      ),
      'sort'=>$sort,
		));
	}
	




	
	
		//插入一笔旅游的数据
	public function insert_coupon_consume(){
		if(!$this->hasErrors()){
				$datas=$this->save();
				return $datas;
		}
	}
	
	function beforeSave(){
	  if(parent::beforeSave()){
			if($this->isNewRecord){
				if(empty($this->create_id)){
				   $this->create_id=Yii::app()->user->id;
				}
				$this->create_time=Util::current_time('timestamp');
			}else{
				//$this->create_id=Yii::app()->user->id;
				//$this->create_time=Util::current_time('timestamp');
			}
			return true;
		}else{
			return false;
		}
	}
		
	//插入一笔抵用劵消费数据
	function insert_coupon_consume_datas($user_id,$coupon_type,$coupon,$coupon_desc,$coupon_category="",$coupon_id=""){
	 //$t = Yii::app()->db->beginTransaction();
	 //try{
		$coupon_category=empty($coupon_category)?'2':$coupon_category;
		$user=new User();
		$user_datas=$user->get_table_datas($user_id);
		$user_coupon=$user_datas->coupon;
		if($coupon_type=='1'){
			$result_coupon=intval($user_coupon)+intval($coupon);
		}else{
			if($user_coupon<=0){
				return false;
			}
			if($coupon>$user_coupon){
			   $coupon=$user_coupon;
			}
			$result_coupon=intval($user_coupon)-intval($coupon);
		}
		$this->coupon_id=$coupon_id;
		$this->user_id=$user_id;
		$this->coupon_before=$user_coupon;
		$this->coupon_value=$coupon;
		$this->coupon_after=$result_coupon;
		$this->coupon_type=$coupon_type;
		$this->coupon_desc=$coupon_desc;
		$this->coupon_category=$coupon_category;
		$create_user_id=Yii::app()->user->id;
		if(empty($create_user_id)){
			$this->create_id=$user_id;
		}else{
			$this->create_id=$create_user_id;
		}
		if($this->save()){
			$attributes_datas['coupon']=$result_coupon;
			$result=$user->update_table_datas($user_id,$attributes_datas,array());
			if($result){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	 //}catch(Exception $e){
				//$t->rollback();
	  //}
	}
	
	//获得操作动作
	
	function get_coupon_type(){
		$coupon_type_datas=CV::$CREDIT_TYPE;
		return $coupon_type_datas[$this->coupon_type];
	}
		
	//获得用户名称
	function get_user_login($user_id){
		$user=new User();
		$user_datas=$user->get_table_datas($user_id);
		return $user_datas['user_login'];
	}
	
	//获得消费类型
	function get_coupon_category(){
		$coupon_category_datas=CV::$COUPON_CATEGORY;
		return $coupon_category_datas[$this->coupon_category];
	}
}
