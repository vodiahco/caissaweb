<?php

/**
 * This is the model class for table "{{pmd_candidate}}".
 *
 * The followings are the available columns in table '{{pmd_candidate}}':
 * @property integer $id
 * @property integer $uid
 * @property integer $company_id
 * @property string $fname
 * @property string $lname
 * @property string $title
 * @property string $date_created
 * @property string $last_modified
 * @property integer $status
 */
class PmdCandidate extends ASModel
{
    
        const NAME_FIELD="name";
    const OFFICER_FIELD="officer";
    const PID_FIELD="pid";
    const LAST_MODIFIED_FIELD="last_modified";
    const JOB_TITLE_FIELD="job_title";
    const STATUS_FIELD="status";
        const FNAME_FIELD="fname";
    const LNAME_FIELD="lname";
    const COMPANY_ID_FIELD="company_id";
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PmdCandidate the static model class
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
		return '{{pmd_candidate}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_id, fname, title', 'required'),
			array('uid, company_id, status', 'numerical', 'integerOnly'=>true),
			array('fname, lname', 'length', 'max'=>40),
			array('title', 'length', 'max'=>255),
			array('date_created', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, company_id, fname, lname, title, date_created, last_modified, status', 'safe', 'on'=>'search'),
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
			'company_id' => 'Company',
			'fname' => 'Fname',
			'lname' => 'Lname',
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
            $this->beforeSearch();


		$criteria=new CDbCriteria(array(
                      'condition'=>'status<3',
                   
                    'offset'=>  $this->offset,
                    'limit'=>  $this->pageSize
                 
                ));
		

//		$criteria->compare('id',$this->id);
//		$criteria->compare('uid',$this->uid);
//		$criteria->compare('company_id',$this->company_id);
//		$criteria->compare('fname',$this->fname,true);
//		$criteria->compare('lname',$this->lname,true);
//		$criteria->compare('title',$this->title,true);
//		$criteria->compare('date_created',$this->date_created,true);
//		$criteria->compare('last_modified',$this->last_modified,true);
//		$criteria->compare('status',$this->status);

                return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>false,
		));
	}
        
        
        public function searchByCompanyId($id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria(array(
                   'condition'=>'company_id=:id and status<6',
                     'offset'=>  $this->offset,
                    'limit'=>  $this->pageSize,
                    'params'=>array(
                        ':id'=>$id
                    )
                ));

//		$criteria->compare('id',$this->id);
//		$criteria->compare('uid',$this->uid);
//		$criteria->compare('company_id',$this->company_id);
//		$criteria->compare('fname',$this->fname,true);
//		$criteria->compare('lname',$this->lname,true);
//		$criteria->compare('title',$this->title,true);
//		$criteria->compare('date_created',$this->date_created,true);
//		$criteria->compare('last_modified',$this->last_modified,true);
//		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                     'pagination'=>false,
		));
	}
        
         public function searchByCompanyIdAndDate($id,$date)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria(array(
                    'condition'=>'company_id=:id and status<6 and transaction_time < :d',
                    'params'=>array(
                        ':d'=>$date,
                        ':id'=>$id
                    ),
                ));

		$criteria->compare('id',$this->id);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('fname',$this->fname,true);
		$criteria->compare('lname',$this->lname,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('last_modified',$this->last_modified,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}