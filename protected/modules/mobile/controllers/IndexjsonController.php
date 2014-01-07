<?php

class IndexjsonController extends ASController
{
    

public $hashname;



private function afterLogout(){
   $page=Yii::app()->createUrl('user/index');
   $this->redirect($page);
}


	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionSend()
	{
		
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
                     header('Content-type: application/json');
	    		echo $error['message'];
	    
	    }
	}
        
        
        


        public function actionLogin()
	{

		$model=new LoginForm;
                $dataArray=array();
		if(isset($_POST[ASLoginForm::USERNAME_FIELD]) && isset($_POST[ASLoginForm::PASSWORD_FIELD]) && isset($_POST[ASLoginForm::LOGIN_TIME_FIELD])
                        && isset($_POST[ASLoginForm::OS_NAME_FIELD]))
             
		{
                    
                    $email=$_POST[ASLoginForm::USERNAME_FIELD];
                    $pass=$_POST[ASLoginForm::PASSWORD_FIELD];
                    $mobileId=$_POST[ASLoginForm::LOGIN_TIME_FIELD];
                    $deviceOs=$_POST[ASLoginForm::OS_NAME_FIELD];
			$model->email=$email;
                        $model->pass=$pass;
                        $model->mobileId=$mobileId;
                        $model->deviceOs=($deviceOs!=null)?$deviceOs:"";
			// validate user input and redirect to the previous page if valid
                         
			if($model->validate()){	
                            $model->login();     
                            
                            if($model->getActivation()){
                                $dataArray[ASLoginForm::RESULT]=  ASLoginForm::ACTINATION_REQUIRED;
                                $dataArray[ASLoginForm::RESULT_CODE]=ASLoginForm::ACTINATION_REQUIRED_CODE; 
                            }
                           else if($model->getLogin() && $model->saveMobileId()){
                                $this->logAction();
                             
                           
                            $session= User::getSessionID(Dna::getId());
                            $loginTime=$model->mobileId;
                            $query=  SiteReusables::getRandonNumbers();
                            //load array
                             $dataArray[ASLoginForm::RESULT]=ASLoginForm::OK;
                            $dataArray[ASLoginForm::RESULT_CODE]=ASLoginForm::OK_CODE; 
                            $dataArray[ASLoginForm::SESSION_ID_FIELD]=$session;
                            $dataArray[ASLoginForm::SESSION_REQUEST_FIELD]=$query;
                            $dataArray[ASLoginForm::LOGIN_TIME_FIELD]=$loginTime;
                            $dataArray[ASLoginForm::LOGIN_CODE_FIELD]= $model->getHashName();
                            $dataArray[ASLoginForm::UID_FIELD]= Dna::getId();
                           // $dataArray["id"]= Dna::getId();
                            }
                            else{
                           $dataArray[ASLoginForm::RESULT]=ASLoginForm::FAILED; 
                            $dataArray[ASLoginForm::RESULT_CODE]=ASLoginForm::FAILED_CODE; 
                            }
                            
                        }
                    else{
                         $dataArray[ASLoginForm::RESULT]=  ASLoginForm::INVALID;
                    $dataArray[ASLoginForm::RESULT_CODE]=  ASLoginForm::INVALID_CODE; 
                    }
		}
                else{
                    $dataArray[ASLoginForm::RESULT]=  ASLoginForm::NO_DATA;
                    $dataArray[ASLoginForm::RESULT_CODE]=ASLoginForm::NO_DATA_CODE; 
                }
               header('Content-type: application/json'); 
               echo CJSON::encode(array(ASLoginForm::JSON_OBJECT_NAME=>$dataArray)) ; 
	}

	

        
        /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionSignup()
	{
		$model=new User;
                $dataArray=array();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                    try{
		if(isset($_POST['email']))
		{
                   $chid=$_POST['chid']; 
                   if(is_numeric($chid)){
                       Yii::app()->user->setState("chid",$chid);
                   }
                    $_POST['User']['email']= $_POST[ASLoginForm::USERNAME_FIELD];
                   $_POST['User']['pass']= $_POST[ASLoginForm::PASSWORD_FIELD];
                   $_POST['User']['cpass']= $_POST['cpass'];
                   $_POST['User']['fname']= $_POST['fname'];
                   $_POST['User']['lname']= $_POST['lname'];
                   $_POST['User']['sex']= $_POST['sex'];
                   $_POST['User']['country']= $_POST['country'];
                   $_POST['User']['identifier']= $_POST[ASLoginForm::LOGIN_TIME_FIELD];
                 //   $_POST['User']['user_code']= $_POST['user_code'];
                  // $this->hashname=time().SiteReusables::getHashKey(); 
                   
			$model->attributes=$_POST['User'];
                        //$model->hashname=$this->hashname;
                        //$model->status=  $this->_autoActivate;
                        $model->pin=  $model->createUserPin();
                        $model->login_session=  SiteReusables::getSessionID();
			if($model->save()){
                           /**
                            * return result ststus only
                            * identification, session and other account related codes will be sent after activation
                            */
                            $dataArray[ASLoginForm::RESULT]=ASLoginForm::OK;
                            $dataArray[ASLoginForm::RESULT_CODE]=  ASLoginForm::OK_CODE; 
                            $dataArray[ASLoginForm::LOGIN_CODE_FIELD]= $model->hashname;
                            $link=$this->getActivationLink($model->id);
                           // $this->sendActivationMail($model->email, $model->pin);
                            $this->sendActivationLinkMail($model->email, $link);
                            
                        }
                        else{
                            $dataArray[ASLoginForm::RESULT]=  ASLoginForm::INVALID;
                            $dataArray[ASLoginForm::RESULT_CODE]=  ASLoginForm::INVALID_CODE; 
                            
                        }
                        
		}
                 else{
                    $dataArray[ASLoginForm::RESULT]=  ASLoginForm::NO_DATA;
                     $dataArray[ASLoginForm::RESULT_CODE]=  ASLoginForm::NO_DATA_CODE; 
                }
               header('Content-type: application/json'); 
               echo CJSON::encode(array(ASLoginForm::JSON_OBJECT_NAME=>$dataArray)) ;
                    }
 catch (Exception $e){
                            $dataArray[ASLoginForm::RESULT]=  ASLoginForm::INVALID.$e->getMessage();
                            $dataArray[ASLoginForm::RESULT_CODE]=  ASLoginForm::INVALID_CODE; 
                            header('Content-type: application/json'); 
                             echo CJSON::encode(array(ASLoginForm::JSON_OBJECT_NAME=>$dataArray)) ;
 }
		
	}
        
        
        
        
        public function sendNotification($senderId){
            $model=new GCM();
            $model->sender_id=$senderId;
            $model->sendNotification();
        }
        
        
private function sendActivationMail($email,$pin){
$sender=  Yii::app()->name;
$body="You have received this email because you have created your $sender account \n\n";

$body.="Please activate your account using the your PIN below \n\n";

$body.="To activate your account on your mobile device, simply enter your PIN and click activate \n\n";
$body.="Once activated, you can start connecting with friends on your favourite TV shows \n\n";


$body.="Your PIN: $pin \n\n";


$body.="if you have recieved this email by error, please contact the administrator immediately: info@greenbooknet.net \n\n";

$body.="Thanks\n\n $sender Admin\n\n";

$body.="www.greenbooknet.net\n\n";

$mailer= new ASMailer();
$mailer->setTo($email);
$subject="$sender account Registration";
//$to=$email;
$mailer->send($subject,$body);


}


private function getActivationLink($id){
    $model= User::model()->findByPk($id);
    if($model!==null){
        $session=$model->login_session;
        $identifier=$model->identifier;
        $ctime=  time();
        $link=$this->createAbsoluteUrl("activation/activate",array("s"=>$session,"id"=>$id,"t"=>$ctime));
        return $link;
        
    }
}


private function sendActivationLinkMail($email,$pin){
$sender=  Yii::app()->name;
$body="You have received this email because you have created your $sender account \n\n";

$body.="Please activate your account using the your link below \n\n";

$body.="To activate your account please click the link below \n\n";
///$body.="Once activated, you can start connecting with  \n\n";


$body.="Account activation link: $pin \n\n";


$body.="if you have recieved this email by error, please contact the administrator immediately: info@greenbooknet.net \n\n";

$body.="Thanks\n\n $sender Admin\n\n";

$body.="www.greenbooknet.net\n\n";

$mailer= new ASMailer();
$mailer->setTo($email);
$subject="$sender account Registration";
//$to=$email;
$mailer->send($subject,$body);


}


	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->afterLogout();
	}
        
        
}