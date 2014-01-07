<?php

/**
 * SiteTexts class file
 * SiteTexts is a static class that displays text on the web page
 * it alse handles mutiple languages
 * it relies/depends on the SiteText model in application.models for access to the site_text table/
 * where SiteText model is not available, it pulls the default value from its property.
 *
 * @author victor Odiah vodiahco1@yahoo.com
 * @category view helpers
 * @final final
 * 
 */
final class SiteTexts {
    
    /**
     * The name of the application
     * @var type string
     */
     private static $SITE_NAME="GreenBook";
     
     /**
     * The int value of the remove status
     * @var type int
     */ 
    private static $REMOVE=0;
    
    /**
     * The int value of the deleted status
     * @var type int
     */ 
    private static $DELETED=1;
    
    
      /**
     * The int value of the deleted status
     * @var string
     */ 
    private static $DELETED_TEXT="Deleted";
    
     /**
     * The string value of the remove status
     * @var type string
     */ 
    private static $REMOVE_TEXT="Removed";
    
    
     /**
     * The int value of the active status
     * @var type int
     */ 
    private static $ACTIVE=1;
    
     /**
     * The string value of the active status
     * @var type string
     */ 
    private static $ACTIVE_TEXT="Active";
    
   
    
    /**
     * default text for the site/benefits
     * @var type string
     */
    public static $BENEFITS_TEXT="In the present day learning environment, there is an indispensable need for greater time management, effective and smart communication, efficient and fast content sharing and academic resource delivery as well as reducing redundancy and wastage within the academic institutions.";
    
    
    /**
     * default text for the site/benefits
     * @var type string
     */
    public static $ABOUT_TEXT="The GreenBook Project is an initiative to provide teachers and students - a free and easy to use document management system ( with a bid to reducing the volume of paper consumed in schools) It is also aimed at providing institutions a full range of online learning platform for students and lecturers benefits.";
    
    public static $REPORT_POST_TEXT="if you find the content on this page inappropriate<br/>Please notify us";
  public static $FEEDBACK_POST_TEXT="Feedback and suggestions";
  public static $DEFAULT_CONTENT_LENGTH=70;
   public static $REPORT_BUTTON_CONFIRMATION="You are about to notify administrator that there is inapropriate content on this page";

  
    /**
    * retrieve the remove value (text or int)
    * @param type $text boolean
    * @return type int if $text==false and string if $text==true
    */ 
    
    public static function getRemove($text=false){
        if($text)
            return self::$REMOVE_TEXT;
        return self::$REMOVE;
}


 /**
    * retrieve the deleted value (text or int)
    * @param type $text boolean
    * @return type int if $text==false and string if $text==true
    */ 
    
    public static function getDeleted($text=false){
        if($text)
            return self::$DELETED_TEXT;
        return self::$DELETED;
}


/**
    * retrieve the active value (text or int)
    * @param type $text boolean
    * @return type int if $text==false and string if $text==true
    */ 
    
    public static function getActive($text=false){
        if($text)
            return self::$ACTIVE_TEXT;
        return self::$ACTIVE;
}
    
    /**
     * returns the site languate
     * @return type string the language
     */
    private static function getSiteLanguage(){
        $language="en";
        if(isset(Yii::app()->user->language))
            $language=Yii::app()->user->language;
        return $language;
    }
    
    
    /**
     * return the site name
     * @return type string 
     */
    public static function getSiteName(){
        $model=  SiteText::model()->find(
                array(
                    'condition'=>'name=:name and language=:l',
                    'params'=>array(':name'=>"SITE_NAME",':l'=>  self::getSiteLanguage()),
                )
                );
        if($model==null)
            return self::$SITE_NAME;
        return $model->post;
}


/**
 * returns a text from the site text database table
 * if text is not found, it returns a given default valus
 * @param type $name string the name of the text to return 
 * @param type $default string the default value given
 * @return type string
 */

public static function getSiteText($name,$default=null){
        $model=  SiteText::model()->find(
                array(
                    'condition'=>'name=:name and language=:l',
                    'params'=>array(':name'=>$name,':l'=>  self::getSiteLanguage()),
                )
                );
        if($model==null)
            return $default;
        return $model->post;
}
    
    
}

?>
