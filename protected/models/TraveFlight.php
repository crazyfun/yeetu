<?php

/**
 * This is the model class for table "{{trave_flight}}".
 *
 * The followings are the available columns in table '{{trave_flight}}':
 * @property string $id
 * @property string $trave_id
 * @property string $go_flight
 * @property string $back_flight
 * @property string $transfer_flight
 * @property string $total_price
 * @property string $flight_desc
 * @property string $create_id
 * @property string $create_time
 */
class TraveFlight extends BaseActive
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
		return '{{trave_flight}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('go_flight,go_flight_com,go_flight_airport,go_flight_rairport,go_flight_time,go_flight_rtime,departure,destinations','required','message'=>'{attribute}不能为空'),
			array('create_id,create_time', 'length', 'max'=>11),
			array('go_flight,go_flight_type,go_flight_com,go_flight_airport,go_flight_rairport,go_flight_time,go_flight_rtime,departure,destinations', 'length', 'max'=>30),
			array('flight_desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, go_flight,flight_desc,create_id,create_time', 'safe', 'on'=>'search'),
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
			'id' => '航班组ID',
			'departure'=>'出发地',
			'destinations'=>'目的地',
			'go_flight' => '航班',
			'go_flight_type'=>'机型',
			'go_flight_com'=>'航空公司',
			'go_flight_airport'=>'起飞机场',
			'go_flight_rairport'=>'抵达机场',
			'go_flight_time'=>'起飞时间',
			'go_flight_rtime'=>'降落时间',
			'flight_desc' => '航班组描述',
			'create_id' => '创建者ID',
			'create_time' => '创建时间',
		);
	}
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function searchdatas()
	{
			// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$condition=array();
		$params=array();
		$page_params=array();
		$trave_flight=$_REQUEST['trave_flight'];
		$flight_airport=$_REQUEST['flight_airport'];
		$flight_type=$_REQUEST['flight_type'];
		$flight_id=$_REQUEST['flight_id'];
		if(!empty($flight_id)){
			array_push($condition,"(id = :flight_id)");
			$params[':flight_id']="$flight_id";
			$page_params['flight_id']=$flight_id;
		}

		if(!empty($flight_type)){
			array_push($condition,"(go_flight_type LIKE :flight_type)");
			$params[':flight_type']="%$flight_type%";
			$page_params['flight_type']=$flight_type;
		}

    if(!empty($trave_flight)){
			array_push($condition,"(go_flight LIKE :trave_flight)");
			$params[':trave_flight']="%$trave_flight%";
			$page_params['trave_flight']=$trave_flight;
		}
    if(!empty($flight_airport)){
			array_push($condition,"(go_flight_airport LIKE :flight_airport)");
			$params[':flight_airport']="%$flight_airport%";
			$page_params['flight_airport']=$flight_airport;
		}
		/*
		 if(!empty($flight_date)){
			array_push($condition,"(start_date LIKE :flight_date OR end_date LIKE :flight_date)");
			$params[':flight_date']="%$flight_date%";
			$page_params['flight_date']=$flight_date;
		}	
		*/
		
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.id DESC";
  	$sort->params=$page_params;
  	
  	
		$criteria=new CDbCriteria;
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>array(
			    'condition'=>implode(" AND ",$condition),
			    'params'=>$params,
			   
			),
			'pagination'=>array(
            'pageSize'=>'20',
            'params'=>$page_params,
      ),
      'sort'=>$sort,
		));
	}
	



		//插入一笔旅游的数据
	public function insert_traveflight(){
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
				$this->create_id=Yii::app()->user->id;
				$this->create_time=Util::current_time('timestamp');
			}
			return true;
		}else{
			return false;
		}
	}
	
	
	
	function get_traveflight_operate(){
		 $controller_id=Yii::app()->getController()->getId();
		 $return_str="";
		 $validate_user_flag=Yii::app()->getController()->validate_user_operate($this->create_id);
		 if($validate_user_flag){
		  $return_str.=CHtml::link('修改',array("$controller_id/addtraveflight","id"=>$this->id),array('class'=>'operate_button'));
		  $return_str.=CHtml::link("删除",array("$controller_id/deletetraveflight","id"=>$this->id),array('class'=>'operate_dbutton'));
		 }
		 return $return_str;
	}
	
	function converse_date(){
		 $date=new Date(intval($this->create_time));
		 return $date->format();
	}
	
	
	function get_end_date($trave_id,$start_date){
		
		$trave=new Trave();
		$trave_datas=$trave->get_table_datas($trave_id);
		$trave_route_number=$trave_datas->trave_route_number;
		$end_date=strftime("%Y-%m-%d",(strtotime($start_date)+(24*60*60)*($trave_route_number-1)));
		return $end_date;
	}

}