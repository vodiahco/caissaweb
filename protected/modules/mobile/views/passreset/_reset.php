


        <div class="form margin-top rounded margin-bottom">
            <h3>Reset password</h3>
            <hr/>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<?php 


echo SiteContainers::pageSubHeader("Please enter your email",'prepend-top');
echo SiteContainers::pWrap("A link will be sent to your email to enable you reset your password");
?>


 <div class="row ">
                <?php 
        echo CHtml::beginForm("#",'post',array('class'=>'append-bottom'));
        echo CHtml::textField('email',"",array('class'=>'span4 margin-right','size'=>60,'maxlength'=>255));;

    echo CHtml::submitButton('Go',array('class'=>'btn  btn-primary '));
 echo CHtml::endForm();
 
 
                
                ?>
            </div>
	
        
	

	

<?php $this->endWidget(); ?>
</div><!-- form -->
    

