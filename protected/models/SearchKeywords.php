<?php

/**
 * This is the model class for table "{{search_keywords}}".
 *
 * The followings are the available columns in table '{{search_keywords}}':
 * @property string $id
 * @property string $search_content
 * @property string $search_nums
 * @property string $search_ip
 * @property string $search_time
 */
class SearchKeywords extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SearchKeywords the static model class
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
		return '{{search_keywords}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('search_content', 'length', 'max'=>200),
			array('search_nums, search_time', 'length', 'max'=>11),
			array('search_ip', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, search_content, search_nums, search_ip, search_time', 'safe', 'on'=>'search'),
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
			'id' => '搜索关键字ID',
			'search_content' => '搜索关键字内容',
			'search_nums' => '搜索关键字次数',
			'search_ip' => '最后搜索关键字IP',
			'search_time' => '搜索关键字时间',
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
		$criteria->compare('search_content',$this->search_content,true);
		$criteria->compare('search_nums',$this->search_nums,true);
		$criteria->compare('search_ip',$this->search_ip,true);
		$criteria->compare('search_time',$this->search_time,true);

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
    $search_content=$_REQUEST['search_content'];
    $search_ip=$_REQUEST['search_ip'];
    if(!empty($search_content)){
			 array_push($conditions,"search_content LIKE :search_content");
			 $params[':search_content']="%$search_content%";
			 $page_params['search_content']=$search_content;
		}
		if(!empty($search_ip)){
			 array_push($conditions,"search_ip LIKE :search_ip");
			 $params[':search_ip']="%$search_ip%";
			 $page_params['search_ip']=$search_ip;
		}
		
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.search_time DESC";
  	$sort->params=$page_params;
  	
  	
		$criteria=new CDbCriteria;
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
	
	
	
	function insert_search_keywords($search_content){
       $search_keywords_datas=$this->find(array('select'=>'id,search_nums','condition'=>'search_content=:search_content','params'=>array(':search_content'=>$search_content)));
       if(!empty($search_keywords_datas)){
       	$update_conditions['search_nums']=$search_keywords_datas->search_nums+1;
       	$ip=Util::getip();
       	$ip_convert=new IpConvert();
       	$search_area=$ip_convert->convertip($ip);
       	$update_conditions['search_ip']=$ip."(".$search_area.")";
        $this->update_table_datas($search_keywords_datas->id,$update_conditions,array());
       }else{
       	  $this->search_content=$search_content;
       	  $this->search_nums='1';
       	  $ip=Util::getip();
       	  $ip_convert=new IpConvert();
       	  $search_area=$ip_convert->convertip($ip);
       	  $this->search_ip=$ip."(".$search_area.")";
       	  $this->search_time=Util::current_time('timestamp');  
       	  $this->save();  	
       }
	}
}