<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ASLoginForm extends CFormModel
{
    const LOGIN_TIME_FIELD ="login_time";

    const LOGIN_CODE_FIELD ="login_code";

    const SESSION_REQUEST_FIELD ="session_query_id";

    const SESSION_RESPONSE_FIELD ="session_query_string";

    const SESSION_ID_FIELD ="session_id";

    const USERNAME_FIELD="email";
    const PASSWORD_FIELD="pass";

    const OS_NAME_FIELD ="device_os";

    const UID_FIELD ="uid";
    
     const OK ="ok";
      const FAILED ="failed";
      
      const NO_DATA ="no data";
      const INVALID ="invalid";
      
      const OK_CODE =0;
      const FAILED_CODE =1;
      
      const NO_DATA_CODE =2;
      const INVALID_CODE =3;
      
      const ACTINATION_REQUIRED ="activation required";
      const ACTINATION_REQUIRED_CODE =4;
      
      const RESULT ="result";
      const RESULT_CODE ="result code";
      
      const JSON_OBJECT_NAME ="model";
    
	public $email;
	public $pass;
	public $rememberMe;

	private $_identity;
        private $_activation=false;
        private $_login=false;
        private $_error;

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
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new ASUserIdentity($this->email,$this->pass);
			if(!$this->_identity->authenticate())
				$this->addError('password','Incorrect username or password.');
		}
	}

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
        
           
        
}
