<?php
session_start();
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=gestionmateriels;charset=utf8', 'root','');
    }
    catch(Exception $e)
    {
        die('Erreur' .$e->getMessage());
    }           
?>

<?php
//enregistrement des messages liés à une commande
  $date=date("Y.m.d.H:i:s");
  //echo $date;
  $niveau = "En cours";
      $reponse = $bdd->prepare('INSERT INTO messagerie (email_emetteur, email_recepteur, messages, date_message, titre, id_demande_m, prenom_emetteur) 
      VALUES(:email_emetteur, :email_recepteur, :messages, :date_message, :titre, :id_demande_m, :prenom_emetteur)');
      $reponse -> execute(array(
      'email_emetteur' => $_SESSION['Auth']['email'],
      'email_recepteur' => $_GET['email'],
      'messages' => $_POST['message'],
      'date_message' => $date,
      'titre' => $_POST['titre'],
      'id_demande_m' => $_GET['id_cmd'],
      'prenom_emetteur' => $_GET['prenom_emetteur']
      ));
?>

<?php
//echo $_GET['prenom_emetteur'] .$_GET['id_cmd'] .'----------'.$_POST['message'] .$_POST['titre'] .$_GET['email'] .$_SESSION['Auth']['email'] .$date;
    header("location: gestion.php");  
?>

