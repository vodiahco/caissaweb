<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends ASLoginForm
{
	public $email;
	public $pass;
	public $rememberMe;
        public $mobileId;
        public $deviceOs;
        public $hashName;

        private $_identity;
        private $_activation=false;
        private $_login=false;
        private $_error;
        protected $_id;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('email, pass', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			//array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Remember me',
                    'pass'=>'Password',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
//	public function authenticate($attribute,$params)
//	{
//		if(!$this->hasErrors())
//		{
//			$this->_identity=new UserIdentity($this->email,$this->pass);
//			if(!$this->_identity->authenticate())
//				$this->addError('password','Incorrect username or password.');
//		}
//	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new ASUserIdentity($this->email,$this->pass);
			$this->_identity->authenticate();
		}
                $errorCode=  $this->_identity->errorCode;
               
		
                if($errorCode==1){
                    $this->setUserFailError();
                   
                }
                    elseif ($errorCode==2) 
                        $this->setActivation();
                        elseif ($errorCode==3) {
                      $this->setPassFailError();  
                    }
                    else if($errorCode==0){
                     $this->setLogin(); 
                       Yii::app()->user->login($this->_identity);
                       $this->_id=$this->_identity->getId();
                    }
	}
        
        
        
        
        
        public function setActivation(){
            $this->_activation=true;
             $this->setLoginError('Account Activation required'); 
        }
        
        public function getActivation(){
            return $this->_activation;
        }
        
        public function setUserFailError(){
          $this->setLoginError('Invalid login'); 
        }
        
        public function setPassFailError(){
           $this->setLoginError('Invalid login'); 
        }
        
        public function setLogin(){
            $this->_login=true;
        }
        
        public function getLogin(){
            
            return $this->_login;
        }
        
        private function setLoginError($error){
            $this->_error=$error;
        }
        
        public function getLoginError(){
            return $this->_error;
        }
        
        
        public function saveMobileId(){
            
            if($this->mobileId!=null && $this->mobileId!="" )
            {
                $model=  User::model()->findByPk(Dna::getId());
                if($model==null)
                    return false;
                $model->identifier=  $this->mobileId;
                $model->device_os=$this->deviceOs;
                $model->login_session=  SiteReusables::getSessionID();
                
               return ($model->save());
                
            } 
        }
        
        public function getHashName(){
             $model=  User::model()->find(array(
         'select'=>'hashname',
        'condition'=>'id=:id and status=:status',
        'params'=>array(':id'=>Dna::getId(),':status'=>  SiteSetup::$PUBLISHED)
    ));
    return $model->hashname;
        }
        
        
      
        
           
        
}
