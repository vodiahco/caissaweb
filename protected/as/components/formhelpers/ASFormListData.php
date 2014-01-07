<?php

/**
 * SiteImages class file
 * Description of SiteImages
 * SiteImages is a static class that displays images on the web page
 * this class relies on application.viewhelpers.PageFilePath
 *
 * @author victor Odiah vodiahco1@yahoo.com
 * @category view helpers
 * 
 * 
 */
 class ASFormListData {
 
        
        
        /**
         * Generates a list data for the site languages
         * @return type array CHtml::listData
         */
        public static function siteLanguageListData(){
            $criteria= new CDbCriteria(array(
                'condition'=>'remove=:rem',
                'params'=>array(':rem'=>0)
            ));
            $array= SiteTextLanguage::model()->findAll($criteria);
            return CHtml::listData($array,'language_code','language');
        }
        
        /**
         * Generates a list data for gender
         * @return type array CHtml::listData
         */
        public static function genderListData(){
            return array(1=>'Male',2=>'Female');
        }
        
        
        
         public static function currentYearListData(){
             $year=date("y");
            return array($year=>$year);
        }
        
        
         /**
         * Generates a list data for status
         * @return type array CHtml::listData
         */
        public static function statusListData(){
           return array(
            '0'=>'Draft',
            '1'=>'Published',
            '2'=>'Archived',
            '3'=>'Removed'
        );
            
        }
        
         /**
         * Generates a list data for status
         * @return type array CHtml::listData
         */
        public static function orderStatusListData(){
           return array(

            '0'=>'Pending',
            '1'=>'Collected'
        );
            
        }
        
        
        
         public static function nameTitleListData(){
           return array(
            'Mr'=>'Mr',
            'Mrs'=>'Mrs',
               'Miss'=>'Miss'
            
        );
            
        }
        
         /**
         * Generates a list data for switching settings
         * @return type array 
         */
        public static function switchListData(){
            return array(1=>'ON',0=>'OFF');
        }
        
        
                 /**
         * Generates a list data for yes or no
         * @return type array 
         */
        public static function yesNoListData(){
            return array(1=>'Yes',0=>'No');
        }
        
        
         /**
         * Generates a list data for switching settings
         * @return type array 
         */
        public static function scopeListData(){
            return array(1=>'Public',0=>'Private');
        }
        
        
        /**
         * Generates a list data for switching between private and public
         * @return type array 
         */
        public static function visibilityListData(){
            return array(1=>'Private',0=>'Public');
        }
        
         public static function categorylistData($name=false){
        $model= PostCategory::model()->findAll(array(
            'condition'=>'status=:rem and (church_id=0 or church_id=:chid)',
            'params'=>array(':rem'=>1,
                             ':chid'=>  Dna::getChid())
        ));
        if($name)
            return $data=CHtml::listData($model,'title','title');
        return $data=CHtml::listData($model,'id','title');
    }
    
    
    public static function countrylistData($name=false){
        $model= Countries::model()->findAll(array(
            'condition'=>'status=:rem',
            'order'=> 'name ASC',
            'params'=>array(':rem'=>1)
        ));
        if($name)
            return $data=CHtml::listData($model,'name','name');
        return $data=CHtml::listData($model,'alpha_2','name');
    }
    
    
     /**
         * Generates a list data for the site languages
         * @return type array CHtml::listData
         */
        public static function soapListData(){
            $criteria= new CDbCriteria(array(
                'condition'=>'status=:rem',
                'params'=>array(':rem'=>1)
            ));
            $array= Soap::model()->findAll($criteria);
            return CHtml::listData($array,'id','title');
        }
    
        
        
         /**
         * Generates a list data for the site languages
         * @return type array CHtml::listData
         */
        public static function groupListData(){
            $criteria= new CDbCriteria(array(
                'condition'=>'status=:rem',
                'params'=>array(':rem'=>1)
            ));
            $array= Group::model()->findAll($criteria);
            return CHtml::listData($array,'id','name');
        }
    
   
        
         
}

?>
