<?php
Yii::import('zii.behaviors.CTimestampBehavior');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GBBeforeValidate
 *
 * @author vonnero
 */
class ASBeforeValidate extends CTimestampBehavior {
    
    public $createAttribute="date_created";
    
    public $setUpdateOnCreate= true;
    
    public $updateAttribute = "last_modified";
    
    public $timestampExpression;






    public function beforeValidate($event){
        
            if($this->owner->isNewRecord){
               
                if($this->owner->hasAttribute('uid'))
                $this->owner->uid=  Dna::getId();  
                
                if($this->owner->hasAttribute('church_id'))
                $this->owner->church_id=  Dna::getChid();  
                
                 if($this->owner->hasAttribute('transaction_time'))
                $this->owner->transaction_time= time();  
                

                
                if($this->owner->hasAttribute('last_updated')){
                    $this->owner->last_updated=  new CDbExpression('now()');
                }
                
                if($this->owner->hasAttribute('hashname')){
                    $this->owner->hashname=time().SiteReusables::getHashKey();
                }
                
                
                
                
                if($this->owner->hasAttribute('event_date'))
               $this->owner->event_date=  mktime($this->owner->event_date);
                
                if($this->owner->hasAttribute('start_date'))
               $this->owner->start_date=  mktime($this->owner->start_date);
                
                if($this->owner->hasAttribute('end_date'))
               $this->owner->end_date=  mktime($this->owner->end_date);
                

            }
            
         
            
     $this->timestampExpression= new CDbExpression('now()');     
             
            return parent::beforeValidate($event);
        }
    
}

?>
