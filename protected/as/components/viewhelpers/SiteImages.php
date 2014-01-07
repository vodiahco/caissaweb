<?php



/**
 * SiteImages class file
 * SiteImages is a static class that displays images on the web page
 * this class relies on application.viewhelpers.PageFilePath
 *
 * @author victor Odiah vodiahco1@yahoo.com
 * @category view helpers
 * @final final
 * 
 */
final class SiteImages {
    
    /**
     * returns the logo image
     * @return type string 
     */
    public static function getLogo($class='logo'){
        return CHtml::image(PageFilePath::imageUrl('/images/logo.png'),'logo',array('class'=>$class));
    }
    
    /**
     * returns the download image
     * @return type string 
     */
    public static function getDownloadImage($context="publication",$class='icon_large_no_margin_top'){
        $img="pub.png";
        
        return CHtml::image(PageFilePath::uploadImgUrl($img,false),'download',array('class'=>$class));
    }
    
    
    /**
     * returns the specified image image
     * @return type string 
     */
    public static function getSiteImage($img,$alt="",$htmlOptions=array()){
        
        return CHtml::image(PageFilePath::imageUrl($img),$alt,$htmlOptions);
    }
    
    
    public static function getIconLink($iconId,$class='icon_no_margin_top'){
         switch($iconId){
        case 'download':return PageFilePath::imageUrl('icons/download_.png');
            break;
       default: return PageFilePath::imageUrl("icons/$iconId.png");
            break;
         }
         
    }
    
    public static function getLargeIcon($iconId,$class='left'){
         
      $path=PageFilePath::imageUrl("largeicons/$iconId.png");
   return CHtml::image($path,'',array('class'=>$class));
    }
   
    
    public static function getIcon($iconId,$class='icon_no_margin_top',$title="icon"){
         if($class==null || $class=="")
             $class='icon_no_margin_top';
         if($title==null || $title=="")
             $title="icon";
             
      $path=PageFilePath::imageUrl("icons/$iconId.png");
   return CHtml::image($path,'icon',array('class'=>$class,'title'=>$title));
    }
    
    
    /**
	 * Method.
     * generates in icon based on the icon id specified
	 * @param string $iconId string representing the name of the icon.
	 * @param string $class the css class to apply
     * @return string image icon
	 */
    
    public static function DEP_getIcon($iconId,$class='icon_no_margin_top'){

    switch($iconId){
         case 'store' : return CHtml::image(PageFilePath::imageUrl('icons/store.png'),'store',array('class'=>$class));
            break;
        case 'user' : return CHtml::image(PageFilePath::imageUrl('icons/user.png'),'user',array('class'=>$class));
            break;
        case 'forward' : return CHtml::image(PageFilePath::imageUrl('icons/forward.png'),'',array('class'=>$class));
            break;
         case 'todo' : return CHtml::image(PageFilePath::imageUrl('icons/todo.png'),'',array('class'=>$class));
            break;
        case 'add_group' : return CHtml::image(PageFilePath::imageUrl('icons/group_new.png'),'',array('class'=>$class));
            break;
        
         case 'group' : return CHtml::image(PageFilePath::imageUrl('icons/group.png'),'group',array('class'=>$class));
            break;
        
        case 'play' : return CHtml::image(PageFilePath::imageUrl('icons/play.png'),'play',array('class'=>$class));
            break;
        case 'test' : return CHtml::image(PageFilePath::imageUrl('icons/test.png'),'test',array('class'=>$class));
            break;
         case 'result' : return CHtml::image(PageFilePath::imageUrl('icons/result.png'),'result',array('class'=>$class));
            break;
        case 'feedback' : return CHtml::image(PageFilePath::imageUrl('icons/feedback.png'),'group',array('class'=>$class));
            break;
         case 'x' : return CHtml::image(PageFilePath::imageUrl('icons/x.png'),'delete',array('class'=>$class));
            break;
         case 'newfolder' : return CHtml::image(PageFilePath::imageUrl('icons/newfolder.png'),'new folder',array('class'=>$class));
            break;
        case 'elibrary' : return CHtml::image(PageFilePath::imageUrl('icons/elibrary.png'),'e-library',array('class'=>$class));
            break;
        case 'task' : return CHtml::image(PageFilePath::imageUrl('icons/task1.png'),'assignment',array('class'=>$class));
            break;
        case 'savedcontacts' : return CHtml::image(PageFilePath::imageUrl('icons/savedcontacts.png'),'saved contacts',array('class'=>$class));
            break;
        
        case 'linkedcontacts' : return CHtml::image(PageFilePath::imageUrl('icons/linkedcontacts.png'),'linked contacts',array('class'=>$class));
            break;
        case 'savedfolder' : return CHtml::image(PageFilePath::imageUrl('icons/docfolder_green.png'),'saved folder',array('class'=>$class));
            break;
        
        case 'groupfolder' : return CHtml::image(PageFilePath::imageUrl('icons/groupfolder.png'),'saved contacts',array('class'=>$class));
            break;
        case 'document' : return CHtml::image(PageFilePath::imageUrl('icons/notes.png'),'document',array('class'=>$class));
            break;
        
             case 'info' : return CHtml::image(PageFilePath::imageUrl('icons/info.png'),'info',array('class'=>$class));
            break;
        
         case 'blocked' : return CHtml::image(PageFilePath::imageUrl('icons/stop.png'),'blocked',array('class'=>$class));
            break;
          case 'sitemessage' : return CHtml::image(PageFilePath::imageUrl('icons/message-new.png'),'message',array('class'=>$class));
            break;
        case 'message' : return CHtml::image(PageFilePath::imageUrl('icons/message.png'),'message',array('class'=>$class));
            break;
        
             case 'comments_reply' : return CHtml::image(PageFilePath::imageUrl('icons/comments_reply.png'),'reply',array('class'=>$class));
            break;
         case 'usersearch' : return CHtml::image(PageFilePath::imageUrl('icons/user_search.png'),'reply',array('class'=>$class));
            break;
        
         case 'locked' : return CHtml::image(PageFilePath::imageUrl('icons/private.png'),'locked',array('class'=>$class,'title'=>'locked'));
            break;
        case 'key' : return CHtml::image(PageFilePath::imageUrl('icons/key.gif'),'private',array('class'=>$class,'title'=>'private'));
            break;
        
        case 'upload' : return CHtml::image(PageFilePath::imageUrl('icons/file_add.png'),'upload',array('class'=>$class,'title'=>'private'));
            break;
        case 'documents':return CHtml::image(PageFilePath::imageUrl('icons/documents.jpg'),'documents',array('class'=>$class));
            break;
        case 'project':return CHtml::image(PageFilePath::imageUrl('icons/projects.png'),'assignment',array('class'=>$class));
            break;
        case 'discuss':return CHtml::image(PageFilePath::imageUrl('icons/discuss.png'),'discuss',array('class'=>$class));
            break;
         case 'discuss2':return CHtml::image(PageFilePath::imageUrl('icons/discuss.png'),'discuss',array('class'=>$class));
            break;
          case 'calendar':return CHtml::image(PageFilePath::imageUrl('icons/calendar.png'),'calendar',array('class'=>$class));
            break;
        case 'notice':return CHtml::image(PageFilePath::imageUrl('icons/announcements.gif'),'notice',array('class'=>$class));
            break;
        case 'home':return CHtml::image(PageFilePath::imageUrl('icons/home_page.png'),'students',array('class'=>$class));
            break;


        case 'class':return CHtml::image(PageFilePath::imageUrl('icons/class.png'),'class',array('class'=>$class));
            break;

        case 'download':return CHtml::image(PageFilePath::imageUrl('icons/download_.png'),'download',array('class'=>$class));
            break;
         case 'add':return CHtml::image(PageFilePath::imageUrl('icons/add.png'),'add',array('class'=>$class));
            break;
         case 'mail':return CHtml::image(PageFilePath::imageUrl('icons/email.png'),'mail',array('class'=>$class));
            break;
        case 'people':return CHtml::image(PageFilePath::imageUrl('icons/people.png'),'students',array('class'=>$class));
            break;
        case 'teacher':return CHtml::image(PageFilePath::imageUrl('icons/teacher.png'),'teacher',array('class'=>$class));
            break;


        case 'folder':return CHtml::image(PageFilePath::imageUrl('icons/folder.png'),'documents',array('class'=>$class));
            break;
        case 'docfolder':return CHtml::image(PageFilePath::imageUrl('icons/docfolder_green.png'),'docs',array('class'=>$class));
            break;
        case 'save':return CHtml::image(PageFilePath::imageUrl('icons/save.png'),'save',array('class'=>$class));
         break;
        case 'assignment':return CHtml::image(PageFilePath::imageUrl('icons/assignments.png'),'assignments',array('class'=>$class));
            break;
         case 'options':return CHtml::image(PageFilePath::imageUrl('icons/options.png'),'options',array('class'=>$class));
            break;
         case 'administrator':return CHtml::image(PageFilePath::imageUrl('icons/administrator.png'),'admin',array('class'=>$class));
            break;
         case 'bin':return CHtml::image(PageFilePath::imageUrl('icons/bin.png'),'bin',array('class'=>$class));
            break;
        case 'settings':return CHtml::image(PageFilePath::imageUrl('icons/settings.png'),'settings',array('class'=>$class));
            break;
        case 'accessibility':return CHtml::image(PageFilePath::imageUrl('icons/accessibility.png'),'accessibility',array('class'=>$class));
            break;
          case 'help':return CHtml::image(PageFilePath::imageUrl('icons/help.png'),'help',array('class'=>$class));
            break;
          case 'fonts':return CHtml::image(PageFilePath::imageUrl('icons/font_size.png'),'fonts',array('class'=>$class));
            break;

         case 'add_document':return CHtml::image(PageFilePath::imageUrl('icons/add_document.png'),'submitted',array('class'=>$class));
            break;
        case 'ok':return CHtml::image(PageFilePath::imageUrl('icons/tick.png'),'ok',array('class'=>$class));
            break;
        
        case 'restore':return CHtml::image(PageFilePath::imageUrl('icons/restore.png'),'restore',array('class'=>$class));
            break;
        case 'search':return CHtml::image(PageFilePath::imageUrl('icons/search.png'),'search',array('class'=>$class));
            break;
        
        case 'pdf':return CHtml::image(PageFilePath::imageUrl('icons/pdf.png'),'pdf',array('class'=>$class));
            break;
        
        case 'word':return CHtml::image(PageFilePath::imageUrl('icons/word.png'),'word',array('class'=>$class));
            break;
        case 'powerpoint':return CHtml::image(PageFilePath::imageUrl('icons/powerpoint.png'),'powerpoint',array('class'=>$class));
            break;
        case 'spreadsheet':return CHtml::image(PageFilePath::imageUrl('icons/spreadsheet.png'),'spreadsheet',array('class'=>$class));
            break;
        case 'notepad':return CHtml::image(PageFilePath::imageUrl('icons/notepad.png'),'search',array('class'=>$class));
            break;
        case 'alert':return CHtml::image(PageFilePath::imageUrl('icons/alert.png'),'alert',array('class'=>$class));
            break;
        
        
        default: return CHtml::image(PageFilePath::imageUrl("icons/$iconId.png"),"$iconId",array('class'=>$class));
            break;
    }
}




/*
 * sets default profile picture
 * default photo is set based on gender
 * @var int name $x integer representing the user gender
 * @return string url
 */
    public static function defaultPic($x){
$profile_pic="";
  
if($x==1){
 $profile_pic='male.jpg';
}

else if($x==2){
 $profile_pic='female.jpg';
}
else
$profile_pic='default.jpg';    

return $profile_pic;
   }


}

?>
