<?php

/**
 * This is the model class for table "{{login}}".
 *
 * The followings are the available columns in table '{{login}}':
 * @property integer $id
 * @property string $date_created
 * @property string $last_modified
 * @property integer $remove
 * @property integer $updated_by
 * @property integer $created_by
 * @property string $iplog
 * @property string $useragentlog
 */
class ASLog extends ASModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Login the static model class
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
		return '{{login}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('last_modified', 'required'),
			array('remove, updated_by, created_by', 'numerical', 'integerOnly'=>true),
			array('iplog', 'length', 'max'=>100),
			array('useragentlog', 'length', 'max'=>255),
			array('date_created', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, date_created, last_modified, remove, updated_by, created_by, iplog, useragentlog', 'safe', 'on'=>'search'),
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
			'date_created' => 'Date Created',
			'last_modified' => 'Last Modified',
			'remove' => 'Remove',
			'updated_by' => 'Updated By',
			'created_by' => 'Created By',
			'iplog' => 'Iplog',
			'useragentlog' => 'Useragentlog',
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
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('last_modified',$this->last_modified,true);
		$criteria->compare('remove',$this->remove);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('iplog',$this->iplog,true);
		$criteria->compare('useragentlog',$this->useragentlog,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
         public function loadLog(){
           $model=$this;
            $request=Yii::app()->request;
            $session=Yii::app()->getSession();
            
            $ipLog=$request->userHost." / ".$request->userHostAddress;
            $userAgent=$request->userAgent;
            $user=  Dna::getId();
            
            
            
           $model->iplog=$ipLog;
           $model->useragentlog=$userAgent;
           $model->session_id=$session->sessionId;
          
           $model->created_by= $user;
           $model->updated_by= $user;

           return $model;
        }
}