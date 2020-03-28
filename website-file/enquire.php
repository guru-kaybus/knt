<?php


       $companyname=ucfirst($_REQUEST["name"]);
       //$subjects=ucfirst($_REQUEST["FieldData3"]);
       //$phone=$_REQUEST["FieldData2"];
       //if($phone != ""){ $strno=$phone; } else { $strno="-"; }
       $email=$_REQUEST["email"];
       $comments=ucfirst($_REQUEST["message"]);

    // MAIL SUBJECT

    $subject = "Enquire from ".$companyname;

    // TO MAIL ADDRESS


    $to="info@knt.co.in";

     $message= "Hi ! This is " . $companyname ."\n";
	
	 
          $message .="MESSAGE :";
	  $message .= $comments."\n";
          $from = $email;
	  $header="From:$from";

      
    // SEND MAIL

       @mail($to, $subject, $message, $header);
    
	   header('Location: success.html');


?>