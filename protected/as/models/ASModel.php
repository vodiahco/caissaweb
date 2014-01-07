<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ASModel
 *
 * @author Admin
 */
abstract class ASModel extends CActiveRecord {
    
       public $cpass;
    public $cemail;
    public $verifyReg; 
    
    public $pageSize=100;
    public $limit=100;
    public $offset=0;
    
    
     public $country="GB";
    
    public function defaultScope(){
        return array(
            'order'=>"id DESC"
        );
}
    

    public function behaviors(){
            return array(
                
                   'ASBeforeValidate'=>array(
            'class'=>'application.as.models.behavior.events.ASBeforeValidate',
                     ),
                'GBDeleteModel'=>array(
            'class'=>'application.as.models.behavior.helpers.GBDeleteModel',       
               ),
                'GBModelHelper'=>array(
            'class'=>'application.as.models.behavior.helpers.GBModelHelper',       
               ),
                 'GBIncrementer'=>array(
                 'class'=>'application.as.models.behavior.stat.GBIncrementer'   
                ),
//                 'GBRequestLogger'=>array(
//                 'class'=>'application.as.models.behavior.log.GBRequestLogger'   
//                ),

            );
        
       
        }
        
        
       
        
        
     public function getClassName(){
            return __CLASS__;
        }  
    
  protected function beforeFind(){
           $pageSize= $this->pageSize;
           $offset=Yii::app()->request->getQuery("pagenum",0);
           if($offset<0)
               $offset=0;
           if($offset>0)
               $offset=$offset-1;
            
    $this->offset=($offset * $pageSize);
}



public function beforeSearch(){
           $pageSize= $this->pageSize;
           $offset=Yii::app()->request->getQuery("pagenum",0);
           if($offset<0)
               $offset=0;
           if($offset>0)
               $offset=$offset-1;
            
    $this->offset=($offset * $pageSize);
}
       
}



?>
