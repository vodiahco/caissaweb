<?php

/**
 * Dna Class file
 * represents the logged webuser
 * the class is a read only class
 *
 * @author victor Odiah vodiahco1@yahoo.com
 * @category webuserhelpers
 * @final final
 */
final class Dna extends ASDna {

    public static function getId(){
return Yii::app()->user->id;

}

public static function getChid(){
return Yii::app()->user->chid;

}

public static function getCurrency(){
    if(self::getLogged())
 return (Church::model()->findByPk(self::getChid())->currency!=null)?Church::model()->findByPk(self::getChid())->currency:"GBP (£)";
}




public static function getChurch(){
    if(self::getLogged())
 return User::model()->findByPk(self::getId())->church_id;
}



public static function getLogged(){
 return (! Yii::app()->user->isGuest);

}



}
?>
