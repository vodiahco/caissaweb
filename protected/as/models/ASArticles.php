<?php

/**
 * This is the model class for table "{{articles}}".
 *
 * The followings are the available columns in table '{{articles}}':
 * @property integer $id
 * @property integer $uid
 * @property string $title
 * @property string $abstract
 * @property string $post
 * @property integer $active
 * @property string $date_created
 * @property string $last_modified
 * @property integer $remove
 * @property string $doccode
 * @property string $hashname
 * @property string $photo
 * @property string $photo_title
 * @property string $photo_small
 * @property integer $icounter
 * @property integer $category
 * @property string $photo_desc
 */
class ASArticles extends ASModel
{
    
    private $isDoc=false;
    
    private $isPhoto=false;
    
    public $uploadDocModel;
    public $uploadPhotoModel;

    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Articles the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{articles}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, abstract,post', 'required'),
			array('uid, remove, active', 'numerical', 'integerOnly'=>true),
			array('title, doc, photo', 'length', 'max'=>255),
			array('abstract, date_created', 'safe'),
                         array('doc_size', 'length', 'max'=>20),
			array('doc_type', 'length', 'max'=>10),
                    array('doc', 'file','types'=>'doc,docx,pdf,ppt,pptx,txt','allowEmpty'=>true,'skipOnError'=>false,'on'=>'create'),
                     array('doc', 'file','types'=>'doc,docx,pdf,ppt,pptx,txt','allowEmpty'=>true,'skipOnError'=>false,'on'=>'update'),
                    array('photo_title', 'length', 'max'=>100),
                    array('photo_desc', 'length', 'max'=>600),
                    array('photo', 'file','types'=>'jpg,jpeg,gif,png','allowEmpty'=>false,'skipOnError'=>false,'on'=>'create'),
                     array('photo', 'file','types'=>'jpg,jpeg,gif,png','allowEmpty'=>true,'skipOnError'=>false,'on'=>'update'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, abstract, doc, photo,photo_desc, uid, remove, active, date_created, last_modified, icounter', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'uid' => 'Uid',
			'title' => 'Title',
			'abstract' => 'Abstract',
			'post' => 'Post',
			'active' => 'Active',
			'date_created' => 'Date Created',
			'last_modified' => 'Last Modified',
			'remove' => 'Remove',
			'doccode' => 'Doccode',
			'hashname' => 'Hashname',
			'photo' => 'Photo',
			'photo_title' => 'Photo Title',
			'icounter' => 'Icounter',
			'category' => 'Category',
			'photo_desc' => 'Photo Desc',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('abstract',$this->abstract,true);
		$criteria->compare('post',$this->post,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('last_modified',$this->last_modified,true);
		$criteria->compare('remove',$this->remove);
		$criteria->compare('doccode',$this->doccode,true);
		$criteria->compare('hashname',$this->hashname,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('photo_title',$this->photo_title,true);
		$criteria->compare('photo_small',$this->photo_small,true);
		$criteria->compare('icounter',$this->icounter);
		$criteria->compare('category',$this->category);
		$criteria->compare('photo_desc',$this->photo_desc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        /**
         * set isDoc to true 
         */
        public function setDoc(){
            $this->isDoc=true;
        }
        
        /**
         * set isPhoto to true 
         */
         public function setPhoto(){
            $this->isPhoto=true;
        }
        
        
        /**
         * set isDoc to true 
         */
        public function getDoc(){
            return $this->isDoc;
        }
        
        /**
         * set isPhoto to true 
         */
         public function getPhoto(){
            return $this->isPhoto;
        }
        
        
         protected function setDocName($doc){
            return Dna::getSchool()."_".strtotime('now')."_".$doc;
        }
        
        
          protected function setDocCode(){
            $name=$this->getClassName();
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
        
        
        
        
        public function loadDoc(){
            $doc=CUploadedFile::getInstance($this,'doc');
                                
                                if($doc==null){
                                   $this->addError('doc', "please add a document");
                                }
                                
                                $this->setDoc();
                                $doctype=$doc->getExtensionName();
                                $docsize=$doc->size;
                                $docname=  $this->setDocName($doc->name);
                                $this->doc=$docname;
                                $this->docsize=$docsize;
                                $this->doctype=$doctype;
                            //    $model->isactive=  SiteTexts::getActive();
                        $this->doccode=$this->setDocCode();
                       // $model->context="document";
                        $this->uploadDocModel=$doc;
        }
        
        public function loadPhoto(){
             $photo= $this->photo = EUploadedImage::getInstance($this,'photo');
                                $photo->maxWidth = 300;
                                $photo->maxHeight = 400;
                                
                                $this->photo->thumb = array(
                                'maxWidth' => 50,
                                'maxHeight' => 100,
                               'dir' => 'thumb_upload',
//                                'prefix' => 'tx_',
);

                                
                                if($photo==null){
                                   $this->addError('photo', "please add a photo");
                                  
                                }
                                $this->setPhoto();
                                $doctype2=$photo->getExtensionName();
                                $docsize2=$photo->getSize();
                                $docname2=  strtotime('now')."_".$photo->getName();
                                $this->photo=$docname2;
                                $this->uploadPhotoModel=$photo;
        }
        
        
        
}