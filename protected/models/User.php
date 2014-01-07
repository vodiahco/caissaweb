<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $email
 * @property string $pass
 * @property string $fname
 * @property string $mname
 * @property string $lname
 * @property string $sex
 * @property string $age
 * @property string $date_created
 * @property string $last_modified
 * @property string $identifier
 * @property integer $ug
 * @property string $hashname
 * @property string $device
 * @property integer $allow_notify_newpost
 * @property integer $allow_notify_newuser
 * @property integer $allow_contact_me_all
 * @property integer $allow_contact_me_friends
 * @property integer $uid
 * @property integer $status
 * @property string $user_code
 * @property string $profile_pic
 * @property string $about
 * @property string $occupation
 * @property string $employer
 * @property string $pin
 * @property string $login_session
 * @property string $country
 */
class User extends ASUser
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email,pass,fname,lname', 'required'),
			array('ug, allow_notify_newpost, allow_notify_newuser, allow_contact_me_all, allow_contact_me_friends, uid, status', 'numerical', 'integerOnly'=>true),
			array('email', 'length', 'max'=>150),
			array('pass', 'length', 'max'=>32),
                    array('pass', 'compare', 'compareAttribute'=>'cpass', 'on'=>'register'),
			array('fname, mname, lname', 'length', 'max'=>40),
			array('sex, age', 'length', 'max'=>1),
			array('identifier, device', 'length', 'max'=>20),
			array('hashname', 'length', 'max'=>100),
			array('profile_pic, occupation, employer, pin, login_session', 'length', 'max'=>255),
			array('country', 'length', 'max'=>3),
                    array('cpass,newPass,oldPass', 'required','on'=>'reset'),
                    array('newPass', 'compare', 'compareAttribute'=>'cpass', 'on'=>'reset'),

			array('date_created, user_code, about', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, email, pass, fname, mname, lname, sex, age, date_created, last_modified, identifier, ug, hashname, device, allow_notify_newpost, allow_notify_newuser, allow_contact_me_all, allow_contact_me_friends, uid, status, user_code, profile_pic, about, occupation, employer, pin, login_session, country', 'safe', 'on'=>'search'),
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
			'pass' => 'Password',
			'fname' => 'First name',
			'mname' => 'Middle name',
			'lname' => 'Last name',
			'sex' => 'Sex',
			'age' => 'Age',
			'date_created' => 'Date Created',
			'last_modified' => 'Last Modified',
			'identifier' => 'Identifier',
			'ug' => 'Ug',
			'hashname' => 'Hashname',
			'device' => 'Device',
			'allow_notify_newpost' => 'Allow Notify Newpost',
			'allow_notify_newuser' => 'Allow Notify Newuser',
			'allow_contact_me_all' => 'Allow Contact Me All',
			'allow_contact_me_friends' => 'Allow Contact Me Friends',
			'uid' => 'Uid',
			'status' => 'Status',
			'user_code' => 'User Code',
			'profile_pic' => 'Profile Photo',
			'about' => 'About',
			'occupation' => 'Occupation',
			'employer' => 'Employer',
			'pin' => 'Pin',
			'login_session' => 'Login Session',
			'country' => 'Country',
                        'cpass' => 'Confirm password',
                    'oldPass' => 'Old password',
                    'newPass' => 'New password',
                    'cemail' => 'Confirm email',
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
		$criteria->compare('fname',$this->fname,true);
		$criteria->compare('mname',$this->mname,true);
		$criteria->compare('lname',$this->lname,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('age',$this->age,true);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('last_modified',$this->last_modified,true);
		$criteria->compare('identifier',$this->identifier,true);
		$criteria->compare('ug',$this->ug);
		$criteria->compare('hashname',$this->hashname,true);
		$criteria->compare('device',$this->device,true);
		$criteria->compare('allow_notify_newpost',$this->allow_notify_newpost);
		$criteria->compare('allow_notify_newuser',$this->allow_notify_newuser);
		$criteria->compare('allow_contact_me_all',$this->allow_contact_me_all);
		$criteria->compare('allow_contact_me_friends',$this->allow_contact_me_friends);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('status',$this->status);
		$criteria->compare('user_code',$this->user_code,true);
		$criteria->compare('profile_pic',$this->profile_pic,true);
		$criteria->compare('about',$this->about,true);
		$criteria->compare('occupation',$this->occupation,true);
		$criteria->compare('employer',$this->employer,true);
		$criteria->compare('pin',$this->pin,true);
		$criteria->compare('login_session',$this->login_session,true);
		$criteria->compare('country',$this->country,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
         public function createUserPin(){
            $pin=  SiteReusables::getHashKeyForUserPin();
            while($this->pinExists($pin)){
                $pin=  SiteReusables::getHashKeyForUserPin();
            }
          
            return $pin;
        }
        
        public function pinExists($pin){
            return User::model()->exists(array(
                'condition'=>'pin=:pin',
                'params'=>array(':pin'=>$pin)
            ));
        }
        
        
        
        public static function getSessionID($id){
            $model=User::model()->findByPk($id);
            if($model!==null)
                return $model->login_session;
            
        }
        
}