<?php


       $name=ucfirst($_REQUEST["name"]);
 


       $phone=$_REQUEST["mobile"];
      

    $email=$_REQUEST["email"];
    $skills=ucfirst($_REQUEST["skills"]);


    $strresume_name=$_FILES["resume"]["name"];
    $strresume_type=$_FILES["resume"]["type"];
    $strresume_size=$_FILES["resume"]["size"];
    $strresume_temp=$_FILES["resume"]["tmp_name"];



    if($strresume_type=="application/octet-stream" or $strresume_type=="text/plain" or $strresume_type=="application/msword ")
    {

        $message= '


            <table cellspacing="0" cellpadding="8" border="0" width="400">
            <tr>
                <td colspan="2"></td>
            </tr>
            <tr bgcolor="#eeeeee">
                <td style="font-family:Verdana, Arial; font-size:11px; color:#333333;"><strong>Name</strong></td>
                <td style="font-family:Verdana, Arial; font-size:11px; color:#333333;">'.$name.'</td>
            </tr>
            
              
              <tr><td colspan="2" style="padding:0px;"><img src="images/whitespace.gif" alt="" width="100%" height="1" /></td></tr>
            <tr bgcolor="#eeeeee">
              <td style="font-family:Verdana, Arial; font-size:11px; color:#333333;"><strong>Contact No.</strong></td>
              <td style="font-family:Verdana, Arial; font-size:11px; color:#333333;">'.$mobile.'</td>
              </tr>
            <tr><td colspan="2" style="padding:0px;"><img src="images/whitespace.gif" alt="" width="100%" height="1" /></td></tr>
            <tr bgcolor="#eeeeee">
                <td style="font-family:Verdana, Arial; font-size:11px; color:#333333;"><strong>Email</strong></td>
                <td style="font-family:Verdana, Arial; font-size:11px; color:#333333;">'.$email.'</td>
            </tr>
            <tr><td colspan="2" style="padding:0px;"><img src="images/whitespace.gif" alt="" width="100%" height="1" /></td></tr>

            <tr bgcolor="#eeeeee">
                <td colspan="2" style="font-family:Verdana, Arial; font-size:11px; color:#333333;"><strong>Comments</strong></td>
            </tr>
            <tr bgcolor="#eeeeee">
                <td colspan="2" style="font-family:Verdana, Arial; font-size:11px; color:#333333;">'.$skills.'</td>
            </tr>

            <tr><td colspan="2" style="padding:0px;"><img src="images/whitespace.gif" alt="" width="100%" height="1" /></td></tr>
         </table>




';

    // MAIL SUBJECT

    $subject = "Resume ".$name;

    // TO MAIL ADDRESS


    $to="prakash.p.roy@gmail.com";

/*
    // MAIL HEADERS

    $headers  = "MIME-Version: 1.0\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\n";
    $headers .= "From: Name <name@name.com>\n";

*/



    // MAIL HEADERS with attachment

    $fp = fopen($strresume_temp, "rb");
    $file = fread($fp, $strresume_size);

    $file = chunk_split(base64_encode($file));
    $num = md5(time());

        //Normal headers

    $headers  = "From: $strname.<$stremail>\r\n";
       $headers  .= "MIME-Version: 1.0\r\n";
       $headers  .= "Content-Type: multipart/mixed; ";
       $headers  .= "boundary=".$num."\r\n";
       $headers  .= "--$num\r\n";

        // This two steps to help avoid spam

    $headers .= "Message-ID: <".gettimeofday()." TheSystem@".$_SERVER['SERVER_NAME'].">\r\n";
    $headers .= "X-Mailer: PHP v".phpversion()."\r\n";

        // With message

    $headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";
       $headers .= "Content-Transfer-Encoding: 8bit\r\n";
       $headers .= "".$message."\n";
       $headers .= "--".$num."\n";

        // Attachment headers

    $headers  .= "Content-Type:".$strresume_type." ";
       $headers  .= "name=\"".$strresume_name."\"r\n";
       $headers  .= "Content-Transfer-Encoding: base64\r\n";
       $headers  .= "Content-Disposition: attachment; ";
       $headers  .= "filename=\"".$strresume_name."\"\r\n\n";
       $headers  .= "".$file."\r\n";
       $headers  .= "--".$num."--";



    // SEND MAIL

       @mail($to, $subject, $message, $headers);


     fclose($fp);

      header('Location: success.html');

}
else
    {
        echo '<font style="font-family:Verdana, Arial; font-size:11px; color:#F3363F; font-weight:bold">Wrong file format. Mail was not sent.</font>';
        "<script>window.location.href='careers.html';</script>";
    }

?>