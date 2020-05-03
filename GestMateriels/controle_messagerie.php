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
                
                if (!empty($_SESSION['Auth'])) 
                {
                    $req = $bdd->prepare('SELECT * FROM employe WHERE email =:email');
                 
                    $req->execute(array(
                        'email' => $_SESSION["Auth"]['email']
                    ));
                    $resultat = $req->fetch();
                    
                     if($resultat['accreditation'] == 2) 

                    {
                       header('location: messagerie.php');    
                    }
                    elseif($resultat['accreditation'] == 1)
                    { 
                        header('location: messagerie.php');
                    }
                }
                        
                ?>

                