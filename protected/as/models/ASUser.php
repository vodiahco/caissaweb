<?php

/**
 * This is the model class for table "{{users}}".
 *
 * The followings are the available columns in table '{{users}}':
 * @property integer $id
 * @property string $email
 * @property string $pass
 * @property string $fname
 * @property string $lname
 * @property string $sex
 * @property string $date_created
 * @property string $last_modified
 * @property integer $remove
 * @property integer $activated
 * @property integer $role
 * @property string $identifier
 * @property integer $ug
 * @property string $hashname
 * @property string $phone
 * @property integer $notify_newpost
 * @property integer $notify_newuser
 * @property integer $institution
 *
 * The followings are the available model relations:
 * @property Comments[] $comments
 * @property ContactList[] $contactLists
 * @property Document[] $documents
 * @property Forum[] $forums
 * @property GroupDocument[] $groupDocuments
 * @property Profile[] $profiles
 * @property Saveddocuments[] $saveddocuments
 * @property Shareddocuments[] $shareddocuments
 */
abstract class ASUser extends ASModel
{
    
    
    /**
         *
         * @var string confirm password property 
         */
        public $cpass;
        
        public $newPass;
        
        public $oldPass;


        /**
        *
        * @var string confirm email property 
        */
        public $cemail;
        
        /**
         *
         * @var string captcha text 
         */
    public $verifyReg;
        
    public $newpass;
    public $oldpass;
   
        
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return '{{users}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
                    array('email, pass,cpass, fname, lname, sex,', 'required','on'=>'register'),
                         array('pass','compare', 'compareAttribute'=>'cpass','on'=>'register'),
//                     array('email','compare', 'compareAttribute'=>'cemail','on'=>'register'),
                     array('email', 'email'),
                     array('verifyReg', 'captcha','allowEmpty'=>false,'on'=>'register'),
                    //array('email', 'checkMX'=>true),
                      array('email', 'unique','attributeName'=>'email',),
                        array('email,cpass', 'required','on'=>'changemail'),
                         array('fname,lname,cpass', 'required','on'=>'changename'),
                        array('oldpass,cpass,newpass', 'required','on'=>'changep'),
                         array('newpass','compare', 'compareAttribute'=>'cpass','on'=>'changep'),
                  
			array('remove, activated, role, ug, notify_newpost, notify_newuser, institution', 'numerical', 'integerOnly'=>true),
			array('email', 'length', 'max'=>150),
			array('pass', 'length', 'max'=>32),
			array('fname, lname', 'length', 'max'=>40),
			array('sex', 'length', 'max'=>1),
			array('identifier, phone', 'length', 'max'=>20),
			array('hashname', 'length', 'max'=>100),
			array('date_created', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, email, pass, fname, lname, sex, date_created, last_modified, remove, activated, role, identifier, ug, hashname, phone, notify_newpost, notify_newuser, institution', 'safe', 'on'=>'search'),
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
			'email' => 'Email',
                    'cemail' => 'Email confirmation',
			'pass' => 'Password',
                    'cpass' => 'Password confirmation',
                    'oldPass' => 'Old Password',
                    'newPass' => 'Old Password',
			'fname' => 'Firstname',
			'lname' => 'Last name',
			'sex' => 'Sex',
			'date_created' => 'Date Created',
			'last_modified' => 'Last Modified',
			'remove' => 'Remove',
			'activated' => 'Activated',
			'role' => 'Role',
			'identifier' => 'Identifier',
			'ug' => 'Ug',
			'hashname' => 'Hashname',
			'phone' => 'Contact Phone number',
			'notify_newpost' => 'New post notification',
			'notify_newuser' => 'New user notification',
                    'verifyReg' => 'Verification code',

			'institution' => 'Account type',
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('pass',$this->pass,true);
		$criteria->compare('fname',$this->fname,true,'or');
		$criteria->compare('lname',$this->lname,true,'or');
		$criteria->compare('sex',$this->sex,true);
		
		$criteria->compare('role',$this->role);
		$criteria->compare('identifier',$this->identifier,true);
		$criteria->compare('ug',$this->ug);
		$criteria->compare('hashname',$this->hashname,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('notify_newpost',$this->notify_newpost);
		$criteria->compare('notify_newuser',$this->notify_newuser);
		$criteria->compare('institution',$this->institution);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
        public function loggedUser(){
            $criteria= new CDbCriteria(array(
                'condition'=>'id=:id and remove=:rem and activated=:active',
                'params'=>array(':id'=>  Dna::getId(),':rem'=>0,':active'=>1)
            ));
            return $this->find($criteria);
        }
        
        
        
          public function checkPass($name=null){
           if($name!=null){
             if($this->$name==$this->pass)
            return true;
            else
                $this->addError($name,'Invalid entry ');
                return false;   
           }
           else{
            if($this->cpass==$this->pass)
            return true;
            else
                $this->addError('cpass','Invalid entry ');
                return false;
           }
        }
}