<?php


/**
 * SiteReusables class file
 * Description of SiteReusables
 * SiteReusables is a class for resuable methods
 *
 * @author victor Odiah vodiahco1@yahoo.com
 * @category view helpers
 * @final final
 * 
 */
 class ASSiteReusables {
  
    /**
     *
     * @param type $label string the link label
     * @param type $url string the link url
     * @param type $htmlOptions array the other html options
     * @return type string CHtml::link(); 
     */
    
    public static function easyLink($label,$url,$htmlOptions=array()){
        
        return CHtml::link($label,Yii::app()->createUrl($url),$htmlOptions);
    }
    
    

    
    
    /**
     *
     * @param $string type string the text to count

     */
    public static function getStrlen($string){
       return strlen($string);
   }
   
   
   /**
 * Create a random key
 * @return string the random key
 */
   
   public static function getHashKey($segment=null,$useDna=false){
       $length = 2;
$chars = array_merge(range(0,9), range('A','Z'));
shuffle($chars);
$hash = implode(array_slice($chars, 0, $length));

        $id= substr(rand(),0,3);
        if(Dna::getId()!==null && $useDna)
       $id=  Dna::getId();
      
if($segment!=null){
    if($segment=="simple")
     return strtoupper(rand(1,999).$hash);
    else
    return strtoupper($segment.rand(1,999)."-".rand(1,999).$hash);

}
else{
$x=time();
$x=str_split($x);
shuffle($x);
$hashx = implode(array_slice($x, 0, 5));
       return strtoupper($hashx."_".$hash);
}
   }
   
   /*
 * Create a random key
 * @return string the random key
 */
   
   public static function getRandomKey(){
     $ld=substr(rand(),0,3);  
       if(Dna::getId()!==NULL)
           $ld=Dna::getId();

       return strtoupper($ld.time().rand(1,15));
   }
   
   public static function getSessionID(){
       $x=time();
       $x=str_split($x);
shuffle($x);
$hashx = implode($x);
return $hashx.time();
   }
   
   
   
    public static function getRandonNumbers(){
      $length = 3;
$chars = range(1,9);
shuffle($chars);
$hash = implode(array_slice($chars, 0, $length));
return $hash;
   }
   
   /**
 * Create a random key
 * @return string the random key
 */
   
   public static function getHashKeyForUserPin($segment=null){
       $length = 3;
$chars = array_merge(range(0,9), range('A','Z'));
shuffle($chars);
$hash = implode(array_slice($chars, 0, $length));

        $id= substr(rand(),0,3);
        
$x=time();
$x=str_split($x);
shuffle($x);
$hashx = implode(array_slice($x, 0, 3));

       return strtoupper($hashx.$hash);

   }
   
   
   /**
     * formats date time
     * @param type $date datetime or unix timestamp
     * @return type string the date and time
     */
   public static function friendlyMonthAndYear($date,$raw=false){
       if($raw)
        return date('M-Y', $date);
       return date('M-Y',  strtotime($date));
       
   }
   
 /**
     * formats date time
     * @param type $date datetime or unix timestamp
     * @return type string the date and time
     */
   public static function friendlyDate($date,$raw=false){
       if($raw)
        return date('d-M-Y H:i:s', $date);
       return date('d-M-Y H:i:s',  strtotime($date));
       
   }

 /**
     * formats date
     * @param type $date datetime 
     * @return type string the date
     */
   public static function friendlyDateNoTime($date,$raw=false){
        if($raw)
        return date('d-M-Y', $date);
       return date('d-M-Y',  strtotime($date));
   }



    /**
     * formats date time
     * @param type $date datetime or unix timestamp
     * @param type $raw boolean
     * @return type string the date and time day
     */


   public static function fullFriendlyDate($date,$raw=null){
       if($raw!=null)
           return date('D d-M-Y H:i:s', $date);
       return date('D d-M-Y H:i:s',  strtotime($date));
   }

/**
 * get the current timestamp
 */
public static function getNow(){
return date('Y-m-d H:i:s',strtotime('now'));
}



 /**
* wordWrap
* this method is used to format retrieved content
* @access public
* @paran  string $str string to format
*/
public static function wordWrap($str,$len=75){
	$words=wordwrap($str, $len, "\n", true);
	return "<pre>".$words."</pre>";

}



/**
 * used to extract part of a text
 * @param type $str string the original text
 * @param type $len int the lenth of output text
 * @return type string
 */

public static function getSub($str,$len=100){

$nstr=substr($str,0,$len);
if(strlen($nstr)>($len-1))
return $nstr."...";
else
return $nstr;
   
}


/**
 * set site update notification
 * @param type $m string name of flashmessage
 * @param type $message string the message to flash
 */
public static function setUpdateFlash($message){
    $m="success";
     Yii::app()->user->setFlash($m,$message);
}

/**
 * get site update notification
 * @param type $m string name of flashmessage nto retrieve
 */

public static function showFlash($m="success"){

if(Yii::app()->user->hasFlash($m)):
 Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$(".updated").animate({opacity: 1.0}, 2500).fadeOut("slow");',
   CClientScript::POS_READY
);


        ?>
    <div class="updated flash-notice alert alert-success">
        <?php echo Yii::app()->user->getFlash($m); ?>
    </div><?php
endif;
}






 /**
  * Document Icon selector
  * @param type $docType string the document extension
  * @return string 
  */   
  
    public static function  getIconText($docType){
        
        $docType=  strtolower($docType);
        if(!$docType==null){
            switch ($docType){
                case "pdf": return "pdf";
                    break;
                case "doc"; case "docx" : return "word";
                    break;
                case "xls"; case "xlsx": return "spreadsheet";
                    break;
                case "pptx"; case"ppt": return "powerpoint";
                    break;
                case "txt" : return "notepad";
                    break;
                default : return "notepad";
            }
        }
        return "notepad";
    }
    
    
    
    public static function getDoctypeFromId($docid,$model=null){
         if($model==null)
        $model=  Document::model()->findByPk($docid);
        
        $doctype=($model==null)?null: $model->doctype;
        $icontext= self::getIconText($doctype);
        return SiteImages::getIcon($icontext);
        
    }
    
    
    public static function getDocSizeFromId($docid,$model=null,$docsize=null){
        if($docsize==null){
        if($model==null)
        $model=  Document::model()->findByPk($docid); 
        $docsize=($model==null)?null: $model->docsize;
        }
        $mb=(1024*1024);
        $kb=1024;
        $unit="MB";
        $size=$docsize/$mb;
        if($size<1){
            $size=$docsize/$kb;
            $unit="KB";
        }
        $result=round($size,2).$unit;


            
        return SiteContainers::elementWrap($result,'div', 'hint');
        
    }
    
    
   /**
     * For retrieving the data status
     * @param type $active int the row status
     * @return string 
     */
    
//    public static function getStatus($remove){
//        $array= FormListData::statusListData();
//        
//             if(($remove>=0) && $remove<4 && $remove!=null)
//                 return $array["$remove"];
//             else
//                 return "N/A";
//
//            
//        }
        
        
         public static function getArticleStatus($active){
            
            if($active==1)
                 return "Published";
            else if($active==0)
                return "Pending";
             else if($active==2)
                return "Archived";
            
        }
        
            public static function getOrderStatus($active){
            
           $array=  FormListData::orderStatusListData();
           if($active==1 || $active==0)
               return $array[$active];
        }
  /**
     * Description gets the user name of the specified user id
     * username is set based on passed in id
     *
     * @return type string 
     */
   public static function userNameById($id,$short=false){
       if($id==null)
           return "";
       $module=null;
$module=(Yii::app()->getController()->getModule()!=null)?Yii::app()->getController()->getModule()->id:null;

           $f=  User::model()->find(array(
                   'select'=>'fname,lname',
                   'condition'=>'id=:id',
               'params'=> array(':id'=>$id)
               ));
             if($f!==null){
           $fullName= ucwords($f->getAttribute('fname')." ".$f->getAttribute('lname'));
           
            $fullNamex=$fullName;
           
           if($short)
               $fullNamex=  self::getSub ($fullName, 12);
             return CHtml::link($fullNamex,Yii::app()->createUrl($module.'/user/view',array('id'=>$id)),array('title'=>$fullName));
             }
   }
   
   
    /**
     * Description gets the user name of the specified user id
     * username is set based on passed in id
     *
     * @return type string 
     */
   public static function userNameByIdNoLink($id,$short=false){

           $f=  User::model()->find(array(
                   'select'=>'fname,lname',
                   'condition'=>'id=:id',
               'params'=> array(':id'=>$id)
               ));
             if($f!==null){
           $fullName= ucwords($f->getAttribute('fname')." ".$f->getAttribute('lname'));
           
           if($short)
               $fullName=  self::getSub ($fullName, 18);
             return $fullName;
             }
   }
   
   
   
    public static function userNameByIdentifierNoLink($id,$short=false){

           $f=  User::model()->find(array(
                   'select'=>'fname,lname',
                   'condition'=>'identifier=:id',
               'params'=> array(':id'=>$id)
               ));
             if($f!==null){
           $fullName= ucwords($f->getAttribute('fname')." ".$f->getAttribute('lname'));
           
           if($short)
               $fullName=  self::getSub ($fullName, 18);
             return $fullName;
             }
   }
   
   
   
    public static function userNameByIdentifier($id,$short=false){
       if($id==null)
           return "";
       $module=null;
$module=(Yii::app()->getController()->getModule()!=null)?Yii::app()->getController()->getModule()->id:null;

           $f=  User::model()->find(array(
                   'select'=>'fname,lname,id',
                   'condition'=>'identifier=:id',
               'params'=> array(':id'=>$id)
               ));
             if($f!==null){
                 $userId=$f->id;
           $fullName= ucwords($f->getAttribute('fname')." ".$f->getAttribute('lname'));
           
            $fullNamex=$fullName;
           
           if($short)
               $fullNamex=  self::getSub ($fullName, 12);
             return CHtml::link($fullNamex,Yii::app()->createUrl($module.'/user/view',array('id'=>$userId)),array('title'=>$fullName));
             }
   }
   
  
   
   public static function deleteXButton($id,$url,$confirm='You are about to delete this contact from your contact list'){
       $info=CHtml::beginForm($url,'post');
       $info.=CHtml::hiddenField('uid',$id);
       $info.=CHtml::submitButton('X',array('class'=>'xbutton','confirm'=>$confirm));
       $info.=CHtml::endForm();
       return $info;
   }
   
   
   
   
    
  /**
   *
   * @param string $attribute string model attribute
   * @param int $id id
   * @param string $url post url
   * @param string $label name of field
   * @param string $class css class
   * @param string $confirm confirmation message
   * @param string $fields CHtml::dropDownList
   * @return string 
   */ 
   public static function allPurposeButton($attribute,$id,$url,$label='+',$class="xbutton",$confirm='You are about to delete this contact from your contact list',$fields=null){
       
       $info=CHtml::beginForm($url,'post');
       $info.=$fields;
       $info.=CHtml::hiddenField($attribute,$id);
       $info.=CHtml::submitButton($label,array('class'=>$class,'confirm'=>$confirm));
       $info.=CHtml::endForm();
       return $info;
   }
   
   public static function getButton($label='OK',$fields=null,$confirm='You are about to sumbit this form',$class="button"){
       
       $info=CHtml::beginForm(null,'get');
       $info.=$fields;
      // $info.=CHtml::hiddenField($label,$label);
       $info.=CHtml::submitButton($label,array('class'=>$class,'confirm'=>$confirm,'name'=>$label));
       $info.=CHtml::endForm();
       return $info;
   }
   
   public static function submitButton($label='OK',$fields=null,$confirm='You are about to sumbit this form',$class="button"){
       
       $info=CHtml::beginForm(null,'post');
       $info.=$fields;
      // $info.=CHtml::hiddenField($label,$label);
       $info.=CHtml::submitButton($label,array('class'=>$class,'confirm'=>$confirm,'name'=>$label));
       $info.=CHtml::endForm();
       return $info;
   }
   
  public static function submitButtonSwitch($remove){
      if($remove==1)
          return self::submitButton ("SWITCH OFF",null,"You are about to switch this menu off",'offbutton');
      else
          return self::submitButton ("SWITCH ON",null,"You are about to switch this menu on",'onbutton');
  }
   
    public static function folderListData(){
         $f=  Folders::model()->findAll(array(
        'select'=>'id,folder',
        'condition'=>'remove=:rem and uid=:uid',
        'params'=>array(':rem'=>0,':uid'=>Yii::app()->user->id)
    ));
         return $data=CHtml::listData($f,'id','folder');
    }
    
    
    
//    public static function groupTypeListData(){
//        return  $data=array('1'=>'Public group- anybody can join','2'=>'Private group- Join by invitation only',''=>'All Groups',);
//    }
//    
    
    
//    public static function getfolderNameById($id){
//         
//         $f=  Folders::model()->find(array(
//        'select'=>'folder',
//        'condition'=>'remove=:rem and uid=:uid and id=:id',
//        'params'=>array(':rem'=>0,':uid'=>Yii::app()->user->id,':id'=>$id)
//    ));
//         if($f!=null){
//             
//         return ucfirst ($f->folder);
//         }
//    }
    
//    public static function getfolderNameByDocId($id){
//       
//         $f= Saveddocuments::model()->find(array(
//        'select'=>'folder',
//        'condition'=>'remove=:rem and uid=:uid and docid=:id',
//        'params'=>array(':rem'=>0,':uid'=>Yii::app()->user->id,':id'=>$id)
//    ));
//         if($f!==null){
//              if($f->folder==0)
//            return "Saved Documents Folder";
//         return self::getfolderNameById($f->folder);
//         }
//    }
    
    
    
    ///document user count
//    public static function getDocumentUserCount($docId,$removeOwner=true){
//    
//     $f=  Saveddocuments::model()->count(array(
//         'condition'=>'docid=:docid and remove=:rem',
//         'params'=>array(
//             ':docid'=>$docId,
//             ':rem'=>0,
//         )
//     ));
////     if($removeOwner==true)
////     $f=$f-1;
//     
//         
//     return ($f>=1)? self::allUrl(SiteImages::getIcon('linkedcontacts')." (Users: ".$f.")","contactlist/links/id/".$docId) : "No user";
// }
// 
 
  public static function reportButton($class="icon_no_margin_top"){
     $button=  SiteImages::getIcon('alert',$class);
     
      return CHtml::link($button.  SiteTexts::$REPORT_POST_TEXT,Yii::app()->createUrl('report'),array('confirm'=>  SiteTexts::$REPORT_BUTTON_CONFIRMATION));
    }
    
    
//    public static function getDocStatus($isactive){
//        return ($isactive==0)?"<span class='red'>Awaiting approval</span>":"Approved";
//     }
//     
     
     /**
 *
 * creates the links for the site controller actions
 * @param type $title string the label for the link
 * @param type $action string the name of the controller action
 * @return type String CHtml link
 */

public static function allUrl($title,$url,$html=array()){
$c=Yii::app();
   return CHtml::link($title,$c->createUrl($url,$html)
   );
}



   public  static function getProfilePic($id,$class='icon_large_no_margin_top'){
        $url=self::getProfilePicUrl($id);
        $pic=CHtml::image(PageFilePath::profileUrl($url),'profile pic',array('class'=>$class));
         return CHtml::link($pic,Yii::app()->createUrl('users/view',array('id'=>$id)));
    }
    
    public  static function getProfilePicNoLink($id,$class='icon_large_no_margin_top'){
        $url=self::getProfilePicUrl($id);
        return CHtml::image(PageFilePath::profileUrl($url),'pic',array('class'=>$class));
         
    }
    
    public  static function getProfilePicWithName($id,$class='icon_large_no_left'){
        $url=self::getProfilePicUrl($id);
        $name=  self::userNameByIdNoLink($id);
        $pic=CHtml::image(PageFilePath::profileUrl($url),'profile pic',array('class'=>$class))."<br/>";
         $profile=CHtml::link($pic.$name,Yii::app()->createUrl('users/view',array('id'=>$id)));
         return SiteContainers::flexibleWraper($profile,'left');
    }
    
    
    
     public static function getProfilePicUrl($id){
        if($id!==null){
            $f= User::model()->find(array(
                'select'=>'profile_pic',
               'condition'=>'id=:uid and status=:rem',
                'params'=>array(':rem'=>  SiteSetup::$PUBLISHED,':uid'=>$id),
            ));
            if($f!==null){
                if($f->profile_pic!==null)
                    return $f->profile_pic;
            } 
        }
      return self::defaultPic(self::getUserGender ($id));  
     
    }
    
    
    
     public static function getUserGender($id){
         if($id!==null){
            $f=  User::model()->find(array(
                'select'=>'sex',
               'condition'=>'id=:uid and status=:rem',
                'params'=>array(':rem'=>0,':uid'=>$id),
            ));
            if($f!==null)
            return $f->sex;    
         }
                return 0;
    }
    
     public static function getGenderText($sex){
         if($sex==1)
             return "Male";
         else if($sex==2)
             return "Female";
        
            
     }
    
    
    
    
    /*
 * sets profile pic to defaults
 * default photo is set based on gender
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
   
   
   
//   public static function homeDocumentViewUrl($id,$title,$context="document"){
//    $context=  Document::model()->resetScope()->findByPk($id)->context;
//$c=Yii::app()->controller;
//    return CHtml::link($title,$c->createUrl("document/view",array(
//        'id'=>$id,
//       
//    )
//            )
//   );
//}

/**
 *
 * @param int $scope group scope
 * @param boolean $showOpen
 * @param string $class class name
 * @return string 
 */
public static function getXScope($scope,$showOpen=false,$class='icon'){
        if($scope==2)
            return SiteImages::getIcon ('locked', $class);
        else
            return ($showOpen)? SiteImages::getIcon ('group', $class):"";
    }
    
    
    /**
     * group name by id
     * @param string $groupId
     * @return string 
     */
//    public static function getGroupNameById($groupId){
//        return Group::model()->findByPk($groupId)->name;
//        
//    }
//    
//    /**
//     * group name url
//     * @param string $groupId
//     * @return string 
//     */
//     public static function getGroupLinkById($groupId){
//        $label= Group::model()->findByPk($groupId)->name;
//         return CHtml::link($label,Yii::app()->createUrl('group/view',array('id'=>$groupId)));
//    }
//    
    
    
      
    public static function documentDownloadLink($docId,$title=null,$model=null){
        $controller=Yii::app()->getController();
        $controllerId=$controller->id;
        
        if($docId==null){
             if($model!==null)
            $docId=$model->id;
        }
        
        if($model==null)
        $model=  Document::model()->findByPk($docId);
        
        if($title==null){ 
        if($controllerId=='noticeboard')
           $model= Announcement::model()->findByPk($docId); 
        if($model!==null)
        $title=$model->title;
        }
        
        $downloadIcon= SiteImages::getIcon("download");
        $docIcon=self::getDoctypeFromId($docId);
        $url=$controller->createUrl("download",array('docid'=>$docId));
        $downloadIcon=$downloadIcon.$docIcon;
        
      return CHtml::link($downloadIcon.$title,$url);
                
    }
    

    
//     public static function documentLinksCount($docId){
//        $model=  Document::model()->findByPk($docId);
//        $count=$model->usersCount();
//        return ($count==0)? "No linked contact": self::allUrl(SiteImages::getIcon('linkedcontacts')." contacts (".$count.")","contactlist/links/id/".$docId);
//            
//       
//    }
  
    
    
//     public static function groupLinksCount($groupId){
//        $model= Group::model()->findByPk($groupId);
//        $count=$model->countCurrentGroupMembers();
//        return ($count==0 || $count==null)? "No linked contact": SiteReusables::allUrl(SiteImages::getIcon('linkedcontacts')." contacts (".$count.")","contactlist/glinks/id/".$groupId);
//            
//       
//    }
    
    
    
//    public static function groupContactsUrl($id,$title){
//$c=Yii::app()->controller;
//   return CHtml::link($title,$c->createUrl("group/view",array(
//        'id'=>$id,
//       
//    )
//            )
//   );
//}



 public static function getProfile($uid){
         $model=  self::getProfileModel($uid);
         if($model===null)
             return self::defaultProfileView ();
         return self::wordWrap($model->profile);
     }

//     public static function getOccupation($uid){
//         $model=  self::getProfileModel($uid);
//         if($model===null)
//             return self::defaultOccupationView ();
//         return self::wordWrap($model->occupation);
//     }
     
     
     
     
     public static function getContactAddButton($uid){
         
         $url=Yii::app()->createUrl('users/view',array('id'=>$uid));
         $confirm="Are you sure you want to add ". SiteReusables::userNameByIdNoLink($uid)." to your contact list?";
         $info=  SiteReusables::allPurposeButton('contact_id',$uid,$url,'Add to contacts',"gb_a_button",$confirm);
         
         //$model=  Users::model()->findByPk($uid);
         if(!Yii::app()->userHelper->isContact($uid))
         return SiteContainers::flexibleWraper($info);
         else
         return SiteContainers::flexibleWraper(SiteReusables::userNameByIdNoLink($uid). " is in your contact list",'gbwidget-green');    
     }
     
     protected static function getProfileModel($uid){
        return Profile::model()->find(array(
            'condition'=>'uid=:uid',
            'params'=>array(':uid'=>$uid),
            
            ));
        
     }
     
     
     
      //profile
    protected static function defaultProfileView(){
         return SiteContainers::titleBlockWrapper("Profile has not been created",'');
     }
     
     
     
     
     
    public static function searchBlock($text,$span="span7"){
   ?>
        <div class="row">
   
    <div class="<?php echo $span;?>">
     <?php

echo SiteContainers::pageSubHeader($text);
?>   
    </div>
    
    <div class="span2 pull-right">
        <?php
echo CHtml::link('<i class="icon-search"></i> Search','#',array('class'=>'search-button')); 
?>
    </div>
</div>

<?php 
    } 
     
     
     
     
     
     
//      protected static function defaultOccupationView(){
//         return SiteContainers::titleBlockWrapper("Occupation has not been specified",'');
//     }
    
     
     /**
     * description creates the link url;
     * 
     * @return type string 
     */
//    public static function getPostUrl($post,$id){
//        $app=Yii::app();
//        return CHtml::link($post,$app->createUrl("forum/view",array('id'=>$id)),array('class'=>'abold'));
//    }
//    
    
     
    //contact activity alert
    /**
     *
     * for contact activity notification
     * @param type $postId int relates to document id or group id
     * @param type $postType string genrated from GBContactAlertModelHelper
     * @return type string
     */
//    public static function getContactActivityNetwork($postId,$postType){
//        
//        if($postType=="group_request" || $postType=="group_join" ||  $postType=="group_member")
//            return SiteImages::getIcon ('group').self::getGroupLinkById($postId);
//       else if($postType=="document_request" || $postType=="document_join" ||  $postType=="document_member")
//            return SiteImages::getIcon ('notepad').self::getDocumentLinkById($postId);
//
//    }
    
    
    
    /**
     *
     * @param type $postId int the document id or group id
     * @param type $postType the post type
     * @return type string the welcome message specific to the selected post type
     */
//    public static function newNetworkWelcomeMessage($postId,$postType){
//        
//        if($postType=="group_request" || $postType=="group_join" ||  $postType=="group_member")
//            return self::groupNetworkWelcomeNote($postId);
//        else if($postType=="document_request" || $postType=="document_join" ||  $postType=="document_member")
//            return self::documentNetworkWelcomeNote($postId);
//
//    }
    
    /**
     *
     * @param type $postId int the document id or group id
     * @param type $postType the post type
     * @return type string the welcome message specific to the selected post type
     */
//    public static function networkMemberLink($postId,$postType){
//        
//        if($postType=="group_request" || $postType=="group_join" ||  $postType=="group_member")
//            return self::groupMembersLink($postId);
//        else if($postType=="document_request" || $postType=="document_join" ||  $postType=="document_member")
//            return self::documentMembersLink($postId);
//
//    }
    
    /**
     * return the welcome message for the new document network member
     * dependency- this method uses DivBlock::pWrap
     * @param type $docId the document id
     * @return type string the welcome message
     */
//    public static function documentNetworkWelcomeNote($docId){
//        $model=Document::model()->findByPk($docId);
//        $docTitle=  self::getDocumentLinkById($docId);
//        
//        $text= SiteContainers::pWrap("Welcome to the Document Network on $docTitle.");
//        $text.=SiteContainers::pWrap("The document network brings together everyone using/ reading this document so they can share ideas, comment, questions via the discussion forum.");
//        $text.=SiteContainers::pWrap("Members of this Document Network have been added to your Saved Documents Contacts");
//        $text.=SiteContainers::pWrap("You are free to make comments, ask questions and also respond to questions /comments from other members");
//        $text.=SiteContainers::pWrap("Network moderator<br/>".self::userNameById($model->uid));
//        return $text;
//    }
    
    /**
     * return the welcome message for the new document network member
     * dependency- this method uses DivBlock::pWrap
     * @param type $docId the document id
     * @return type string the welcome message
     */
//    public static function groupNetworkWelcomeNote($groupId){
//        $model=Group::model()->findByPk($groupId);
//        $name=  self::getGroupLinkById($groupId);
//        
//        $text= SiteContainers::pWrap("Welcome to the Group $name.");
//        $text.=SiteContainers::pWrap("The Group network brings together everyone connected to this group so they can share ideas, comment, questions via the discussion forum.");
//        $text.=SiteContainers::pWrap("Members of this Group Network have been added to your Group Contacts");
//        $text.=SiteContainers::pWrap("You are free to make comments, ask questions and also respond to questions /comments from other members");
//        $text.=SiteContainers::pWrap("Group moderator<br/>".self::userNameById($model->uid));
//        return $text;
//    }
    
    
    /**
     * returns the link to the document network members
     * @param type $docId int document id
     * @return type string
     */
//    public static function documentMembersLink($docId){
//        return CHtml::link("Document Network Members",Yii::app()->createUrl("contactlist/links/id/".$docId));
//    }
    
      /**
     * returns the link to the group network members
     * @param type $docId int group id
     * @return type string
     */
//    public static function groupMembersLink($groupId){
//        return CHtml::link("Group Network Members",Yii::app()->createUrl("contactlist/glinks/id/".$groupId));
//    }
    
    
    public static function getDocumentNameById($docId){
        return Document::model()->findByPk($docId)->title;
    }
    
     public static function getDocumentLinkById($docId){
        $label= Document::model()->findByPk($docId)->title;
        return CHtml::link($label,Yii::app()->createUrl('document/view',array('id'=>$docId)));
    }

     public static function titleView($id,$title){
        $controller=Yii::app()->controller;
        //$controllerId=$controller->id;
        return CHtml::link($title,$controller->createUrl('view',array('id'=>$id)));
    }
    
    public static function postTitleView($data){
        $controller=Yii::app()->controller;
        $title=$data['title'];
        $id=$data['id'];
        $status=$data['status'];
        $dateCreated=$data['date_created'];
        $abstract=$data['abstract'];
        $title=  ucfirst($title);
        $text="<div class='title'>".$title."</div>".self::getSub($abstract,255);
        $post=CHtml::link($text,$controller->createUrl('view',array('id'=>$id)));
        $post.=SiteContainers::flexibleWraper($dateCreated,"hint margin-bottom"); 
         
        if($status==0 && Dna::isAdmin()){
            $post.="<hr/>";
        $post.=SiteContainers::flexibleWraper (CHtml::link("View and publish",$controller->createUrl('view',array('id'=>$id)),array('class'=>'btn')));
        }
        else if($status==1 && ($controller instanceof PostController)){
            $post.="<hr/>";
            $comments=(Post::commentCount($id)>0)? "Comments: ".Post::commentCount($id):"No comments yet";
        $post.=SiteContainers::flexibleWraper (CHtml::link($comments,$controller->createUrl('view',array('id'=>$id)),array('class'=>'btn btn-info')));
        }
        return $post;
        
    }
    
    
    
    
    public static function commentView($data){
        $controller=Yii::app()->controller;
        $title=$data['post'];
        $id=$data['id'];
        $uid=$data['uid'];
        $dateCreated=$data['date_created'];
        $status=$data['status'];
        $text=  ucfirst($title);
        $author= self::userNameByIdNoLink($uid);
        $post=SiteContainers::flexibleWraper($text,"margin-bottom"); 
        $post.=SiteContainers::flexibleWraper($author,"hint"); 
        $post.=SiteContainers::flexibleWraper($dateCreated,"hint margin-bottom"); 
        if(Dna::isAdmin())      
        $post.=CHtml::link("X",$controller->createUrl('view',array('id'=>$id,'remove'=>1)),
        array('name'=>'remove','class'=>'btn btn-error margin-right',
            'submit' => array('view', 'id'=>$id,'remove'=>1), 
            'confirm' => 'You are about to remove this comment',
            'params'=>array('id'=>$id, 'status'=>3,'unpublish'=>'unpublish',),));
        
        if(Dna::isAdmin() && $status==0)      
        $post.=CHtml::link("Publish",$controller->createUrl('view',array('id'=>$id,'publish'=>1)),
        array('name'=>'publish','class'=>'btn btn-success',
            'submit' => array('view', 'id'=>$id,'publish'=>1), 
            'confirm' => 'You are about to publish this comment',
            'params'=>array('id'=>$id, 'status'=>1,'publish'=>'publish',),));
        
        return $post;
        
    }

     
    public static function simpleArticleViewerNoLink($model){
        if(!$model instanceof ASModel){
            return "No data";
        }
        $post="";
        $dateCreated;
        $by;
//        if($model->hasAttribute('uid'))
//         $post.=  SiteContainers::flexibleWraper(self::userNameByIdNoLink ($model->uid),'gray'); 
//        if($model->hasAttribute('date_created'))
//         $post.=  SiteContainers::flexibleWraper(self::friendlyDate($model->date_created),'gray'); 
//        $post.="<hr/>";
         
         if($model->hasAttribute('abstract'))
         $post.=  SiteContainers::flexibleWraper($model->abstract); 
        if($model->hasAttribute('post'))
         $post.=  SiteContainers::flexibleWraper($model->post); 
         
        
        return SiteContainers::flexibleWraper($post);
    }
    
    
    
    public static function simpleTitleViewerNoLink($model){
        if(!$model instanceof ASModel){
            return "No data";
        }
        $post="";
        $dateCreated;
        $by;
         $controller=Yii::app()->controller;
         
         if($model->hasAttribute('title'))
         $post.=  SiteContainers::flexibleWraper(ucfirst ($model->title),'title'); 
         if($model->hasAttribute('uid'))
         $post.=  SiteContainers::flexibleWraper(self::userNameByIdNoLink ($model->uid),'gray'); 
        if($model->hasAttribute('last_modified'))
         $post.=  SiteContainers::flexibleWraper(self::friendlyDate($model->last_modified),'gray'); 
        
        $post.="<hr/>";
             
        $publish=CHtml::link("Publish",$controller->createUrl('view',array('id'=>$model->id,'publish'=>1)),
        array('name'=>'publish','class'=>'btn btn-warning',
            'submit' => array('view', 'id'=>$model->id,'publish'=>1), 
            'confirm' => 'You are about to publish this post',
            'params'=>array('id'=>$model->id, 'status'=>1,'publish'=>1,),));
        
        $unPublish=CHtml::link("Remove",$controller->createUrl('view',array('id'=>$model->id,'publish'=>0)),
        array('name'=>'unpublish','class'=>'btn btn-error',
            'submit' => array('view', 'id'=>$model->id,'publish'=>0), 
            'confirm' => 'You are about to remove this post',
            'params'=>array('id'=>$model->id, 'status'=>0,'unpublish'=>1,),));
        
        if($model->status==0 && Dna::isAdmin())
           
        $post.=SiteContainers::flexibleWraper ($publish);
        elseif($model->status==1 && Dna::isAdmin())
           
        $post.=SiteContainers::flexibleWraper ($unPublish);

        return SiteContainers::flexibleWraper($post);
    }
    
    
    
    public static function simpleDownloadViewer($model,$logged=false){
        if(!$model instanceof ASModel){
            return "No data";
        }
        $post="";
        
        if($model->hasAttribute('title'))
         $post.=  SiteContainers::flexibleWraper(self::documentDownloadLink (null,null, $model),'bold'); 
         
         if($model->hasAttribute('uid') && $logged)
         $post.=  SiteContainers::flexibleWraper(self::userNameByIdNoLink ($model->uid));
         if($model->hasAttribute('docsize'))
         $post.=  SiteContainers::flexibleWraper(self::getDocSizeFromId (null,$model));
         if($model->hasAttribute('last_modified'))
         $post.=  SiteContainers::flexibleWraper(self::friendlyDate($model->last_modified)); 
         
         if($model->hasAttribute('abstract'))
         $post.=  self::getSub (SiteContainers::flexibleWraper($model->abstract),100); 
        
        return SiteContainers::flexibleWraper($post);
    }
    
    
    public static function availableOnMobileOnlyNotice(){
        $post="<h4>Only available on the Mobile Applcation</h4><div>Please contact admin on how to download the App</div>";
         return SiteContainers::flexibleWraper($post,'alert');
    }
    
    public static function getCurrency(){
        $chid=  Dna::getChid();
        $currency="GBP";
        if($chid!==null){
            $model=  Church::model()->findByPk($chid);
            if($model!==null)
                $currency=$model->currency;
        }
        return $currency;
    }
    
    
    
    public static function getChurchName(){
        $chid=  Dna::getChid();
        $name="";
        if($chid!==null){
            $model=  Church::model()->findByPk($chid);
            if($model!==null)
                $name=$model->name;
        }
        return $name;
    }
    
    public static function getChurchNameById($id){
        
        $name="";
        if($id!==null){
            $model=  Church::model()->findByPk($id);
            if($model!==null)
                $name=$model->name;
        }
        return $name;
    }
    
    
    
    
    
}


?>
