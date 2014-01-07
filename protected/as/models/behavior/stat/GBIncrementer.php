<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GBIncrementer
 *
 * @author vonnero
 */
class GBIncrementer extends CActiveRecordBehavior  {
    
    public function updateIcounter(){
//        $icounter=$this->owner->icounter;
//        if($icounter==null)
//            $icounter=0;
//        $icounter ++;
//        $this->owner->save();
        if(!Dna::isAdmin())
        $this->owner->saveCounters(array('icounter'=>1));
    }
    
    
    public function getIcounter(){
        return $this->owner->icounter;
    }
    
    
}

?>
