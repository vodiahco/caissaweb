<?php

/**
 * A helper class to hold global site settings
 *
 * @author victor Odiah vodiahco1@yahoo.com
 * @category settings
 * @final final
 */

 class ASSiteSetup {
    
   private static $SITE_EMAIL="";
   
   private static $ADMIN_EMAIL="";
   
   private static $SITE_ADDRESS="";
   private static $DEFAULT_CONTENT_LENGTH=70;
   
   public static $INACTIVE=0;
   
   public static $ACTIVE=1;
   
   public static $REMOVE=2;
   
   public static $ARCHIVE=3;
   
   public static $ADMINREMOVE=4;
   
   private static $SITE_ADMIN=5;
   
    private static $BLOCK=6;
    
    private static $BLOCK_TEXT="Blocked";
   
   public static $ADMIN_MODULE="siteadmin";
   public static $ADMIN_ONLY=1;
   
   public static $PUBLISHED=1;




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
     * The string value of the active status
     * @var type string
     */ 
    private static $ACTIVE_TEXT="Active";
    

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
    * retrieve the active value (text or int)
    * @param type $text boolean
    * @return type int if $text==false and string if $text==true
    */ 
    
    public static function getAdmin(){
        return self::$SITE_ADMIN;
}



/**
    * retrieve the active value (text or int)
    * @param type $text boolean
    * @return type int if $text==false and string if $text==true
    */ 
    
    public static function getBlocked($text=false){
         if($text)
            return self::$BLOCK_TEXT;
        return self::$BLOCK;
}
    
}

?>
