<div class="form margin-top margin-bottom rounded">
    <h3>Create new account</h3>
    <hr/>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	
	
	<div class="row">
		<?php echo $form->labelEx($model,'oldPass'); ?>
		<?php echo $form->passwordField($model,'oldPass',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'oldPass'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'newPass'); ?>
		<?php echo $form->passwordField($model,'newPass',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'newPass'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'cpass'); ?>
		<?php echo $form->passwordField($model,'cpass',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'cpass'); ?>
	</div>


	
	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'SAVE' : 'Save',array('class'=>'btn btn-large btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->