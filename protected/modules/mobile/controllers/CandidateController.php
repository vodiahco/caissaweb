<?php

class CandidateController extends ASController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
        
        protected $searchById=false;


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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new PmdCandidate;

		$dataArray=array();



		if(isset($_POST[PmdCandidate::JOB_TITLE_FIELD]) && isset($_POST[PmdCandidate::FNAME_FIELD]) 
                         && isset($_POST[PmdCandidate::COMPANY_ID_FIELD]))
		{
                    $title=$_POST[PmdCandidate::JOB_TITLE_FIELD];
                    $company_id=$_POST[PmdCandidate::COMPANY_ID_FIELD];
                    $fname=$_POST[PmdCandidate::FNAME_FIELD];
                   
			$model->title=$title;
                        $model->company_id=$company_id;
                        $model->fname=$fname;
                       
			if($model->save()){
                             

                            $this->loadAll($dataArray);
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
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PmdCandidate']))
		{
			$model->attributes=$_POST['PmdCandidate'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
            if(Yii::app()->request->getQuery('id',0)>0)
                $this->searchById=true;
		$this->loadAll();
	}
        
         protected function loadAll($dataArrayItems=array()){
            $model=new PmdCandidate('search');
		 $model->unsetAttributes(); 
               
		$data=$model->search();
                if($this->searchById){
                    $id=Yii::app()->request->getQuery('id',0);
                   $data=$model->searchByCompanyId ($id);
                }
                $dataArray=$data->getData();
                
                             $dataArrayItems[ASLoginForm::RESULT]=  ASLoginForm::OK;
                            $dataArrayItems[ASLoginForm::RESULT_CODE]=  ASLoginForm::OK_CODE; #
                            $content=array();
               // foreach ($dataArray as $items){
                for($i=0;$i<count($dataArray);$i++){
                    $items=$dataArray[$i];
                  $content[$i]['pid']=(int)$items['id'] ; 
                  $content[$i]['job_title']=$items['title']; 
                  $content[$i]['name']=  ucfirst($items['fname']); 
                  $content[$i]['last_modified']=$items['last_modified'];
                  $content[$i]['company_id']=$items['company_id'];
                  $content[$i]['status']=(int)$items['status'];
                  
                }
               // $model=array("model"=>$dataArrayItems);
                // header('Content-type: application/json'); 
               // echo json_encode($model);
                $dataArrayItems["content"]=$content;
                $this->parceJson($dataArrayItems);
        }


	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new PmdCandidate('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PmdCandidate']))
			$model->attributes=$_GET['PmdCandidate'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=PmdCandidate::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='pmd-candidate-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
