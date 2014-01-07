<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ASController
 *
 * @author Admin
 */
class ASController extends Controller {
   
    public $innerMenu=array();
    
     public $alias="";
     
     protected $_autoActivate=1;
     









     /**
         * logs the footprints of the current logged user 
         */
         protected function logAction($action_id="",$action_message=""){
             $modelLog=new ASLog;
             $model=$modelLog->loadLog();
             $model->action_id=$action_id;
             $model->action_message=$action_message;
              $model->save();
        }
        
        
         protected function loginByHash()
	{
             $h=Yii::app()->request->getPost(LoginForm::LOGIN_CODE_FIELD,null);
             $uid=Yii::app()->request->getPost(LoginForm::UID_FIELD,null);
             
		$model=User::model()->find(array(
                    'condition'=>'hashname=:h and id=:uid',
                    'params'=>array(
                        ':h'=>$h,
                        ':uid'=>$uid
                    )
                ));
                if($model==null)
                return false;
                $email=$model->email;
                $pass=$model->pass;
                
               $loginForm=new LoginForm();
               $loginForm->email=$email;
                $loginForm->pass=$pass;
               if($loginForm->validate()){	
                            $loginForm->login();     
                            
                         return $loginForm->getLogin();
                              
               }
               return false;
	}
        
        
        
        protected function isOwner(){
            return true;
        }
        
        public function isAuthorisedManager(){
            
            return $this->isOwner();
        }
        
        public function isViewMode(){
           return  (yii::app()->request->getQuery('id')!=null);
        }
        
        protected function setGenderPicture($sex=null){
           
            if($sex==1)
                return "male.jpg";
            else if ($sex==2)
                return "female.jpg";
            else
            return "default.jpg";
        }
        protected function sendNotification($model){
            
        }
        
      protected function   parceJson($array){
            header('Content-type: application/json'); 
             echo CJSON::encode(array("model"=>$array)) ;
      }
        
}

?>
