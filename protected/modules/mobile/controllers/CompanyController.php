<?php

class CompanyController extends ASController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
    
    public function init(){
        $this->loginByHash();
        if(Dna::getId()==null){
            $dataArray=array();
            $dataArray[ASLoginForm::RESULT]=  ASLoginForm::INVALID;
            $dataArray[ASLoginForm::RESULT_CODE]=  ASLoginForm::INVALID_CODE; 
		$this->parceJson($dataArray);
                exit();
        }
}
    
	public $layout='//layouts/column2';

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
				'actions'=>array('index','view',),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','cancel','cancelcandidate','updatecandidate','selection'),
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new PmdCompany;
                 $dataArray=array();



		if(isset($_POST[PmdCompany::TITLE_FIELD]))
		{
                    $title=$_POST[PmdCompany::TITLE_FIELD];
			$model->title=$title;
                        $model->status=  $this->_autoActivate;
			if($model->save()){
                             

                            $this->loadAllWithCandidates($dataArray);
                            exit();
                        }	

                        else{
                            $dataArray[ASLoginForm::RESULT]=  ASLoginForm::INVALID;
                            $dataArray[ASLoginForm::RESULT_CODE]=  ASLoginForm::INVALID_CODE; 
                            
                        }
                        
                         
		}
                else{
                            $dataArray[ASLoginForm::RESULT]=  ASLoginForm::NO_DATA;
                            $dataArray[ASLoginForm::RESULT_CODE]=  ASLoginForm::NO_DATA_CODE; 
                            
                        }

		$this->parceJson($dataArray);
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionCancel()
	{
		
                 $dataArray=array();



		if(isset($_POST[PmdCompany::ID_FIELD]))
		{
                   $id=$_POST[PmdCompany::ID_FIELD]; 
                    $model=  PmdCompany::model()->findByPk($id);
                    if($model==null){
                         $dataArray[ASLoginForm::RESULT]=  ASLoginForm::INVALID;
            $dataArray[ASLoginForm::RESULT_CODE]=  ASLoginForm::INVALID_CODE; 
		$this->parceJson($dataArray);
                exit();
                    }
                        $model->status=4;
			if($model->save()){
                             

                            $this->loadAllWithCandidates($dataArray);
                            exit();
                        }	

                        else{
                            $dataArray[ASLoginForm::RESULT]=  ASLoginForm::INVALID;
                            $dataArray[ASLoginForm::RESULT_CODE]=  ASLoginForm::INVALID_CODE; 
                            
                        }
                        
                         
		}
                else{
                            $dataArray[ASLoginForm::RESULT]=  ASLoginForm::NO_DATA;
                            $dataArray[ASLoginForm::RESULT_CODE]=  ASLoginForm::NO_DATA_CODE; 
                            
                        }

		$this->parceJson($dataArray);
	}
        
        
        
        public function actionCancelcandidate()
	{
		
                 $dataArray=array();



		if(isset($_POST[PmdCompany::ID_FIELD]))
		{
                   $id=$_POST[PmdCompany::ID_FIELD]; 
                    $model= PmdCandidate::model()->findByPk($id);
                    if($model==null){
                         $dataArray[ASLoginForm::RESULT]=  ASLoginForm::INVALID;
            $dataArray[ASLoginForm::RESULT_CODE]=  ASLoginForm::INVALID_CODE; 
		$this->parceJson($dataArray);
                exit();
                    }
                        $model->status=6;
			if($model->save()){
                             

                            $this->loadAllWithCandidates($dataArray);
                            exit();
                        }	

                        else{
                            $dataArray[ASLoginForm::RESULT]=  ASLoginForm::INVALID;
                            $dataArray[ASLoginForm::RESULT_CODE]=  ASLoginForm::INVALID_CODE; 
                            
                        }
                        
                         
		}
                else{
                            $dataArray[ASLoginForm::RESULT]=  ASLoginForm::NO_DATA;
                            $dataArray[ASLoginForm::RESULT_CODE]=  ASLoginForm::NO_DATA_CODE; 
                            
                        }

		$this->parceJson($dataArray);
	}
        
        
         public function actionUpdatecandidate()
	{
		
                 $dataArray=array();



		if(isset($_POST[PmdCompany::ID_FIELD]) && isset($_POST[PmdCompany::STATUS_FIELD]))
		{
                   $id=$_POST[PmdCompany::ID_FIELD]; 
                   $status=$_POST[PmdCompany::STATUS_FIELD]; 
                    $model= PmdCandidate::model()->findByPk($id);
                    if($model==null){
                         $dataArray[ASLoginForm::RESULT]=  ASLoginForm::INVALID;
            $dataArray[ASLoginForm::RESULT_CODE]=  ASLoginForm::INVALID_CODE; 
		$this->parceJson($dataArray);
                exit();
                    }
                        $model->status=$status;
			if($model->save()){
                             

                            $this->loadAllWithCandidates($dataArray);
                            exit();
                        }	

                        else{
                            $dataArray[ASLoginForm::RESULT]=  ASLoginForm::INVALID;
                            $dataArray[ASLoginForm::RESULT_CODE]=  ASLoginForm::INVALID_CODE; 
                            
                        }
                        
                         
		}
                else{
                            $dataArray[ASLoginForm::RESULT]=  ASLoginForm::NO_DATA;
                            $dataArray[ASLoginForm::RESULT_CODE]=  ASLoginForm::NO_DATA_CODE; 
                            
                        }

		$this->parceJson($dataArray);
	}


	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
            if(Yii::app()->request->getQuery("extra",0)==1)
                    $this->loadAllWithCandidates ();
            else
                $this->loadAll();
                
	}
        
        
        public function actionSelection()
	{
            if(Yii::app()->request->getPost(PmdCompany::START_DATE_FIELD,null)==null)
                    $this->loadAllWithCandidates ();
            else{
            $date=$_POST[PmdCompany::START_DATE_FIELD];
            $date=  strtotime($date);
          $this->loadAllWithCandidatesByDate($date); 
            }
	}
        
        protected function loadAll($dataArrayItems=array()){
            $model=new PmdCompany('search');
		 $model->unsetAttributes(); 
               
		$data=$model->search();
                $dataArray=$data->getData();
                
                             $dataArrayItems[ASLoginForm::RESULT]=  ASLoginForm::OK;
                            $dataArrayItems[ASLoginForm::RESULT_CODE]=  ASLoginForm::OK_CODE; 
                            $content=array();
               // foreach ($dataArray as $items){
                for($i=0;$i<count($dataArray);$i++){
                    $items=$dataArray[$i];
                  $content[$i]['id']=(int)$items['id'] ; 
                  $content[$i]['title']=$items['title']; 
                  $content[$i]['last_modified']=$items['last_modified'];
                  $content[$i]['uid']=$items['uid'];
                  
                }
               // $model=array("model"=>$dataArrayItems);
                // header('Content-type: application/json'); 
               // echo json_encode($model);
                $dataArrayItems["content"]=$content;
                $this->parceJson($dataArrayItems);
        }
        
        
        
        
         protected function loadAllWithCandidates($dataArrayItems=array()){
            $model=new PmdCompany('search');
		 $model->unsetAttributes(); 
               
		$data=$model->search();
                $dataArray=$data->getData();
                
                             $dataArrayItems[ASLoginForm::RESULT]=  ASLoginForm::OK;
                            $dataArrayItems[ASLoginForm::RESULT_CODE]=  ASLoginForm::OK_CODE; 
                            $content=array();
               // foreach ($dataArray as $items){
                for($i=0;$i<count($dataArray);$i++){
                    $items=$dataArray[$i];
                  $content[$i]['id']=(int)$items['id'] ; 
                  $content[$i]['title']=  ucwords($items['title']); 
                  $content[$i]['last_modified']=$items['last_modified'];
                  $content[$i]['uid']=$items['uid'];
                  $content[$i]['content']=$this->loadCandidatesByCompanyId($items['id']);
                  
                }
               // $model=array("model"=>$dataArrayItems);
                // header('Content-type: application/json'); 
               // echo json_encode($model);
                $dataArrayItems["content"]=$content;
                $this->parceJson($dataArrayItems);
        }
        
        
        
        
        protected function loadCandidatesByCompanyId($id){
             $model=new PmdCandidate('search');
		 $model->unsetAttributes(); 
               
		
                   $data=$model->searchByCompanyId ($id);
                $dataArray=$data->getData();

                            $content=array();
               // foreach ($dataArray as $items){
                for($i=0;$i<count($dataArray);$i++){
                    $items=$dataArray[$i];
                  $content[$i]['pid']=(int)$items['id'] ; 
                  $content[$i]['job_title']=$items['title']; 
                  $content[$i]['name']= ucwords($items['fname']); 
                  $content[$i]['last_modified']=$items['last_modified'];
                  $content[$i]['company_id']=$items['company_id'];
                 // $content[$i]['uid']=$items['uid'];
                  $content[$i]['status']=(int)$items['status'];
                  
                }
                return $content;
        }
        
        
        
        protected function loadCandidatesByCompanyIdAndDate($id,$date){
             $model=new PmdCandidate('search');
		 $model->unsetAttributes(); 
               
		
                   $data=$model->searchByCompanyIdAndDate ($id,$date);
                $dataArray=$data->getData();

                            $content=array();
               // foreach ($dataArray as $items){
                for($i=0;$i<count($dataArray);$i++){
                    $items=$dataArray[$i];
                  $content[$i]['pid']=(int)$items['id'] ; 
                  $content[$i]['job_title']=$items['title']; 
                  $content[$i]['name']= ucwords($items['fname']); 
                  $content[$i]['last_modified']=$items['last_modified'];
                  $content[$i]['company_id']=$items['company_id'];
                 // $content[$i]['uid']=$items['uid'];
                  $content[$i]['status']=(int)$items['status'];
                  
                }
                return $content;
        }
        
        
         protected function loadAllWithCandidatesByDate($date,$dataArrayItems=array()){
            $model=new PmdCompany('search');
		 $model->unsetAttributes(); 
               
		$data=$model->searchBydate($date);
                $dataArray=$data->getData();
                
                             $dataArrayItems[ASLoginForm::RESULT]=  ASLoginForm::OK;
                            $dataArrayItems[ASLoginForm::RESULT_CODE]=  ASLoginForm::OK_CODE.$date; 
                            $content=array();
               // foreach ($dataArray as $items){
                for($i=0;$i<count($dataArray);$i++){
                    $items=$dataArray[$i];
                  $content[$i]['id']=(int)$items['id'] ; 
                  $content[$i]['title']=  ucwords($items['title']); 
                  $content[$i]['last_modified']=$items['last_modified'];
                  $content[$i]['uid']=$items['uid'];
                  $content[$i]['content']=$this->loadCandidatesByCompanyIdAndDate($items['id'],$date);
                  
                }
               // $model=array("model"=>$dataArrayItems);
                // header('Content-type: application/json'); 
               // echo json_encode($model);
                $dataArrayItems["content"]=$content;
                $this->parceJson($dataArrayItems);
        }

       
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=PmdCompany::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='pmd-company-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
