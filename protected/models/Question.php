<?php

/**
 * This is the model class for table "{{question}}".
 *
 * The followings are the available columns in table '{{question}}':
 * @property string $id
 * @property string $subject
 * @property string $content
 * @property string $user_id
 * @property string $create_time
 * @property string $modify_time
 * @property integer $status
 * @property integer $category_id
 * @property string $best_id
 */
class Question extends CActiveRecord
{
    const UNSOLVED = 1;
    //const SOLVING = 2;
    const SOLVED = 3;
    const CLOSED = 4;
    //const UNSATISFIED = 5;

    /**
     * @return string the associated database table name
     */
     
  public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    public function tableName()
    {
        return '{{question}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('subject, content, user_id, create_time, status, category_id', 'required'),
            array('status, category_id,views', 'numerical', 'integerOnly'=>true),
            //array('subject', 'length', 'max'=>50),
            array("subject","length",'encoding'=>'utf-8','max'=>100,'tooLong'=>'最多只能输入50个字'),
            array('content', 'length', 'max'=>3000),
            array('user_id, create_time, modify_time, best_id', 'length', 'max'=>11),
            array('shit_status','length','max'=>'1'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, subject, content, user_id, create_time, modify_time, status, category_id, best_id', 'safe', 'on'=>'search'),
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
            'answer_count'=>array(self::STAT,'Answer','question_id'),
            'user'=>array(self::BELONGS_TO,'User','user_id'),
            'category'=>array(self::BELONGS_TO,'QuestionCategory',"category_id"),
            'answers'=>array(self::HAS_MANY,'Answer','question_id'),
            'best_answer'=>array(self::BELONGS_TO,'Answer','best_id'),
        );

    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'subject' => '标题',
            'content' => '内容',
            'user_id' => '用户',
            'create_time' => '创建时间',
            'modify_time' => '修改时间',
            'status' => '状态',
            'category_id' => '分类',
            'best_id' => '最佳答案ID',
            'shit_status'=>'乱提问',
        	  'views' => '查看次数',
        	  'answer_count' => '回答'
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
        $criteria->compare('subject',$this->subject,true);
        $criteria->compare('content',$this->content,true);
        $criteria->compare('user_id',$this->user_id,true);
        $criteria->compare('create_time',$this->create_time,true);
        $criteria->compare('modify_time',$this->modify_time,true);
        $criteria->compare('status',$this->status);
        $criteria->compare('category_id',$this->category_id);
        $criteria->compare('best_id',$this->best_id,true);

        return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
        ));
    }

	public function searchdatas()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$condition=array();
		$params=array();
		$page_params=array();
		$subject=$_REQUEST['subject'];
		$status=$_REQUEST['status'];
		$user_name=$_REQUEST['user_name'];
		$category_id=$_REQUEST['category_id'];
		
    	if(!empty($subject)){
			array_push($condition,"(t.subject LIKE :subject)");
			$params[':subject']="%$subject%";
			$page_params['subject']=$subject;
		}

		if(!empty($user_name)){
			$user=User::model()->find('user_login=:user_login',array(':user_login'=>$user_name));
			$user_id=$user->id;
			array_push($condition,"t.user_id=:user_id");
			$params[':user_id']=$user_id;
			$page_params['user_id']=$user_id;
		}
				
		if(!empty($status)){
			array_push($condition,"t.status=:status");
			$params[':status']=$status;
			$page_params['status']=$status;
		}
		
		if(!empty($category_id)){
			array_push($condition,"t.category_id=:category_id");
			$params[':category_id']=$category_id;
			$page_params['category_id']=$category_id;
		}

    $sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.id ASC";
  	$sort->params=$page_params;
  	
  	
		$criteria=new CDbCriteria;
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>array(
			    'condition'=>implode(' AND ',$condition),
			    'params'=>$params,
			    'with'=>array(),

			),
			'pagination'=>array(
          'pageSize'=>'20',
          'params'=> $page_params,
      ),
      'sort'=>$sort,
		));
	}

    public function get_status_image(){
        if($this->status == self::UNSOLVED){
            //return CHtml::image("../images/ask_wjj.gif","未解决",array('width'=>44,'height'=>19,'align'=>'absmiddle'));
            return CHtml::image("/css/images/ask_jjz.gif","解决中",array('width'=>44,'height'=>19,'align'=>'absmiddle'));
        }else if($this->status == self::SOLVED){
            return CHtml::image("/css/images/ask_yjj.gif","已解决",array('width'=>44,'height'=>19,'align'=>'absmiddle'));
        }
        /*
        else if($this->status == self::SOLVING){
            return CHtml::image("../images/ask_jjz.gif","解决中",array('width'=>44,'height'=>19,'align'=>'absmiddle'));
        }
         */
        else if($this->status == self::CLOSED){
            return CHtml::image("/css/images/ask_closed.gif","已关闭",array('width'=>44,'height'=>19,'align'=>'absmiddle'));

        }
        /*
        else if($this->status == self::UNSATISFIED){

        }
         */
    }

    public function get_unsolved_question($num=10){
        $questions = $this->with(array('answer_count','category',
            'user'=>array('select'=>'user_login')))->findAll(
                array('condition'=>'t.status='.self::UNSOLVED,
                'order'=>'t.id desc',
                'limit'=>$num,
                'select'=>'t.id,t.subject,t.content,t.create_time,t.user_id,t.status'));

        return $questions;
    }

    public function get_solved_question($num=10){
        $questions = $this->with(array('answer_count','category',
            'user'=>array('select'=>'user_login')))->findAll(
                array('condition'=>'t.status='.self::SOLVED,
                'order'=>'t.id desc',
                'limit'=>$num,
                'select'=>'t.id,t.subject,t.content,t.create_time,t.user_id,t.status'));
        return $questions;
    }

    public function get_latest_zhoubian($num=10){
        $questions = $this->with(array('answer_count','category',
            'user'=>array('select'=>'user_login')))->findAll(
                array('condition'=>'t.category_id='.QuestionCategory::ZHOUBIAN,
                'order'=>'t.id desc',
                'limit'=>$num,
                'select'=>'t.id,t.subject,t.content,t.create_time,t.user_id,t.status'));
        return $questions;
    }


    public function get_latest_guonei($num=10){
        $questions = $this->with(array('answer_count','category',
            'user'=>array('select'=>'user_login')))->findAll(
                array('condition'=>'t.category_id='.QuestionCategory::GUONEI,
                'order'=>'t.id desc',
                'limit'=>$num,
                'select'=>'t.id,t.subject,t.content,t.create_time,t.user_id,t.status'));
        return $questions;
    }


    public function get_latest_chujing($num=10){
        $questions = $this->with(array('answer_count','category',
            'user'=>array('select'=>'user_login')))->findAll(
                array('condition'=>'t.category_id='.QuestionCategory::CHUJING,
                'order'=>'t.id desc',
                'limit'=>$num,
                'select'=>'t.id,t.subject,t.content,t.create_time,t.user_id,t.status'));
        return $questions;
    }


    public function get_latest_ziyou($num=10){
        $questions = $this->with(array('answer_count','category',
            'user'=>array('select'=>'user_login')))->findAll(
                array('condition'=>'t.category_id='.QuestionCategory::ZIYOU,
                'order'=>'t.id desc',
                'limit'=>$num,
                'select'=>'t.id,t.subject,t.content,t.create_time,t.user_id,t.status'));
        return $questions;
    }


    /**
     * 返回问题是否关闭
     *@return bool true表示已关闭,false表示未关闭
     */
    public function is_over(){
        $now = time();
        if($this->status == self::SOLVED){
            return true;
        }else if($this->status == self::CLOSED){
            return true;
        }else if($now - $this->create_time >= CV::QUESTION_CLOSE_TIMES){
            //设置为已关闭
            if($this->status == self::UNSOLVED){
                $this->status = self::CLOSED;
                $this->save();
            }
            return true;
        }else{ 
            return false;
        }
    }

    public function distance_to_over(){
        $now = time();
        $t = CV::QUESTION_CLOSE_TIMES + $this->create_time - $now;
        if($t <= 0){
            return 0;
        }
        $seconds = $t;
        $mins = floor ( $seconds / 60 );
        $hours = floor ( $mins / 60 );
        $days = floor ( $hours / 24 );
        $distance = "";
        if ($days > 0) {
            $hours = $hours - $days * 24;
            $distance = $days . "天" . $hours . "时";
        } else {
        $mins = $mins - $hours * 60;
        $seconds = $seconds - $mins * 60 - $hours * 60 * 60;
        
        $hours = $hours >= 10 ? $hours : "0" . $hours;
        $mins = $mins >= 10 ? $mins : "0" . $mins;
        $seconds = $seconds >= 10 ? $seconds : "0" . $seconds;
        
        $distance = $hours . ":" . $mins . ":" . $seconds;
        }
        return $distance;
    }


    /*
     *增加浏览次数
     *@return integer 浏览次数
     */
    public function increase_views(){
        $this->views++;
        $this->save();
    }
    
    /**
     * 
     * @return string 后台查看问题URL
     */
    public function get_admin_view_url() {
    	return Yii::app()->createUrl('qa/view', array('id'=> $this->id));
    }
    
    /**
     * @return string 后台编辑问题URL
     */
    public function get_admin_edit_url() {
    	return Yii::app()->createUrl('qa/edit_question', array('id'=> $this->id));
    }
    
    /**
     * 
     * @return string 后台删除问题URL
     */
    public function get_admin_delete_url() {
    	return Yii::app()->createUrl('qa/delete_question', array('id' => $this->id));
    }
    
    /**
     * 
     * @return string 后台关闭问题URL
     */
    public function get_admin_close_url() {
    	return Yii::app()->createUrl('qa/close', array('id' => $this->id));
    }
    
    /**
     * 
     * @return string 后台开启问题URL
     */
    public function get_admin_open_url() {
    	return Yii::app()->createUrl('qa/open', array('id' => $this->id));
    }
    
    /**
     * 
     * @return string 后台操作链接
     */
    public function get_operate_links() {
    	$co = self::CLOSED == $this->status ? CHtml::link('开启', $this->get_admin_open_url(),array('class'=>'operate_button')) : CHtml::link('关闭', $this->get_admin_close_url(),array('class'=>'operate_button'));
    	if(empty($this->shit_status)){
    		$co.=CHtml::link('乱提问',Yii::app()->createUrl('qa/shitquestion',array('id'=>$this->id,'shit_status'=>'1')),array('class'=>'operate_button'));
    	}
    	$co=CHtml::link('查看', $this->get_admin_view_url(),array('class'=>'operate_button')). ' ' .
    	 $co . ' ' . 
    	CHtml::link('编辑', $this->get_admin_edit_url(),array('class'=>'operate_button')) .' ' .
    	CHtml::link('删除', $this->get_admin_delete_url(), array('class'=>'operate_dbutton',
    		'onclick' => 'return confirm("确定要删除这个问题吗？\n删除后，该问题的所有答案也将会被删除！")'
    	)).' ';
    	
    	
    	return $co;
    	
    }
}
