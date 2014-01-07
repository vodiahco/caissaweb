<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GBModelAlerter
 *
 * @author vonnero
 */
class GBModelAlerter extends CActiveRecordBehavior {
    
    
    protected function getPostType(){
       $model=$this->owner;
       
       if($model instanceof Forum){
           if($model->parent_id!==0)
               return "Post Reply";
           return "New Post";
       }
    }
    
    public function alertUsers(){
        $model=$this->owner;
        
        $users=  $model->getValidUsers();
        
//        print_r($users); exit;
        
        $count=count($users);
        $postType=  $this->getPostType();
        
            
            $db=Yii::app()->db;
            
            $table="gbn_alerter";
             $sql="insert into $table (uid,post_type,receiver_id,post_id,post,date_created,status) values(:uid,:postType,:receiverId,:postId,:post,:date_created,:status)";
        $command=$db->createCommand($sql);
        
         for($i=0;$i<$count;$i++){
        $uid=  Dna::getId();
       $status=  SiteSetup::$PUBLISHED;
        $dateCreated=  SiteReusables::getNow();
       
        
        $receiverId=$users[$i];
        if($receiverId==null)
            continue;
        $post= SiteReusables::userNameByIdNoLink($uid)." added a new post";
         
        if($model->hasAttribute('parent_id'))
        $postId=($model->parent_id==0)?$model->id:$model->parent_id;
        else
            $postId=$model->id;
        
        $command->bindParam(":uid",$uid,PDO::PARAM_INT);
        $command->bindParam(":postType",$postType,PDO::PARAM_STR);
        $command->bindParam(":receiverId",$receiverId,PDO::PARAM_INT);
        $command->bindParam(":postId",$postId,PDO::PARAM_INT);
        $command->bindParam(":post",$post,PDO::PARAM_STR);
              $command->bindParam(":date_created",$dateCreated,PDO::PARAM_STR);
               $command->bindParam(":status",$status,PDO::PARAM_INT);
            
            $command->execute();
         }
        
    }
    
    
    
    
}

?>
