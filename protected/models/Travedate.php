<?php

/**
 * This is the model class for table "{{travedate}}".
 *
 * The followings are the available columns in table '{{travedate}}':
 * @property string $id
 * @property string $trave_id
 * @property integer $date_type
 * @property string $trave_date
 * @property string $child_price
 * @property string $adult_price
 * @property string $profit_price
 * @property integer $trave_status
 * @property string $create_id
 * @property string $create_time
 */
class Travedate extends BaseActive
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
		return '{{travedate}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('trave_status', 'safe'),
			array('trave_status,date_type', 'numerical', 'integerOnly'=>true),
			array('trave_id, child_price, adult_price,fa_price,fc_price,create_id, create_time,seats,flight_id,back_flight_id,flight_price', 'length', 'max'=>11),
			array('trave_date', 'length', 'max'=>50),
			array('child_price,adult_price,fa_price,fc_price','required'),
			array('trave_date,seats','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, trave_id, trave_date, child_price, adult_price, fa_price,fc_price, trave_status,date_type, create_id, create_time', 'safe', 'on'=>'search'),
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
		  'Trave'=>array(self::BELONGS_TO, 'Trave', 'trave_id'),
		  'TraveFlight'=>array(self::BELONGS_TO,'TraveFlight','flight_id'),
		  'B_TraveFlight'=>array(self::BELONGS_TO,'TraveFlight','back_flight_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '出发时间ID',
			'trave_id' => '线路名称',
			'date_type'=>'日期类型',
			'trave_date' => '出发时间',
			'trave_price' => '线路价钱',
			'child_price' => '儿童价钱',
			'adult_price' => '成人价钱',
			'fa_price'=>'成人结算价',
			'fc_price'=>'儿童结算价',
			'flight_id'=>'航班ID',
			'back_flight_id'=>'返程航班ID',
			'flight_price'=>'航班组价钱',
			'trave_status' => '时间状态',
			'seats'=>'位置',
			'create_id' => '创建者',
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
		$criteria->compare('date_type',$this->date_type,true);
		$criteria->compare('trave_date',$this->trave_date,true);
		$criteria->compare('child_price',$this->child_price,true);
		$criteria->compare('adult_price',$this->adult_price,true);
		$criteria->compare('trave_status',$this->trave_status);
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
	  $page_params=array();
	  $page_params['trave_id']=empty($_REQUEST['trave_id'])?$this->trave_id:$_REQUEST['trave_id'];
	  $page_params['trave_date']=empty($_REQUEST['trave_date'])?$this->trave_date:$_REQUEST['trave_id'];
		$criteria=new CDbCriteria;
		
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.id DESC";
  	$sort->params=$page_params;
  	
  	
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>array(
			    'condition'=>'t.trave_id=:trave_id AND t.trave_date LIKE :trave_date',
			    'params'=>array(':trave_id'=>$this->trave_id,':trave_date'=>"%$this->trave_date%"),
			    'with'=>array("Trave"),

			),
			
			'pagination'=>array(
                'pageSize'=>'20',
                'params'=>$page_params,
      ),
      'sort'=>$sort,
		));
	}
	


		//插入一笔旅游的数据
	public function insert_travedate(){
		if(!$this->hasErrors()){
        $datas=$this->save();
			  return $datas;
		}
	}

		function beforeSave(){
	  if(parent::beforeSave()){
			if($this->isNewRecord){
					$this->trave_status=1;
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

	
		function get_travedate_operate(){
		 $controller_id=Yii::app()->getController()->getId();
		 $return_str="";
		 $return_str.=CHtml::link('修改',array("$controller_id/addtravedate","id"=>$this->id,"trave_id"=>$this->trave_id),array('class'=>'operate_button'));
		 if($this->trave_status == '1')
		   $return_str.=CHtml::link("关闭",array("$controller_id/closetravedate","id"=>$this->id,"trave_id"=>$this->trave_id),array('class'=>'operate_button'));
		 else
		   $return_str.=CHtml::link("启用",array("$controller_id/opentravedate","id"=>$this->id,"trave_id"=>$this->trave_id),array('class'=>'operate_button'));
		 $return_str.=CHtml::link("删除",array("$controller_id/deletetravedate","id"=>$this->id,"trave_id"=>$this->trave_id),array('class'=>'operate_dbutton'));
		 return $return_str;
	}
	
	//获得线路的最低价格
	function get_trave_price($trave_id){
		$sql="SELECT MIN(adult_price)  as trave_price FROM {{travedate}} WHERE trave_id='$trave_id' AND trave_status='1'";
		$command=Yii::app()->db->createCommand($sql);
		$travedate_datas=$command->queryRow();
		return $travedate_datas['trave_price'];
	}
	function get_price_detals(){
		return "会员价:$this->adult_price,儿童价:$this->child_price";
	}
	function get_trave_date_name(){
		return Util::get_trave_start_date_name($this->trave_date,$this->date_type);
	}
	
	
		function converse_date(){
		 $date=new Date(intval($this->create_time));
		 return $date->format();
	}


}