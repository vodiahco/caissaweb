<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RequestLogger
 *
 * @author vonnero
 */
class GBRequestLogger extends CActiveRecordBehavior {
    //put your code here
    
    protected function loadLog(){
           $model=$this->owner;
            $request=Yii::app()->request;
            
            $ipLog=$request->userHost." / ".$request->userHostAddress;
            $userAgent=$request->userAgent;
            $user=  Dna::getId();
            
            
           $model->iplog=$ipLog;
           $model->useragentlog=$userAgent;
          
           $model->created_by=  $user;
           $model->updated_by=  $user;
           
           if($model instanceof Report){
           $post=$request->urlReferrer;
           $model->title="user ID: $user reports content"; 
            $model->post=$post;
             if($this->owner->hasAttribute('reporter'))
                 $model->reporter=$user;
           }
           
           return $model;
        }
        
        protected function setRemove(){
            $this->owner->remove=1;
            $this->owner->save(false);
        }
        
        protected function setActive(){
            $this->owner->activated=1;
            $this->owner->save(false);
        }
}

?>
