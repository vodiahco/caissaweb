<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormListData
 *
 * @author Admin
 */
class FormListData extends ASFormListData{
    
   
     public static function storeCategorylistData($name=false){
        $model= StoreCategory::model()->findAll(array(
            'condition'=>'status=:rem',
            'params'=>array(':rem'=>1)
        ));
        if($name)
            return $data=CHtml::listData($model,'title','title');
        return $data=CHtml::listData($model,'id','title');
    }
    
    
     public static function itemlistData($name=false){
        $model= StoreItem::model()->findAll(array(
            'condition'=>'status=:rem',
            'params'=>array(':rem'=>1)
        ));
        if($name)
            return $data=CHtml::listData($model,'item_name','item_name');
        return $data=CHtml::listData($model,'id','item_name');
    }
}

?>
