<?php

/**
 * This is the model class for table "{{passreset}}".
 *
 * The followings are the available columns in table '{{passreset}}':
 * @property integer $id
 * @property integer $uid
 * @property string $resetpass
 * @property string $date_created
 * @property string $last_modified
 * @property integer $isused
 * @property integer $status
 * @property string $iplog
 * @property string $useragentlog
 * @property integer $from_admin
 */
class Passreset extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Passreset the static model class
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
		return '{{passreset}}';
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
			array('uid, isused, status, from_admin', 'numerical', 'integerOnly'=>true),
			array('resetpass', 'length', 'max'=>100),
			array('iplog', 'length', 'max'=>20),
			array('useragentlog', 'length', 'max'=>255),
			array('date_created', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, resetpass, date_created, last_modified, isused, status, iplog, useragentlog, from_admin', 'safe', 'on'=>'search'),
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
			'resetpass' => 'Resetpass',
			'date_created' => 'Date Created',
			'last_modified' => 'Last Modified',
			'isused' => 'Isused',
			'status' => 'Status',
			'iplog' => 'Iplog',
			'useragentlog' => 'Useragentlog',
			'from_admin' => 'From Admin',
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
		$criteria->compare('uid',$this->uid);
		$criteria->compare('resetpass',$this->resetpass,true);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('last_modified',$this->last_modified,true);
		$criteria->compare('isused',$this->isused);
		$criteria->compare('status',$this->status);
		$criteria->compare('iplog',$this->iplog,true);
		$criteria->compare('useragentlog',$this->useragentlog,true);
		$criteria->compare('from_admin',$this->from_admin);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}