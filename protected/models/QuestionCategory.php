<?php

/**
 * This is the model class for table "{{question_category}}".
 *
 * The followings are the available columns in table '{{question_category}}':
 * @property integer $id
 * @property string $name
 */
class QuestionCategory extends CActiveRecord
{
    const DEFAULT_ID = 1;

    const ALL=0;
    const ZHOUBIAN = 3;
    const GUONEI = 1;
    const CHUJING=2;
    const ZIYOU=4;
    const OTHER=5;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{question_category}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'name' => 'Name',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

    public function get_all_categories(){
        $categories = $this->findAll(array("order"=>"id asc"));
        return $categories;
    }


    public function get_categories_for_select(){
        $data = array();
        $categories = $this->findAll(array("order"=>"id asc"));
        $data[] = array("id"=>self::ALL,'name'=>'所有');
        foreach($categories as $c){
            $data[] = array("id"=>$c->id,"name"=>$c->name);
        }
        return $data;
    }

    public function get_category_info(){
        $guonei = $this->_get_question_info_by_catid(self::GUONEI);
        $chujing = $this->_get_question_info_by_catid(self::CHUJING);
        $zhoubian = $this->_get_question_info_by_catid(self::ZHOUBIAN);
        $ziyou = $this->_get_question_info_by_catid(self::ZIYOU);

        return array(self::GUONEI=>$guonei,self::CHUJING=>$chujing,self::ZHOUBIAN=>$zhoubian,self::ZIYOU=>$ziyou);
    }


    private function _get_question_info_by_catid($catid){
        $condition = "category_id=".intVal($catid);
        $q = new Question();
        $questionCount = $q->count($condition);
        //$answerCount = Answer::model()->count("q.category_id=".intVal($catid),array('join'=>'inner join {{question}} as q on t.question_id=q.id'));
        $answerCount = $this->_get_answer_count($catid);
        $solvedCount = $q->count($condition." and t.status=".Question::SOLVED);
        $unsolvedCount = $q->count($condition." and t.status=".Question::UNSOLVED);

        return compact("questionCount","answerCount","solvedCount","unsolvedCount");
    }

    private function _get_answer_count($catid){
        $sql = "select count(*) from {{answer}} as t inner join  {{question}} as q 
            on t.question_id=q.id where q.category_id=".intVal($catid);
        $con = Yii::app()->db;
        $cmd = $con->createCommand($sql);
        $c = $cmd->queryScalar();
        return $c;
    }
}
