<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GBDeleteModel
 *
 * @author vonnero
 */
class GBModelHelper extends CActiveRecordBehavior {
    
    public function ifOwner(){
        
        return($this->owner->uid==Dna::getId());
       
    }
    
    public function GBPublish(){
       
        $this->owner->status=1;
        return ($this->owner->save());
       
    }
    
    public function GBRestore(){
       
        $this->owner->status=1;
        return ($this->owner->save());
       
    }
    
    public function GBOn(){
       
        $this->owner->status=1;
        return ($this->owner->save());
       
    }
    
    public function GBOff(){
       
        $this->owner->status=0;
        return ($this->owner->save());
       
    }
    
    public function GBArchive(){
       
        $this->owner->status=2;
        return ($this->owner->save());
       
    }
    
     public function GBBlock(){
       
        $this->owner->status=6;
        return ($this->owner->save());
       
    }
    
    
    
    
    
}

?>
