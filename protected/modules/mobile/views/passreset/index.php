<?php
$this->breadcrumbs=array(
	'resent password'
	
);


?>



<div class="row">
    <div class="span5">
        <?php echo $this->renderPartial('_reset'); ?>
    </div>
    <div class="span7 padding-top">
        <?php 
        
        if(Yii::app()->user->hasState('activation')){
            
            echo SiteContainers::success(Yii::app()->user->getState('activation'));
            $this->clearActivationSession();
        }
        else{
          echo SiteContainers::info("Enter the email that you used to setup the account");
           
        }
            
        ?>
        
    </div>
</div>