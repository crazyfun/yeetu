<?php

/**
 * This is the model class for table "{{travel_infor}}".
 *
 * The followings are the available columns in table '{{travel_infor}}':
 * @property string $id
 * @property string $information_title
 * @property string $information_sort
 * @property string $information_content
 * @property string $create_id
 * @property string $create_time
 */
class TravelInfor extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return TravelInfor the static model class
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
		return '{{travel_infor}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('information_title,information_content,information_sort,information_theme,information_desc,information_status','required','message'=>'{attribute}不能为空'),
		  array('information_title','exist_information_title'),
			array('information_title', 'length', 'max'=>100),
			array('information_sort', 'length', 'max'=>6),
			array('information_theme,create_id, create_time,view_numbs', 'length', 'max'=>11),
			array('information_status,information_recommend','length','max'=>1),
			array('information_content,information_desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, information_title, information_sort, information_content, create_id, create_time', 'safe', 'on'=>'search'),
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
		'Infortheme'=>array(self::BELONGS_TO,'InforTheme','information_theme'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '资讯ID',
			'information_theme'=>'旅游资讯主题',
			'information_desc'=>'资讯描述',
			'information_title' => '资讯名称',
			'information_sort' => '资讯排序',
			'information_content' => '资讯内容',
			'view_numbs'=>'查看次数',
			'information_status'=>'是否发布',
			'information_recommend'=>'是否是推荐',
			'create_id' => '发布者',
			'create_time' => '发布时间',
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
		$criteria->compare('information_title',$this->information_title,true);
		$criteria->compare('information_sort',$this->information_sort,true);
		$criteria->compare('information_content',$this->information_content,true);
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
	  $information_title=empty($_REQUEST['information_title'])?$this->information_title:$_REQUEST['information_title'];
	  $create_name=$_REQUEST['create_name'];
	  $information_theme=$_REQUEST['information_theme'];
	  $information_recommend=$_REQUEST['information_recommend'];
	  $user_condition=array();
	  if(!empty($create_name)){
	  	$user_condition=array('select'=>'User.user_login','condition'=>'User.user_login LIKE :create_name','params'=>array(':create_name'=>"%$create_name%"));
	  	$page_params['create_name']=$create_name;
	  }
	  
	  $conditions=array();
	  $params=array();
	  if($information_title) {
	  	array_push($conditions,"t.information_title LIKE :information_title");
	  	$params[':information_title']="%$this->information_title%";
	  	$page_params['information_title']=$information_title;
	  }
	  if(!empty($information_theme)){
	  	array_push($conditions,"t.information_theme=:information_theme");
	  	$params[':information_theme']=$information_theme;
	  	$page_params['information_theme']=$information_theme;
	  }
	  
	  if(!empty($information_recommend)){
	  	array_push($conditions,"t.information_recommend = :information_recommend");
	  	$params[':information_recommend']=$information_recommend;
	  	$page_params['information_recommend']=$information_recommend;
	  }
	
	  $sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.id DESC";
  	$sort->params=$page_params;
  	
  	
		$criteria=new CDbCriteria;
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>array(
			    'condition'=>implode(" AND ", $conditions),
			    'params'=>$params,
			    'with'=>array("User"=>$user_condition),
			    
			),
			'pagination'=>array(
            'pageSize'=>'20',
            'params'=>$page_params,
      ),
      'sort'=>$sort,
		));
	}
	

	
	
		//插入一笔旅游的数据
	public function insert_travel_infor(){
		if(!$this->hasErrors()){
				$datas=$this->save();
			  return $datas;
		}
	}
	

	
		function beforeSave(){
	  if(parent::beforeSave()){
			if($this->isNewRecord){
				  $this->information_status='1';
					$this->create_id=Yii::app()->user->id;
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
	

	function exist_information_title(){
		$id=$this->id;
		if(!empty($id)){
			 $get_table_datas=$this->get_table_datas($id,array());
			 if($get_table_datas->information_title!=$this->information_title){
			 	 $find_datas=$this->find(array(
          'select'=>'information_title',
          'condition'=>'information_title=:information_title',
          'params'=>array(':information_title' => $this->information_title),
         ));
			 }
		}else{
			$find_datas=$this->find(array(
         'select'=>'information_title',
         'condition'=>'information_title=:information_title',
         'params'=>array(':information_title' => $this->information_title),
       ));
		}
     if(!empty($find_datas)){
     	 $this->addError("information_title","咨询名称已存在");
     }
	}
	
	function converse_date(){
		 $date=new Date(intval($this->create_time));
		 return $date->format();
	}
	
	
	function get_tinfor_operate(){
		 $controller_id=Yii::app()->getController()->getId();
		 $return_str="";
		 $return_str.=CHtml::link('修改',array("$controller_id/add","id"=>$this->id),array('class'=>'operate_button'));
		 if($this->information_status=='2'){
		 	  $return_str.=CHtml::link("不发布",array("$controller_id/publish","id"=>$this->id,'status'=>'1'),array('class'=>'operate_button'));
		 }else{
			$return_str.=CHtml::link("发布",array("$controller_id/publish","id"=>$this->id,'status'=>'2'),array('class'=>'operate_button'));
		 }
		 $return_str.=CHtml::link("删除",array("$controller_id/delete","id"=>$this->id),array('class'=>'operate_dbutton'));
		 return $return_str;
	}
	
	//获得首页的旅游咨询资料
	function get_index_trave_infor(){
		$condition=" information_status=:information_status AND information_recommend=:information_recommend ORDER BY information_sort ASC LIMIT 10";
		$trave_info_datas=$this->findAll(array('select'=>'id,information_title,create_time','condition'=>$condition,'params'=>array(':information_status'=>'2',':information_recommend'=>'1')));
		return $trave_info_datas;
		
	}
	
	//获得资讯推荐
	function get_traveinfo_recommend(){
		$condition=" information_recommend=:information_recommend AND information_status=:information_status  ORDER BY information_sort ASC LIMIT 10";
		$traveinfo_recommend=$this->findAll(array('select'=>'id,information_title,create_time','condition'=>$condition,'params'=>array(':information_recommend'=>'1',':information_status'=>'2')));
		return $traveinfo_recommend;
	}
	
	//获得最新资讯
	function get_traveinfo_new(){
		$condition=" information_status=:information_status ORDER BY create_time ASC LIMIT 10";
		$traveinfo_new=$this->findAll(array('select'=>'id,information_title,create_time','condition'=>$condition,'params'=>array(':information_status'=>'2')));
		return $traveinfo_new;
	}
	
	//获得资讯主题
	function get_infor_theme($info_theme_value=""){
	  $infor_theme_value=empty($info_theme_value)?$this->information_theme:$info_theme_value;
	  $infor_theme=new InforTheme();
	  $select_value=$infor_theme->get_infor_theme_select();
	  return $select_value[$infor_theme_value];
		
	}
	
	

}