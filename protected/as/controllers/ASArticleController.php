<?php

class ASArticleController extends ASController
{

    
    private $_adminOnly=0;
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
        protected $maxWidth=450;
        protected $maxHeight=400;
        
        protected $articleModel=null;
        
        protected $doc;
        protected $photo;
        protected $docName;
        protected $photoName;
        
        
        protected function afterAttributesLoad($model){
            
        }
        
        protected function afterAttributesSaved(){
            
        }
        
        protected function beforeAttributesSaved(){
            
        }

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
        

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
        
        
        
        
        
        protected function docUploadPath($file){
            return PageFilePath::uploadUrl($file,false);
        }
        
        
        protected function photoUploadPath($file){
            return PageFilePath::uploadImgUrl($file,false);
        }
        
        protected function setDocName($doc){
            return Dna::getSchool()."_".strtotime('now')."_".$doc;
        }
        
        

//        protected function loadDoc($model){
//            $doc=CUploadedFile::getInstance($model,'doc');
//                                
//                                if($doc==null){
//                                   $model->addError('doc', "please add a document");
//                                   $this->render('create',array(
//                                                        'model'=>$model,
//                                                ));
//                                   Yii::app()->end();
//                                }
//                                $model->setDoc();
//                                $doctype=$doc->getExtensionName();
//                                $docsize=$doc->size;
//                                $docname=  $this->setDocName($doc->name);
//                                $model->doc=$docname;
//                                $model->docsize=$docsize;
//                                $model->doctype=$doctype;
//                            //    $model->isactive=  SiteTexts::getActive();
//                        $model->doccode=$this->setDocCode($model);
//                       // $model->context="document";
//                        $this->doc=$doc;
//        }
        
//        protected function loadPhoto($model){
//             $photo= $model->photo = EUploadedImage::getInstance($model,'photo');
//                                $photo->maxWidth = 300;
//                                $photo->maxHeight = 400;
//                                
//                                $model->photo->thumb = array(
//                                'maxWidth' => 50,
//                                'maxHeight' => 100,
//                               'dir' => 'thumb_upload',
////                                'prefix' => 'tx_',
//);
//
//
//                             //$photo=CUploadedFile::getInstance($model,'photo');
//                                
//                                if($photo==null){
//                                   $model->addError('photo', "please add a photo");
//                                   $this->render('create',array(
//			'model'=>$model,'selector'=>$selector
//                                                ));
//                                   Yii::app()->end();
//                                }
//                                $model->setPhoto();
//                                $doctype2=$photo->getExtensionName();
//                                $docsize2=$photo->getSize();
//                                $docname2=  strtotime('now')."_".$photo->getName();
//                                $model->photo=$docname2;
//                                $this->photo=$photo;
//        }
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
            $model=($this->articleModel==null)?new Articles('create'):$this->articleModel;
		
                $name=$model->getClassName();
                
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST[$name]))
		{
                   
			$model->attributes=$_POST[$name];
                        $this->afterAttributesLoad($model);
                        
                        //load document
                           if(!empty($_FILES[$name]['name']['doc'])){
                         
                               $model->loadDoc(); 
                               
                            //   $photo=null;
                           }   
                       //load photo
//                               
                           
                           
                            if(!empty($_FILES[$name]['name']['photo'])) {
                              $model->loadPhoto();
                         } 
                                
			if($model->save()){
                           if($model->getDoc())
                                $model->uploadDocModel->saveAs($this->docUploadPath($model->doc));
                                if($model->getPhoto())
                                 //$photo->saveAs(PageFilePath::uploadImgUrl($docname2,false));
                                    $model->uploadPhotoModel->saveAs($this->photoUploadPath($model->photo));
                                SiteReusables::setUpdateFlash('Document has been uploaded');
				$this->redirect(array('view','id'=>$model->id));
                      
                         }
  
                        
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
                $currentPhoto=null;
                $currentDoc=null;
                if($model->hasAttribute('photo'))
                $currentPhoto=$model->photo;
                if($model->doc!=null)
                $currentDoc=$model->doc;

		$name=$model->getClassName();
              //  print_r($model->attributes);
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST[$name]))
		{
                   
			$model->attributes=$_POST[$name];
                        
                        $model->status=$this->_autoActivate;
                        
                        //load document
                         if($model->hasAttribute('doc')){
                           if(!empty($_FILES[$name]['name']['doc'])){
                               $model->loadDoc(); 
//                                $photo=null;
                               print_r($model->getDoc())  ;  
                           } 
                        else
                        $model->doc=$currentDoc;
                         }
                       //load photo
                             
                           
                           
                            if($model->hasAttribute('photo')){
                            if(!empty($_FILES[$name]['name']['photo'])) {
                               $model->loadPhoto();
                              
                         } 
                         else
                             $model->photo=$currentPhoto;
                            }
                         
			if($model->save()){
                            if($model->getDoc())
                                $model->uploadDocModel->saveAs($this->docUploadPath($model->doc));
                                if($model->getPhoto())
                                 //$photo->saveAs(PageFilePath::uploadImgUrl($docname2,false));
                                    $model->uploadPhotoModel->saveAs($this->photoUploadPath($model->photo));
                                SiteReusables::setUpdateFlash('Document has been uploaded');
				$this->redirect(array('view','id'=>$model->id));
                      
                         }
//                        else{
//                            
//                            if($model->save()){
//                                SiteReusables::setUpdateFlash('Document has been uploaded');
//				$this->redirect(array('view','id'=>$model->id)); 
//                            }
//                        }
  
                        
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=($this->articleModel==null)?new Articles('create'):$this->articleModel;
		
                $name=$model->getClassName();
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET[ $name]))
			$model->attributes=$_GET[ $name];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Articles('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Articles']))
			$model->attributes=$_GET['Articles'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        
        public function actionDownload()
        {
        if(isset($_GET['docid']))
                $id=$_GET['docid'];
        $f=$this->loadModel($id);
//         $f= Document::model()->find(array(
//             'select'=>'doc,id,status,uid',
//             'condition'=>'id=:id',
//             'params'=>array(':id'=>$id)
//         ));

           $file=$f->doc;
       $filePath=PageFilePath::uploadUrl($file,false);
       
       if (file_exists($filePath))
           {   
   $fileContent=file_get_contents($filePath);
   
   $f->updateIcounter();
 
Yii::app()->getRequest()->sendFile($file, $fileContent);


}
else
    {
    echo "The file $file does not exist";
}
        }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Articles::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='articles-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        
        
        protected function setDocCode($model){
            $name=$model->getClassName();
            $docCode=  SiteReusables::getHashKey();
            $model= new $name;
            while ($model->exists(array(
                'condition'=>'doccode=:d',
                'params'=>array(':d'=>$docCode)
            ))){
                
                $docCode=SiteReusables::getHashKey();
               
            }
             return $docCode;
        }
 
        
        
        public function getAdminOnly(){
       return $this->_adminOnly;
   }  
}
