<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dna
 *
 * @author vonnero
 */
class ASDna {

    public static function getId(){
return Yii::app()->user->id;

}

 public static function getLoggedStoreId(){
return Yii::app()->user->storeId;

}



public static function getUg($session=false){
    if($session)
       return Yii::app()->user->ug; 
 $model= User::model()->findByPk(self::getId());
        if($model!==null)
            return $model->ug;
}

public static function isAdmin(){
    $model=null;
    if(!Yii::app()->user->isGuest)
        $model=User::model()->findByPk(self::getId());
    if($model!==null)
 return ($model->ug==ASSiteSetup::getAdmin());
    else
        return false;
}


public static function isAStaff(){
    $model=null;
    if(!Yii::app()->user->isGuest)
        $model=User::model()->findByPk(self::getId());
    if($model!==null)
 return ($model->ug>1);
    else
        return false;
}

public static function getLogged(){
 return (! Yii::app()->user->isGuest);
}



}
?>
