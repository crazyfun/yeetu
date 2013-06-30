<?php

/**
 * This is the model class for table "{{coupon}}".
 *
 * The followings are the available columns in table '{{coupon}}':
 * @property string $id
 * @property string $coupon_number
 * @property string $coupon_desc
 * @property string $coupon_price
 * @property string $expiration_date
 * @property string $create_id
 * @property string $create_time
 */
class Coupon extends BaseActive
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
		return '{{coupon}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('coupon_number','required','message'=>'{attribute}不能为空','on'=>'ResumeCoupon'),
		  array('coupon_number',"validate_coupon_number",'on'=>'ResumeCoupon'),
		  array('coupon_number,coupon_desc,coupon_price,coupon_desc','required','message'=>'{attribute}不能为空','on'=>'AddCoupon'),
			array('coupon_number', 'length', 'max'=>100),
			array('coupon_price, create_id, create_time,user_time', 'length', 'max'=>11),
			array('coupon_status','length','max'=>1),
			array('coupon_number',"exist_coupon_number",'on'=>'AddCoupon'),
			array('expiration_date', 'length', 'max'=>30),
			array('coupon_desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, coupon_number, coupon_desc, coupon_price, expiration_date, create_id, create_time', 'safe', 'on'=>'search'),
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
			'id' => '抵用劵ID',
			'coupon_number' => '抵用劵编号',
			'coupon_desc' => '抵用劵描述',
			'coupon_price' => '抵用劵价钱',
			'expiration_date' => '到期时间',
			'coupon_status'=>'是否使用',
			'create_id' => '创建人',
			'user_time'=>'使用时间',
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
		$criteria->compare('coupon_number',$this->coupon_number,true);
		$criteria->compare('coupon_desc',$this->coupon_desc,true);
		$criteria->compare('coupon_price',$this->coupon_price,true);
		$criteria->compare('expiration_date',$this->expiration_date,true);
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
    $coupon_number=$_REQUEST['coupon_number'];
    $coupon_status=$_REQUEST['coupon_status'];
    $user_time=$_REQUEST['user_time'];
    	if(!empty($coupon_number)){
			 array_push($conditions,"coupon_number LIKE :coupon_number");
			 $params[':coupon_number']="%$coupon_number%";
			 $page_params['coupon_number']=$coupon_number;
		}
		if(!empty($coupon_status)){
			 array_push($conditions," coupon_status = :coupon_status");
			 $params[':coupon_status']=$coupon_status;
			 $page_params['coupon_status']=$coupon_status;
		}
		if(!empty($user_time)){
			 array_push($conditions," FROM_UNIXTIME(t.user_time, '%Y-%m-%d')='$user_time'");
			 $page_params['user_time']=$user_time;
		}
		$criteria=new CDbCriteria;
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.create_time DESC";
  	$sort->params=$page_params;
  	
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>array(
			    'condition'=>implode(',',$conditions),
			    'params'=>$params,
			    'with'=>array("User"),
			),
			'pagination'=>array(
          'pageSize'=>'20',
          'params'=> $page_params,
      ),
      'sort'=>$sort,
		));
	}
	
	
	




	
		//插入一笔旅游的数据
	public function insert_coupon(){
		if(!$this->hasErrors()){
        $datas=$this->save();
			  return $datas;
		}
	}

	
	
	function beforeSave(){
	  if(parent::beforeSave()){
			if($this->isNewRecord){
				$this->create_time=Util::current_time('timestamp');
			}else{
				//$this->create_time=Util::current_time('timestamp');
			}
			return true;
		}else{
			return false;
		}

	}

	public function exist_coupon_number(){
		$id=$this->id;
		if(!empty($id)){
			$get_table_datas=$this->get_table_datas($id,array());
			if($get_table_datas->coupon_number!=$this->coupon_number){
				$find_datas=$this->find(array(
         'select'=>'id',
         'condition'=>'coupon_number=:coupon_number',
         'params'=>array(':coupon_number' => $this->coupon_number),
        ));
			}
		}else{
			 $find_datas=$this->find(array(
         'select'=>'id',
         'condition'=>'coupon_number=:coupon_number',
         'params'=>array(':coupon_number' => $this->coupon_number),
        ));
		}
     if(!empty($find_datas)){
     	 $this->addError("coupon_number","抵用劵序号已存在");
     }
	}
	
	
	public function validate_coupon_number(){
		
		$coupon_datas=$this->get_table_datas("",array('coupon_number'=>$this->coupon_number));
		if(empty($coupon_datas)){
			$this->addError('coupon_number',"抵用劵不存在");
			return false;
		}else{
			
			$expiration_date=$coupon_datas[0]['expiration_date'];
			$coupon_status=$coupon_datas[0]['coupon_status'];
	
			if($coupon_status=='2'){
				  $this->addError('coupon_number',"此抵用劵已经使用过");
					return false;
			}
			
			if(strlen($expiration_date)){
				
				$current_date=date('Y-m-d');
				
				if($current_date>$expiration_date){
					$this->addError('coupon_number',"抵用劵已过期,过期时间:$expiration_date");
					return false;
				}
			}
			
		}
		return true;
	}
	
	
	
	function get_coupon_operate(){
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="";
		  $return_str.=CHtml::link('修改',array("$controller_id/add","id"=>$this->id),array('class'=>'operate_button'));
		  $return_str.=CHtml::link('删除',array("$controller_id/delete","id"=>$this->id),array('class'=>'operate_dbutton'));
		  return $return_str;
	}
	
	function get_coupon_status(){
		$coupon_status_datas=array("1"=>"未使用","2"=>"已使用");
		return $coupon_status_datas[$this->coupon_status];
	}
	
	
}