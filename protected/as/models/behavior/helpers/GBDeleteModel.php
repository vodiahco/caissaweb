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
class GBDeleteModel extends CActiveRecordBehavior {
    

    public function gbDelete(){
        
      if($this->owner instanceof Email || $this->owner instanceof Support)
      {
          if($this->owner->receiver_id==Dna::getId()){
        $this->owner->status=3;
        return ($this->owner->save());
        }
        else
            return false;
          
      }
   
        if(Dna::isAdmin()){
        $this->owner->status=3;
        return ($this->owner->save());
        }
        else
            return false;
    }
    
    
    
    public function adminDelete(){
       
        $this->owner->status=4;
        return ($this->owner->save());
       
    }
    
    public function ownerDelete(){
       
        if($this->owner->uid==Dna::getId()){
        $this->owner->status=3;
        return ($this->owner->save());
        }
       else
            return false;
       
    }
    
    
    
      
}

?>
