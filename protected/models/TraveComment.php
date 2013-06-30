<?php

/**
 * This is the model class for table "{{trave_comment}}".
 *
 * The followings are the available columns in table '{{trave_comment}}':
 * @property string $id
 * @property string $trave_id
 * @property string $parent_id
 * @property integer $comment_total
 * @property integer $comment_scape
 * @property integer $comment_shop
 * @property integer $comment_server
 * @property string $comment_content
 * @property string $create_id
 * @property string $create_time
 */
 

 
 
class TraveComment extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return TraveComment the static model class
	 */
	protected $avg_comment_total="";
  protected $count_ids="";
  protected $avg_comment_scape="";
  protected $avg_comment_shop="";
  protected $avg_comment_server="";
  protected $avg_comment_stay="";
  protected $avg_comment_dining="";
  protected $avg_comment_cat="";
  protected $avg_comment_guide="";

  public static function model($className=__CLASS__)
	{
	
		return parent::model($className);
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{trave_comment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comment_total', 'safe'),
			array('comment_total, comment_scape, comment_shop, comment_server,comment_stay,comment_dining,comment_cat,comment_guide', 'numerical', 'integerOnly'=>true),
			array('trave_id, parent_id, create_id, create_time', 'length', 'max'=>11),
			array('shit_comment','length','max'=>'1'),
			array('comment_content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, trave_id, parent_id, comment_total, comment_scape, comment_shop, comment_server, comment_content, create_id, create_time', 'safe', 'on'=>'search'),
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
		  'User'=>array(self::BELONGS_TO,'User','create_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '评论ID',
			'trave_id' => '线路名称',
			'parent_id' => '评论父类',
			'comment_total' => '总评分',
			'comment_scape' => '风景评分',
			'comment_stay'=>'住宿评分',
			'comment_dining'=>'用餐评分',
			'comment_cat'=>'车辆评分',
			'comment_guide'=>'导游评分',
			'comment_shop' => '购物评分',
			'comment_server' => '客服评分',
			'comment_content' => '评论内容',
			'shit_comment'=>'乱评论',
			'create_id' => '评论人',
			'create_time' => '评论时间',
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
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('comment_total',$this->comment_total);
		$criteria->compare('comment_scape',$this->comment_scape);
		$criteria->compare('comment_shop',$this->comment_shop);
		$criteria->compare('comment_server',$this->comment_server);
		$criteria->compare('comment_content',$this->comment_content,true);
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
    $trave_name=$_REQUEST['trave_name'];
    $shit_comment=$_REQUEST['shit_comment'];
    $comment_total=$_REQUEST['comment_total'];
    $comment_scape=$_REQUEST['comment_scape'];
    $comment_shop=$_REQUEST['comment_shop'];
    $comment_stay=$_REQUEST['comment_stay'];
    $comment_dining=$_REQUEST['comment_dining'];
    $comment_cat=$_REQUEST['comment_cat'];
    $comment_guide=$_REQUEST['comment_guide'];
    $comment_server=$_REQUEST['comment_server'];
    $create_time=$_REQUEST['create_time'];
    if(!empty($trave_name)){
			 array_push($conditions,"Trave.trave_name LIKE :trave_name");
			 $params[':trave_name']="%$trave_name%";
			 $page_params['trave_name']=$trave_name;
		}
		
		if(!empty($shit_comment)){
			 array_push($conditions,"t.shit_comment =:shit_comment");
			 $params[':shit_comment']=$shit_comment;
			 $page_params['shit_comment']=$shit_comment;
		}
		
		if(!empty($create_time)){
			 array_push($conditions,"FROM_UNIXTIME(t.create_time,'%Y-%m-%d')=:create_time");
			 $params[':create_time']=$create_time;
			 $page_params['create_time']=$create_time;
		}

		if(!empty($comment_total)){
			 array_push($conditions,"t.comment_total = :comment_total");
			 $params[':comment_total']=$comment_total;
			 $page_params['comment_total']=$comment_total;
		}
		
		if(!empty($comment_scape)){
			 array_push($conditions,"t.comment_scape = :comment_scape");
			 $params[':comment_scape']=$comment_scape;
			 $page_params['comment_scape']=$comment_scape;
		}
		
		if(!empty($comment_shop)){
			 array_push($conditions,"t.comment_shop = :comment_shop");
			 $params[':comment_shop']=$comment_shop;
			 $page_params['comment_shop']=$comment_shop;
		}
		
		if(!empty($comment_stay)){
			 array_push($conditions,"t.comment_stay = :comment_stay");
			 $params[':comment_stay']=$comment_stay;
			 $page_params['comment_stay']=$comment_stay;
		}
		
		if(!empty($comment_dining)){
			array_push($conditions,"t.comment_dining = :comment_dining");
			 $params[':comment_dining']=$comment_dining;
			 $page_params['comment_dining']=$comment_dining;
		}
		
		if(!empty($comment_cat)){
			 array_push($conditions,"t.comment_cat = :comment_cat");
			 $params[':comment_cat']=$comment_cat;
			 $page_params['comment_cat']=$comment_cat;
		}
		
		if(!empty($comment_guide)){
			 array_push($conditions,"t.comment_guide = :comment_guide");
			 $params[':comment_guide']=$comment_guide;
			 $page_params['comment_guide']=$comment_guide;
		}
		
		if(!empty($comment_server)){
			 array_push($conditions,"t.comment_server = :comment_server");
			 $params[':comment_server']=$comment_server;
			 $page_params['comment_server']=$comment_server;
		}
		
		$validate_sregion=Yii::app()->getController()->validate_sregion();
	  if($validate_sregion){
	    $validate_sregion=" AND ".$validate_sregion;
	  }
	  
	  $sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.create_time DESC";
  	$sort->params=$page_params;
  	
  	
		$criteria=new CDbCriteria;
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>array(
			    'condition'=>implode(' AND ',$conditions),
			    'params'=>$params,
			    'with'=>array("User","Trave"=>array('select'=>'trave.trave_name','condition'=>'(1=1)'.$validate_sregion,'params'=>array(),'together'=>true)),

			),
			'pagination'=>array(
          'pageSize'=>'20',
          'params'=> $page_params,
      ),
       'sort'=>$sort,
		));
	}
	
	


			//插入一笔旅游的数据
	public function insert_trave_comment(){
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
			}
			return true;

		}else{
			return false;
		}
	}
	
	function afterSave(){
		      return true;
	}

	function get_user_login(){
		$user=new User();
		$user_datas=$user->get_table_datas($this->create_id);
		return $user_datas->user_login;
	}
	
	function get_rating(){
		$avg_comment_total=$this->comment_total;
		$avg_comment_scape=$this->comment_scape;
		$avg_comment_shop=$this->comment_shop;
		$avg_comment_server=$this->comment_server;
		$avg_comment_stay=$this->comment_stay;
		$avg_comment_dining=$this->comment_dining;
		$avg_comment_cat=$this->comment_cat;
		$avg_comment_guide=$this->comment_guide;
		$rating_values=CV::$RATING_VALUES;
		$return_str="<span class='around_price'>";
		$return_str.="<a class='trave_tipsy' title='(";
		if($avg_comment_scape)
		 $return_str.="景点:".$rating_values[$avg_comment_scape];
		if($avg_comment_stay)
		 $return_str.=",住宿:".$rating_values[$avg_comment_stay];
		if($avg_comment_dining)
		 $return_str.=",用餐:".$rating_values[$avg_comment_dining];
		if($avg_comment_cat)
		 $return_str.=",车辆:".$rating_values[$avg_comment_cat];
		if($avg_comment_guide)
		 $return_str.=",导游:".$rating_values[$avg_comment_guide];
		if($avg_comment_shop)
		 $return_str.=",购物:".$rating_values[$avg_comment_shop];
		if($avg_comment_server)
		 $return_str.=",服务:".$rating_values[$avg_comment_server];
		if(!$avg_comment_scape&&!$avg_comment_stay&&!$avg_comment_dining&&!$avg_comment_cat&&!$avg_comment_guide&&!$avg_comment_shop&&!$avg_comment_server){
			$return_str.="没有其他评价";
		}
		
		$return_str.=")'>".Util::get_rating_img($avg_comment_total)."</a>";
		$return_str.="</span>";
		return $return_str;
	}
	
	function get_trave_comments($trave_id,$trave_category=""){
		
		
		$sql="SELECT FLOOR(AVG(comment_total)) as avg_comment_total,FLOOR(AVG(comment_scape)) as avg_comment_scape,FLOOR(AVG(comment_shop)) as avg_comment_shop,FLOOR(AVG(comment_server)) as avg_comment_server,FLOOR(AVG(comment_stay)) as avg_comment_stay,FLOOR(AVG(comment_dining)) as avg_comment_dining,FLOOR(AVG(comment_cat)) as avg_comment_cat,FLOOR(AVG(comment_guide)) as avg_comment_guide,COUNT(id) as count_ids FROM {{trave_comment}} WHERE trave_id=:trave_id AND parent_id=''";
		$trave_comment_datas=$this->findBySql($sql,array(":trave_id"=>$trave_id));
		$avg_comment_total=$trave_comment_datas->avg_comment_total;
		$avg_comment_scape=$trave_comment_datas->avg_comment_scape;
		$avg_comment_shop=$trave_comment_datas->avg_comment_shop;
		$avg_comment_server=$trave_comment_datas->avg_comment_server;
		$avg_comment_stay=$trave_comment_datas->avg_comment_stay;
		$avg_comment_dining=$trave_comment_datas->avg_comment_dining;
		$avg_comment_cat=$trave_comment_datas->avg_comment_cat;
		$avg_comment_guide=$trave_comment_datas->avg_comment_guide;
		$count_ids=$trave_comment_datas->count_ids;
		$rating_values=CV::$RATING_VALUES;
		$return_str="<table><tbody><tr><td><span class='around_price'>";
		$return_str.="<a class='trave_tipsy' title='(评论:".$count_ids;
		if($avg_comment_scape)
		 $return_str.=",景点:".$rating_values[$avg_comment_scape];
		if($avg_comment_stay)
		 $return_str.=",住宿:".$rating_values[$avg_comment_stay];
		if($avg_comment_dining)
		 $return_str.=",用餐:".$rating_values[$avg_comment_dining];
		if($avg_comment_cat)
		 $return_str.=",车辆:".$rating_values[$avg_comment_cat];
		if($avg_comment_guide)
		 $return_str.=",导游:".$rating_values[$avg_comment_guide];
		if($avg_comment_shop)
		 $return_str.=",购物:".$rating_values[$avg_comment_shop];
		if($avg_comment_server)
		 $return_str.=",服务:".$rating_values[$avg_comment_server];
		$return_str.=")'>".Util::get_rating_img($avg_comment_total)."</a>";
		$return_str.="</span>";

	  $return_str.="</td><td><span>(评论:<a href='";
		if($trave_category==5){
		   $return_str.="javascript:change_trave_tab(4,5);";
		}else{
		   $return_str.="javascript:change_trave_tab(5,6);";
		}
		$return_str.="'>".$count_ids."条</a>)</span></td></tr></tbody></table>";
		return $return_str;
		
		
	
	}
	
	
	function get_trave_satisfied($trave_id){
		
		$sql="SELECT FLOOR(AVG(comment_total)) as avg_comment_total,FLOOR(AVG(comment_scape)) as avg_comment_scape,FLOOR(AVG(comment_shop)) as avg_comment_shop,FLOOR(AVG(comment_server)) as avg_comment_server,FLOOR(AVG(comment_stay)) as avg_comment_stay,FLOOR(AVG(comment_dining)) as avg_comment_dining,FLOOR(AVG(comment_cat)) as avg_comment_cat,FLOOR(AVG(comment_guide)) as avg_comment_guide,COUNT(id) as count_ids FROM {{trave_comment}} WHERE trave_id=:trave_id AND parent_id=''";
		$trave_comment_datas=$this->findBySql($sql,array(":trave_id"=>$trave_id));
		$avg_comment_total=$trave_comment_datas->avg_comment_total;
		$avg_comment_scape=$trave_comment_datas->avg_comment_scape;
		$avg_comment_shop=$trave_comment_datas->avg_comment_shop;
		$avg_comment_server=$trave_comment_datas->avg_comment_server;
		$avg_comment_stay=$trave_comment_datas->avg_comment_stay;
		$avg_comment_dining=$trave_comment_datas->avg_comment_dining;
		$avg_comment_cat=$trave_comment_datas->avg_comment_cat;
		$avg_comment_guide=$trave_comment_datas->avg_comment_guide;
		$count_ids=$trave_comment_datas->count_ids;
		$rating_values=CV::$RATING_VALUES;
		$return_str="<span class='around_price'>";
		$return_str.="<a class='trave_tipsy' title='(评论:".$count_ids;
		if($avg_comment_scape)
		 $return_str.=",景点:".$rating_values[$avg_comment_scape];
		if($avg_comment_stay)
		 $return_str.=",住宿:".$rating_values[$avg_comment_stay];
		if($avg_comment_dining)
		 $return_str.=",用餐:".$rating_values[$avg_comment_dining];
		if($avg_comment_cat)
		 $return_str.=",车辆:".$rating_values[$avg_comment_cat];
		if($avg_comment_guide)
		 $return_str.=",导游:".$rating_values[$avg_comment_guide];
		if($avg_comment_shop)
		 $return_str.=",购物:".$rating_values[$avg_comment_shop];
		if($avg_comment_server)
		 $return_str.=",服务:".$rating_values[$avg_comment_server];
		$return_str.=")'>".Util::get_rating_img($avg_comment_total)."</a>";
		$return_str.="</span>";

		return $return_str;
		
	}
	
	
	function get_trave_b_satisfied($trave_id){
		$sql="SELECT FLOOR(AVG(comment_total)) as avg_comment_total,FLOOR(AVG(comment_scape)) as avg_comment_scape,FLOOR(AVG(comment_shop)) as avg_comment_shop,FLOOR(AVG(comment_server)) as avg_comment_server,FLOOR(AVG(comment_stay)) as avg_comment_stay,FLOOR(AVG(comment_dining)) as avg_comment_dining,FLOOR(AVG(comment_cat)) as avg_comment_cat,FLOOR(AVG(comment_guide)) as avg_comment_guide,COUNT(id) as count_ids FROM {{trave_comment}} WHERE trave_id=:trave_id AND parent_id=''";
		$trave_comment_datas=$this->findBySql($sql,array(":trave_id"=>$trave_id));
		$avg_comment_total=$trave_comment_datas->avg_comment_total;
		$avg_comment_scape=$trave_comment_datas->avg_comment_scape;
		$avg_comment_shop=$trave_comment_datas->avg_comment_shop;
		$avg_comment_server=$trave_comment_datas->avg_comment_server;
		$avg_comment_stay=$trave_comment_datas->avg_comment_stay;
		$avg_comment_dining=$trave_comment_datas->avg_comment_dining;
		$avg_comment_cat=$trave_comment_datas->avg_comment_cat;
		$avg_comment_guide=$trave_comment_datas->avg_comment_guide;
		$count_ids=$trave_comment_datas->count_ids;
		$rating_values=CV::$RATING_VALUES;
		$return_str="<span class='b_around_price'>";
		$return_str.=Util::get_rating_img($avg_comment_total);
		$return_str.="</span>";
		$return_str.='<span class="b_tip_content">';
		$return_str.="<span>(评论:".$count_ids;
		if($avg_comment_scape)
		 $return_str.=",景点:".$rating_values[$avg_comment_scape];
		if($avg_comment_stay)
		 $return_str.=",住宿:".$rating_values[$avg_comment_stay];
		if($avg_comment_dining)
		 $return_str.=",用餐:".$rating_values[$avg_comment_dining];
		if($avg_comment_cat)
		 $return_str.=",车辆:".$rating_values[$avg_comment_cat];
		if($avg_comment_guide)
		 $return_str.=",导游:".$rating_values[$avg_comment_guide];
		if($avg_comment_shop)
		 $return_str.=",购物:".$rating_values[$avg_comment_shop];
		if($avg_comment_server)
		 $return_str.=",服务:".$rating_values[$avg_comment_server];
		 $return_str.=")</span>";
		$return_str.='</span>';
		return $return_str;
		
	}
	
	
	
	function get_trave_admin_satisfied(){

		$comment_total=$this->comment_total;
		$comment_scape=$this->comment_scape;
		$comment_shop=$this->comment_shop;
		$comment_server=$this->comment_server;
		$comment_stay=$this->comment_stay;
		$comment_dining=$this->comment_dining;
		$comment_cat=$this->comment_cat;
		$comment_guide=$this->comment_guide;
		$rating_values=CV::$RATING_VALUES;
		$return_str="<span class='b_around_price'>";
		$return_str.=Util::get_rating_img($comment_total);
		$return_str.="</span>";
		$return_str.='<span class="b_tip_content">';
		$return_str.="<span>(景点:".$rating_values[$comment_scape].",住宿:".$rating_values[$comment_stay].",用餐:".$rating_values[$comment_dining].",车辆:".$rating_values[$comment_cat].",导游:".$rating_values[$comment_guide].",购物:".$rating_values[$comment_shop].",服务:".$rating_values[$comment_server].")</span>";
		$return_str.='</span>';
		
		
		
		return $return_str;
		
	}
	
	
	function get_comment_operate(){
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="";
		  $return_str.=CHtml::link('修改',array("$controller_id/add","id"=>$this->id),array('class'=>'operate_dbutton'));
		  if($this->shit_comment=='')
		   $return_str.=CHtml::link('乱评论',array("$controller_id/shitcomment","id"=>$this->id,"shit_comment"=>"1"),array('class'=>'operate_button'));
      $return_str.=CHtml::link('删除',array("$controller_id/delete","id"=>$this->id),array('class'=>'operate_button'));
		  return $return_str;
	}
	
	
	function get_new_comment($trave_sregion){
		$trave_comment_datas=$this->with("Trave")->findAll(array('select'=>'id,trave_id,comment_total,comment_scape,comment_shop,comment_stay,comment_dining,comment_cat,comment_guide,comment_server,comment_content,shit_comment,create_time','condition'=>'shit_comment<>:shit_comment  AND Trave.trave_status=:trave_status AND Trave.recycle=:recycle AND Trave.trave_sregion=:trave_sregion','params'=>array(':shit_comment'=>'1',':trave_status'=>'2',':recycle'=>'0',':trave_sregion'=>$trave_sregion),'order'=>'t.create_time DESC','together'=>true,'limit'=>10));
		return $trave_comment_datas;
	}
}