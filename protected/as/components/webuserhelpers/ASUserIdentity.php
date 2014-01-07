<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class ASUserIdentity extends CUserIdentity
{
	
    private $_id;
    /**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$username=$this->username;
        $user=User::model()->find(array(
           // 'select'=>'id,ug,email,pass,status',
            'condition'=>'status=:rem and email=:email',
            'params'=>array(':rem'=>1,':email'=>$username)
        ));

		if($user===null)
			$this->errorCode=1;
                else if($user->pass!==$this->password)
			$this->errorCode=3;
                else if ($user->status==0)
                    $this->errorCode=2;
		
		else{
			$this->errorCode=0;
                           $this->_id=$user->id;
                           $this->setState('ug',$user->ug);
                           /// specific to server
                           $this->setState('chid',$user->c_id);
                            
                          
                         
                }
		return !$this->errorCode;
                        
	}
        
        
        public function getId(){
            return $this->_id;
        }
}