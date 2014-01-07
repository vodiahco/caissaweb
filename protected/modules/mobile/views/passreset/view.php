<?php
$this->breadcrumbs=array(
	'Password resets'
	
);

echo SiteContainers::pageHeader(SiteImages::getIcon('secure','icon')."Retrieve password");

$this->renderPartial('_form',array('model'=>$model));
?>


