<?php


/**
 * Description of Gbmailer
 * model for sending mails and alerts to users
 *
 * @author Daniel Käfer
 */
class ASMailer {




/*
    Name:           eMail
    Description:    Simple sending eMail in text and HTML with CC, BCC and attachment
    Version:        1.0
    last modified:  2004-05-14

    Autor:          Daniel Käfer
    Homepage:       http://www.danielkaefer.de

    Leave this header in this file!
*/


    protected $to = array();

    protected $boundary = "";
    protected $header = "";
    public $subject;
    protected $body;
    
    //public  $name;
   // public $mail;
    public $text;
    protected $mymail;
    protected $senderName;


public function	init()
    {
        $this->boundary = md5(uniqid(time()));
        //self:: $header .= "From: $this->name <$this->mymail>\n";
        $this->mymail=Yii::app()->params['adminEmail'];
        $this->senderName=Yii::app()->params['adminName'];
        
    }

   public function setTo($to)
    {
    	$this->to[] = $to;
    }


   public function text()
    {
	    $this->body = "Content-Type: text/plain; charset=ISO-8859-1\n";
	    $this->body .= "Content-Transfer-Encoding: 8bit\n\n";
	    $this->body .= $this->text."\n";
    }

  public function html()
    {
	    $this->body = "Content-Type: text/html; charset=ISO-8859-1\n";
	    $this->body .= "Content-Transfer-Encoding: quoted-printable\n\n";
	    $this->body .= "<html><body>\n".$this->text."\n</body></html>\n";
    }

	public function send($subject,$text)
    {
            ///check logic
            //$this->setTo($to);
//  $body = "Content-Type: text/plain; charset=ISO-8859-1\n";
//	    $body .= "Content-Transfer-Encoding: 8bit\n\n";
            
            
	    $body = $text."\n";
            
            //set header
   $header = "From:".Yii::app()->params['adminName']." <".Yii::app()->params['adminEmail'].">\n";
      
       // $header .= "MIME-Version: 1.0\n";
	    $header .= "Content-Type: text/plain; charset=ISO-8859-1\n";
	    $header .= "Content-Transfer-Encoding: 8bit\n\n";
        $header .= "--".md5(uniqid(time()))."\n";
        
      // $header.= $body;

       // $header .= "--".md5(uniqid(time()))."--\n\n";
        
        

        foreach($this->to as $mail)
        {
            mail($mail,$subject,$body,$header);
        }
    }






}
?>
