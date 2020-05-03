<?php

    $email_message = "Détail.\n\n";
  //  $email_message .= "Nom: ".$nom."\n";
  //  $email_message .= "Prenom: ".$prenom."\n";
   // $email_message .= "Email: ".$_POST['email']."\n";
   $email_message .= $_POST['message'] ;
   
    $email = $_POST['email'];
 
    // create email headers
    $headers = 'From: '.$email."\r\n".
    'Reply-To: '.$email."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    mail($email, $_POST['titre'], $email_message, $headers);
?>