<?php


    
    
/**
 * Description of pageFilePath
 * A helper class to hold paths to images, css and js files
 * @var $page string the file to locate
 *
 * @author victor Odiah vodiahco1@yahoo.com
 * @category view helpers
 * @final final
 */
final class PageFilePath {

    //path to image files
    public static function imageUrl($page){
    return Yii::app()->baseUrl.'/images/'.$page;
//        return Yii::getPathOfAlias('webroot.images')."/".$page;


    }
    
    //path to profile image files
    public static function profileUrl($page){
    return Yii::app()->baseUrl.'/images/photos/'.$page;


    }
    
     //path to profile image files
    public static function uploadProfileUrl($page){
    return Yii::getPathOfAlias('webroot.images.photos')."/".$page;


    }

    //path to js files
    public static function jsUrl($page){
    return Yii::app()->baseUrl.'/js/'.$page;
    }
   

   
    //path to css files
    public static function cssUrl($page){
    return Yii::app()->baseUrl.'/css/'.$page;
    }

   
    
      //path to uploaded files
    public static function uploadCsvUrl($page,$base=true){
        if($base)
return Yii::app()->baseUrl.'/csvdocs/'.$page;
     return Yii::getPathOfAlias('webroot.csvdocs').'/'.$page;

    }


    

    //path to uploaded files
    public static function uploadUrl($page,$base=true){
        if($base)
return Yii::app()->baseUrl.'/docs/'.$page;
     return Yii::getPathOfAlias('webroot.docs').'/'.$page;

    }
    
    //path to uploaded files
    public static function uploadUrlLive($page){
  // return Yii::getPathOfAlias('webroot.docs').'/'.$page;
return Yii::app()->baseUrl.'/docs/'.$page;

    }
    //path to uploaded files
    public static function downloadUrl($page){
       return Yii::getPathOfAlias('webroot.docs').'/'.$page;
//return "../".Yii::app()->baseUrl.'/docs/'.$page;

    }
    

   
 //path to uploaded files
    public static function uploadImgUrl($page,$base=true){
     if($base)
        return Yii::app()->baseUrl.'/images/upload/'.$page;
         return Yii::getPathOfAlias('webroot.images.upload').'/'.$page;


    }
    
    public static function thumbnailUrl($page,$base=true){
     if($base)
        return Yii::app()->baseUrl.'/images/upload/thumb_upload/thumb_'.$page;
         return Yii::getPathOfAlias('webroot.images.upload.thumb_upload').'/thumb_'.$page;


    }


}

?>
