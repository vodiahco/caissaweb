<?php

/**
 * Description of pageFilePath
 * A helper class to hold paths to images, css and js files
 * @var $page string the file to locate
 *
 * @author victor Odiah vodiahco1@yahoo.com
 * @category view helpers
 * @final final
 */
final class SiteContainers {
    /*
     * blockWrapper encapsulates the div openning and clossing tags
     * @var subHeading string subheading wrapped in h2 tags
     * @var head css class for the heading div
     * @var body css class for the body div
     */

    public static function blockWrapper($subHeading,$text,$head='setupDivHead',$body='setupDivBody_nobg'){

        if(!isset($head)|| $head=="")
       $head='setupDivHead';

        if(!isset($body) || $body=="")
       $body='setupDivBody_nobg';
        ?>
  <div class="setupDiv_auto">

     <!--sub heading-->
        <div class="<?php echo $head; ?>">

<?php echo $subHeading; ?>

</div> <!--setupDivBody_Bttm_border-->


<div class="<?php echo $body; ?>">
       
<?php 
/* 
* @var text text content 
*/
     echo $text;
     ?>

</div>


     </div><!--setupDiv_marginTop-->

<?php
    }
    
/*
 * div block capsule with openning tags
    
 */

public static function beginBlockWrapper() {

     return "<div class='setupDiv_auto'>";
    
}



/*
 * div block capsule with openning and closing tags

 */

public static function bodyBlockWrapper($text,$body='setupDivBody_nobg') {


     $info="<div class='".$body."'>";

$info.=$text;

     $info.="</div>";
     return $info;

}


/*
 * div block capsule with openning and closing tags for heading

 */

public static function headBlockWrapper($text='',$head='setupDivHead') {

   
     $info="<div class='".$head."'>";
  
$info.=$text;
     
     $info.="</div>";
     return $info;
     
}


public static function titleBlockWrapper($text='',$head='setupDivBody_bg_border') {


     $info="<div class='".$head."'>";

$info.=$text;

    $info.="</div>";
         return $info;
    
}


/*
* div block capsule with closing tags

*/

public static function endBlockWrapper() {
     

     return "</div>";
    
}



 public static function flexibleWraper($text="",$class=""){
     $info="<div class='".$class."'>";

$info.=$text;

    $info.="</div>";
         return $info;
    
        
    }
    

    
    public static function pageHeader($text,$class="gb-page-header",$h="h1"){
 return "<$h class='$class'>$text</$h>";
}


 public static function pageSubHeader($text,$class="h3",$h="p"){
 return "<$h class='$class'>$text</$h>";
}


public static function errorBlock($error="Error!"){
    return "<div class='flash-error'>$error</div>";
}

public static function pWrap($text, $class=""){
    return "<p class='$class'>$text</p>";
}

public static function spanWrap($text, $class="",$showBracket=false){
    if($showBracket)
        return "<span class='$class'>($text)</span>";
    return "<span class='$class'>$text</span>";
}

public static function divider($class="divider"){
    return "<hr class='$class'/>";
}

public static function hrDivider($class="append-bottom prepend-top"){
    return "<hr class='$class'/>";
}


public static function elementWrap($text,$element="p",$class=""){
    return "<$element class=".$class.">".$text."</$element>";
}

public static function counterWrapper($numb, $class="",$bracket=true,$label=""){
   
   if($bracket)
    return ($numb>0)?"<span class='$class'> ($label $numb)</span>":"";
   else
   return ($numb>0)?"<span class='$class'> $label $numb</span>":"";
       
}


public static function info($text=""){
     $info="<div class='alert alert-info'>";

$info.=$text;

    $info.="</div>";
         return $info;
    
        
    }
    
    public static function success($text=""){
     $info="<div class='alert alert-success'>";

$info.=$text;

    $info.="</div>";
         return $info;
    
        
    }
    public static function error($text=""){
     $info="<div class='alert alert-error'>";

$info.=$text;

    $info.="</div>";
         return $info;
    
        
    }
    


}

?>
