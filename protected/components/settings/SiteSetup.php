<?php

/**

 * A helper class to hold global site settings
 *
 * @author victor Odiah vodiahco1@yahoo.com
 * @category settings
 * @final final
 */
final class SiteSetup extends ASSiteSetup {
    
   private static $SITE_EMAIL="info@greenbooknet.com";
   
   private static $ADMIN_EMAIL="admin@greenbooknet.com";
   
   private static $SITE_ADDRESS="www.greenbooknet.com";
   private static $DEFAULT_CONTENT_LENGTH=70;
   
      public static $TEACHER=2;
      
      public static $STUDENT=1;
       public static $MODERATOR=3;
    
    /**
     * method to check if account activation is required
     * @return type bopolean
     */
    public static function getAutoActive(){
        return SiteSettings::model()->exists(
                array(
                    'condition'=>'name=:name and remove=:rem and activated=:a',
                    'params'=>array(':name'=>"auto_activate",':rem'=>  SiteTexts::getRemove(),':a'=>  SiteTexts::getActive()),
                )
                );
       
}


/**
     * method to check if document activation is required
     * @return type bopolean
     */
    public static function getAutoActiveDocument(){
        return SiteSettings::model()->exists(
                array(
                    'condition'=>'name=:name and remove=:rem and activated=:a',
                    'params'=>array(':name'=>"document_auto_active",':rem'=>  SiteTexts::getRemove(),':a'=>  SiteTexts::getActive()),
                )
                );
       
}

/**
 * retrieves the site email
 * @return string 
 */
public static function getSiteEmail(){
    return self::$SITE_EMAIL;
}

/**
 * retrieves the admin email
 * @return string 
 */
public static function getAdminEmail(){
    return self::$ADMIN_EMAIL;
}


/**
 * retrieves the web address
 * @return string 
 */
public static function getSiteAddress(){
    return self::$SITE_ADDRESS;
}

/**
 * retrieves the default text length
 * @return string 
 */
public static function getDefaultContentLength(){
    return self::$DEFAULT_CONTENT_LENGTH;
}
    
}

?>
