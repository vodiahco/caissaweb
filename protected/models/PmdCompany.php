<?php

/**
 * This is the model class for table "{{pmd_company}}".
 *
 * The followings are the available columns in table '{{pmd_company}}':
 * @property integer $id
 * @property integer $uid
 * @property string $title
 * @property string $date_created
 * @property string $last_modified
 * @property integer $status
 */
class PmdCompany extends ASModel
{
    
    const TITLE_FIELD="title";
    const ID_FIELD="id";
    const STATUS_FIELD="status";
    const START_DATE_FIELD="start_date";
    const END_DATE_FIELD="end_date";
    const TRANSACTION_TIME_FIELD="t_time";
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PmdCompany the static model class
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
		return '{{pmd_company}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('uid, status', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('date_created', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, title, date_created, last_modified, status', 'safe', 'on'=>'search'),
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
			'uid' => 'Uid',
			'title' => 'Title',
			'date_created' => 'Date Created',
			'last_modified' => 'Last Modified',
			'status' => 'Status',
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

		$this->beforeSearch();


		$criteria=new CDbCriteria(array(
                    'condition'=>'status=1',
                    'offset'=>  $this->offset,
                    'limit'=>  $this->pageSize
                 
                ));
		

		$criteria->compare('id',$this->id);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('last_modified',$this->last_modified,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>false,
                    
		));
	}
        
        
        
        public function searchBydate($date)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$this->beforeSearch();


		$criteria=new CDbCriteria(array(
                    'condition'=>'status=1 and transaction_time < :d',
                    'params'=>array(
                        ':d'=>$date
                    ),
                    'offset'=>  $this->offset,
                    'limit'=>  $this->pageSize
                 
                ));
		

		$criteria->compare('id',$this->id);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('last_modified',$this->last_modified,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>false,
                    
		));
	}
        
        
}