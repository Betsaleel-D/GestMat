<?php
session_start();
?>
              <?php

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
                    $req = $bdd->prepare('SELECT * FROM employe WHERE email =:email');
                 
                    $req->execute(array(
                        'email' => $_SESSION["Auth"]['email']
                    ));
                    $resultat = $req->fetch();
               
                if (!empty($_SESSION['Auth'])) 
                {
                     if($resultat['accreditation'] == 2) 

                    {
                       header('location: gestion.php');
                        
                    }
                    elseif($resultat['accreditation'] == 1)
                    { 
                        header('location: messagerie_des_employes.php');

                    }
                 }
                        
                ?>

                