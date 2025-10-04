   <?php

   /*$to = "harris@f5tech.ae";
   $subject = "Perfect store email test";

   $message = "<b>This is HTML message.</b>";
   $message .= "<h1>This is headline.</h1>";

   $header = "From:harris@f5tech.ae \r\n";
   // $header .= "Cc:afgh@somedomain.com \r\n";
   $header .= "MIME-Version: 1.0\r\n";
   $header .= "Content-type: text/html\r\n";

   $retval = mail($to, $subject, $message, $header);

   if ($retval == true) {
      echo "Message sent successfully...";
   } else {
      echo "Message could not be sent...";
   }*/
   $aResult = array();

   $customeremail = isset($_POST['emailInput']) ? $_POST['emailInput'] : false;
   $subject = isset($_POST['subject']) ? $_POST['subject'] : false;
   $message = isset($_POST['message']) ? $_POST['message'] : false;

   if ($customeremail != false) {
      if ($subject != false) {
         if ($message != false) {
            $toEmail = "perfectsmilecenter@gmail.com";
            //$toEmail = "harris@f5tech.ae";
            $subject = $subject;
            $message = $message;
            $success = sendMail($toEmail, $subject, $message, $customeremail);
            if ($success) {
               $aResult['result'] = 'Mail sent successfully.';
            } else {
               $aResult['error'] = 'Mail not sent.';
            }
         } else {
            $aResult['error'] = 'Failed sending email. Email message not entered.';
         }
      } else {
         $aResult['error'] = 'Failed sending email. Email subject not entered.';
      }
   } else {
      $aResult['error'] = 'Failed sending email. Email id not entered.';
   }
   echo json_encode($aResult);
   ?>
   <?php


   function spamcheck($field)
   {
      //filter_var() sanitizes the e-mail
      //address using FILTER_SANITIZE_EMAIL
      $field = filter_var($field, FILTER_SANITIZE_EMAIL);

      //filter_var() validates the e-mail
      //address using FILTER_VALIDATE_EMAIL
      if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
         return true;
      } else {
         return false;
      }
   }

   function sendMail($toEmail, $subject, $message, $customeremail)

   {

      $headers = "From: $customeremail \r\n";
      // $header .= "Cc:afgh@somedomain.com \r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

      $validFromEmail = spamcheck($customeremail);
      $emailSuccess = false;
      if ($validFromEmail) {
         $emailSuccess = mail($toEmail, $subject, $message, $headers);
      }
      //echo ("emailSuccess->" . $emailSuccess . " . ");
      return $emailSuccess;
   }

   ?>

